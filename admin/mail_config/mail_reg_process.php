<?php
include '../includes/conn.php';
session_start();
if(!isset($_POST['submit'])){
    $sender = $_POST['sender'];
    $_SESSION['error'] = 'Invalid request';
    header('location: ../'.$sender);
}
else{
    $port = $_POST['port'];
    $host = $_POST['host'];
    $mail = $_POST['mail'];
    $mail_password = $_POST['mail_password'];
    $subject = $_POST['subject'];
    $set_from =  $_POST['set_from'];
    $name = $_POST['name'];
    $head = $_POST['head'];
    //$sub_head = $_POST['sub_head'];
    $sub_head = 'null';
    $top_body = $_POST['top_body'];
    $bottom_body = $_POST['bottom_body'];

    $conn = $pdo->open();
    $stmt = $conn->prepare("INSERT INTO mail (port, host, mail, mail_password, subject, set_from, name, head, sub_head, top_body, bottom_body) VALUES (:port, :host, :mail, :mail_password, :subject, :set_from, :name, :head, :sub_head, :top_body, :bottom_body)");
    $stmt->execute(['port'=>$port, 'host'=>$host, 'mail'=>$mail, 'mail_password'=>$mail_password, 'subject'=>$subject, 'set_from'=>$set_from, 'name'=>$name, 'head'=>$head, 'sub_head'=>$sub_head, 'top_body'=>$top_body, 'bottom_body'=>$bottom_body]);

    $_SESSION['success'] = 'Mail configuration set successfully!';
    header('location: ../'.$sender);


}
?>