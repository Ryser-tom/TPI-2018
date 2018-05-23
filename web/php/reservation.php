<?php
session_start();
try{
    if(isset($_SESSION['userId'])){
        if(isset($_POST['vehicleId']) && isset($_POST['startDate']) && isset($_POST['endDate'])){
            require_once('fonctionsBD_insert.php');
            $vehicleId = filter_input(INPUT_POST, 'vehicleId', FILTER_SANITIZE_NUMBER_INT);
            $startDate = filter_input(INPUT_POST, 'startDate', FILTER_SANITIZE_STRING);
            $endDate = filter_input(INPUT_POST, 'endDate', FILTER_SANITIZE_STRING);
            if(addReservation($_SESSION['userId'], $vehicleId, $startDate, $endDate)){//à vérifier
                throw new exception("true");
            exit;
            }else{
                throw new exception("false");
            }
        }
    }
}
catch(exception $e){
    header("location: ../view/index.php?result=".$e->getMessage());
    exit;
}
?>