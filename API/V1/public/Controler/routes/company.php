<?php
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;

    $app->get("/Company", function (Request $request, Response $response, $args) {
        //everyone
        validate_token(); // unotherized pepole will get rejected

        $reservations = get_all_reservations();

        if ($reservations) {
            echo json_encode($reservations);
        }
        else if (is_string($reservations)) {
            error_function(500, $reservations);
        }
        else {
            error(400, "Error");
        }

        return $response;
    });
    
    
    $app->get("/Reservation/{id}", function (Request $request, Response $response, $args) {
        //everyone
        validate_token(); // unotherized pepole will get rejected

        $id = intval($args["id"]);

        $reservation = get_reservation_by_id($id);

        if ($reservation) {
            echo json_encode($reservation);
        }
        else if (is_string($reservation)) {
            error($reservation, 500);
        }
        else {
            error("The Name "  . $id . " was not found.", 404);
        }

        return $response;
    });

    $app->post("/Company", function (Request $request, Response $response, $args) {
        //everyone
        validate_token();

        $request_body_string = file_get_contents("php://input");
        $request_data = json_decode($request_body_string, true);

        $company_name = trim($request_data["company_name"]);
        $street = trim($request_data["street"]);
        $city = trim($request_data["city"]);
        $zip = trim($request_data["zip"]);
        $collaborative_contract = trim($request_data["collaborative_contract"]);


        if (empty($company_name)) {
            error_function(400, "Please provide the (companyname) field.");
        } 
        elseif (strlen($company_name) > 255) {
            error_function(400, "The (companyname) field must be less than 255 characters.");
        }

        if (empty($street)) {
            error_function(400, "Please provide the (street) field.");
        }
        elseif (strlen($street) > 255) {
            error_function(400, "The (street) field must be less than 255 characters.");
        } 

        if (empty($city)) {
            error_function(400, "Please provide the (city) field.");
        }
        elseif (strlen($city) > 255) {
            error_function(400, "The (city) field must be less than 255 characters.");
        } 

        if (empty($zip)) {
            error_function(400, "Please provide the (zip) field.");
        }
        elseif (strlen($zip) > 255) {
            error_function(400, "The (zip) field must be less than 255 characters.");
        } 

        if (empty($collaborative_contract)) {
            error_function(400, "Please provide the (collaborative_contract) field.");
        }
        elseif (strlen($collaborative_contract) > 2555) {
            error_function(400, "The (collaborative_contract) field must be less than 2555 characters.");
        } 

        $collaborative_contract = base64_encode($collaborative_contract);

        //checking if everything was good
        if (create_company($company_name, $street, $city, $zip, $collaborative_contract) === true) {
            message_function(200, "The company was successfully created.");
        } 
        else {
            error_function(500, "An error occurred while saving the company.");
        }
        return $response;        
    });

    $app->post("/TryOut", function (Request $request, Response $response, $args) {
        //everyone
        validate_token();

        $request_body_string = file_get_contents("php://input");
        $request_data = json_decode($request_body_string, true);

        $company_id = trim($request_data["company_id"]);
        $from_date = trim($request_data["from_date"]);
        $till = trim($request_data["till"]);
    
        if (empty($from_date)) {
            error_function(400, "Please provide the (from_date) field.");
        } 
        elseif (strlen($from_date) > 255) {
            error_function(400, "The (from_date) field must be less than 255 characters.");
        }

        if (empty($till)) {
            error_function(400, "Please provide the (till) field.");
        } 
        elseif (strlen($till) > 255) {
            error_function(400, "The (till) field must be less than 255 characters.");
        }

        //checking if everything was good
        if (create_tryOut($from_date, $till) === true) {
            message_function(200, "The Try Out was successfully created.");
        } 
        else {
            error_function(500, "An error occurred while saving the Try Out.");
        }
        return $response;        
    });

    $app->post("/ResponsiblePeople", function (Request $request, Response $response, $args) {
        //everyone
        validate_token();

        $request_body_string = file_get_contents("php://input");
        $request_data = json_decode($request_body_string, true);

        $company_id = trim($request_data["company_id"]);
        $name = trim($request_data["name"]);
        $surname = trim($request_data["surname"]);
        $email = trim($request_data["email"]);
        $phone = trim($request_data["phone"]);

        if (empty($company_id)) {
            error_function(400, "Please provide the (company_id) field.");
        } 
        elseif (strlen($company_id) > 255) {
            error_function(400, "The (company_id) field must be less than 255 characters.");
        }

        if (empty($name)) {
            error_function(400, "Please provide the (name) field.");
        }
        elseif (strlen($name) > 255) {
            error_function(400, "The (name) field must be less than 255 characters.");
        } 

        if (empty($surname)) {
            error_function(400, "Please provide the (surname) field.");
        }
        elseif (strlen($surname) > 255) {
            error_function(400, "The (surname) field must be less than 255 characters.");
        } 

        if (empty($email)) {
            error_function(400, "Please provide the (email) field.");
        }
        elseif (strlen($email) > 255) {
            error_function(400, "The (email) field must be less than 255 characters.");
        } 

        if (empty($phone)) {
            error_function(400, "Please provide the (phone) field.");
        }
        elseif (strlen($phone) > 2555) {
            error_function(400, "The (phone) field must be less than 2555 characters.");
        }

        //checking if everything was good
        if (create_ResponsiblePeople($company_id, $name, $surname, $email, $phone) === true) {
            message_function(200, "The company was successfully created.");
        } 
        else {
            error_function(500, "An error occurred while saving the company.");
        }
        return $response;        
    });

    $app->put("/Reservation/{id}", function (Request $request, Response $response, $args) {

		$id = user_validation("A");
        validate_token();
		
		$id = $args["id"];
		
		$reservation = get_reservation_by_id($id);
		
		if (!$reservation) {
			error_function(404, "No reservation found for the id ( " . $id . " ).");
		}
		
		$request_body_string = file_get_contents("php://input");
		
		$request_data = json_decode($request_body_string, true);

		if (isset($request_data["from_date"])) {
			$from_date = strip_tags(addslashes($request_data["from_date"]));
		
			if (strlen($from_date) > 255) {
				error_function(400, "The from_date is too long. Please enter less than 255 letters.");
			}
		
			$reservation["from_date"] = $from_date;
		}

        if (isset($request_data["to_date"])) {
			$to_date = strip_tags(addslashes($request_data["to_date"]));
		
			if (strlen($to_date) > 500) {
				error_function(400, "The to_date is too long. Please enter less than 500 letters.");
			}
		
			$reservation["to_date"] = $to_date;
		}

        if (isset($request_data["place_name"])) {
			$place_name = strip_tags(addslashes($request_data["place_name"]));
		
			if (strlen($place_name) > 1000) {
				error_funciton(400, "The place_name is too long. Please enter less than 1000 letters.");
			}
		
			$reservation["place_name"] = $place_name;
		}

        if (isset($request_data["host"])) {
			$host = strip_tags(addslashes($request_data["host"]));
		
			if (strlen($host) > 1000) {
				error_funciton(400, "The host is too long. Please enter less than 1000 letters.");
			}
		
			$reservation["host"] = $host;
		}

        if (isset($request_data["description"])) {
			$description = strip_tags(addslashes($request_data["description"]));
		
			if (strlen($description) > 1000) {
				error_function(400, "The description is too long. Please enter less than 1000 letters.");
			}
		
			$reservation["description"] = $description;
		}
		
		if (update_reservation($id, $reservation["from_date"], $reservation["to_date"], $reservation["place_name"], $reservation["host"], $reservation["description"])) {
			message_function(200, "The reservation data were successfully updated");
		}
		else {
			error_function(500, "An error occurred while saving the reservation data.");
		}
		
		return $response;
	});

    $app->delete("/Reservation/{id}", function (Request $request, Response $response, $args) {
        //everyone
        validate_token();
        
        $id = $args["id"];
        
        $result = delete_reservation($id);
        
        if (!$result) {
            error_function(404, "No reservation found for the id " . $id . ".");
        }
        else {
            message_function(200, "The reservation was succsessfuly deleted.");
        }
        
        return $response;
    });

?>
