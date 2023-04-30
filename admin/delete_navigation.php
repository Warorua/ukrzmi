<?php
include './includes/session.php';
$conn = $pdo->open();

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("DELETE FROM navlinks WHERE id=:id");
    $stmt->execute(['id'=>$_GET['id']]);
    $_SESSION['success'] = 'Navigation Link Deleted Successfully!';
    header('location: ./navigation_view.php');
} else {
    $_SESSION['error'] = 'Error deleting Link!';
    header('location: ./navigation_view.php');
}
