<?php
    session_start();
    include_once '../../includes/domain.php';
    include_once '../../sql/connect.php';


    if(!isset($_SESSION['agents_login'])){
        $_SESSION['error'] = "Please login";
        header("location: {$domain}Admin/login.php");
    }

    $id = $_SESSION['agents_login'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AndamanTour | Dashboard</title>
    <link rel="stylesheet" href="includes/sidebar_style.css">
    <link rel="stylesheet" href="dashboard_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <?php include_once("includes/sidebar.php")?>
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
                <h2>Agent Dashboard</h2>
            </div>
            <div class="user-info">
                <a href="<?php echo "{$domain}Admin/agents/selectprofile/selectprofile.php?id=" . $row['agentsID']?>"><img src="<?php echo "{$domain}Admin/agents/img/" . $row['image'];?>" alt="profile"></a>
            </div>
        </div>
        <div class="card-container">
            <H3 class="main-title">Today's data</H3>
            <div class="card-wapper">
                <div class="agent-card">
                    <div class="card-header">
                        <div class="amout">
                            <?php
                                $stmt = $conn->prepare("SELECT COUNT(packID) as allPackage FROM packages WHERE agents_ID = $id");
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
        
        <div class="table-card">
            <H3 class="main-title">Order amount package</H3>
            <div class="table-container">
                <table>
                    <tr>
                        <th></th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> <!-- jquery -->
    <script>
        let specificDate = new Date();

        let year = specificDate.getFullYear();
        let month = String(specificDate.getMonth() + 1).padStart(2, '0');
        let day = String(specificDate.getDate()).padStart(2, '0');

        let date = `${year}-${month}-${day}`;
        let Url = "https://data.tmd.go.th/nwpapi/v1/forecast/location/daily/at?lat=8.042129&lon=98.836766&fields=tc_max,rh&date="+ date +"&duration=2";

        console.log(date);
        var tdmApi = {
            "async": true,
            "crossDomain": true,
            "url": Url,
            "method": "GET",
            "headers": {
                "accept": "application/json",
                "authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImFiNzFjNDlmZTY4ZWE2ZjNhMDRmZTYzOGJkNjAyOTM0YjhlZWI3Y2UzZDQzZDg5Y2JlMDgxNjgxMjM4MTEwYjA4NDFiNTM5NzJhNzIyMmM1In0.eyJhdWQiOiIyIiwianRpIjoiYWI3MWM0OWZlNjhlYTZmM2EwNGZlNjM4YmQ2MDI5MzRiOGVlYjdjZTNkNDNkODljYmUwODE2ODEyMzgxMTBiMDg0MWI1Mzk3MmE3MjIyYzUiLCJpYXQiOjE2OTYyNTI5OTksIm5iZiI6MTY5NjI1Mjk5OSwiZXhwIjoxNzI3ODc1Mzk5LCJzdWIiOiIyNzk3Iiwic2NvcGVzIjpbXX0.b-U9JWaWTZ-2LJAL-PI_wMMBZGRUXi3xxTvR4Yf_c9SoAtZLAEQ9adcmKGTWp08vUrcQHzDJ0K8dHIxTXXoRD93P__3RV_1ypSvMdPWMxPDFKELyMTmcx3LbYLF4p6GBghPDo3KIBqoDqRw9nt6QJ-cpz6XnGEKnqnFCetzZ-qf7GEsgfl0D2cm6qGH3Nj3WIw3mkfJkzL0-Mxp4-K90wE2FsmXib8xmlGSh6MUGAVj_Wfv5GsAJu_e2wm-pgFBGKvG5VZ3iCZRIFeOK28va97SXP2_oi-gvNcUusSqoItWRQ2H0OCV_9gKFKeAMpJNYm4x8Wzylkkkl5nkTjui87jZj-SaSkyL9GYLbdV0KkA7BXm26xeUW6OS3PAJi-6RPAG40diLUjD8WXHxrPeI_0GW2eR3NEOX9HKDtWVIxBVvPFgzIP_dOpnaU2enjLLfuTq2OhkFZfrAosjFX_nl4TgFOEABNagCxAMK_y8JJDZ53sCGFs4sogOJhjazXgW1TCdtt3mbK_2CMPE7zDMs3RvcWfoz7BtSrzNeVzIoClx8wNJcVwuvQliVNW4Ny7wuX1c_XD7As0nuzyrlgWwKUM0CzaAlnTsMlTBqsTUxgrVcxfihuP-X9YbyX6ondiagXOxLH4iW-8OgW6aZSM89tqfuwA26wQWRiTPcOY_AAyiE",
            }
        }

        $.ajax(tdmApi).done(function(response) {
            console.log(response);
        });
    </script>
</body>
</html>