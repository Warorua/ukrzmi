<?php
include '../includes/conn.php';
$output = '';
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT * FROM authors");
$stmt->execute();
$author = $stmt->fetchAll();
$output .= '
<table id="scrapedData" class="table table-bordered table-striped table-sm">
<thead>
<tr>
  <th>ID</th>
  <th>Name</th>
  <th>Photo</th>

  <th>Role</th>
  <th>Status</th>
  <th>Reports</th>
  <th>Evaluations</th>
  <th>Trust Index</th>
  <th>Description</th>
  <th>Content</th>
  

  <th>Admin</th>
</tr>
</thead>
<tbody>
';
foreach($author as $row){
$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM news WHERE author=:author");
$stmt->execute(['author'=>$row['name']]);
$author_count = $stmt->fetch();
$output .= '
                    <tr>
                    <td></td>
                    <td>'.$row['name'].'</td>
                    <td></td>

                    <td></td>
                    <td>Active</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
          



                    <td>'.$author_count['numrows'].'</td>
                    <td><a class="btn btn-info" href="author_article.php?id='.$row['id'].'">Admin</a></td>
                  </tr>
  
   '; 
}
$output .= '

</tbody>              
</table>
';
echo $output;
?>