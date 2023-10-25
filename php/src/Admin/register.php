<?php
    session_start();
    require_once("../sql/connect.php");
    include_once '../includes/domain.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AndamanTour | Registers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/Styles/register_style.css">
</head>
<body>
        <style>
            li, a, button {
                font-family: 'Roboto', sans-serif;
                font-weight: 500;
                font-size: 16px;
                color: #caf0f8;
                text-decoration: none;
            }
            .back-page {
                position: fixed;
                top: 0;
                left: 50%;
                justify-content: start;
            }
            .back-page i{
                position: relative;
                left: -5%;
            }
            .back-page button {
                color: #caf0f8;
                border: none;
                width: 120px;
                padding: 9.5px;
                margin: 20px;
                border-radius: 50px;
                background-color: #004AAD;
            }
            @media (max-width: 768px) {
                section .vdoBx {
                    position: absolute;
                    width: 100%;
                    height: 100%;
                }
                section .contentBx {
                    display: flex;
                    width: 100%;
                    height: 100%;
                    justify-content: center;
                    align-items: center;
                    z-index: 1;
                }
                section .contentBx .form {
                    width: 100%;
                    background: rgb(255,255,255 ,0.9);
                    padding: 40px;
                    margin: 50px;
                    border-radius: 20px;
                }
                .back-page {
                    position: absolute;
                    top: 0px;
                    left: 0px;
                }
            }
        </style>
    <section>
    <div class="vdoBx">
            <video autoplay loop muted plays-inline class="back-video">
                <source src="../includes/video/info_smail.mp4" type="video/mp4">
            </video>
        </div>
        <div class="contentBx">
            <div class="back-page">
                <button><a href="<?php echo "{$domain}Admin/login.php"?>"><i class="fa-solid fa-angle-left" style="color: #ffffff;"></i>Provide</a></button>
            </div>
            <div class="form">
                <H2>AndamanTour Agent SignUp</H2>
                <form action="insert_register.php" id="signupForm" method="POST">
                <div class="alert">
                <?php if(isset($_SESSION['error'])) { ?>
                    <div class="error-alert" role="alert">
                        <?php 
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                        ?>
                    </div>
                <?php } ?>
                <?php if(isset($_SESSION['success'])) { ?>
                    <div class="suscess-alert" role="alert">
                        <?php 
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                        ?>
                    </div>
                <?php } ?>
                <?php if(isset($_SESSION['warning'])) { ?>
                    <div class="warning-alert" role="alert">
                        <?php 
                            echo $_SESSION['warning'];
                            unset($_SESSION['warning']);
                        ?>
                    </div>
                <?php } ?>
                    <div class="inputBx">
                        <span>Name</span>
                        <input type="text" name="name" placeholder="Name">
                    </div>
                    <div class="inputBx">
                        <span>Lastname</span>
                        <input type="text" name="lastName" placeholder="Lastname">
                    </div>
                    <div class="inputBx">
                        <span>Email</span>
                        <input type="email" name="email" placeholder="Email">
                    </div>
                    <div class="inputBx">
                        <span>Password</span>
                        <input type="password" name="password" placeholder="Password">
                    </div>
                    <div class="inputBx">
                        <span>Confirm Password</span>
                        <input type="password" name="password_c" placeholder="Password">
                    </div>
                    <div class="inputBx">
                        <input type="submit" value="Sign Up" name="signup">
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>