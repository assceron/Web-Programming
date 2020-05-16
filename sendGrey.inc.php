<?php
include 'function.php';
session_start();
checkSession();

if (isset( $_POST['rigai']) && isset( $_POST['colonnai']) && isset( $_POST['rigaf']) && isset( $_POST['colonnaf']) ){
$ri = $_POST['rigai'];
$ci = $_POST['colonnai'];
$rf = $_POST['rigaf'];
$cf = $_POST['colonnaf'];


  if(isset($_SESSION['u_id'])){
    $usr=userLoggedIn();
    insertReactangle($ri,$ci,$rf,$cf,$usr);
    // initTableUser($r,$c,$MAXLENGHT);
    // echo "Inserito con successo";


  }
  else {
    echo "Non messa";
  }

}
else {
  echo "NotIsset";
}


// if(isset($_SESSION['u_id'])){
//   $usr=userLoggedIn();
//   insertChain($ri,$ci,$rf,$cf,$usr);
//
// }
// else {
//   echo "Non messa";
// }


?>
