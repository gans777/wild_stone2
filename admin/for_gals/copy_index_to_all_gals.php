<?php
$dir = "../../photos";
    $scandir = scandir($dir);
    unset($scandir[0]);
    unset($scandir[1]);
$file = 'index.php';
print_r($scandir);
$new_file = $dir;
 
 foreach ($scandir as $value) {
 	if (copy($file, $new_file."/".$value."/".$file)) {
    echo "Файл успешно скопирован! в папку ".$new_file."/".$value."/".$file;
}else{
    echo "Файл не удалось скопировать!";
}
 }

?>