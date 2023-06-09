<?php
    // Database conection string
    require "util/database.php";
 
    function get_all_user() {
        global $database;
    
        $result = $database->query("SELECT name, email, picture_id, parents, birthdate, ahvnumer, role, id FROM user;");
    
        if ($result == false) {
            error_function(500, "Error");
        } else if ($result !== true) {
            if ($result->num_rows > 0) {
                $result_array = array();
                while ($user = $result->fetch_assoc()) {
                    $id = $user['id'];
                    $class_name = get_class_name($id);
                    $user['class'] = $class_name;
                    $company_name = get_company_name($id);
                    $user['company'] = $company_name;
                    $adress = get_adress($id);
                    $user['adress'] = $adress;
                    $picture_id = $user['picture_id'];
                    $blobfile_type = get_blobfile_type($picture_id);
                    $user['picture'] = $blobfile_type;
                    
                    $result_array[] = $user;
                }
                
                $response = array(
                    'user' => $result_array
                );
                
                return $response;
            } else {
                error_function(404, "Not Found");
            }
        } else {
            error_function(404, "Not Found");
        }
    }
    
    function get_blobfile_type($picture_id) {
        global $database;
    
        $query = "SELECT file FROM blobfiles WHERE id = '$picture_id';";
        $result = $database->query($query);
    
        if ($result == false || $result->num_rows == 0) {
            return null;
        } else {
            $row = $result->fetch_assoc();
            return $row['file'];
        }
    }   
    
    function get_class_name($id) {
        global $database;
    
        $getId = $database->query("SELECT class_id FROM user_class WHERE user_id = '$id';")->fetch_assoc()["class_id"];
       

        $getName =  $database->query("SELECT class_name FROM class WHERE id = '$getId' ORDER BY class_name;");
    
        if ($getName == false || $getName->num_rows == 0) {
            return null;
        } else {
            $row = $getName->fetch_assoc();
            return $row['class_name'];
        }
    }

    function get_company_name($id) {
        global $database;
    
        $getId = $database->query("SELECT company_id FROM user_company WHERE user_id = '$id';")->fetch_assoc()["company_id"];
       
        $getName =  $database->query("SELECT companyname FROM company WHERE id = '$getId';");
    
        if ($getName == false || $getName->num_rows == 0) {
            return null;
        } else {
            $row = $getName->fetch_assoc();
            return $row['companyname'];
        }
    }

    function get_adress($id) {
        global $database;
    
        $getId = $database->query("SELECT adress_id FROM user_adress WHERE user_id = '$id';")->fetch_assoc()["adress_id"];
       
        $getName =  $database->query("SELECT land, street, plz, city FROM adress WHERE id = '$getId';");
    
        if ($getName == false || $getName->num_rows == 0) {
            return null;
        } else {
            $row = $getName->fetch_assoc();
            $result_array[] = $row;
                }
                
                $response = array(
                    'adress' => $result_array
                );
                
                return $response;
    }


    function get_user($myId) {
        global $database;

        $result = $database->query("SELECT name, email, picture_id, parents, birthdate, ahvnumer, role, id FROM user WHERE id = $myId;");

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

    function get_my_files($myId) {
        global $database;

        $result = $database->query("SELECT id FROM user WHERE id = '$myId';");
    
        if ($result == false) {
            error_function(500, "Error");
        } else if ($result !== true) {
            if ($result->num_rows > 0) {
                $result_array = array();
                while ($user = $result->fetch_assoc()) {
                    $id = $user['id'];
                    $files = get_my_file($id);
                    $user['files'] = $files;
                    
                    $result_array[] = $user;
                }
                
                $response = array(
                    'files' => $result_array
                );
                
                return $response;
            } else {
                error_function(404, "Not Found");
            }
        } else {
            error_function(404, "Not Found");
        }
    }

    function get_my_file($id) {
        global $database;
    
        $getId = $database->query("SELECT file_id FROM user_files WHERE user_id = '$id';")->fetch_assoc()["file_id"];
       
        $getName =  $database->query("SELECT file FROM blobfiles WHERE id = '$getId';");
    
        if ($getName == false || $getName->num_rows == 0) {
            return null;
        } else {
            $row = $getName->fetch_assoc();
            return $row;
        }
    }


    function change_player_data($data, $id) {
        global $database;

        $result = $database->query("UPDATE user SET player_data = '$data' WHERE user.id = $id;");

        if (!$result) {
            error_function(500, "Error");
        }
    }

    function get_user_by_mail($mail) {
        global $database;

        $result = $database->query("SELECT * FROM user WHERE email = '$mail';");

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
    
    function get_user_role($id) {
        global $database;
    
        $result = $database->query("SELECT role FROM user WHERE user_id = '$id';");
    
        if ($result == false) {
            error_function(500, "Error");
        } else if ($result !== true) {
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                return $user['role'];
            } else {
                error_function(404, "not Found");
            }
        } else {
            error_function(404, "not Found");
        }
    }
       
    function get_user_by_email($email) {
        global $database;

        $result = $database->query("SELECT * FROM user WHERE email = '$email';");

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

        $result = $database->query("SELECT * FROM user WHERE user_id = '$user_id';");

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
    
        // Check for expired temp and delete it
        $expired_temp_id = $database->query("SELECT id FROM temp WHERE timeout < NOW();")->fetch_assoc()["id"];
    
        if ($expired_temp_id) {
            $delete_result = $database->query("DELETE FROM temp WHERE id = '$expired_temp_id';");
        }
    
        // Check for user's existing temp and delete it
        $existing_temp_id = $database->query("SELECT id FROM temp WHERE user_id = $user_id;")->fetch_assoc()["id"];
    
        if ($existing_temp_id) {
            $delete_result = $database->query("DELETE FROM temp WHERE id = '$existing_temp_id';");
        }
    
        // Create new temp
        $result = $database->query("INSERT INTO `temp` (`user_id`, `hash`, `timeout`) VALUES ('$user_id', '$message2', '$timeout');");
    
        if ($result == false) {
            error_function(500, "Error creating new reservation.");
            return false;
        } else if ($result !== true) {
            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                error_function(404, "Not found.");
                return false;
            }
        } 
    
        return true;
    }

    function get_id_by_email($email) {
        global $database;

        $result = $database->query("SELECT user_id FROM user WHERE email = '$email';");

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

    function get_password_by_id($tempData) {
        global $database;

        $result = $database->query("SELECT password FROM user WHERE user_id = $tempData;");

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

        $result = $database->query("SELECT student_id, name, user_id FROM user WHERE id = '$id';");

        if ($result == false) {
            error_function(500, "Error");
		} else if ($result !== true) {
			if ($result->num_rows > 0) {
                return $result->fetch_assoc();
			} else {
                error_function(404, "not Found");
            }
		}

        $result = $result->fetch_assoc();

	    return $result;
    }

    function get_student_id($id) {
        global $database;

        $result = $database->query("SELECT student_id, name, surname FROM students WHERE user_id = '$id';");

        if ($result == false) {
            error_function(500, "Error");
		} else if ($result !== true) {
			if ($result->num_rows > 0) {
                return $result->fetch_assoc();
			} else {
                error_function(404, "not Found");
            }
		}

        $result = $result->fetch_assoc();

	    return $result;
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

    function create_student($user_id, $name, $surname, $street, $city, $plz, $birthdate, $ahvnumer, $guardian, $specialization, $class_id) {
        global $database;

        $existing_place = $database->query("SELECT * FROM `students` WHERE `AHV` = '$ahvnumer'")->fetch_assoc();
        if ($existing_place) {
            // handle error
            error_function(400, "A user with the AHV '$ahvnumer' already exists.");
            return false;
        }

        $result = $database->query("INSERT INTO `students` (`user_id`,`name`, `surname`, `street`, `city`, `zip`, `date_of_birth`, `AHV`, `guardien_id`, `specialization`, `class_id`) VALUES ('$user_id', '$name', '$surname', '$street', '$city', '$plz', '$birthdate', '$ahvnumer', '$guardian', '$specialization', '$class_id');");
        if ($result) {
                
            $user_id_query = $database->query("SELECT user_id FROM user WHERE `user_id` = '$user_id'");
            if ($user_id_query->num_rows > 0) {
                $user_id = $user_id_query->fetch_assoc()['user_id'];
            }
            else {
                error_function(400, "The user_id does not exist");
                return false;
            }
            return true;
        }
        else {
            return false;
        }
    }

    function create_user($name, $email, $password, $role) {
        global $database;

        $existing_place = $database->query("SELECT * FROM `user` WHERE `email` = '$email'")->fetch_assoc();
        if ($existing_place) {
            // handle error
            error_function(400, "A user with the email '$email' already exists.");
            return false;
        }

        $result = $database->query("INSERT INTO `user` (`username`, `email`, `password`, `role`) VALUES ('$name', '$email', '$password', '$role');");
        if ($result) {
            
            return true;
        }
        else {
            return false;
        }
    }

    function create_file($type, $file, $user_id) {
        global $database;

        $result = $database->query("INSERT INTO `blobfiles` (`type`, `file`) VALUES ('$type', '$file');");

        if ($result) {
            $file_id = $database->query("SELECT id FROM blobfiles WHERE `file` = '$file'")->fetch_assoc()['id'];

            $userFileDefine = $database->query("INSERT INTO user_files (`user_id`, `file_id`) VALUES ('$user_id', '$file_id');");

            if ($userFileDefine) {
                message_function(200, "Very nice");
            }
            return;
        }

        if (!$result) {
            // handle error
            error_function(400, "An error occurred while saving the file.");
            return false;
        }
    }

    function create_Application($student_id, $application_date, $company_id, $application_status, $interview_date, $approval_date, $try_out_id, $contract) {
        global $database;

        $companyExist = $database->query("SELECT * FROM companies WHERE company_id = '$company_id';");

        if ($companyExist->num_rows === 0) {
            error_function(400, "This company does not exist.");
            return false;
        }

        $tryOutExist = $database->query("SELECT * FROM try_outs WHERE try_out_id = '$try_out_id';");
        if ($tryOutExist->num_rows === 0) {
            error_function(400, "This try out does not exist");
            return false;
        }

        $result = $database->query("INSERT INTO `applicaions` (`student_id`, `application_date`, `company_id`, `application_status`, `interview_date`, `approval_date`, `try_out_id`, `contract`) VALUES ('$student_id', '$application_date', '$company_id', '$application_status', '$interview_date', '$approval_date', '$try_out_id', '$contract');");

        if ($result) {
            message_function(200, "The Application was created");
        }
        else {
            error_function(400, "There is an Error");
            return false;
        }
    }

    function delete_Application_ID($application_id) {
        global $database;
    
        $result = $database->query("DELETE FROM applicaions WHERE applicaion_id = $application_id");
    
        if ($result == false) {
            error_function(500, "Error");
        } else if ($database->affected_rows > 0) {
            return true; // Erfolgreich gelöscht
        } else {
            error_function(404, "Not Found");
        }
    }    

    function get_all_users() {
        global $database;
    
        $result = $database->query("SELECT username, email, role FROM user;");
    
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
    
    function create_Blob($student_id, $type, $file) {
        global $database;

        $studentExist = $database->query("SELECT * FROM students WHERE student_id = '$student_id';");

        if ($studentExist->num_rows === 0) {
            error_function(400, "This student does not exist.");
            return false;
        }

        $typeExist = $database->query("SELECT * FROM blob_types WHERE type = '$type';");
        if ($typeExist->num_rows === 0) {
            error_function(400, "This type does not exist");
            return false;
        }

        $result = $database->query("INSERT INTO `blob_files` (`student_id`, `type`, `file`) VALUES ('$student_id', '$type', '$file');");

        if ($result) {
            message_function(200, "The file was created");
        }
        else {
            error_function(400, "There is an Error");
            return false;
        }
    }

    function get_blob($myId) {
        global $database;
    
        $result = $database->query("SELECT type, file FROM blob_files WHERE student_id = $myId;");
    
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

    function get_all_students() {
        global $database;
    
        $result = $database->query("SELECT s.name, s.surname, s.street, s.city, s.zip, s.date_of_birth, s.AHV, s.specialization, g.name AS guardian_name, g.surname AS guardian_surname, c.class_name
                                   FROM students s
                                   LEFT JOIN guardians g ON s.guardien_id = g.guardian
                                   LEFT JOIN class c ON s.class_id = c.class_id;");
    
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

    function update_user($user_id, $name, $email, $password, $picture_id, $parents, $birthdate, $ahvnumer, $role) {
		global $database;

		$result = $database->query("UPDATE `user` SET name = '$name', email = '$email', passwdhash = '$password', picture_id = '$picture_id', parents = '$parents', birthdate = '$birthdate', ahvnumer = '$ahvnumer', role = '$role' WHERE id = '$user_id';");

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

    function delete_user_file($id) {
		global $database;

        $deleteMyFile = $database->query("DELETE FROM `user_files` WHERE file_id = '$id';");

        if (!$deleteMyFile) {
            error_function(400, "Cannot delete it");
        }
		
		$result = $database->query("DELETE FROM `blobfiles` WHERE id = '$id';");
        
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

    function add_files_to_user($id, $file, $role) {
        global $database;

        $result = $database->query("SELECT id FROM blobfiles WHERE file = $file;");

        if ($result == false) {
		} else if ($result !== true) {
			if ($result->num_rows > 0) {
			} else {
                $result = $database->query("INSERT INTO blobfiles (id, role, file) VALUES (NULL, '$file', '$role');");
                if (!$result) {
                    return false;
                }
                else if ($database->affected_rows == 0) {
                    return false;
                }
            }
		} else {
            $result = $database->query("INSERT INTO blobfiles (id, role, file) VALUES (NULL, '$file', '$role');");
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