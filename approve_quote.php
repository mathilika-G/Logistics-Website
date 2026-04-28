<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';
include 'db_connect.php';

if(isset($_GET['id']) && isset($_GET['amount'])) {
    $qid = $_GET['id'];
    $price = $_GET['amount'];

    mysqli_query($conn, "UPDATE tbl_QuoteForm SET Quoted_price = '$price', Status = 'quoted' WHERE Id = '$qid'");

    $res = mysqli_query($conn, "SELECT Email, Name FROM tbl_QuoteForm WHERE Id = '$qid'");
    $user = mysqli_fetch_assoc($res);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mathivijaya04@gmail.com';
        $mail->Password   = 'oamf ardf yuok jnrg';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('mathivijaya04@gmail.com', 'Shadowws Logistics');
        $mail->addAddress($user['Email']);

        $accept_url = "http://localhost/Import_Export_Web/accept_shipments.php?qid=" . $qid;
        $mail->isHTML(true);
        $mail->Subject = 'Quote Approved - Action Required';
        $mail->Body = "<h3>Hello " . $user['Name'] . ",</h3>
               <p>Your shipping quote has been approved! The calculated price for your shipment is <b>Rs" . $price . "</b>.</p>
               <p>If you are satisfied with this quote, please click the button below to accept and generate your unique Tracking ID.</p>
               <br>
               <p><a href='$accept_url' style='background:#fcdc04; color:#000; padding:12px 20px; font-weight:bold; text-decoration:none; border-radius:5px;'>Accept Quote & Get Tracking ID</a></p>
               <br>
               <p>Thank you for choosing Shadowws Logistics!</p>";

        $mail->send();
        echo "Success";
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}
?>