<?php
include './includes/session.php';

if (isset($_POST)) {
    $conn = $pdo->open();

    $name = $_POST['name'];
    $link = $_POST['link'];
    $status = $_POST['status'];
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $stmt = $conn->prepare("UPDATE navlinks SET name=:name, link=:link, status=:status WHERE id=:id");
        $stmt->execute(['name' => $name, 'link' => $link, 'status' => $status, 'id' => $id]);
        $_SESSION['success'] = 'Navigation Link Added Successfully';
        header('location: ./navigation_view.php');
    } else {
        $stmt = $conn->prepare("INSERT INTO navlinks (name, link, status) VALUES (:name, :link, :status)");
        $stmt->execute(['name' => $name, 'link' => $link, 'status' => $status]);
        $_SESSION['success'] = 'Navigation Link Added Successfully';
        header('location: ./navigation_view.php');
    }
} else {
    $_SESSION['error'] = 'Invalid Post Request!';
    header('location: ./home.php');
}
