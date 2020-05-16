<?php
include 'function.php';
if(!isset($_SESSION)){
  session_start();
}


checkHttps();

// if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS']== 'off') {
//     $redirect="https://".$_SERVER["SERVER_NAME"].":443".$_SERVER['REQUEST_URI'];
//     header("Location: ".$redirect);
//     exit;
// }
$resSession = checkSession();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>s252848</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script type="text/javascript" src="jquery.js"></script>
  <script type="text/javascript" src="JSFunctions.js"></script>
  <script type="text/javascript">
      if(!(document.cookie.indexOf('PHPSESSID')!=-1))
        window.location.replace('error.php');
  </script>
</head>
<body>

  <div id="main-container">
    <div id="header">

        <h1>Rectangle Game</h1>

    </div>

    <div id="content">
      <noscript>
        <div class="row" >
          <div class='alert alert-danger'>
            Javascript richiesto. Potrebbe non essere possibile testare se i cookies sono abilitati.
          </div>
        </div>
      </noscript>
      <div id="menu" class="menus">
        <p>
           <a id="homelink" href="index.php">Home</a>
        </p>

        <?php
        if (!$resSession) {
        echo "<p>Bentornato!</p>  <p>Puoi inserire pezzi di dimensione=$MAXLENGHT</p>";
      }
      ?>
      <div id="form" class="nav-login">

        <?php
        if ($resSession)
        include 'guestMenu.php';
        else
        include 'userMenu.php';
        ?>

      </div>
    </div>


    <div id="main">

      <?php
      if(isset($_GET['success']) && $_GET['success']==='1'){
        echo ('<script type="text/javascript">
            alert("utente reg");
          </script>');
          //header("Location: index.php");
      }

      if ($resSession)  include 'guestTable.php';
      else  include 'userTable.php';
      ?>
    </div>
  </div>


  <div class="footer">
    <p>
      <h3>s252848WebSite - Copyright 2018 Mirko Bertone</h3>
    </p>
  </div>

</div>
</body>
</html>
