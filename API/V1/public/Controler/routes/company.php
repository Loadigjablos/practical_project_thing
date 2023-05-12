<?php
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;

    $app->get("/Reservations", function (Request $request, Response $response, $args) {
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

        $companyname = trim($request_data["companyname"]);
        $phone = trim($request_data["phone"]);
        $mail = trim($request_data["mail"]);
        $owner = trim($request_data["owner"]);
        $land = trim($request_data["land"]);
        $street = trim($request_data["street"]);
        $plz = trim($request_data["plz"]);
        $city = trim($request_data["city"]);
    
        if (empty($companyname)) {
            error_function(400, "Please provide the (companyname) field.");
        } 
        elseif (strlen($companyname) > 255) {
            error_function(400, "The (companyname) field must be less than 255 characters.");
        }

        if (empty($phone)) {
            error_function(400, "Please provide the (phone) field.");
        } 
        elseif (strlen($phone) > 255) {
            error_function(400, "The (phone) field must be less than 255 characters.");
        }

        if (empty($mail)) {
            error_function(400, "Please provide the (mail) field.");
        } 
        elseif (strlen($mail) > 255) {
            error_function(400, "The (mail) field must be less than 255 characters.");
        }

        if (empty($owner)) {
            error_function(400, "Please provide the (owner) field.");
        } 
        elseif (strlen($owner) > 255) {
            error_function(400, "The (owner) field must be less than 255 characters.");
        }

        if (empty($land)) {
            error_function(400, "Please provide the (land) field.");
        }
        elseif (strlen($land) > 255) {
            error_function(400, "The (land) field must be less than 255 characters.");
        } 

        if (empty($street)) {
            error_function(400, "Please provide the (street) field.");
        }
        elseif (strlen($street) > 255) {
            error_function(400, "The (street) field must be less than 255 characters.");
        } 

        if (empty($plz)) {
            error_function(400, "Please provide the (plz) field.");
        }
        elseif (strlen($plz) > 255) {
            error_function(400, "The (plz) field must be less than 255 characters.");
        } 

        if (empty($city)) {
            error_function(400, "Please provide the (city) field.");
        }
        elseif (strlen($city) > 255) {
            error_function(400, "The (city) field must be less than 255 characters.");
        } 

        //checking if everything was good
        if (create_company($companyname, $phone, $mail, $owner, $land, $street, $plz, $city) === true) {
            message_function(200, "The company was successfully created.");
        } 
        else {
            error_function(500, "An error occurred while saving the company.");
        }
        return $response;        
    });

    $app->post("/UserCompany", function (Request $request, Response $response, $args) {
        //everyone
        $id = user_validation("A");
        validate_token();

        $request_body_string = file_get_contents("php://input");
        $request_data = json_decode($request_body_string, true);

        $company_id = trim($request_data["company_id"]);
        $user_id = trim($request_data["user_id"]);
        $salary = trim($request_data["salary"]);
        $date_of_approval = trim($request_data["date_of_approval"]);
        $date_of_the_contract = trim($request_data["date_of_the_contract"]);
    
        if (empty($company_id)) {
            error_function(400, "Please provide the (company_id) field.");
        } 
        elseif (strlen($company_id) > 255) {
            error_function(400, "The (company_id) field must be less than 255 characters.");
        }

        if (empty($user_id)) {
            error_function(400, "Please provide the (user_id) field.");
        } 
        elseif (strlen($user_id) > 255) {
            error_function(400, "The (user_id) field must be less than 255 characters.");
        }

        if (empty($salary)) {
            error_function(400, "Please provide the (salary) field.");
        } 
        elseif (strlen($salary) > 255) {
            error_function(400, "The (salary) field must be less than 255 characters.");
        }

        if (empty($date_of_approval)) {
            error_function(400, "Please provide the (date_of_approval) field.");
        } 
        elseif (strlen($date_of_approval) > 255) {
            error_function(400, "The (date_of_approval) field must be less than 255 characters.");
        }

        if (empty($date_of_the_contract)) {
            error_function(400, "Please provide the (date_of_the_contract) field.");
        }
        elseif (strlen($date_of_the_contract) > 255) {
            error_function(400, "The (date_of_the_contract) field must be less than 255 characters.");
        } 

        //checking if everything was good
        if (create_user_company($company_id, $user_id, $salary, $date_of_approval, $date_of_the_contract) === true) {
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
