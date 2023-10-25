<?php
      session_start();
      include_once '../../../sql/connect.php';
      include_once '../../../includes/domain.php';

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        try{
            $up_st = $conn->prepare("UPDATE packages SET status = '1' WHERE packID = $id");
            $up_st->execute();

            header("location: {$domain}Admin/pages/packages/package.php");
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

?>