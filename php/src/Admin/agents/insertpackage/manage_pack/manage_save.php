<?php
session_status();
require_once("../../../../sql/connect.php");
include_once '../../../../includes/domain.php';
$traget = "../pack_img/";
    if(isset($_GET['id'])){
        $pack_id = $_GET['id'];
        if(isset($_POST['save'])){
            $packname = $_POST['packname']; 
            $price = $_POST['Price'];
            $priceKid = $_POST['priceKid'];
            $promotion = $_POST['promotion'];
            $type = $_POST['Type'];
            $deteil = $_POST['deteil'];
            $date = date("d-m-Y");

            if(!isset($packname)){
                $_SESSION['error'] = 'Please enter the package name.';
                header("location:{$domain}Admin/agents/insertpackage/manage_pack/manage_pack.php");
           }else if(!isset($price)){
                $_SESSION['error'] = 'Please enter the package price.';
                header("location:{$domain}Admin/agents/insertpackage/manage_pack/manage_pack.php");
           }else if(!isset($deteil)){
                $_SESSION['error'] = 'Please enter the package deteil.';
                header("location:{$domain}Admin/agents/insertpackage/manage_pack/manage_pack.php");
           }else{
            try{
                        $up_pk = $conn->prepare("UPDATE packages SET packName = :packName, packPrice = :price, packtypeID = :type, packDeteil = :deteil, update_at = :date, promotion = :promotion, ticketKid = :priceKid WHERE packID = $pack_id");
                        $up_pk->bindParam(':packName', $packname);
                        $up_pk->bindParam(':price', $price);
                        $up_pk->bindParam(':type', $type);
                        $up_pk->bindParam(':deteil', $deteil);
                        $up_pk->bindParam(':date', $date);
                        $up_pk->bindParam(':promotion', $promotion);
                        $up_pk->bindParam(':priceKid', $priceKid);
                        $up_pk->execute();

                        $_SESSION['success'] = "Save package success.";
                        header("location:{$domain}Admin/agents/insertpackage/manage_pack/manage_pack.php?id=" . $pack_id);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
           }
        }else if(isset($_POST['save_image'])){
           try{
                $filename = basename($_FILES["file"]["name"]);
                $new_filename = rand(0, microtime(true)).'-'.$filename;
                $foder = $traget . $new_filename;
                $tragetType = pathinfo($foder, PATHINFO_EXTENSION);

                $allowType = array('jpg', 'png', 'jpeg', 'gif', 'pdf');

                if(in_array($tragetType, $allowType)) {
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $foder)){
                        $up_img = $conn->prepare("UPDATE packages SET image = :image WHERE packID = $pack_id");
                        $up_img->bindParam(':image', $new_filename);
                        $up_img->execute();

                        $_SESSION['success'] = "Save package success.";
                        header("location:{$domain}Admin/agents/insertpackage/manage_pack/manage_pack.php?id=" . $pack_id);
                    }else{
                        $_SESSION['error'] = "Something went wrong.";
                        header("location:{$domain}Admin/agents/insertpackage/manage_pack/manage_pack.php?id=" . $pack_id);
                    }
                }else{
                    $_SESSION['error'] = "Please enter an image file.";
                    header("location:{$domain}Admin/agents/insertpackage/manage_pack/manage_pack.php?id=" . $pack_id);
                }
           }catch(PDOException $e) {
                echo $e->getMessage();
           }
        } else {
            $_SESSION['error'] = "Something went wrong.";
            header("location:{$domain}Admin/agents/insertpackage/manage_pack/manage_pack.php");
        }
    }else{
        $_SESSION['error'] = "Something went wrong.";
        header("location:{$domain}Admin/agents/insertpackage/manage_pack/manage_pack.php");
    }
?>