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

    function get_files_by_id($id) {
        global $database;

        $result = $database->query("SELECT * FROM `students` WHERE `id` = `$id`;");

        if (!$result) {
            error_function(500, "Error");
		} else if ($result !== true) {
			if ($result->num_rows > 0) {
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

    function delete_student($student_id, $user_id) {
        global $database;
        $check = $database->query("SELECT user_id FROM students WHERE user_id = '$user_id';")->fetch_assoc()["user_id"];
    
        if ($check === $user_id) {
            $hasLinks = $database->query("SELECT student_id FROM blob_files WHERE student_id = '$student_id';")->fetch_assoc()["student_id"];
    
            if ($hasLinks) {
                $unlinkResult = $database->query("DELETE FROM blob_files WHERE student_id = '$student_id';");
                if (!$unlinkResult) {
                    error_function(500, "error: 'blob_files'");
                    return;
                }
            }

            $deleteResult = $database->query("DELETE FROM students WHERE student_id = '$student_id';");
            if ($deleteResult) {
                message_function(200, "successfully deleted");
            } else {
                error_function(500, "error");
            }
        } else {
            error_function(400, "access denied");
        }
    }
    

    /**
     * function delete_student($student_id, $user_id) {
        global $database;
       
        $check = $database->query("SELECT user_id FROM students WHERE user_id = '$user_id';")->fetch_assoc()["user_id"];
        if ($check === $student_id) {
            $result = $database->query("DELETE FROM students WHERE student_id = $student_id;");
            if ($result) {
                message_function(200, "deleted");
            }
            error_function(400, "there is was problem while deleting");
        }
        else if ($check !== $student_id) {
            error_function(400, "Access denied");
            }
            error_function(400, "There is no application with this id");
        }
     */
?>