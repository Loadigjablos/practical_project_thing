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

    function get_all_reservations() {
        global $database;

        $result = $database->query("SELECT * FROM company;");

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

    function create_company($companyname, $phone, $mail, $owner, $land, $street, $plz, $city) {
        global $database;

        $result = $database->query("INSERT INTO `company` (`companyname`,`phone`, `mail`, `owner`) VALUES ('$companyname', '$phone', '$mail', '$owner');");

        if ($result) {
            $addAdress = $database->query("INSERT INTO `adress` (`land`, `street`, `plz`, `city`) VALUES ('$land', '$street', '$plz', '$city')");

            if (!$addAdress) {
                error_function(400, "faild to create the address");
                return false;
            }

            $company_id_query = $database->query("SELECT id FROM company WHERE `mail` = '$mail'");
            if ($company_id_query->num_rows > 0) {
                $company_id = $company_id_query->fetch_assoc()['id'];
            }
            else {
                error_function(400, "The user does not exist");
                return false;
            }

            $adress_id_query = $database->query("SELECT id FROM adress WHERE `street` = '$street' AND `city` = '$city'");
            if ($adress_id_query->num_rows > 0) {
                $adress_id = $adress_id_query->fetch_assoc()['id'];
            }
            else {
                error_function(400, "The adress does not exist");
                return false;
            }
    
            $defineAdress = $database->query("INSERT INTO `company_adress` (`company_id`, `adress_id`) VALUES ('$company_id', '$adress_id');");

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

    function create_user_company($company_id, $user_id, $salary, $date_of_approval, $date_of_the_contract) {
        global $database;

        $result = $database->query("INSERT INTO `user_company` (`company_id`,`user_id`, `salary`, `date_of_approval`, `date_of_the_contract`) VALUES ('$company_id', '$user_id', '$salary', '$date_of_approval', '$date_of_the_contract');");

        if ($result) {
            message_function(200, "Created");
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