<?php
    session_start();
    require_once "../sql/connect.php";
    include_once '../includes/domain.php';

    if(isset($_POST['signup'])){
        $name = $_POST['name'];
        $lastname = $_POST['lastName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_c = $_POST['password_c'];


        if (empty($name)){
            $_SESSION['error'] = 'Please enter firstname.';
            header("location: {$domain}Admin/register.php");
        }else if(empty($lastname)){
            $_SESSION['error'] = 'Please enter lastname.';
            header("location: {$domain}Admin/register.php");
        }else if(empty($email)){
            $_SESSION['error'] = 'Please enter email.';
            header("location: {$domain}Admin/register.php");
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['error'] = 'Please enter a valid email address.';
            header("location: {$domain}Admin/register.php");
        }else if(empty($password)){
            $_SESSION['error'] = 'Please enter password.';
            header("location: {$domain}Admin/register.php");
        }else if(strlen($_POST['password']) > 20 || strlen($_POST['password']) < 8){
            $_SESSION['error'] = 'Password must be 8 to 20 characters long.';
            header("location: {$domain}Admin/register.php");
        }else if(empty($password_c)){
            $_SESSION['error'] = 'Please confirm your password.';
            header("location: {$domain}Admin/register.php");
        }else if($password != $password_c){
            $_SESSION['error'] = "Passwords don't match";
            header("location: {$domain}Admin/register.php");
        } else {
            try{
                $check_email = $conn->prepare("SELECT agnetsEmail FROM agents WHERE agnetsEmail = :email"); //prepare ป้องกันการเกิด sql injection
                $check_email->bindParam(":email",$email);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);

                if($row['agnetsEmail'] == $email){
                    $_SESSION['warning'] = "This email is already in the system. <a href='{$domain}login.php'></a>";
                    header("location: {$domain}Admin/register.php");
                }else if(!isset($_SESSION['error'])){
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO agents(agentsName, agentsLastname, agnetsEmail, agentsPassword)
                                            VALUES(:name, :lastname, :email, :encryption_pwd)");
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':lastname', $lastname);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':encryption_pwd', $passwordHash);
                    $stmt->execute();
                    $_SESSION['agents_regis'] = $email;
                    $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว! <a href='{$domain}login.php' class='alert-link'>คลิ๊กที่นี้</a>เพื่อเข้าสู่ระบบ";
                    header("location: {$domain}Admin/login.php");
                    // $_SESSION['agents_login'] = $row['agentsID'];
                    // header("location: {$domain}pages/dashboard/dashboard.php");
                }else{
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: {$domain}Admin/register.php");
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        
    }

?>