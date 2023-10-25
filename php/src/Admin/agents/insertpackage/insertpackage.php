<?php
    session_start();
    include_once '../../../sql/connect.php';
    include_once '../../../includes/domain.php';

    if(!isset($_SESSION['agents_login'])){
        header("location: {$domain}Admin/login.php");
    }
    $ag_id = $_SESSION['agents_login'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AndamanTour | Insertpackage</title>
    <link rel="stylesheet" href="insertpackage_style.css">
    <link rel="stylesheet" href="../includes/sidebar_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <style>
       
    </style>
    <?php include_once("../includes/sidebar.php")?>
    <div class="main-container">
        <div class="header">
            <div class="header-title">
                <?php
                    if(isset($_SESSION['agents_login'])){
                        $agents_id = $_SESSION['agents_login'];
                        $stmt = $conn->query("SELECT * FROM agents WHERE agentsID = $agents_id");
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                ?>
                <span><?php echo $row['agentsName'] . ' ' . $row['agentsLastname']?></span>
                <h2>Agent Manage package</h2>
            </div>
            <div class="user-info">
                <a href="<?php echo "{$domain}Admin/agents/selectprofile/selectprofile.php?id=" . $row['agentsID']?>"><img src="<?php echo "{$domain}Admin/agents/img/" . $row['image'];?>" alt="profile"></a>
            </div>
        </div>
        <div class="table-card">
            <div class="main-title">
                <H3>Packages</H3>
                <button><a href="<?php echo "{$domain}Admin/agents/insertpackage/addpackage.php"?>">Add New package</a></button>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <?php
                            $stmt = $conn->query("SELECT packages.*, packagestype.packagesTypename FROM packagestype INNER JOIN packages ON packagestype.packagesTypeId = packages.packtypeID WHERE packages.agents_ID = $ag_id ORDER BY packID ASC");
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                        ?>
                        <tr>
                            <th>Number</th>
                            <th>Package ID</th>
                            <th>Package Name</th>
                            <th>Package Type</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Edit</th>
                        </tr>
                        <tbody>
                            <?php
                                $n = 1;
                                foreach($result AS $row){ //foreach การ loop data
                                $row['packID'];
                            ?>
                            <tr>
                                <td><?php echo $n++; ?></td>
                                <td><?php echo $row['packID']; ?></td>
                                <td><?php echo $row['packName']; ?></td>
                                <td><?php echo $row['packagesTypename']; ?></td>
                                <td><?php echo $row['packPrice']; ?></td>
                                <td><?php if($row['status'] == 1){
                                    echo '<i class="fa-solid fa-circle" style="color: #ffff00;"></i> ONLINE';
                                }else{
                                    echo '<i class="fa-solid fa-circle" style="color: #323232;"></i> OFFLINE';
                                } ?></td>
                                <td>
                                    <a href="<?php echo "{$domain}Admin/agents/insertpackage/manage_pack/manage_pack.php?id=" . $row['packID'];?>">EDIT</a>

                                    
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>
</html>