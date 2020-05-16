<?php
$r=7; $c=9; $MAXLENGHT=4;


function checkSession()
{
  $x;
  $t=time();
  $diff=0;

  if (isset($_SESSION['time_252848']) && isset($_SESSION['username_252848']))
  {
    $t0 = $_SESSION['time_252848'];
    $diff = ($t - $t0);
    if ($diff < 120)
    {
      $_SESSION['time_252848'] = time(); //update time
      $x = 0;
    }
    else
    {
      session_unset();
      session_destroy();

      $x=1;
      // session_start(); // col corretto funzionamento questo era commentato
      $_SESSION['message_252848']="Time out";
      $_SESSION['messagetype_252848']="error";

    }
  }
  else
  {
    $x=1;
  }
  return $x;
}

function checkHttps()
{
    if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS']== 'off') {
        header("Location: https://$_SERVER[HTTP_HOST]$_SERVER[SCRIPT_NAME]?$_SERVER[QUERY_STRING]");
        exit;
    }
}

function userLoggedIn() {
  if (isset($_SESSION['u_id'])) {
    return ($_SESSION['u_id']);
  } else {
    return false;
  }
}

function userNameLoggedIn(){
  if (isset($_SESSION['u_id'])) {
    return ($_SESSION['u_email']);
  } else {
    return false;
  }
}

function isMarked($matrix,$x,$y){
  foreach($matrix as $row){
    if($row['riga'] == $x && $row['colonna'] == $y) return true; //se è presente nel db
  }
  return false;
}
function isOwned($matrix,$x,$y){ //se è presente nel db
  $user = userLoggedIn();

  // $usser = $_SESSION['u_id'];
  foreach($matrix as $row){
    if($row['riga'] == $x && $row['colonna'] == $y) {
      if ($row['user_id']==$user) {
        // echo ('<script type="text/javascript">
        //   alert("ISOWNEDDDDDDDDDDDDDDDDDDDDDDDD");
        // </script>');
        return true;
      }
    }
  }
  return false; //nessun match
}

function initTableUser($r,$c,$MAXLENGHT){
  $connessione_al_server = dbConnect();
  //mysqli_autocommit ( $connessione_al_server, false );
  try {
    mysqli_autocommit($connessione_al_server,false);

    $query = "SELECT * FROM rectagle for update";
    if (!($result = mysqli_query($connessione_al_server,$query)))
    throw new Exception("Php: 1)Eccezione initTalbleUser");

    $matrix= mysqli_fetch_all($result,MYSQLI_ASSOC);

    //Inizializza tabella con identificativi
    for($i=0;$i<$r;$i++){ //per tutte le righe
      echo("<tr>");
      for($j=0;$j<$c;$j++){ //per tutte le colonne
        if (isOwned($matrix,$i,$j))
        echo("<td class= \"owned\" id=" .$i."_".$j. " onclick = selectCell(this,".$MAXLENGHT.")> </td>");
        else if (isMarked($matrix,$i,$j))
        echo("<td class= \"marked\" id=" .$i."_".$j. " onclick = selectCell(this,".$MAXLENGHT.")> </td>");
        else
        echo("<td class= \"free\" id=" .$i."_".$j. " onclick = selectCell(this,".$MAXLENGHT.")> </td>");
      }
      echo("</tr>");
    }

    // Free result set
    mysqli_free_result($result);
    mysqli_commit($connessione_al_server);
    mysqli_autocommit($connessione_al_server,true);
    mysqli_close($connessione_al_server);
  } catch (Exception $e) {
    mysqli_rollback($connessione_al_server);
    mysqli_autocommit($connessione_al_server,true);
    mysqli_close($connessione_al_server);
    echo $e->getMessage();
  }


}

function initTableGuest($r,$c,$MAXLENGHT)
{
  $connessione_al_server = dbConnect();

  try {
    mysqli_autocommit($connessione_al_server,false);

    $query = "SELECT * FROM rectagle FOR UPDATE";
    if (!($result = mysqli_query($connessione_al_server,$query)))
    throw new Exception("Php: 1)Eccezione initTalbleGuest");

    $matrix= mysqli_fetch_all($result,MYSQLI_ASSOC);

    //Inizializza tabella con identificativi
    for($i=0;$i<$r;$i++){
      echo("<tr>");
      for($j=0;$j<$c;$j++){
        if(isMarked($matrix,$i,$j)) echo("<td class= \"marked\" id=" .$i."_".$j. "> </td>");
        else echo("<td class= \"free\" id=" .$i."_".$j. "> </td>");
      }
      echo("</tr>");
    }
    mysqli_commit($connessione_al_server);
    mysqli_autocommit($connessione_al_server,true);
    mysqli_close($connessione_al_server);

  } catch (Exception $e) {
    mysqli_rollback($connessione_al_server);
    mysqli_autocommit($connessione_al_server,true);
    mysqli_close($connessione_al_server);
    echo $e->getMessage();
  }

  //mysqli_autocommit ( $connessione_al_server,
}


