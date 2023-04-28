<?php
function valueExistsInArray($value, $array) {
    // Loop through each element in the array
    foreach ($array as $element) {
        // Compare the value with each element in the array
        if ($element === $value) {
            // If the value is found, return true
            return true;
        }
    }
    // If the value is not found, return false
    return false;
}
function build_file($file, $data){
   
    $file_data = fopen($file, "w");

    fwrite($file_data, $data);

    fclose($file_data); 
}

function tags_obj()
{
    global $pdo;
    $conn = $pdo->open();
    $stmt = $conn->prepare("SELECT DISTINCT tag_1, tag_2, tag_3 FROM news");
    $stmt->execute();
    $author_select = $stmt->fetchAll();
    $data = [];
    foreach ($author_select as $row) {
        if (strlen($row['tag_1']) > 1) {
            if (!valueExistsInArray($row['tag_1'], $data)) {
                array_push($data, $row['tag_1']);
            }
        }
        if (strlen($row['tag_2']) > 1) {
            if (!valueExistsInArray($row['tag_2'], $data)) {
                array_push($data, $row['tag_2']);
            }
        }
        if (strlen($row['tag_3']) > 1) {
            if (!valueExistsInArray($row['tag_3'], $data)) {
                array_push($data, $row['tag_3']);
            }
        }
    }

    build_file('./components/tags.json', json_encode($data));
}

function filter_by_key($array, $allowed_values, $key, $unique_key)
{
      $unique_ages = [];
    $filtered_array = array_filter($array, function($item) use ($allowed_values, &$unique_ages, $unique_key, $key) {
        if(isset($item[$key]) && in_array($item[$key], $allowed_values) && !in_array($item[$unique_key], $unique_ages)) {
            $unique_ages[] = $item[$unique_key];
            return true;
        }
        return false;
    });
    usort($filtered_array, function($a, $b) {
        return $b['id'] - $a['id'];
    });
    return $filtered_array;
}

function cleandt($item){
    $dt1 = str_replace(' ','',$item);
    $dt1 = str_replace('AND','"',$dt1);
    $dt1 = str_replace("='",'":"',$dt1);
    $dt1 = str_replace("'",'"',$dt1);
    return $dt1;
   }

   function download_image($url, $storage_path)
{
	$sub_1 = "";
	$sub_2 = "";
	$ar_error = "";
	$gen = 'temp' . time() . generate_code();
	$filee = basename($url);
	$ext = pathinfo($filee, PATHINFO_EXTENSION);
	$img = $gen . "." . $ext;
	$path = $storage_path . $img;
	file_put_contents($path, file_get_contents($url));
	$filename = $img;
	 return $filename;
}

function generate_exif_data($image_path)
{
  $exif = exif_read_data($image_path);
  $exif_data = array();

  if ($exif !== false) {
    foreach ($exif as $key => $value) {
      $exif_data[$key] = $value;
    }
  }

  return $exif_data;
}

function generate_code()
{
	$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$code = substr(str_shuffle($set), 0, 24);
	return $code;
}
function generate_exif_data_from_url($image_url)
{
      $path = './temp/';
      $filename = download_image($image_url, $path);
      $image = $path . $filename;
      $image_type = exif_imagetype($image);
      if ($image_type === IMAGETYPE_JPEG || $image_type === IMAGETYPE_TIFF_II || $image_type === IMAGETYPE_TIFF_MM) {
          $exif_data = generate_exif_data($image);  
      }else{
            $exif_data = 'Unsupported file format: '.$image_type;
      }
      unlink($image);
      //$exif_data = generate_exif_data($image);
      return $exif_data;
}