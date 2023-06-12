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
        $QV_year = trim($request_data["QV_year"]);
    
        //The position field cannot be empty and must not exceed 2048 characters
        if (empty($class_name)) {
            error_function(400, "The (class_name) field must not be empty.");
        } 
        elseif (strlen($class_name) > 2048) {
            error_function(400, "The (class_name) field must be less than 2048 characters.");
        }
    
        //The name field cannot be empty and must not exceed 255 characters
        if (empty($QV_year)) {
            error_function(400, "The (QV_year) field must not be empty.");
        } 
        elseif (strlen($QV_year) > 255) {
            error_function(400, "The (QV_year) field must be less than 255 characters.");
        }
    
        //checking if everything was good
        if (create_class($class_name, $QV_year) === true) {
            message_function(200, "The class was successfully created.");
        } else {
            error_function(500, "An error occurred while saving the class.");
        }
        return $response;        
    });

    $app->post("/Guardian", function (Request $request, Response $response, $args) {
        $id = user_validation("A");
        validate_token();

        $request_body_string = file_get_contents("php://input");
        $request_data = json_decode($request_body_string, true);
        $name = trim($request_data["name"]);
        $surname = trim($request_data["surname"]);
        $street = trim($request_data["street"]);
        $city = trim($request_data["city"]);
        $zip = trim($request_data["zip"]);
        $phone = trim($request_data["phone"]);

        if (empty($name)) {
            error_function(400, "The Feld 'name' can not be empty.");
        } elseif (strlen($name) > 2048) {
            error_function(400, "Das Feld 'name' darf maximal 2048 Zeichen lang sein.");
        }

        if (empty($surname)) {
            error_function(400, "The Feld 'surname' can not be empty.");
        } elseif (strlen($surname) > 2048) {
            error_function(400, "Das Feld 'surname' darf maximal 2048 Zeichen lang sein.");
        }

        if (empty($street)) {
            error_function(400, "The Feld 'street' can not be empty.");
        } elseif (strlen($street) > 2048) {
            error_function(400, "Das Feld 'street' darf maximal 2048 Zeichen lang sein.");
        }

        if (empty($city)) {
            error_function(400, "The Feld 'city' can not be empty.");
        } elseif (strlen($city) > 2048) {
            error_function(400, "Das Feld 'city' darf maximal 2048 Zeichen lang sein.");
        }

        if (empty($zip)) {
            error_function(400, "The Feld 'zip' can not be empty.");
        } elseif (strlen($zip) > 2048) {
            error_function(400, "Das Feld 'zip' darf maximal 2048 Zeichen lang sein.");
        }

        if (empty($phone)) {
            error_function(400, "The Feld 'phone' can not be empty.");
        } elseif (strlen($phone) > 2048) {
            error_function(400, "Das Feld 'phone' darf maximal 2048 Zeichen lang sein.");
        }

        //checking if everything was good
        if (create_guardian($name, $surname, $street, $city, $zip, $phone) === true) {
            message_function(200, "The guardian was successfully created.");
        } else {
            error_function(500, "An error occurred while saving the guardian.");
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
