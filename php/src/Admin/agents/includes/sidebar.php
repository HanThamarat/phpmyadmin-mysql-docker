<?php
    $domain = "http://localhost:8080/";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <link rel="stylesheet" href="sidebar_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo"><img src="<?php echo "{$domain}includes/img/logoText.png"?>" alt="logo" loading="lazy"></div>
            <ul class="menu">
                <li class="active"><a href="<?php echo "{$domain}Admin/agents/dashboard.php"?>"><i class="bi bi-speedometer"></i><span>Dashboard</span></a></li>
                <li><a href="<?php echo "{$domain}Admin/agents/insertpackage/insertpackage.php"?>"><i class="bi bi-clipboard2-plus"></i><span>Packages</span></a></li>
                <li><a href="#"><i class="bi bi-people"></i><span>Reservation</span></a></li>
                <li><a href="#"><i class="bi bi-speedometer"></i><span>Dashboard</span></a></li>

                <li class="setting"><a href="#"><i class="bi bi-gear"></i><span>Setting</span></a></li>
                <li class="logout">
                    <a href="<?php echo "{$domain}Admin/logout.php"?>"><i class="bi bi-box-arrow-in-right"></i><span>Logout</span></a>
                </li>
            </ul>
    </div>
</body>
</html>