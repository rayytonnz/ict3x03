<?php
//session_start();
//include_once "../userInformation.php";
include "../config.php";
include"../authentication.php";

require '../twilio-php-master/Twilio/autoload.php';

use Twilio\Rest\Client;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$getRole = $_SESSION['userRole'];
//echo $getRole;

$getEmail = $_SESSION['userEmail'];
//echo $getEmail;
$getID = $_SESSION['userID'];
//echo $getID;

session_cashier_role_check();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <script src="../JS/checkCapsLock.js"></script>


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
        <script src="../JS/clickCreditTable.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/content.css">
        <link rel="stylesheet" type="text/css" href="../css/table.css">
        <link rel="stylesheet" href="../css/navigation.css" type="text/css"/>
        <title></title>
    </head>
    <body>
        <div class="topnav">
            <a class="active" href="cashier_home.php">Home</a> 
            <a id="right" href="../doLogout.php" class="btn-logout">Logout</a>

        </div>
        <div class="panel-body">
            <div class="row">
                <h3>Credit Listing</h3>
                <?php
                $creditquery = "SELECT * FROM credit";
                $result = mysqli_query($db, $creditquery);
                ?>
                <table class="table" border="1" id="credittable">
                    <tr class="tableheader">
                        <th class="thcredit"></th>
                        <th class="thcredit">Credit Name</th>
                        <th class="thcredit">Credit Price</th>
                    </tr>
                    <tbody>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='clickable-row'>";
                            echo "<td class='tdcredit'><button class='expand_button'>+</button></td>";
                            echo "<td class='tdcredit'>" . $row['creditName'] . "  </td>";
                            echo "<td class='tdcredit'>" . $row['creditPrice'] . "  </td>";
                            echo "</tr>";
                            echo "<tr><td class='expand' colspan='2'><p>This is a credit that cost $" . $row['creditPrice'] . "</p>"
                            . "</td><td class='expand' colspan='1'>"
                            . "<button class='buttoncredit' value='"
                            . $row['creditID']
                            . ","
                            . $row['creditName']
                            . ","
                            . $row['creditPrice']
                            . "'>Select</button>"
                            . "</td>"
                            . "</tr>";
                        }
                        ?>
                    </tbody>        

                </table>
                <div class="OTPnumber">
                    <form id="enter_number" method="post">
                        <p id="idvalue" class="value">You have selected </p>                     
                        <p>Please enter the customer phone number</p>
                        <p><input type="text" class="phone_number" name="phone_number" id="phone_number"/><p id="error_message"></p></p>
                        <p><input type="hidden" style="display:none" class="credit_otppid" id="credit_otppid" name="credit_otppid"/></p>
                        <p><input type="submit" name="submit" value="Send Code" /></p>
                        

                        <?php
                        if (isset($_POST['submit'])) {
                            $phoneNumber = $_POST["phone_number"];
                            $creditID = $_POST["credit_otppid"];
                            //echo '<script language="javascript">';
                            //echo 'alert("message '.$creditID.' successfully sent '.$phoneNumber.'");';
                            //echo '</script>';                       
                            $date = date("Y-m-d H:i:s");
                            $code = rand(100000, 999999);
                            $sql_select = "SELECT * FROM numbers where numberMobile = '$phoneNumber'";
                            $result = mysqli_query($db, $sql_select);
                            $count = mysqli_num_rows($result);

                            if ($count > 0) {
                                $customerdate = "";
                                while ($row = $result->fetch_assoc()) {
                                    $customerdate = $row['numberdate'];
                                }
                                $timenow = strtotime($date) - strtotime($customerdate);
                                if ($timenow > 120) {
                                    $sql_delete = "DELETE FROM numbers where numberMobile = $phoneNumber";
                                    if (mysqli_query($db, $sql_delete)) {
                                        $sql_insert = "INSERT INTO numbers (numberMobile, numberCode, numberVerified, numberCashier, numberCreditID, numberdate) VALUES($phoneNumber, $code, 0, '$getEmail',$creditID, '$date')";
                                        $result = mysqli_query($db, $sql_insert);

                                        $sidtokenquery = "SELECT * FROM sidtoken LIMIT 1";
                                        $result = mysqli_query($db, $sidtokenquery);
                                        $sidtoken = mysqli_fetch_array($result);
                                        $sid = $sidtoken['sid'];
                                        $token = $sidtoken['token'];
                                        $headerinfo = $sidtoken['info'];
                                        $botnumber = $sidtoken['botnumber'];
                                        $singaporecode = $sidtoken['singaporecode'];
                                        // Your Account SID and Auth Token from twilio.com/console
                                        // Instantiate a new Twilio Rest Client
                                        $client = new Client($sid, $token);
                                        echo '<script language="javascript">';
                                        echo 'alert("sent request to: ' . $sid . ' ' . $token . ' ' . $singaporecode . $phoneNumber . $code . '");';
                                        echo '</script>';
                                        // Disabled for time being
//                                $client->messages->create(
//                                                // the number you'd like to send the message to
//                                                $singaporecode . $phoneNumber, array(
//                                            // A Twilio phone number you purchased at twilio.com/console
//                                            'from' => $botnumber,
//                                            // the body of the text message you'd like to send
//                                            'body' => "Hey! Your Code is : " . $code
//                                                )
//                                        );
                                    }
                                } else {
                                    echo '<script language="javascript">';
                                    echo 'alert("Customer has already an existing OTP request sent for the last 2 minutes. Customer must complete the request before requesting again!");';
                                    echo '</script>';
                                }
                            } else {
                                echo '<script language="javascript">';
                                echo 'alert("ERROR! Customer is not a registered customer. Please try again!");';
                                echo '</script>';
                            }
                            mysqli_close($db);
                        }
                        ?>
                    </form>
                </div> 
            </div>
        </div>
    </body>
</html>
