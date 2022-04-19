<?php
include 'includes/session.php';
// Specifying directory
$mydir = './images';

// Scanning files in a given directory in ascending order
$myfiles = scandir($mydir);
$conn = $pdo->open();
// Displaying the files in the directory
$valid = 0;
$invalid = 0;
foreach($myfiles as $item){
    $stmt =  $conn->prepare("SELECT COUNT(*) AS numrows FROM news WHERE photo=:photo");
    $stmt->execute(['photo'=>$item]);
    $ct = $stmt->fetch();
    if($ct['numrows'] < 1){
        $invalid = $invalid + 1;
        echo "Picture - <b style='color:red'>".$item."</b><br/>";
        unlink("./images/".$item);
    }
    else{
        $valid = $valid + 1;
        echo "Picture - <b style='color:green'>".$item."</b><br/>";
    }
    //echo "Picture - <b>".$item."</b><br/>";
}
echo "
<h1 style='color:red'>".$invalid." Invalid (Have been deleted)</h1><br/>
<h1 style='color:green'>".$valid." Valid</h1>
";
?>
