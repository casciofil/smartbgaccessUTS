<?php



class User {


    private $username;
    private $password;
    private $role;

    public function __constructor ($user, $password){
        $this->username=$user;
        $this->password=$password;
        $this->role='user';
    }

    public function login(){
        require_once "../config.php";

        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $this->username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $this->username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($this->password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();                     
                            $this->password=null;
                            $_SESSION["stored_user"] = new user($this->username, $this->password);

                            // Store data in session variables
                            /*
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $this->username;     */                       
                        }
                    }
                } else{
                    //$_SESSION["loggedin"] = false; 
                    $_SESSION["stored_user"] = null;
                }
            }
    
            // Close statement
            mysqli_stmt_close($stmt);
        }
        // Close connection
        mysqli_close($link);


    }

    public function logout(){
        session_start();

        //remove all session variables
        session_unset();

        //destroy the session
        session_destroy();
    }

    function getUsername(){
        return $this->username;
    }

    function getRole(){
        return $this->role;
    }


}
