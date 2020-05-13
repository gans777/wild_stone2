<?php 
if ($_POST['label']=='save_main_info') {
	$current=$_POST['data_save'];
	$path = '../photos/'.$_POST['directory'].'/data.txt';
	file_put_contents($path, $current);
	echo $current;
}

if ($_POST['label'] == 'rename_img') {
	$old_name = '../photos/'.$_POST['directory'].'/'.$_POST['old_name'];
	$new_name = '../photos/'.$_POST['directory'].'/'.$_POST['new_name'];
	if (rename($old_name, $new_name)) {
		echo "new name is ".$_POST['new_name'];
   // и переименовать файл description 
		if (file_exists('../photos/'.$_POST['directory'].'/'.substr($_POST['old_name'],0, (strlen ($value) - 4)).".txt")) {
			if (rename('../photos/'.$_POST['directory'].'/'.substr($_POST['old_name'],0, (strlen ($value) - 4)).".txt", '../photos/'.$_POST['directory'].'/'.substr($_POST['new_name'],0, (strlen ($value) - 4)).".txt")) {echo "a file-description renamed too";}
		}
}
		
}

if ($_POST['label'] == 'description_img') {
	$path = '../photos/'.$_POST['directory'].'/'.substr($_POST['name_this_img'],0, (strlen ($value) - 4)).".txt";
	$error=file_put_contents($path, $_POST['description']);
	if ($error !=false) {echo "description saved ";}
		
}

if ($_POST['label'] == 'meta_description') {
	$path = '../photos/'.$_POST['directory'].'/meta_description.txt';
	$error=file_put_contents($path, $_POST['meta_description'].PHP_EOL);
	if ($error !=false) {echo " meta description saved ";}
		
}

?>