// function DeleteManagement(){
//   if(isset($_POST['deleteLast'])) {
//       $connessione_al_server = dbConnect();
//       $query = "DELETE FROM rectagle WHERE user_id=111 ORDER BY time DESC LIMIT 4";
//       $result = mysqli_query($connessione_al_server,$query);
//       if (!$result){
//
//         echo ('<script type="text/javascript">alert("Non vi è più nulla da cancellare");
//
//         </script>');
//       }
//       $numlines=mysqli_num_rows($result);
//       if($numlines<=0){
//         echo ('<script type="text/javascript">alert("Non vi è più nulla da cancellare");
//
//         </script>');
//       }
//       // mysqli_free_result($result);
//       mysqli_close($connessione_al_server);
//   }
// }


// sanitize input string
function sanitizeString($var, $conn) {

  $var = strip_tags($var);
  $var = htmlentities($var);
  $var = stripcslashes($var);
  return mysqli_real_escape_string($conn, $var);
}

// connect to the DB
// return connection handle
function dbConnect() {

  $conn = mysqli_connect("localhost", "root", "");
  if (mysqli_connect_errno()) {
    die("Internal error: connection to DB failed ".
    mysqli_connect_error());
  }
  if (!mysqli_select_db($conn, "s252848")) {
    die("Internal error: selection of DB failed");
  }
  return $conn;
}

function insertReactangle($ri, $ci, $rf, $cf, $usr){
  $conn=dbConnect();
  try{
    mysqli_autocommit($conn, false); //-----AUTOCOMMIT = FALSE
    $sql = ("SELECT * FROM rectagle FOR UPDATE");
      if (!($result=mysqli_query($conn,$sql)))
      throw new Exception("Internal error");
    $sql="SELECT * FROM rectagle
    WHERE (riga>='".($ri-1)."'AND riga<='".($rf+1)."')
    AND (colonna>='".($ci-1)."'AND colonna<='".($cf+1)."')";

    if (!($result=mysqli_query($conn,$sql)))
    throw new Exception("Internal error");
    if (!(mysqli_num_rows($result))==0)
    throw new Exception("Php: Inserimento rettangolo non valido");
    //sleep(5);
    $sql="INSERT INTO rectagle VALUES ";
    if ($ri==$rf){
      for ($i=0; $i<$GLOBALS['MAXLENGHT']-1; $i++)
      $sql.="('".$ri."','".($ci+$i)."','".$usr."','".date("Y-m-d H:i:s")."'), ";
      $sql.="('".$ri."','".($ci+$i)."','".$usr."','".date("Y-m-d H:i:s")."');";
    }
    else{
      for ($i=0; $i<$GLOBALS['MAXLENGHT']-1; $i++)
      $sql.="('".($ri+$i)."','".$ci."','".$usr."','".date("Y-m-d H:i:s")."'), ";
      $sql.="('".($ri+$i)."','".$ci."','".$usr."','".date("Y-m-d H:i:s")."');";
    }

    if (!($result=mysqli_query($conn,$sql)))
    throw new Exception("Php: Qualcuno ha fatto prima di te!");
    mysqli_commit($conn); //-------COMMIT
    mysqli_autocommit($conn, true);
    mysqli_close($conn);
    echo "Pezzo inserito con successo";

  }catch(Exception $e){
    mysqli_rollback($conn); //-----ROLLBACK
    mysqli_autocommit($conn, true);
    mysqli_close($conn);
    echo $e->getMessage();
  }


}

// function dbRead($usr){
//
//   $conn=dbConnect();
//   //$params=$GLOBALS['M']."_".$GLOBALS['N']."_".$GLOBALS['MAX'].",";
//   $params=$GLOBALS['r']."_".$GLOBALS['c']."_".$GLOBALS['MAXLENGHT'];
//   $cells="";
//
//   try{
//     $sql="SELECT * FROM cells";
//     if (!($result=mysqli_query($conn, $sql)))
//     throw new Exception("Internal error");
//     while ($row=mysqli_fetch_row($result))
//     $cells.=$row[0]."_".$row[1].",";//perché non mi fa accedere usando i nomi come indici?
//     $cells.="";
//     echo "<script> initTable(\"$params\"); </script>";
//     echo "<script> paintTable(\"$cells\"); </script>";
//     if ($usr!==""){
//       $sql="SELECT * FROM cells WHERE User='".$usr."'";
//       $cells="";
//       if (!($result=mysqli_query($conn, $sql)))
//       throw new Exception("Internal error");
//       while ($row=mysqli_fetch_row($result))
//       $cells.=$row[0]."_".$row[1].",";//perché non mi fa accedere usando i nomi come indici?
//       $cells.="";
//       echo "<script> paintCellsUser(\"$cells\"); </script>";
//     }
//   }
//   catch(Exception $e){
//     echo $e->getMessage();
//   }
//   mysqli_close($conn);
//
// }




?>
