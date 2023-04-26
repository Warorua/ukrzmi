<?php
include './includes/session.php';

if (isset($_GET['query'])) {
    $conn = $pdo->open();
    $stmt = $conn->prepare(
        "SELECT id, time, title, deep_link, type, photo_url, category, sub_1, sub_2, tag_1, tag_2, tag_3, author, source, input, hide_status FROM news " . $_GET['query'] . " ORDER BY id DESC"
    );
    $stmt->execute();
    $scrape = $stmt->fetchAll();
} else {
    $conn = $pdo->open();
    $stmt = $conn->prepare(
        "SELECT id, time, title, deep_link, type, photo_url, category, sub_1, sub_2, tag_1, tag_2, tag_3, author, source, input, hide_status FROM news ORDER BY id DESC"
    );
    $stmt->execute();
    $scrape = $stmt->fetchAll();
}

echo json_encode($scrape);
