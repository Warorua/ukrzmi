<?php

include ('full_coverage/vendor/autoload.php');
use \NlpTools\Tokenizers\WhitespaceTokenizer;
use \NlpTools\Similarity\CosineSimilarity;
use \NlpTools\Similarity\Simhash;
 $tok = new WhitespaceTokenizer();
$fc_algorithm = new CosineSimilarity();
//$fc_algorithm = new Simhash(16); // 16 bits hash

include 'includes/header.php';
if(!isset($_POST['term'])){
    header("location: home.php");
}
else{
    $s1 = $_POST['term'];
}


function fullDescSort($item1,$item2)
{
    if ($item1['full_coverage'] == $item2['full_coverage']) return 0;
    return ($item1['full_coverage'] > $item2['full_coverage']) ? -1 : 1;
}


$conn = $pdo->open();

$stmt = $conn->prepare("SELECT * FROM news ORDER BY id DESC LIMIT 1");
$stmt->execute();
$evv = $stmt->fetch();
$id_evv = $evv['id'] - 1494;

$stmt = $conn->prepare("SELECT * FROM news ORDER BY id DESC");
$stmt->execute();
$auth = $stmt->fetchAll();
//print_r(array_column($auth, 'title'));
//echo sizeof($auth);
$fc_array = array();
foreach($auth as $row){
//$s2 = "";
$s2 = $row['title'];
//$s2 = strip_tags($s2);
$setA = $tok->tokenize($s1);
$setB = $tok->tokenize($s2);
$eval_perc = number_format($fc_algorithm->similarity($setA,$setB), 3)*100;

if($eval_perc >= 1){
    
$fc = $eval_perc;      
$val = Array
      (
          'id' => $row['id'],
          'full_coverage' => $eval_perc,
          'source' => $row['source'],
         'deep_link' => $row['deep_link'],
          'title' => $row['title'],
          'published' => $row['published'],
          'author' => $row['author'],
          'article' => $row['article'],
          'tag_1' => $row['tag_1'], 
          'tag_2' => $row['tag_2'] ,
          'tag_3' => $row['tag_3'] ,
         'photo' => $row['photo'],
          'photo_url' => $row['photo_url'],
          'p_grapher' => $row['p_grapher'],
          'category' => $row['category'],
          'time' => $row['time'],
          'code' => $row['code'],
          'parent' => $row['parent'],
          'type' => $row['type'],
          'video_url' => $row['video_url'],
          'frame_color' => $row['frame_color'],
          'title_badge' => $row['title_badge'],
          'meta_title' => $row['meta_title'],
          'meta_desc' => $row['meta_desc'],
          'meta_keywords' => $row['meta_keywords'],
          'post_date' => $row['post_date'],
          'pin' => $row['pin'],
          'sub_1' => $row['sub_1'],
          'sub_2' => $row['sub_2'],
          'intefax' => $row['intefax'],
          'source_error' =>$row['source_error'],
          'input' => $row['input']
      );
    array_push($fc_array, $val);
}

usort($fc_array,'fullDescSort');
//echo number_format($fc_algorithm->similarity($setA,$setB), 3)*100 .'% --- <b>'.$row['title'].'</b> ---- <a class="btn btn-warning" href="../article_data.php?id='.$row['code'].'" target="_blank" >Preview</a>--- <b>'.$row['time'].'</b>--- <b>'.$row['id'].'</b><br/>';
}

//$list_first_item = array_slice($fc_array,0,3);


?>
<body class="">
<?php
include 'home/blocks.php';
include 'includes/topbar.php';
include 'includes/navbar.php';
?>
<div class="newsContainer">
    <div class="row homeContent">
        <div class="col-md-9 col-lg-9 col-xl-9 cardColumn">
        <?php
include 'search/data.php';
?>
        </div>

        <div class="col-md-3 cardColumn_2">
        <?php
include 'home/ad_column.php';
?>
        </div>
    </div>

</div>


<?php
include 'includes/footer.php';
include 'includes/script.php';
?>
<script type="text/javascript" src="../bower/js/jquery-3.6.0.js"></script>
<script>
    $(function(){
        // Highlight the Searched keyword
        if('<?php echo $search ?>' != ''){
            $('ul li').each(function(){
                var reg = new RegExp('(<?php echo $search ?>)','gi');
                var new_html = ($(this).html()).replace(reg,'<mark>$1</mark>');
                $(this).html(new_html)
            })

        }
    })
</script>
</body>