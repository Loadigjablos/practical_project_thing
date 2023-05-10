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
            error($users, 500);
        }
        else {
            error("The ID "  . $id . " was not found.", 404);
        }

        return $response;
    });

    $app->post("/User", function (Request $request, Response $response, $args) {
        //$id = user_validation("A");
        //validate_token();

        $request_body_string = file_get_contents("php://input");
        $request_data = json_decode($request_body_string, true);
        $name = trim($request_data["name"]);
        $email = trim($request_data["email"]);
        $password = trim($request_data["passwdhash"]);
        $picture_id = trim($request_data["picture_id"]);
        $parents = trim($request_data["parents"]);
        $birthdate = trim($request_data["birthdate"]);
        $ahvnumer = trim($request_data["ahvnumer"]);
        $role = trim($request_data["role"]);
    
        //The position field cannot be empty and must not exceed 2048 characters
        if (empty($name)) {
            error_function(400, "The (name) field must not be empty.");
        } 
        elseif (strlen($name) > 255) {
            error_function(400, "The (name) field must be less than 2048 characters.");
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

        if (empty($picture_id)) {
            error_function(400, "Please provide the (password) field.");
        }

        if (empty($parents)) {
            error_function(400, "Please provide the (password) field.");
        }
        elseif (strlen($parents) > 255) {
            error_function(400, "The (email) field must be less than 255 characters.");
        } 

        if (empty($birthdate)) {
            error_function(400, "Please provide the (password) field.");
        }
        elseif (strlen($birthdate) > 255) {
            error_function(400, "The (email) field must be less than 255 characters.");
        } 

        if (empty($ahvnumer)) {
            error_function(400, "Please provide the (password) field.");
        }
        elseif (strlen($ahvnumer) > 255) {
            error_function(400, "The (email) field must be less than 255 characters.");
        } 
        
        if (empty($role)) {
            $role = "C";
        } 

        $password = hash("sha256", $password);
    
        //checking if everything was good
        if (create_user($name, $email, $password, $picture_id, $parents, $birthdate, $ahvnumer, $role) === true) {
            message_function(200, "The user was successfully created.");
        } else {
            error_function(500, "An error occurred while saving the userdata.");
        }
        return $response;        
    });

    $app->put("/User/{id}", function (Request $request, Response $response, $args) {

		//$id = user_validation("A");
        //validate_token();
		
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
				error_funciton(400, "The password is too long. Please enter less than 1000 letters.");
			}
		
			$user["passwdhash"] = $password;

            $user["passwdhash"] = hash("sha256", $password);

		}

        if (isset($request_data["picture_id"])) {
			$picture_id = strip_tags(addslashes($request_data["picture_id"]));
		
			if (strlen($picture_id) > 1000) {
				error_funciton(400, "The picture_id is too long. Please enter less than 1000 letters.");
			}
		
			$user["picture_id"] = $picture_id;
		}

        if (isset($request_data["parents"])) {
			$parents = strip_tags(addslashes($request_data["parents"]));
		
			if (strlen($parents) > 1000) {
				error_funciton(400, "The parents is too long. Please enter less than 1000 letters.");
			}
		
			$user["parents"] = $parents;
		}

        if (isset($request_data["birthdate"])) {
			$birthdate = strip_tags(addslashes($request_data["birthdate"]));
		
			if (strlen($birthdate) > 1000) {
				error_funciton(400, "The birthdate is too long. Please enter less than 1000 letters.");
			}
		
			$user["birthdate"] = $birthdate;
		}

        if (isset($request_data["ahvnumer"])) {
			$ahvnumer = strip_tags(addslashes($request_data["ahvnumer"]));
		
			if (strlen($ahvnumer) > 1000) {
				error_funciton(400, "The ahvnumer is too long. Please enter less than 1000 letters.");
			}
		
			$user["ahvnumer"] = $ahvnumer;
		}

        if (isset($request_data["role"])) {
			$role = strip_tags(addslashes($request_data["role"]));
		
			if (strlen($role) > 1000) {
				error_funciton(400, "The role is too long. Please enter less than 1000 letters.");
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

    $app->put("/UserFiles/{id}", function (Request $request, Response $response, $args) {
        $user_id = $args["id"];

        $request_body_string = file_get_contents("php://input");
		$request_data = json_decode($request_body_string, true);

        
		
	});
?>