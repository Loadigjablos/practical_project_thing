<?php

    //error handler function
    function customError($errno, $errstr) {
        echo " ";
    }
    
    //set error handler
    set_error_handler("customError");

    // this handel the request and response.
    use Psr\Http\Message\ResponseInterface as Response; 
    use Psr\Http\Message\ServerRequestInterface as Request;

    // This allows to Using Slim and build our application.
    use Slim\Factory\AppFactory;
    use ReallySimpletoken\Token;

    // all the libraries we need.
    require __DIR__ . "/../vendor/autoload.php";
    
    // self made functions
    require_once "Controler/validation.php";
    require "Model/users.php";
    require "Model/classes.php";
    require "Model/company.php";
    require "Model/students.php";
    require "Model/resp_people.php";

    require_once "Controler/error-and-info-messages.php";

    // all response data will be in the Json Fromat
    header("Content-Type: application/json");

    $app = AppFactory::create();

    $app->setBasePath("/API/V1");

    /**
     * This will work
     * @param args 
     * @param request_body 
     * @return response 
     */
    $app->post("/Login", function (Request $request, Response $response, $args) {

        // reads the requested JSON body
        $body_content = file_get_contents("php://input");
        $JSON_data = json_decode($body_content, true);

        // if JSON data doesn't have these then there is an error
        if (isset($JSON_data["username"]) && isset($JSON_data["password"])) {
        } else {
            error_function(400, "Please fill in the fields (username & Password)");
        }

        // Prepares the data to prevent bad data, SQL injection andCross site scripting
        $username = validate_string($JSON_data["username"]);
        $password = validate_string($JSON_data["password"]);

        if (!$password) {
            error_function(400, "password is invalid, must contain at least 5 characters");
        }
        
        if (!$username) {
            error_function(400, "username is invalid, must contain at least 5 characters");
        }
        
        $password = hash("sha256", $password);
        
        $user = get_user_by_username($username);
        
        if ($user["password"] !==  $password) {
            error_function(404, "not Found");
        }        
        
        $token = create_token($username, $password, $user["user_id"]);
        setcookie("token", $token, time() + 3600);
        message_function(200, "Successfully logged in");
        
        return $response;
    });

    function user_validation($required_role = null) {
        $current_user_id = validate_token();
        $current_user_role = get_user_role($current_user_id);
        if ($required_role !== null && $current_user_role !== $required_role) {
            error_function(403, "Access Denied");
        }
        return $current_user_id;
    }

    $app->get("/WhoAmI", function (Request $request, Response $response, $args) {
        // unotherized pepole will get rejected
        $id = user_validation();
		$user = get_legal_user_by_id($id);

		if ($user) {
	        echo json_encode($user); 
		}
		else if (is_string($user)) {
			error_function(500, $user);
		}
		else {
			error_function(404, "The ID "  . $id . " was not found.");
		}

        return $response;
    });
   
    require "Controler/routes/users.php";
    require "Controler/routes/company.php";
    require "Controler/routes/classes.php";
    require "Controler/routes/students.php";
    require "Controler/routes/resp_people.php";

    $app->run();
?>
