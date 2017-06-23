<?php

if($_POST){
    $name = "test";
    $email = "m.jordash.26@gmail.com";
    $message = $_POST['messageEmail'];

//send email
    mail("m.jordash.26@gmail.com", "This is an email from:" .$email, $message);
}
?>

