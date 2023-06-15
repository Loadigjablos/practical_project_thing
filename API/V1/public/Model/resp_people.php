<?php

function update_resp($resp_id, $company_id, $name, $surname, $email, $phone) {
    global $database;

    $result = $database->query("UPDATE `responsible_people` SET company_id = '$company_id', name = '$name', surname = '$surname', email = '$email', phone = '$phone' WHERE responsible_person_id  = '$resp_id';");

    if (!$result) {
        return false;
    }
    
    return true;
}

function get_resp_by_id($id) {
    global $database;
    $result = $database->query("SELECT * FROM responsible_people WHERE 	responsible_person_id = '$id';");

    if ($result == false) {
        error_function(500, "Error");
    } else if ($result !== true) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['responsible_person_id'];  // return only the company_id
        } else {
            error_function(404, "not Found");
        }
    } else {
        error_function(404, "not Found");
    }
}
?>