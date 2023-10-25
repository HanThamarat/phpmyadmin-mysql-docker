<?php
  session_start();
  include_once '../../../sql/connect.php';
  include_once '../../../includes/domain.php';

  if(!isset($_SESSION['admin_login'])){
        header("location: {$domain}Admin/login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AndamanTour | Packages</title>
    <link rel="stylesheet" href="../../assets/Styles/sidebar.css">
    <link rel="stylesheet" href="package.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include_once "../../includes/sidebar.php"?>
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
                <h2>Admin Packages</h2>
            </div>
            <div class="user-info">
                <a href="<?php echo "{$domain}Admin/agents/selectprofile/selectprofile.php"?>"><img src="<?php echo "{$domain}Admin/agents/img/" . $row['image'];?>" alt=""></a>
            </div>
        </div>

        <!-- All package  -->
        <div class="table-card">
            <div class="main-title">
                <H3>All Packages</H3>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <?php
                            $stmt = $conn->query("SELECT packages.*, packagestype.packagesTypename FROM packagestype INNER JOIN packages ON packagestype.packagesTypeId = packages.packtypeID ORDER BY packID ASC");
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                        ?>
                        <tr>
                            <th>Number</th>
                            <th>Package ID</th>
                            <th>Package Name</th>
                            <th>Status</th>
                            <th>Edit</th>
                        </tr>
                        <tbody>
                            <?php
                                $n = 1;
                                foreach($result AS $row){
                            ?>
                            <tr>
                                <td><?php echo $n++;?></td>
                                <td><?php echo $row['packID'];?></td>
                                <td><?php echo $row['packName'];?></td>
                                <td><?php if($row['status'] == '1'){
                                    echo '<i class="fa-solid fa-circle" style="color: #ffff00;"></i> ONLINE';
                                }else{
                                    echo '<i class="fa-solid fa-circle" style="color: #323232;"></i> OFFLINE';
                                }?>
                                </td>
                                <td><a href="#">EDIT</a></td>
                            </tr>
                        </tbody>
                        <?php
                            }
                        ?>
                    </thead>
                </table>
            </div>
        </div>

        <!-- Package Confirm -->
        <div class="table-card">
            <div class="main-title">
                <H3>Packages Confirm</H3>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <?php
                            $stmt = $conn->query("SELECT packages.*, packagestype.packagesTypename FROM packagestype INNER JOIN packages ON packagestype.packagesTypeId = packages.packtypeID WHERE packages.status = '0'");
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                        ?>
                        <tr>
                            <th>Number</th>
                            <th>Package ID</th>
                            <th>Package Name</th>
                            <th>Status</th>
                            <th>Edit</th>
                        </tr>
                        <tbody>
                            <?php
                                $n = 1;
                                foreach($result AS $row){
                            ?>
                            <tr>
                                <td><?php echo $n++;?></td>
                                <td><?php echo $row['packID'];?></td>
                                <td><?php echo $row['packName'];?></td>
                                <td><?php if($row['status'] == '1'){
                                    echo '<i class="fa-solid fa-circle" style="color: #ffff00;"></i> ONLINE';
                                }else{
                                    echo '<i class="fa-solid fa-circle" style="color: #323232;"></i> OFFLINE';
                                }?>
                                </td>
                                <td>
                                    <div class="confirm-button">
                                        <div class="confirm"></div>
                                        <a href="<?php $pk_id = $row['packID']; echo "{$domain}Admin/pages/packages/cf.php?id=$pk_id"?>" name="confirm"><i class="fa-solid fa-check"></i>Confirm</a>
                                        <a href="<?php $pk_id = $row['packID']; echo "{$domain}Admin/pages/packages/cc.php?id=$pk_id"?>" name="cancel" id="cancel"><i class="fa-solid fa-ban"></i>Cancel</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <?php
                            }
                        ?>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>
</html>