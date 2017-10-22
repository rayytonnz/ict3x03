<?php
include "../config.php";
include "../authentication.php";
include "../phpqrcode/qrlib.php";

/* For Securing QR Code (WIP)
require_once"../vendor/paragonie/halite/src/Halite.php";

use ParagonIE\Halite\HiddenString;
use ParagonIE\Halite\KeyFactory;
use ParagonIE\Halite\Symmetric\Crypto as Symmetric;*/


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//$getID = $_SESSION['userID'];
//echo $getID;

$getRole = $_SESSION['userRole'];
$getID = $_SESSION['userID'];
$getEmail = $_SESSION['userEmail'];
//echo $getID;

$query = "SELECT * FROM customers where custEmail = $getEmail LIMIT 1";

$result = mysqli_query($db, $query);
if ($result) {
    $customerinfo = mysqli_fetch_array($result);
    $phonenumber = $customerinfo['numberMobile'];
    echo '<script language="javascript">';
    echo 'alert("sent request to: ' . $phonenumber . '");';
    echo '</script>';
} else {
    echo '<script language="javascript">';
    echo 'alert("sent request to: rkewrjweorjwer");';
    echo '</script>';
}





$query2 = "SELECT * FROM numbers where numberMobile = 97705168 LIMIT 1";
$result2 = mysqli_query($db, $query2);
$creditinfo = mysqli_fetch_array($result2);
$creditid = $creditinfo['numberCreditID'];
$creditdate = $creditinfo['numberdate'];
$creditcashier = $creditinfo['numberCashier'];

$query3 = "SELECT * FROM credit where creditID = $creditid";
$result3 = mysqli_query($db, $query3);
mysqli_close($db);
?>

<html>
    <head>
        <title>View Pending Transaction</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/table.css">
        <link rel="stylesheet" href="../css/navigation.css" type="text/css"/>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- QR Code -->
        <script type="text/javascript" src="../JS/qrcode.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/content.css">
    </head>

    <body>
        <div class="topnav">
            <a href="customer_home.php">Home</a> 
            <a id="right" href="../doLogout.php" class="btn-logout">Logout</a>
            <a  class="active" id="right"href="customer_profile.php">Profile</a>
        </div>


        <div style="padding:60px;">
            <h2 class="text-center white">Profile</h2><br>
            <form id="enter_number" method="post" action="customer_enterotp.php">
                <table class="table" border="1">
                    <tr class="tableheader">
                        <th class="th">Credit Name</th>    
                        <th class="th">Credit Price</th>
                        <th class="th">Credit Date</th>
                        <th class="th">Cashier</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_assoc($result3)) {
                        
                        $creditName = $row['creditName'];
                        $creditPrice = $row['creditPrice'];
                        
                        echo "<tr>\n";
                        echo "  <td  class='td'>" . $row['creditName'] . "  </td>" . "\n";
                        echo "  <td  class='td'>" . $row['creditPrice'] . "  </td>" . "\n";
                        echo "  <td  class='td'>" . $creditdate . "  </td>" . "\n";
                        echo "  <td  class='td'>" . $creditcashier . "  </td>" . "\n";
                        echo "  </tr>";
                        
                     
                    }
                    ?>
                </table>
                <p><input type="text" class="otp_code" name="otp_code" id="otp_code"/></p>
                <p><input type="submit" name="submit" value="Verify" /></p> 

                
                <?php
                if (isset($_POST['submit'])){
                    //Supposed to work after verifying OTP
                    //get all details
                    //concatanate all values by using implode(),joined by "+" sign
                    //TODO: hash up values
                    //Generate QR Code
                    $qrArr = array($creditName,$creditPrice,$creditdate,$creditcashier);
                    $qrImp = implode("+",$qrArr);
                    $qrExp = explode("+",$qrImp);
                    print_r($qrExp);
                    
                    QRcode::png($qrImp,'../img/qrcode.png',QR_ECLEVEL_L,4);
                    echo '<img src="../img/qrcode.png"/>';
                

                    //For Securing QR Code (WIP)
                    /* $passwd = new HiddenString('correct horse battery staple');
                    // Use random_bytes(16); to generate the salt:
                    $salt = random_bytes(16);

                    $encryptionKey = KeyFactory::deriveEncryptionKey($passwd, $salt);

                    $qrArr = array($creditName,$creditPrice,$creditdate,$creditcashier);
                    $qrImp = implode("+",$qrArr);
                    $qrExp = explode("+",$qrImp);
                    print_r($qrExp);
                    
                    $message = new HiddenString($prImp);
                    $ciphertext = Symmetric::encrypt($message, $encryptionKey);
                    QRcode::png($ciphertext,'../img/qrcode.png',QR_ECLEVEL_L,4);
                    echo '<img src="../img/qrcode.png"/>';

                    $decrypted = Symmetric::decrypt($ciphertext, $encryptionKey);

                    var_dump($decrypted === $message); // bool(true)
                }
                    var_dump([
                        SODIUM_LIBRARY_MAJOR_VERSION,
                        SODIUM_LIBRARY_MINOR_VERSION,
                        SODIUM_LIBRARY_VERSION
                    ]);*/
                }
                ?>
            </form>          
        </div>

    </body>

</html>

