<?php
    /**
     * @param _string the string that will be processed to safety
     * @return _string either false or a correct string
     */
    function validate_string($_string) {
        $_string = addslashes($_string);
        $_string = strip_tags($_string);
        // a string needs at least one character
        if (!(isset($_string) && !(strlen($_string) < 1) && !(empty($_string)))) {
            return false;
        }
        return $_string;
    }
    /**
     * @param _integer this variable will be turned into a safe integer
     * @return _integer a integer number
     */
    function validate_number($_integer) {
        $_integer = intval($_integer);
        return $_integer;
    }
    /**
     * @param _float this variable will be turned into a safe float
     * @return _float a float number
     */
    function validate_float($_float) {
        $_float = floatval($_float);
        return $_float;
    }
    /**
     * @param _bool changes every value to a boolean
     * @return _bool either true or false
     */
    function validate_boolean($_bool) {
        $_bool = filter_var($_bool, FILTER_VALIDATE_BOOLEAN);
        return $_bool;
    }
    require_once "Controler/Secret.php";
    /**
     * 
     */
    function create_token($id) {
        global $secret;
        $token = Token::getToken($id, $secret, '6h');
        return $token;
    }

    /**
     * validates the token in the cookies if it matches with a user.
     */
    function validate_token($token = false) {
        global $secret;
        require_once "Model/users.php";

        $the_set_token = validate_string($_COOKIE["token"]); // cookie from the browser
        
        if ($the_set_token === false) {
            error_function(403, "no token ;_;");
        }
        if ($token !== false) {
            $the_set_token = $token;
        }

        $result = Token::validate($token, 'secret');

        $user = get_user_by_id($result); // array of this user

        return $user;
 
        error_function(403, "Authentication Failed ;_;");
    }
?>
