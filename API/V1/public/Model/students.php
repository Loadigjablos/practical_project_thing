<?php
    // Database conection string
    require "util/database.php";
    // Get the id of the user
    function id_exists_in_table($id, $table, $column) {
        global $database;
    
        $result = $database->query("SELECT 1 FROM `$table` WHERE `$column` = '$id';");
        return $result->num_rows > 0;
    }  
    

    function update_student($student_id, $user_id, $name, $surname, $street, $city, $zip, $birthdate, $ahv, $guardien_id, $specialization, $class_id ) {
		global $database;

        $exictStudent = $database->query("SELECT * FROM students WHERE `student_id` = '$student_id';")->fetch_assoc();

        if (!$exictStudent) {
            error_function(400, "No Student with this ID");
        }

		$result = $database->query("UPDATE `students` SET name = '$name', surname = '$surname', street = '$street', city = '$city', zip = '$zip', date_of_birth = '$birthdate', AHV = '$ahv', guardien_id = '$guardien_id', specialization = '$specialization', class_id = '$class_id' WHERE student_id = '$student_id';");

		if (!$result) {
			return false;
		}
		
		return true;
	}
?>