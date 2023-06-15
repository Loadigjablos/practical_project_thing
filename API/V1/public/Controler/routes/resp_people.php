<?php
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;

    $app->put("/RespPeople/{id}", function (Request $request, Response $response, $args) {

		$id = user_validation("A");
        validate_token();
		$resp_id = $args["id"];
        $user = get_resp_by_id($resp_id);
		
		if (!$user) {
			error_function(404, "No Responsible People found for the id ( " . $resp_id . " ).");
            return false;
		}

        $request_body_string = file_get_contents("php://input");
		$request_data = json_decode($request_body_string, true);
        $user = array();  // initialize the array
        //company_id
        if (isset($request_data["company_id"])) {
            $company_id = strip_tags(addslashes($request_data["company_id"]));
        
            if (!is_numeric($company_id)) {
                error_function(400, "The company id must be numeric.");
            } else if (!get_company_by_id($company_id)) { 
                error_function(400, "The provided company id does not exist.");
            } else {
                $user["company_id"] = $company_id;
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

        //email
        if (isset($request_data["email"])) {
			$email = strip_tags(addslashes($request_data["email"]));
			if (strlen($email) > 225) {
				error_function(400, "The email is too long. Please enter less than 255 letters.");
			}
			$user["email"] = $email;
		}

        //phone
        if (isset($request_data["phone"])) {
            $phone = strip_tags(addslashes($request_data["phone"]));
        
            if (!is_numeric($phone)) {
                error_function(400, "The phone must be numeric.");
            } else {
                $user["phone"] = $phone;
            }
        }
        
        if (update_resp($resp_id, $user["company_id"], $user["name"], $user["surname"], $user["email"], $user["phone"])) {
			message_function(200, "The Responsible People data were successfully updated");
            return true;
		}
		else {
			error_function(500, "An error occurred while saving the Responsible People data.");
            return false;
		}
		
		return $response;

		

    });

?>