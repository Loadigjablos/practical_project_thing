<?php
    // Database conection string
    require "util/database.php";

    function get_reservation_by_name($place_name) {
        global $database;

        $result = $database->query("SELECT * FROM events WHERE place_name = '$place_name';");

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

    function get_reservation_by_id($id) {
        global $database;

        $result = $database->query("SELECT * FROM events WHERE id = '$id';");

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

    function get_all_companies() {
        global $database;
    
        $result = $database->query("SELECT c.company_name, c.street, c.city, c.zip, c.collaborative_contract, r.name, r.surname, r.email, r.phone 
                                   FROM companies c
                                   LEFT JOIN responsible_people r ON c.company_id = r.company_id;");
    
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
    

    function create_company($company_name, $street, $city, $zip, $collaborative_contract) {
        global $database;

        $result = $database->query("INSERT INTO `companies` (`company_name`,`street`, `city`, `zip`, `collaborative_contract`) VALUES ('$company_name', '$street', '$city', '$zip', '$collaborative_contract');");

        if ($result) {
            message_function(200, "The company was created");
        }
        else {
            error_function(400, "Bad request");
            return false;
        }
    }

    function create_tryOut($from_date, $till) {
        global $database;

        $result = $database->query("INSERT INTO `try_outs` (`from_date`,`till`) VALUES ('$from_date', '$till');");

        if ($result) {
            message_function(200, "Try out is created");
        }
        else {
            error_function(400, "There is a problem");
        }
        return;
    }

    function create_ResponsiblePeople($company_id, $name, $surname, $email, $phone) {
        global $database;

        $companyExist = $database->query("SELECT * FROM companies WHERE company_id = '$company_id';");

        if ($companyExist->num_rows === 0) {
            error_function(400, "This company does not exist.");
            return false;
        }

        $result = $database->query("INSERT INTO `responsible_people` (`company_id`, `name`, `surname`, `email`, `phone`) VALUES ('$company_id', '$name', '$surname', '$email', '$phone');");

        if ($result) {
            message_function(200, "Responsible people is created");
        }
        else {
            error_function(400, "There is a problem");
        }
        return;
    }
        
    function update_reservation($id, $from_date, $to_date, $place_name, $host, $description) {
        global $database;

        $result = $database->query("UPDATE `events` SET from_date = '$from_date', to_date = '$to_date', place_name = '$place_name', host = '$host', description = '$description' WHERE id = '$id';");

        if (!$result) {
            return false;
        }
        
        return true;
    }
    
    function delete_reservation($id) {
        global $database;
    
        $result = $database->query("DELETE FROM `events` WHERE id = '$id';");
            
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