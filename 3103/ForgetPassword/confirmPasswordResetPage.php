<?php
//session_start();
include "../authentication.php";
// get the values here
$userEmail = $_SESSION['userEmail'];
$getUserId = $_SESSION['userID'];
?>
<script>
var userID = <?php echo($getUserId); ?>;
</script>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Shopping Credit</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!-- Validator -->
        <script src="https://code.jquery.com/jquery-1.12.4.js">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js">
        </script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=PT+Serif" rel="stylesheet">

        <link rel="stylesheet" href="css/common.css">
        <link rel="stylesheet" href="css/button.css">
    </head>

    <style>
        body {
            padding-top: 20px;
            background-color:#DFE3EE ;
        }
    </style>

    <body>
        <div class="container">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Reset Password Confirmation</h3>
                </div>
                <div class="panel-body text-center">
                    <div class="col-lg-12">

                        <form action="doResetPassword.php" method="POST" name="resetForm" onsubmit="return CheckPassword();" data-toggle="validator" style="display: block;">
                            <div class="form-group">
                                
                                <label for="">New password</label>
                                <input type="password" class="form-control" name="inputNew" id="inputNew" placeholder="New password" minlength="8" required >

                                <label for="">Confirm password</label>
                                <input type="password" class="form-control" name="inputConfirm" id="inputConfirm" placeholder="Confirm password"  minlength="8" required  >
                            </div>

                            <!--hidden post values over  -->
                            <input type ="hidden" name="userEmail" value="<?php echo $userEmail; ?>">

                            <input type="submit" name="resetPassword" class="btn btn-primary" value="Reset Password">
                            
                        </form>
                        
                        <p id="error_para" ></p>
                    </div>
                </div>
            </div>         
        </div>

    </body>
    <script src="../JS/checkSamePassword.js"></script>
    <script>
    function CheckPassword()
    {
        
        var input = document.getElementById("inputNew");
        var inputConfirm = document.getElementById("inputConfirm");
        var decimal = /((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20})/;
        
        if (!decimal.test(input.value)){
            error = " New password requires one uppercase, one lowercase, one digit and one special char (@#$%). Min 8 characters, max 20 characters.";
            document.getElementById( "error_para" ).innerHTML = error;
            return false;
        } if (input.value !== inputConfirm.value){
            error = " Passwords don't match ";
            document.getElementById( "error_para" ).innerHTML = error;
            return false;
        }
        else{
            return true;
        }
    }
</script>
</head>
</html>

