<?php
    session_start();
    require_once '../sql/connect.php';
    include_once '../includes/domain.php';

    if(isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(empty($email)){
            $_SESSION['error'] = "Please enter email.";
            header("location: login.php");
        }else if(empty($password)){
            $_SESSION['error'] = "Please enter password.";
            header("location: login.php");
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['error'] = "Please enter a valid email address.";
            header("location: login.php");
        }else if(strlen($_POST['password']) > 20 || strlen($_POST['password']) < 8){
            $_SESSION['error'] = "Password must be 8 to 20 characters long.";
            header("location: login.php");
        } else {
            try{
                $check_login = $conn->prepare("SELECT * FROM agents WHERE agnetsEmail = :email");
                $check_login->bindParam(":email", $email);
                $check_login->execute();
                $row = $check_login->fetch(PDO::FETCH_ASSOC);

                if($check_login->rowCount() > 0){
                    if($email == $row['agnetsEmail']){
                         if(password_verify($password, $row['agentsPassword'])){
                            if($row['role'] == '1'){
                                $_SESSION['admin_login'] = $row['agentsID'];
                                header("location:{$domain}Admin/pages/dashboard/dashboard.php");
                            }else{
                                $_SESSION['agents_login'] = $row['agentsID'];
                                header("location:{$domain}Admin/agents/dashboard.php");
                            }
                         }else{
                            $_SESSION['error'] = 'Please enter a valid password.';
                            header("location: login.php");
                         }
                    }else{
                        $_SESSION['error'] = 'Please enter a valid email address.';
                        header("location: login.php");
                    }
                }else{
                    $_SESSION['error'] = 'You do not have any information in system.';
                    header("location: login.php");
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
            
    }
?>