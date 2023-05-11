<?php
    // Database conection string
    require "util/database.php";
 
    function get_all_users() {
        global $database;

        $result = $database->query("SELECT name FROM users;");

        if ($result == false) {
            error_function(500, "Error");
        } else if ($result !== true) {
            if ($result->num_rows > 0) {
                $result_array = array();
                while ($user = $result->fetch_assoc()) {
                    $result_array[] = $user;
                }
                return $result_array;
            } else {
                error_function(404, "not Found");
            }
        } else {
            error_function(404, "not Found");
        }
    }


    function change_player_data($data, $id) {
        global $database;

        $result = $database->query("UPDATE users SET player_data = '$data' WHERE users.id = $id;");

        if (!$result) {
            error_function(500, "Error");
        }
    }

    function get_user_by_mail($mail) {
        global $database;

        $result = $database->query("SELECT * FROM users WHERE email = '$mail';");

        if ($result == false) {
            error_function(500, "Error");
		} else if ($result !== true) {
			if ($result->num_rows > 0) {
                return $result->fetch_assoc();
			} else {
                error_function(404, "not Found");
            }
		} else {
            error_function(404, "not Found");
        }
    }
    
    function get_user_type($id) {
        global $database;
    
        $result = $database->query("SELECT type FROM users WHERE id = '$id';");
    
        if ($result == false) {
            error_function(500, "Error");
        } else if ($result !== true) {
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                return $user['type'];
            } else {
                error_function(404, "not Found");
            }
        } else {
            error_function(404, "not Found");
        }
    }
       
    function get_user_by_username($email) {
        global $database;

        $result = $database->query("SELECT * FROM users WHERE email = '$email';");

        if ($result == false) {
            error_function(500, "Error");
		} 
        else if ($result !== true) {
			if ($result->num_rows > 0) {
                return $result->fetch_assoc();
			} 
		} 
        else {
            error_function(404, "not Found");
        }
    }

    function get_user_by_id($user_id) {
        global $database;

        $result = $database->query("SELECT * FROM users WHERE id = '$user_id';");

        if ($result == false) {
            error_function(500, "Error");
		} else if ($result !== true) {
			if ($result->num_rows > 0) {
                return $result->fetch_assoc();
			} else {
                error_function(404, "not Found");
            }
		} else {
            error_function(404, "not Found");
        }

        $result = $result->fetch_assoc();

	    echo json_decode($result);
    }

    function create_temp($user_id, $message2, $timeout) {
        global $database;

        $result = $database->query("INSERT INTO `temp` (`user_id`, `hash`, `timeout`) VALUES ('$user_id', '$message2', '$timeout');");

        if ($result == false) {
            error_function(500, "Error");
		} else if ($result !== true) {
			if ($result->num_rows > 0) {
                return $result->fetch_assoc();
			} else {
                error_function(404, "not Found");
            }
		} else {
            error_function(404, "not Found");
        }

        $result = $result->fetch_assoc();

	    echo json_decode($result);
    }

    function get_id_by_email($email) {
        global $database;

        $result = $database->query("SELECT id FROM users WHERE email = '$email';");

        if ($result == false) {
            error_function(500, "Error");
		} else if ($result !== true) {
			if ($result->num_rows > 0) {
                return $result->fetch_assoc();
			} else {
                error_function(404, "not Found");
            }
		} else {
            error_function(404, "not Found");
        }

        $result = $result->fetch_assoc();

	    echo json_decode($result);
    }

    function get_temp_by_user_id($tempData) {
        global $database;

        $result = $database->query("SELECT hash FROM temp WHERE user_id = '$tempData';");

        if ($result == false) {
            error_function(500, "Error");
		} else if ($result !== true) {
			if ($result->num_rows > 0) {
                return $result->fetch_assoc();
			} else {
                error_function(404, "not Found");
            }
		} else {
            error_function(404, "not Found");
        }

        $result = $result->fetch_assoc();

	    echo json_decode($result);
    }

    function get_user_id($id) {
        global $database;

        $result = $database->query("SELECT name, type FROM users WHERE id = '$id';");

        if ($result == false) {
            error_function(500, "Error");
		} else if ($result !== true) {
			if ($result->num_rows > 0) {
                return $result->fetch_assoc();
			} else {
                error_function(404, "not Found");
            }
		} else {
            error_function(404, "not Found");
        }

        $result = $result->fetch_assoc();

	    echo json_decode($result);
    }

    function get_skill_by_id($id) {
        global $database;

        $result = $database->query("SELECT * FROM skills WHERE id = '$id';");

        if ($result == false) {
            error_function(500, "Error");
		} else if ($result !== true) {
			if ($result->num_rows > 0) {
                return $result->fetch_assoc();
			} else {
                error_function(404, "not Found");
            }
		} else {
            error_function(404, "not Found");
        }
    }

    function create_user($name, $email, $password, $picture_id, $parents, $birthdate, $ahvnumer, $role, $class_name, $land, $street, $plz, $city) {
        global $database;

        $existing_place = $database->query("SELECT * FROM `users` WHERE `email` = '$email'")->fetch_assoc();
        if ($existing_place) {
            // handle error
            error_function(400, "A user with the email '$email' already exists.");
            return false;
        }

        $result = $database->query("INSERT INTO `users` (`name`,`email`, `passwdhash`, `picture_id`, `parents`, `birthdate`, `ahvnumer`, `role`) VALUES ('$name', '$email', '$password', '$picture_id', '$parents', '$birthdate', '$ahvnumer', '$role');");

        if ($result) {
            $class_id_query = $database->query("SELECT id FROM class WHERE `class_name` = '$class_name'");
            if ($class_id_query->num_rows > 0) {
                $class_id = $class_id_query->fetch_assoc()['id'];
            }
            else {
                error_function(400, "The class does not exist");
                return false;
            }
    
            $user_id_query = $database->query("SELECT id FROM users WHERE `email` = '$email'");
            if ($user_id_query->num_rows > 0) {
                $user_id = $user_id_query->fetch_assoc()['id'];
            }
            else {
                error_function(400, "The user does not exist");
                return false;
            }
    

            $defineClass = $database->query("INSERT INTO `user_class` (`user_id`, `class_id`) VALUES ('$user_id', '$class_id');");

            if (!$defineClass) {
                error_function(400, "faild to create the user");
                return false;
            }

            $addAdress = $database->query("INSERT INTO `adress` (`land`, `street`, `plz`, `city`) VALUES ('$land', '$street', '$plz', '$city')");

            if (!$addAdress) {
                error_function(400, "faild to create the address");
                return false;
            }
            else {
               echo $addAdress;
            }

            $adress_id_query = $database->query("SELECT id FROM adress WHERE `street` = '$street' AND `city` = '$city'");
            if ($adress_id_query->num_rows > 0) {
                $adress_id = $adress_id_query->fetch_assoc()['id'];
            }
            else {
                error_function(400, "The adress does not exist");
                return false;
            }
    
            $defineAdress = $database->query("INSERT INTO `user_adress` (`adress_id`, `user_id`) VALUES ('$adress_id', '$user_id');");

            if ($defineAdress) {
                return true;
            }
            else {
                error_function(400, "faild to create the user");
                return false;
            }
        }
        else {
            return false;
        }
    }

    function update_user($user_id, $name, $email, $password, $picture_id, $parents, $birthdate, $ahvnumer, $role) {
		global $database;

		$result = $database->query("UPDATE `users` SET name = '$name', email = '$email', passwdhash = '$password', picture_id = '$picture_id', parents = '$parents', birthdate = '$birthdate', ahvnumer = '$ahvnumer', role = '$role' WHERE id = '$user_id';");

		if (!$result) {
			return false;
		}
		
		return true;
	}

    function update_product($product_id, $name, $active, $sku, $category_id, $image, $description, $price, $stock) {
		global $database;

		$result = $database->query("UPDATE `product` SET name = '$name', active = $active, sku = '$sku', category_id = $category_id, image = '$image', description = '$description', price = $price, stock = $stock WHERE product_id = $product_id");

		if (!$result) {
			return false;
		}
		
		return true;
	}

    function delete_user($name) {
		global $database;
		
		$result = $database->query("DELETE FROM `users` WHERE name = '$name';");
        
		if (!$result) {
			return false;
		}
		else if ($database->affected_rows == 0) {
			return null;
		}
		else {
			return true;
		}
	}

    function add_files_to_user($id, $file, $type) {
        global $database;

        $result = $database->query("SELECT id FROM blobfiles WHERE file = $file;");

        if ($result == false) {
		} else if ($result !== true) {
			if ($result->num_rows > 0) {
			} else {
                $result = $database->query("INSERT INTO blobfiles (id, type, file) VALUES (NULL, '$file', '$type');");
                if (!$result) {
                    return false;
                }
                else if ($database->affected_rows == 0) {
                    return false;
                }
            }
		} else {
            $result = $database->query("INSERT INTO blobfiles (id, type, file) VALUES (NULL, '$file', '$type');");
            if (!$result) {
                return false;
            }
            else if ($database->affected_rows == 0) {
                return false;
            }
        }
		
        $result = $database->query("SELECT id FROM blobfiles WHERE file = $file;");

        if (!$result) {
			return false;
		}

        $result = $result['id'];

        $result = $database->query("INSERT INTO user_files (user_id, file_id) VALUES ($id, $result);");

        if (!$result) {
			return false;
		}
		else if ($database->affected_rows == 0) {
			return null;
		}
		else {
			return true;
		}
    }

    function remove_files_from_user($user_id, $file_id) {
        global $database;

        $result = $database->query("DELETE FROM user_files WHERE user_id = $user_id AND file_id = $file_id;");

        if (!$result) {
			return false;
		}
		else if ($database->affected_rows == 0) {
			return null;
		}
		else {
			return true;
		}
    }

?>
