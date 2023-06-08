<?php
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;

    $app->get("/Classes", function (Request $request, Response $response, $args) {
  
        validate_token(); // unotherized pepole will get rejected

		$class = get_classes();

		if ($class) {
            echo json_encode($class);
		}
		else if (is_int($class)) {
			error_function($class, 500);
		}
		else {
			error_function(404, "The ID "  . $class["class_name"] . " was not found.");
		}

        return $response;
    });

    $app->get("/Class", function (Request $request, Response $response, $args) {
        //everyone
        validate_token(); // unotherized pepole will get rejected

        $class = get_classes();

        if ($class) {
            echo json_encode($class);
        }
        else if (is_string($class)) {
            error_function(500, $class);
        }
        else {
            error_function(400, "There is no class");
        }

        return $response;
    });


    $app->post("/Class", function (Request $request, Response $response, $args) {
        $id = user_validation("A");
        validate_token();

        $request_body_string = file_get_contents("php://input");
        $request_data = json_decode($request_body_string, true);
        $class_name = trim($request_data["class_name"]);
        $specialization = trim($request_data["specialization"]);
        $yaer_qv = trim($request_data["yaer_qv"]);
    
        //The position field cannot be empty and must not exceed 2048 characters
        if (empty($class_name)) {
            error_function(400, "The (class_name) field must not be empty.");
        } 
        elseif (strlen($class_name) > 2048) {
            error_function(400, "The (class_name) field must be less than 2048 characters.");
        }
    
        //The name field cannot be empty and must not exceed 255 characters
        if (empty($specialization)) {
            error_function(400, "The (name) field must not be empty.");
        } 
        elseif (strlen($specialization) > 255) {
            error_function(400, "The (name) field must be less than 255 characters.");
        }
    
        //The type field must be an uppercase alphabetic character
        if (empty($yaer_qv)) {
            error_function(400, "Please provide the (type) field.");
        } 
        elseif (strlen($yaer_qv) > 255) {
            error_function(400, "The (name) field must be less than 255 characters.");
        }
    
        //checking if everything was good
        if (create_class($class_name, $specialization, $yaer_qv) === true) {
            message_function(200, "The class was successfully created.");
        } else {
            error_function(500, "An error occurred while saving the class.");
        }
        return $response;        
    });

    $app->delete("/class/{class_name}", function (Request $request, Response $response, $args) {
		$id = user_validation("A");
        validate_token();
		
		$class_name = $args["class_name"];
		
		$result = delete_class($class_name);
		
		if (!$result) {
			error_function(404, "No class found for the Name " . $class_name . ".");
		}
		else {
			message_function(200, "The class was succsessfuly deleted.");
		}
		
		return $response;
	});
?>