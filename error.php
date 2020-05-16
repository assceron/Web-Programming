<!DOCTYPE html>
<html>
<head>
    <TITLE>CookieError</TITLE>
    <meta charset="UTF-8">


     <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>


<body  style="padding-top:70px; padding-bottom:70px ">
    <!--html header-->

    <div id="header">


    </div>

    <div id="homeerror" class="container">

            <!-- if javascript is disabled a warning message is displayed -->

            <!-- if cookies are disabled a warning message is showed -->
            <script type="text/javascript">
                function checkCookie(){
                if(document.cookie.indexOf('PHPSESSID')!=-1){
                    $("#cookienotset").hide();
                    window.location.replace('index.php');
                }
                else {
                    $("#cookienotset").show();
                }}
            </script>
            <!-- body of warning message, button to check if javascript or cookie was enabled -->
            <div  id="cookienotset">
                <div class="row">
                    <div class='alert alert-danger'>
                        Abilita i cookies!!!
                    </div>
                </div>
                <div class="row">
                    <form name='bookform' method="post" onsubmit="checkCookie()" action="index.php" enctype="multipart/form-data">
                        <br><INPUT class="btn btn-block" type=submit name=nocookie value='Torna alla home'></br>
                    </form>
                </div>
            </div>

    </div>

    <!--html footer-->
    <div id="footer">
    </div>

</body>


</html>
