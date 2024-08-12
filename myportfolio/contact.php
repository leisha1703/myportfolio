<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    

  // Your email address where you want to receive messages
  $to = "leisha1703@gmail.com";

  // Email subject
  $email_subject = "New Contact Form Submission: $subject";

  // Email headers
  $headers = "From: $name <$email>\r\n";
  $headers .= "Reply-To: $email\r\n";

  // Send the email
  $mail_success = mail($to, $email_subject, $message, $headers);

  // Check if the email was sent successfully
  if ($mail_success) {
      // Optionally, you can redirect the user to a thank-you page
      header("Location: thank-you.html");
      exit();
  } else {
      // Display an error message or redirect to an error page
      echo "Error sending email. Please try again.";
  }


    $host = "localhost";
    $username = "root";
    $password = "ipsleisha1703";
    $dbname = "contactdetails";

   
    $conn = mysqli_connect($host, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    
    $sql = "INSERT INTO contact_form (name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $subject, $message);
    mysqli_stmt_execute($stmt);

    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    
    header("Location: index.html");
    exit();
}
?>
