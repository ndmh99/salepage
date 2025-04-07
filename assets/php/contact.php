<?php

  function json_response($data = null, $code = 200) {
    header_remove();
    http_response_code($code);
    header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
    header('Content-Type: application/json');

    $status = array(
      200 => '200 OK',
      400 => '400 Bad Request',
      422 => 'Unprocessable Entity',
      500 => '500 Internal Server Error'
    );

    // ok, validation error, or failure
    header('Status: ' . $status[$code]);
    
    // return the encoded json
    return json_encode(array(
      'status' => $code < 300, // success or not?
      'data' => $data
    ));
  }

  // Get the submitted form data
  $name = $_POST['contact_name'];

  $email = $_POST['contact_email'];

  $phone = $_POST['contact_phone'];

  $subject = $_POST['contact_subject'];

  $message = $_POST['contact_message'];

  // Check whether submitted data is not empty
  if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
    
    // Recipient email
    $toEmail = 'to@mail.com';  // ← Your email here

    $emailSubject = 'Message from a site visitor - ' . $email;

    $htmlContent = '<h3>Contact Request Submitted</h3>

    <p> <strong>Name:</strong> ' . $name . '</p>

    <p> <strong>Email:</strong> ' . $email . '</p>

    <p> <strong>Phone:</strong> ' . $phone . '</p>

    <p> <strong>Subject:</strong> ' . $subject . '</p>

    <p> <strong>Message:</strong> </p> <p>' . $message . '</p>';

    // Set content-type header for sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";

    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Additional headers
    $headers .= 'From: ' . $name . '<' . $email . '>' . "\r\n";
    
    $headers .= 'Reply-To: ' . $email . "\r\n";

    // Send email
    if (mail($toEmail, $emailSubject, $htmlContent, $headers)) {
      echo json_response([
      ], 200);
    } else {
      echo json_response([
      ], 500);
    }
  } else {
    echo json_response([
    ], 400);
  }

?>