<?php
include '../function.php';
checkHttps();
if(!isset($_SESSION)){
    session_start();
}

if (isset($_POST['submit'])) {
  $conn = dbConnect();
  $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    // $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
 $pwd = ($_POST['pwd']);

  //Error handlers
  //Check if input are empty
  if (empty($uid) || empty($pwd)) {
    header("Location: ../index.php?login=empty");
    exit();

  }else {
    try {
      mysqli_autocommit($conn, false); //-----AUTOCOMMIT = FALSE
      $sql = "SELECT *  FROM users WHERE user_email = '$uid'";
      if (!($result=mysqli_query($conn,$sql)))
      throw new Exception("1)Login error");
      $resultCheck = mysqli_num_rows($result);
      if($resultCheck<1)
        throw new Exception("1)Login error");else {
        if ($row = mysqli_fetch_assoc($result)) {
          //De-hashing password
          $hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
          if ($hashedPwdCheck == false)
            throw new Exception("1)Login error");
           elseif ($hashedPwdCheck == true) {
            //Log in the user here
            $_SESSION['u_id'] = $row['user_id'];
            $_SESSION['u_email'] = $row['user_email'];
            $_SESSION['time_252848']=time();
            $_SESSION['username_252848']=$row['user_id'];
            $_SESSION['message_252848']="Welcome New User!";
            $_SESSION['messagetype_252848']="ok";


                    mysqli_commit($conn); //-------COMMIT
                    mysqli_autocommit($conn, true);
                    mysqli_close($conn);
                    header("Location: ../index.php");//error msg
                    exit();
          }
        }
      }
    } catch (Exception $e) {
      mysqli_rollback($conn); //-----ROLLBACK
      mysqli_autocommit($conn, true);
      mysqli_close($conn);
      echo $e->getMessage();
      header("Location: ../index.php?ExceptionLogin.php");//error msg
      exit();
    }


  }

} else {
  header("Location: ../index.php?login=error");
  exit();
}
