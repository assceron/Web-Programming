<?php
include '../function.php';
checkHttps();
if (isset($_POST['submit'])) {
  $conn = dbConnect();

  $emailDirty = ($_POST['email']);
  $pwdDirty = ($_POST['pwd']);
  $pwd = $_POST['pwd'];


  //Error handlers
  //Check for empty fields
  if(empty($emailDirty) || empty($pwdDirty)){
    mysqli_close($conn);
    header("Location: ../signup.php?signup=empty");//error msg
    exit();
  }
  else {
    $email = sanitizeString($emailDirty,$conn);
    // $pwd =sanitizeString($pwdDirty,$conn);
    //Check email is valid

    if($email!=$emailDirty){
      mysqli_close($conn);
      header("Location: ../signup.php?signup=HACKER");//error msg
      exit();
    }

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      mysqli_close($conn);
      header("Location: ../signup.php?signup=emailNotValid");//error msg
      exit();
    }
    //Check pattern


    else {
      $patterPwd = "/^(?=.*\W.*)(?=.*\S)[a-zA-Z0-9\S]{3,}$/";
      // $patterEmail = "/^[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}$/";

      if(!preg_match($patterPwd,$pwd)){
        mysqli_close($conn);
        header("Location: ../signup.php?signup=pwdNotGood");//error msg
        exit();
      }

      // code...
    }
    //START FINALLY
    try {
      mysqli_autocommit($conn, false); //-----AUTOCOMMIT = FALSE
      $sql = "SELECT * FROM users WHERE user_email='$email' FOR UPDATE";
      if (!($result=mysqli_query($conn,$sql)))
      throw new Exception("1)Exception in signup");
      $resultCheck = mysqli_num_rows($result);
      if($resultCheck>0)
        throw new Exception("Internal error");

      else {
        //Hashing pwd
        $hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);
        //Insert the user in the database
        $sql = "INSERT INTO users (user_email,user_pwd)
        VALUES ('$email', '$hashedPwd');";
        if (!($result=mysqli_query($conn,$sql)))
        throw new Exception("2)Exception in signup");
        // header("Location: ../signup.php?signup=success");//error ms


        mysqli_commit($conn); //-------COMMIT
        mysqli_autocommit($conn, true);
        mysqli_close($conn);
        header("Location: ../index.php?success=1");//error msg
        exit();
      }
    } catch (Exception $e) {
      mysqli_rollback($conn); //-----ROLLBACK
      mysqli_autocommit($conn, true);
      mysqli_close($conn);

      header("Location: ../signup?ExceptionSignup.php");//error msg
      exit();
    }


  }
}

else {
  header("Location: ../signup.php");
  exit();
}
