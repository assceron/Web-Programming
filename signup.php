<?php
include 'function.php';
if(!isset($_SESSION)){
    session_start();
}
checkHttps();

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
      if(document.cookie.indexOf('PHPSESSID')!=-1)
          document.getElementById('form').style.display='';
      else {
          window.location.replace('error.php');
      }
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
      <div id="menu">

        <p>
          <a id="homelink" href="index.php">Home</a>
        </p>
        <div class="nav-login">

          <form action="includes/login.inc.php" method="POST">
            <p>
              <input type="text" name="uid" placeholder="E-mail">
            </p>
            <p>
              <input type="password" name="pwd" placeholder="Password">
            </p>
            <p>
              <button type="submit" name="submit">Login</button>
            </p>
          </form>
          <p>
            <a href="signup.php">Sign up</a>
          </p>
        </div>
      </div>

      <div id="main" class=main-signup>

            <h2>Signup</h2>

          <div class="signup-form">

          <form class="signup-form" action="includes/signup.inc.php" method="POST" onsubmit="return checkForm(this)">
          <!-- <form id="signupid" class="signup-form" action="includes/signup.inc.php" method="POST"> -->
          <p>
            <input type="text" name="email" placeholder="E-mail">
          </p>
          <p>
            <input type="password" name="pwd" placeholder="Password">
          </p>
            <!-- <button type="submit" name="submit" onclick="checkForm(this)" >Sign up</button> -->

              <button type="submit" name="submit">Sign up</button>


          </form>
        </div>



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
