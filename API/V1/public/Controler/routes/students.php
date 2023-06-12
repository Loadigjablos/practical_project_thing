<?php
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;

    $app->put("/Student/{id}", function (Request $request, Response $response, $args) {

		$id = user_validation("A");
        validate_token();
		
		$student_id = $args["id"];
		
	//	$user = get_user_by_id($student_id);
		
		/*if (!$user) {
			error_function(404, "No user found for the id ( " . $user_id . " ).");
            return false;
		}
		*/
		$request_body_string = file_get_contents("php://input");
		
		$request_data = json_decode($request_body_string, true);
        //user_id
        if (isset($request_data["user_id"])) {
            $user_id = strip_tags(addslashes($request_data["user_id"]));
        
            if (!is_numeric($user_id)) {
                error_function(400, "The user id must be numeric.");
            } else if (!id_exists_in_table($user_id, "user", "user_id")) { // replace "users" with the actual table name
                error_function(400, "The provided user id does not exist.");
            }
            else if (id_exists_in_table($user_id, "students", "user_id")) {
                error_function(400, "The user id is already taken.");
            }
            else{
                $user["user_id"] = $user_id;
                //student_id_by_user_id($user["user_id"]);
            }
        }
        //name
		if (isset($request_data["name"])) {
            $name = strip_tags(addslashes($request_data["name"]));
        
            if (strlen($name) > 20) {
                error_function(400, "The name is too long. Please enter less than 20 letters.");
            }
        
            $user["name"] = $name;
        }
        //surname
        if (isset($request_data["surname"])) {
            $surname = strip_tags(addslashes($request_data["surname"]));
        
            if (strlen($surname) > 20) {
                error_function(400, "The surname is too long. Please enter less than 20 letters.");
            }
        
            $user["surname"] = $surname;
        }
        //street
        if (isset($request_data["street"])) {
            $street = strip_tags(addslashes($request_data["street"]));
        
            if (strlen($street) > 20) {
                error_function(400, "The street is too long. Please enter less than 20 letters.");
            }
        
            $user["street"] = $street;
        }
        //city
        if (isset($request_data["city"])) {
            $city = strip_tags(addslashes($request_data["city"]));
        
            if (strlen($city) > 20) {
                error_function(400, "The city is too long. Please enter less than 20 letters.");
            }
        
            $user["city"] = $city;
        }
        //zip
        if (isset($request_data["zip"])) {
            $zip = strip_tags(addslashes($request_data["zip"]));
        
            if (!is_numeric($zip)) {
                error_function(400, "The zip code must be numeric.");
            } else if (strlen($zip) != 4) {
                error_function(400, "The zip code must be exactly 4 digits.");
            } else {
                $user["zip"] = $zip;
            }
        }
        //birthDate
        if (isset($request_data["birthdate"])) {
            $birthdate = strip_tags(addslashes($request_data["birthdate"]));
            $dt = DateTime::createFromFormat('Y-m-d', $birthdate);

            if ($dt === false || array_sum($dt::getLastErrors())) {
                error_function(400, "The birthdate is not valid. Please enter a valid date (yyyy-mm-dd).");
            } else if ($birthdate != $dt->format('Y-m-d')) {
                error_function(400, "The birthdate is not in correct format. Please enter a date in the format (yyyy-mm-dd).");
            } else {
            $user["birthdate"] = $birthdate;
            }
        }

        //ahv
        if (isset($request_data["ahv"])) {
            $ahv = strip_tags(addslashes($request_data["ahv"]));
        
            if (strlen($ahv) > 13) {
                error_function(400, "The ahv is too long. Please enter less than 20 letters.");
            }
        
            $user["ahv"] = $ahv;
        }
        //guardien_id
        if (isset($request_data["guardien_id"])) {
            $guardien_id = strip_tags(addslashes($request_data["guardien_id"]));
        
            if (!is_numeric($guardien_id)) {
                error_function(400, "The guardien id must be numeric.");
            } else if (!id_exists_in_table($guardien_id, "guardians", "guardian")) { // replace "users" with the actual table name
                error_function(400, "The provided Guardien id does not exist.");
            } else {
                $user["guardien_id"] = $guardien_id;
            }
        }
        //specialization
        if (isset($request_data["specialization"])) {
            $specialization = strip_tags(addslashes($request_data["specialization"]));
        
            if (strlen($specialization) > 20) {
                error_function(400, "The specialization is too long. Please enter less than 20 letters.");
            }
        
            $user["specialization"] = $specialization;
        }
        //class_id
        if (isset($request_data["class_id"])) {
            $class_id = strip_tags(addslashes($request_data["class_id"]));
        
            if (!is_numeric($class_id)) {
                error_function(400, "The class id must be numeric.");
            } else if (!id_exists_in_table($class_id, "class", "class_id")) { // replace "users" with the actual table name
                error_function(400, "The provided class id does not exist.");
            } else {
                $user["class_id"] = $class_id;
            }
        }

		if (update_student($student_id, $user["user_id"], $user["name"],$user["surname"],
        $user["street"],
        $user["city"],
        $user["zip"],
        $user["birthdate"],
        $user["ahv"],
        $user["guardien_id"],
        $user["specialization"],
        $user["class_id"] )) {
			message_function(200, "The Student Data were successfully updated");
            return true;
		}
		else {
			error_function(500, "An error occurred while saving the Student data.");
            return false;
		}
		
		return $response;
	});
?>