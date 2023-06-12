<?php
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;

    $app->get("/Users", function (Request $request, Response $response, $args) {
        $id = user_validation("A");
        validate_token(); // unotherized pepole will get rejected

        $users = get_all_users();

        if ($users) {
            echo json_encode($users);
        }
        else if (is_string($users)) {
            error_function($users, 500);
        }
        else {
            error_function("The ID "  . $id . " was not found.", 404);
        }

        return $response;
    });

    $app->get("/User", function (Request $request, Response $response, $args) {
        validate_token(); // unotherized pepole will get rejected
        $id = user_validation();
        $myId = get_user_id($id);
        $myId = $myId["id"];

        $users = get_user($myId);

        if ($users) {
            echo json_encode($users);
        }
        else if (is_string($users)) {
            error_function($users, 500);
        }
        else {
            error_function("The ID "  . $id . " was not found.", 404);
        }

        return $response;
    });

    $app->post("/Student", function (Request $request, Response $response, $args) {
        $id = user_validation("A");
        validate_token();

        $request_body_string = file_get_contents("php://input");
        $request_data = json_decode($request_body_string, true);
        $user_id = trim($request_data["user_id"]);
        $name = trim($request_data["name"]);
        $surname = trim($request_data["surname"]);
        $street = trim($request_data["street"]);
        $city = trim($request_data["city"]);
        $plz = trim($request_data["zip"]);
        $birthdate = trim($request_data["date_of_birth"]);
        $ahvnumer = trim($request_data["AHV"]);
        $guardien_id = trim($request_data["guardien_id"]);
        $specialization = trim($request_data["specialization"]);
        $class_id = trim($request_data["class_id"]);
        
        //checking the informations
        if (empty($name)) {
            error_function(400, "The (name) field must not be empty.");
        } elseif (strlen($name) > 2048) {
            error_function(400, "The (name) field must be less than 2048 characters.");
        }
        
        if (empty($surname)) {
            error_function(400, "The (surname) field must not be empty.");
        } elseif (strlen($surname) > 255) {
            error_function(400, "The (surname) field must be less than 255 characters.");
        }
        
        if (empty($street)) {
            error_function(400, "The (street) field must not be empty.");
        } elseif (strlen($street) > 255) {
            error_function(400, "The (street) field must be less than 255 characters.");
        }
        
        if (empty($city)) {
            error_function(400, "The (city) field must not be empty.");
        } elseif (strlen($city) > 255) {
            error_function(400, "The (city) field must be less than 255 characters.");
        }
        
        if (empty($plz)) {
            error_function(400, "The (plz) field must not be empty.");
        } elseif (strlen($plz) > 255) {
            error_function(400, "The (plz) field must be less than 255 characters.");
        }
        
        if (empty($birthdate)) {
            error_function(400, "The (birthdate) field must not be empty.");
        } elseif (strlen($birthdate) > 255) {
            error_function(400, "The (birthdate) field must be less than 255 characters.");
        }
        
        if (empty($ahvnumer)) {
            error_function(400, "The (ahvnumer) field must not be empty.");
        } elseif (strlen($ahvnumer) > 255) {
            error_function(400, "The (ahvnumer) field must be less than 255 characters.");
        }
        
        if (empty($guardien_id)) {
            error_function(400, "The (guardien_id) field must not be empty.");
        } elseif (strlen($guardien_id) > 255) {
            error_function(400, "The (guardien_id) field must be less than 255 characters.");
        }
        
        if (empty($specialization)) {
            error_function(400, "The (specialization) field must not be empty.");
        } elseif (strlen($specialization) > 255) {
            error_function(400, "The (specialization) field must be less than 255 characters.");
        }

        if (empty($class_id)) {
            error_function(400, "The (class_id) field must not be empty.");
        } elseif (strlen($class_id) > 255) {
            error_function(400, "The (class_id) field must be less than 255 characters.");
        }

        $password = hash("sha256", $password);
    
        //checking if everything was good
        if (create_student($user_id, $name, $surname, $street, $city, $plz, $birthdate, $ahvnumer, $guardien_id, $specialization, $class_id)) {
            message_function(200, "The user was successfully created.");
        } else {
            error_function(500, "An error occurred while saving the user data.");
        }
        return $response;        
    });

    $app->post("/User", function (Request $request, Response $response, $args) {
        $id = user_validation("A");
        validate_token();

        $request_body_string = file_get_contents("php://input");
        $request_data = json_decode($request_body_string, true);
        $name = trim($request_data["username"]);
        $email = trim($request_data["email"]);
        $password = trim($request_data["password"]);
        $role = trim($request_data["role"]);
    
        //The position field cannot be empty and must not exceed 2048 characters
        if (empty($name)) {
            error_function(400, "The (username) field must not be empty.");
        } 
        elseif (strlen($name) > 255) {
            error_function(400, "The (username) field must be less than 2048 characters.");
        }
    
        //The name field cannot be empty and must not exceed 255 characters
        if (empty($email)) {
            error_function(400, "The (email) field must not be empty.");
        } 
        elseif (strlen($email) > 255) {
            error_function(400, "The (email) field must be less than 255 characters.");
        }
    
        //The type field must be an uppercase alphabetic character
        if (empty($password)) {
            error_function(400, "Please provide the (password) field.");
        }
        elseif (strlen($password) > 255) {
            error_function(400, "The (password) field must be less than 255 characters.");
        } 
        
        if (empty($role)) {
            $role = "C";
        } 

        $password = hash("sha256", $password);
    
        //checking if everything was good
        if (create_user($name, $email, $password, $role) === true) {
            message_function(200, "The user was successfully created.");
        } else {
            error_function(500, "An error occurred while saving the userdata.");
        }
        return $response;        
    });

    $app->post("/File", function (Request $request, Response $response, $args) {

        validate_token(); // unotherized pepole will get rejected
        $id = user_validation();
        $myId = get_user_id($id);
        $myId = $myId["id"];

        $request_body_string = file_get_contents("php://input");
        $request_data = json_decode($request_body_string, true);
        $type = trim($request_data["type"]);
        $file = trim($request_data["file"]);


        //The position field cannot be empty and must not exceed 2048 characters
        if (empty($type)) {
            error_function(400, "The (type) field must not be empty.");
        } 
        elseif (strlen($type) > 255) {
            error_function(400, "The (type) field must be less than 2048 characters.");
        }
    
        //The name field cannot be empty and must not exceed 255 characters
        if (empty($file)) {
            error_function(400, "The (file) field must not be empty.");
        } 
        elseif (strlen($file) > 255) {
            error_function(400, "The (file) field must be less than 255 characters.");
        }

        $file = base64_encode($file);

        if (create_file($type, $file, $myId) === true) {
            message_function(200, "The file was successfully created.");
        } else {
            error_function(500, "An error occurred while saving the file.");
        }
        return $response; 
    });

    $app->post("/Application", function (Request $request, Response $response, $args) {
        validate_token(); // unotherized pepole will get rejected
        $id = user_validation();

        $request_body_string = file_get_contents("php://input");
        $request_data = json_decode($request_body_string, true);

        $student_id = trim($request_data["student_id"]);
        $application_date = trim($request_data["application_date"]);
        $company_id = trim($request_data["company_id"]);
        $application_status = trim($request_data["application_status"]);
        $interview_date = trim($request_data["interview_date"]);
        $approval_date = trim($request_data["approval_date"]);
        $try_out_id = trim($request_data["try_out_id"]);
        $contract = trim($request_data["contract"]);

        //getting the Student ID
        $student_id = get_student_id($id);
        $student_id = $student_id["student_id"];

        //The position field cannot be empty and must not exceed 2048 characters
        if (empty($student_id)) {
            error_function(400, "The (student_id) field must not be empty.");
        } 
        elseif (strlen($student_id) > 255) {
            error_function(400, "The (student_id) field must be less than 2048 characters.");
        }
    
        //The name field cannot be empty and must not exceed 255 characters
        if (empty($application_date)) {
            error_function(400, "The (application_date) field must not be empty.");
        } 
        elseif (strlen($application_date) > 255) {
            error_function(400, "The (application_date) field must be less than 255 characters.");
        }

        //The position field cannot be empty and must not exceed 2048 characters
        if (empty($company_id)) {
            error_function(400, "The (company_id) field must not be empty.");
        } 
        elseif (strlen($company_id) > 255) {
            error_function(400, "The (company_id) field must be less than 2048 characters.");
        }
    
        //The name field cannot be empty and must not exceed 255 characters
        if (empty($application_status)){
            error_function(400, "The (application_status) field must not be empty.");
        } 
        elseif (strlen($application_status) > 255) {
            error_function(400, "The (application_status) field must be less than 255 characters.");
        }

        if (empty($interview_date)) {
            error_function(400, "The (interview_date) field must not be empty.");
        } 
        elseif (strlen($interview_date) > 255) {
            error_function(400, "The (interview_date) field must be less than 255 characters.");
        }

        if (empty($approval_date)) {
            error_function(400, "The (approval_date) field must not be empty.");
        } 
        elseif (strlen($approval_date) > 255) {
            error_function(400, "The (approval_date) field must be less than 255 characters.");
        }

        if (empty($try_out_id)) {
            error_function(400, "The (try_out_id) field must not be empty.");
        } 
        elseif (strlen($try_out_id) > 255) {
            error_function(400, "The (try_out_id) field must be less than 255 characters.");
        }

        if (empty($contract)) {
            error_function(400, "The (contract) field must not be empty.");
        } 
        elseif (strlen($contract) > 255) {
            error_function(400, "The (contract) field must be less than 255 characters.");
        }

        $contract = base64_encode($contract);

        if (create_Application($student_id, $application_date, $company_id, $application_status, $interview_date, $approval_date, $try_out_id, $contract) === true) {
            message_function(200, "The Application was successfully created.");
        } else {
            error_function(500, "An error occurred while saving the Application.");
        }
        return $response; 
    });

    $app->get("/Applications", function (Request $request, Response $response, $args) {
        validate_token(); // unotherized pepole will get rejected
        $id = user_validation();

        $myId = get_student_id($id);
        $myId = $myId["student_id"];

        $applications = get_applications($myId);

        if ($applications) {
            echo json_encode($applications);
        }
        else if (is_string($applications)) {
            error_function($applications, 500);
        }
        else {
            error_function("The ID "  . $id . " was not found.", 404);
        }

        return $response;
    });

    $app->post("/Blob", function (Request $request, Response $response, $args) {
        validate_token(); // unotherized pepole will get rejected
        $id = user_validation();

        $request_body_string = file_get_contents("php://input");
        $request_data = json_decode($request_body_string, true);

        $student_id = trim($request_data["student_id"]);
        $type = trim($request_data["type"]);
        $file = trim($request_data["file"]);

        //getting the Student ID
        $student_id = get_student_id($id);
        $student_id = $student_id["student_id"];

        //The student_id field cannot be empty and must not exceed 2048 characters
        if (empty($student_id)) {
            error_function(400, "The (student_id) field must not be empty.");
        } 
        elseif (strlen($student_id) > 255) {
            error_function(400, "The (student_id) field must be less than 2048 characters.");
        }
    
        //The type field cannot be empty and must not exceed 255 characters
        if (empty($type)) {
            error_function(400, "The (type) field must not be empty.");
        } 
        elseif (strlen($type) > 255) {
            error_function(400, "The (type) field must be less than 255 characters.");
        }

        //The file field cannot be empty and must not exceed 2048 characters
        if (empty($file)) {
            error_function(400, "The (file) field must not be empty.");
        } 
        elseif (strlen($file) > 255) {
            error_function(400, "The (file) field must be less than 2048 characters.");
        }

        $file = base64_encode($file);

        if (create_Blob($student_id, $type, $file) === true) {
            message_function(200, "The Application was successfully created.");
        } else {
            error_function(500, "An error occurred while saving the Application.");
        }
        return $response; 
    });

    $app->get("/Blob", function (Request $request, Response $response, $args) {
        validate_token(); // unotherized pepole will get rejected
        $id = user_validation();

        $myId = get_student_id($id);
        $myId = $myId["student_id"];

        $blob = get_blob($myId);

        if ($blob) {
            echo json_encode($blob);
        }
        else if (is_string($blob)) {
            error_function($blob, 500);
        }
        else {
            error_function("The ID "  . $id . " was not found.", 404);
        }

        return $response;
    });

    $app->get("/Students", function (Request $request, Response $response, $args) {
        $id = user_validation("A");
        validate_token(); // unotherized pepole will get rejected

        $students = get_all_students();

        if ($students) {
            echo json_encode($students);
        }
        else if (is_string($students)) {
            error_function($students, 500);
        }
        else {
            error_function("The ID "  . $id . " was not found.", 404);
        }

        return $response;
    });


    $app->put("/User/{id}", function (Request $request, Response $response, $args) {

		$id = user_validation("A");
        validate_token();
		
		$user_id = $args["id"];
		
		$user = get_user_by_id($user_id);
		
		if (!$user) {
			error_function(404, "No user found for the id ( " . $user_id . " ).");
            return false;
		}
		
		$request_body_string = file_get_contents("php://input");
		
		$request_data = json_decode($request_body_string, true);

		if (isset($request_data["name"])) {
			$name = strip_tags(addslashes($request_data["name"]));
		
			if (strlen($name) > 255) {
				error_function(400, "The name is too long. Please enter less than 255 letters.");
			}
		
			$user["name"] = $name;
		}

        if (isset($request_data["email"])) {
			$email = strip_tags(addslashes($request_data["email"]));
		
			if (strlen($email) > 500) {
				error_function(400, "The email is too long. Please enter less than 500 letters.");
			}
		
			$user["email"] = $email;
		}

        if (isset($request_data["passwdhash"])) {
			$password = strip_tags(addslashes($request_data["passwdhash"]));
		
			if (strlen($password) > 1000) {
				error_function(400, "The password is too long. Please enter less than 1000 letters.");
			}
		
			$user["passwdhash"] = $password;

            $user["passwdhash"] = hash("sha256", $password);

		}

        if (isset($request_data["picture_id"])) {
			$picture_id = strip_tags(addslashes($request_data["picture_id"]));
		
			if (strlen($picture_id) > 1000) {
				error_function(400, "The picture_id is too long. Please enter less than 1000 letters.");
			}
		
			$user["picture_id"] = $picture_id;
		}

        if (isset($request_data["parents"])) {
			$parents = strip_tags(addslashes($request_data["parents"]));
		
			if (strlen($parents) > 1000) {
				error_function(400, "The parents is too long. Please enter less than 1000 letters.");
			}
		
			$user["parents"] = $parents;
		}

        if (isset($request_data["birthdate"])) {
			$birthdate = strip_tags(addslashes($request_data["birthdate"]));
		
			if (strlen($birthdate) > 1000) {
				error_function(400, "The birthdate is too long. Please enter less than 1000 letters.");
			}
		
			$user["birthdate"] = $birthdate;
		}

        if (isset($request_data["ahvnumer"])) {
			$ahvnumer = strip_tags(addslashes($request_data["ahvnumer"]));
		
			if (strlen($ahvnumer) > 1000) {
				error_function(400, "The ahvnumer is too long. Please enter less than 1000 letters.");
			}
		
			$user["ahvnumer"] = $ahvnumer;
		}

        if (isset($request_data["role"])) {
			$role = strip_tags(addslashes($request_data["role"]));
		
			if (strlen($role) > 1000) {
				error_function(400, "The role is too long. Please enter less than 1000 letters.");
			}
		
			$user["role"] = $role;
		}

		if (update_user($user_id, $user["name"], $user["email"], $user["passwdhash"], $user["picture_id"], $user["parents"], $user["birthdate"], $user["ahvnumer"], $user["role"])) {
			message_function(200, "The userdata were successfully updated");
            return true;
		}
		else {
			error_function(500, "An error occurred while saving the user data.");
            return false;
		}
		
		return $response;
	});

    $app->get("/UserFile", function (Request $request, Response $response, $args) {
        validate_token(); // unotherized pepole will get rejected
        $id = user_validation();
        $myId = get_user_id($id);
        $myId = $myId["id"];
        $files = get_my_files($myId);

        if ($files) {
            echo json_encode($files);
        }
        else if (is_string($files)) {
            error_function($files, 500);
        }
        else {
            error_function("The ID "  . $id . " was not found.", 404);
        }

        return $response;
    });

    $app->post("/UserFiles/{id}", function (Request $request, Response $response, $args) {
        //$id = user_validation("A");
        //validate_token();

        $user_id = $args["id"];

        $request_body_string = file_get_contents("php://input");
		$request_data = json_decode($request_body_string, true);

        $file = addslashes($request_data['file']);
        $type = strip_tags(addslashes($request_data['type']));
		
        //checking if everything was good
        if (add_files_to_user($user_id, $file, $type) === true) {
            message_function(200, "successfully added files");
        } else {
            error_function(500, "An error occurred");
        }
        return $response;   
	});

    $app->get("/UserFiles/{id}", function (Request $request, Response $response, $args) {
        //$id = user_validation("A");
        //validate_token();

        $user_id = $args["id"];

        echo json_encode(get_files_from_userid($user_id));
		
        return $response;
	});

    $app->delete("/Application/{applicaion_id}", function (Request $request, Response $response, $args) {

        $id = user_validation();
        validate_token();

        $applicaion_id = $args["applicaion_id"];
        $student_id = get_student_id($id);
        $student_id = $student_id["student_id"];

        if (delete_application($applicaion_id, $student_id)) {
            message_function(200, "successfully deleted");
        } else {
            error_function(500, "error");
        }
        return $response;

    });

?>
