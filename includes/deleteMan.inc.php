<?php
include_once '../function.php';
session_start();
// DeleteManagement();
if(isset($_POST['deleteLast'])) {
  $connessione_al_server = dbConnect();
  $usr = $_SESSION['u_id'];
  // $query = "SELECT * FROM rectagle WHERE user_id = '".$usr."' ORDER BY time DESC LIMIT 4 ";
  $query = "SELECT * FROM rectagle WHERE user_id = '".$usr."' order by time desc limit " .$GLOBALS['MAXLENGHT']." FOR UPDATE";
  // $query = "SELECT * FROM rectagle WHERE user_id = '".$usr."' order by time desc limit  4";

  // mysqli_stmt_bind_param($query,$_SESSION['u_id']);
  $result = mysqli_query($connessione_al_server,$query);

  $numlines=mysqli_num_rows($result);
  // echo $numlines;
  // echo $result;
  if($numlines==0){
   // header('HTTP/1.1 307 temporary redirect');
    header("Location: ../index.php");
    echo "<script>alert('Non vi è più nulla da cancellare');</script>";
    exit();
  }
  else{
    $usr = $_SESSION['u_id'];
    // $query = "DELETE FROM rectagle WHERE user_id='".$usr."' ORDER BY time DESC LIMIT .$GLOBALS['MAXLENGHT'];
    $query = "DELETE FROM rectagle WHERE user_id='".$usr."' ORDER BY time DESC LIMIT " .$GLOBALS['MAXLENGHT'];

    $result = mysqli_query($connessione_al_server,$query);
    // if (!$result){
    //
    //   echo ('<script type="text/javascript">alert("Non vi è più nulla da cancellare");
    //
    //   </script>');
    // }

    // mysqli_free_result($result);
    mysqli_close($connessione_al_server);
    // echo "<meta http-equiv='refresh' content='0'>";
    header("Location: ../index.php");//error msg
    exit();
  }
}
else {
  header("Location: ../index.php");
  exit();
}

?>
