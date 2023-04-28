<?php
include './includes/session.php';



$conn = $pdo->open();
$stmt = $conn->prepare(
    "SELECT id, time, title, deep_link, type, photo_url, category, sub_1, sub_2, tag_1, tag_2, tag_3, author, source, input, hide_status FROM news ORDER BY id DESC"
);
$stmt->execute();
$scrape = $stmt->fetchAll();


if (isset($_GET['query'])) {
    if ($_GET['query'] != '') {
        $query = json_decode(base64_decode($_GET['query']), true);
    } else {
        $query = '';
    }

    if (is_array($query)) {
        foreach ($query as $id => $row) {
            $scrape = filter_by_key(
                $scrape,
                [
                    $row
                ],
                $id,
                'id'
            );
        }
    }
}



echo json_encode($scrape);
