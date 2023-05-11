<?php

    //error handler function
    function customError($errno, $errstr) {
        echo " ";
    }
    
    //set error handler
    //set_error_handler("customError");

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
        if (isset($JSON_data["email"]) && isset($JSON_data["password"])) {
        } else {
            error_function(400, "Empty request");
        }

        // Prepares the data to prevent bad data, SQL injection andCross site scripting
        $email = validate_string($JSON_data["email"]);
        $password = validate_string($JSON_data["password"]);

        if (!$password) {
            error_function(400, "password is invalid, must contain at least 5 characters");
        }

        if (!$email) {
            error_function(400, "email is invalid, must contain at least 5 characters");
        }

        $password = hash("sha256", $password);

        $user = get_user_by_username($email);

        if ($user["passwdhash"] !==  $password) {
            error_function(404, "not Found");
        }

        // Send email with .ics file contents as the email body
        $to = $user["email"];
        $subject = "Thanks for your login";
        $message1 = "<h1>This is your password: </h1>";
        $message2 =  hash("sha256", rand(10000, 100000));
        $headers = "From: morhaf.mouayad@gmail.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html\r\n";
        $body = $message1 . $message2;
        
        if (!mail($to, $subject, $body, $headers, "-r morhaf.mouayad@gmail.com")) {
            error_function(400, "Email sending failed, but the login was seccussfully.");
            return false;
        }
        
        $timeout = date('H:i:s', strtotime('+20 minutes'));
        $user_id = $user["id"];
        $temp = create_temp($user_id, $message2, $timeout);

        message_function(200, "Successfully logged in");
        
        return $response;
    });

    $app->post("/Validatemail", function (Request $request, Response $response, $args) {

        $body_content = file_get_contents("php://input");
        $JSON_data = json_decode($body_content, true);

        // if JSON data doesn't have these then there is an error
        if (isset($JSON_data["email"]) && isset($JSON_data["hash"])) {
        } else {
            error_function(400, "Empty request");
            return;
        }

        // Prepares the data to prevent bad data, SQL injection andCross site scripting
        $email = validate_string($JSON_data["email"]);
        $hash = validate_string($JSON_data["hash"]);

        if (!$hash) {
            error_function(400, "hash is invalid, must contain at least 5 characters");
            return;
        }

        if (!$email) {
            error_function(400, "email is invalid, must contain at least 5 characters");
            return;
        }

        $tempData = get_id_by_email($email);

        $tempData = $tempData["id"];

        $temp = get_temp_by_user_id($tempData);

        $temp = $temp["hash"];

        if ($temp !==  $hash) {
            error_function(404, "not Found");
            return false;
        }

        $token = create_token($user["id"]);

        setcookie("token", $token, time() + 3600);
    });

    function user_validation($required_role = null) {
        $current_user_id = validate_token();
        $current_user_role = get_user_type($current_user_id);
        if ($required_role !== null && $current_user_role !== $required_role) {
            error_function(403, "Access Denied");
        }
        return $current_user_id;
    }

    $app->get("/WhoAmI", function (Request $request, Response $response, $args) {
        // unotherized pepole will get rejected
        $id = user_validation();
		$user = get_user_id($id);

		if ($user) {
	        echo json_encode(200, $user);
		}
		else if (is_string($user)) {
			error_function(500, $user);
		}
		else {
			error_function(404, "The ID "  . $id . " was not found.");
		}

        return $response;
    });

        //old hash should be deleted
        $app->get('/Time', function (Request $request, Response $response, $args) {
            // Connect to the database
            global $database;
        
            // Query the database for expired temp
            $result = $database->query("SELECT id FROM temp WHERE timeout < NOW();");
        
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $id = $row['id'];
        
                // Delete the expired temp
                $delete_result = $database->query("DELETE FROM temp WHERE id = '$id';");
        
                if ($delete_result) {
                    error_function(200, "Expired reservation with ID $id has been deleted. ");
                    return true;
                } else {
                    error_function(400, "Error deleting reservation.");
                    return false;
                }
            } 
            else {
                error_function(400, "No expired reservations found.");
                return  false;
            }
        });
   
    require "Controler/routes/users.php";
    require "Controler/routes/company.php";
    require "Controler/routes/classes.php";

    $app->run();
?>
