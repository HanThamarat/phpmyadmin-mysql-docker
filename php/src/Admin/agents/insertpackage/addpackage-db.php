<?php
session_start();
include_once("../../../sql/connect.php");
include_once '../../../includes/domain.php';
$id = $_GET['id'];
$traget = "pack_img/";

    if(isset($_POST['upload'])){
        $packname = $_POST['packname']; 
        $price = $_POST['Price'];
        $priceKid = $_POST['priceKid'];
        $type = $_POST['Type'];
        $deteil = $_POST['deteil'];
        $date = date("d-m-Y");

       if(!isset($packname)){
            $_SESSION['error'] = 'Please enter the package name.';
            header("location: {$domain}Admin/agents/insertpackage/addpackage.php");
       }else if(!isset($price)){
            $_SESSION['error'] = 'Please enter the package price.';
            header("location: {$domain}Admin/agents/insertpackage/addpackage.php");
       }else if(!isset($deteil)){
            $_SESSION['error'] = 'Please enter the package deteil.';
            header("location: {$domain}Admin/agents/insertpackage/addpackage.php");
       }else{
        try{
                $filename = basename($_FILES["file"]["name"]);
                $new_filename = rand(0, microtime(true)).'-'.$filename;
                $foder = $traget . $new_filename;
                $tragetType = pathinfo($foder, PATHINFO_EXTENSION);

                $allowType = array('jpg', 'png', 'jpeg', 'gif', 'pdf');

                if(in_array($tragetType, $allowType)){
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $foder)){
                        $in_pk = $conn->prepare("INSERT INTO packages(packName, packPrice, packtypeID, packDeteil, agents_ID, create_at, image, ticketKid)
                        VALUES (:packname, :price, :type, :deteil, :id, :date, :image, :ticketKid)");
                        $in_pk->bindParam(':packname', $packname);
                        $in_pk->bindParam(':price', $price);
                        $in_pk->bindParam(':type', $type);
                        $in_pk->bindParam(':deteil', $deteil);
                        $in_pk->bindParam(':id', $id);
                        $in_pk->bindParam(':date', $date);
                        $in_pk->bindParam(':image', $new_filename);
                        $in_pk->bindParam(':ticketKid', $priceKid);
                        $in_pk->execute();

                        header("location: {$domain}Admin/agents/insertpackage/insertpackage.php");
                    }else{
                        $_SESSION['error'] = "Something went wrong.";
                        header("location: {$domain}Admin/agents/insertpackage/addpackage.php");
                    }
                }else{
                    $_SESSION['error'] = "Please enter an image file.";
                    header("location: {$domain}Admin/agents/insertpackage/addpackage.php");
                }

        }catch(PDOException $e){
            echo $e->getMessage();
        }
       }
    }
?>