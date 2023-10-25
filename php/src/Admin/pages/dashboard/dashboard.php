<?php
    session_start();
    include_once '../../../sql/connect.php';
    include_once '../../../includes/domain.php';

 

    if(!isset($_SESSION['admin_login'])){
        $_SESSION['error'] = "Please login";
        header("location: {$domain}Admin/login.php");
    }
    $ad_id = $_SESSION['admin_login'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AndamanTour | Dashboard</title>
    <link rel="stylesheet" href="../../assets/Styles/dash_style.css">
    <link rel="stylesheet" href="../../assets/Styles/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <?php include_once("../../includes/sidebar.php")?>
    <div class="main-container">
        <div class="header">
            <div class="header-title">
                <?php
                    if(isset($_SESSION['admin_login'])){
                        $admin_id = $_SESSION['admin_login'];
                        $stmt = $conn->query("SELECT * FROM agents WHERE agentsID = $admin_id");
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                ?>
                <span><?php echo $row['agentsName'] . ' ' . $row['agentsLastname']?></span>
                <h2>Admin Dashboard</h2>
            </div>
            <div class="user-info">
                <a href="<?php echo "{$domain}Admin/agents/selectprofile/selectprofile.php?id=$ad_id"?>"><img src="<?php echo "{$domain}Admin/agents/img/" . $row['image'];?>" alt=""></a>
            </div>
        </div>
        
        <div class="card-container">
            <H3 class="main-title">Today's data</H3>
            <div class="card-wapper">
                <div class="agent-card">
                    <div class="card-header">
                        <div class="amout">
                            <?php
                                $stmt = $conn->prepare("SELECT COUNT(packID) as allPackage FROM packages");
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <span class="title">All package</span>
                            <span class="amout-value"><?php echo $row['allPackage']?></span>
                        </div>
                        <div class="icon"><i class="fa-solid fa-clipboard"></i></div>
                    </div>
                </div>

                <div class="agent-card">
                    <div class="card-header">
                        <div class="amout">
                            <span class="title">Reservation amount</span>
                            <span class="amout-value">500</span>
                        
                        </div>
                        <div class="icon"><i class="fa-solid fa-ship"></i></div>
                    </div>
                </div>

                <div class="agent-card">
                    <div class="card-header">
                        <div class="amout">
                            <span class="title">All package</span>
                            <span class="amout-value">500</span>
                        
                        </div>
                        <div class="icon"><i class="fa-solid fa-clipboard"></i></div>
                    </div>
                </div>

                <div class="agent-card">
                    <div class="card-header">
                        <div class="amout">
                            <span class="title">All package</span>
                            <span class="amout-value">500</span>
                        
                        </div>
                        <div class="icon"><i class="fa-solid fa-clipboard"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>