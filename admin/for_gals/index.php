<?php
/* файл формирующий галлерею  - по старинке glocind.php*/ 
$main_data=file_get_contents('data.txt');
if ($main_data){
  $mass_main_data= explode('||',$main_data);
  

} else { echo "файла с основными данными нет";}


?> 

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    if (file_exists("meta_description.txt")) {
    echo file_get_contents("meta_description.txt");
}
    ?>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $mass_main_data[0]; ?></title>

    <!-- Bootstrap -->
     <!--<link rel="stylesheet" href="/../../css/uikit.min.css" />
        <script src="../../js/uikit.min.js"></script>
        <script src="../../js/uikit-icons.min.js"></script>-->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/f_awesome/css/font-awesome.min.css">
    <link href="../../css/galery.css?rnd=113" rel="stylesheet">
      <script src="../../js/jquery-1.11.0.min.js"></script>
    <script src="../../js/viewer.js?rnd=023"></script>
      <script src="../../js/jquery.lazyload.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-147735349-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-147735349-1');
</script>

  </head>
  <body>
    
    <div class="header">
   <nav>
    <div class="logo">
     <a href="/">rostov-stone.ru</a>
   </div>
   <div class="masters_phone"><div>мастер Юрий Ларионов:  <a href="https://www.instagram.com/ura_masterklas?r=nametag">instagram</a>, тел. +79281570965</div></div>
   </nav>

    <h1><?php echo $mass_main_data[0]; ?> </h1>
    </div>
    <div class="wrap_container">
    <div class="container">
  <div class="row border contents">
    <?php
    if (isset($_GET['admin'])) {
    echo "<div class=\"admin_main_info\">";
    if (file_exists("meta_description.txt")) {
      echo  "<textarea name=\"meta_description\"  cols=\"80\" rows=\"6\" >".file_get_contents("meta_description.txt")."</textarea><br>";
      echo "<button type=\"button\" class=\"btn btn-warning save_meta_description\">сохранить мета-описание</button><br><br>";
    } 
    else 
    {echo "<textarea name=\"meta_description\"  cols=\"80\" rows=\"6\" ><meta name=\"description\" content=\"\"></textarea><br>";
      echo "<button type=\"button\" class=\"btn btn-warning  save_meta_description\">сохранить мета-описание</button><br><br>";
}

      echo "<div class=\"wrap_textarea_main_info\">";
        echo "<textarea name=\"main_info\"  cols=\"80\" rows=\"10\" >$main_data</textarea><br>";
        echo "<button type=\"button\" class=\"btn btn-success button_for_main_info\" data-toggle=\"modal\" data-target=\"#myModal\">save</button>";
        echo "</div>
      </div>";

// переименование изображения и добавить описание изображения
        $dir = __DIR__;
    $scandir = scandir($dir);
    unset($scandir[0]);
    unset($scandir[1]);
   
     $count=1;
    foreach ( $scandir as $value ) {
        
         
         if ((".php"=== substr($value, -4))||(".txt"=== substr($value, -4))||(".gif"===substr($value, -4))) { continue;}
            $descr_this_img_out="";
               $name_file_descr_this_img = substr($value,0, (strlen ($value) - 4)).".txt";
                //$descr_this_img = file_get_contents($name_file_descr_this_img);
          if   (file_exists($name_file_descr_this_img)) {
                 $descr_this_img_out = file_get_contents($name_file_descr_this_img);
          }
        
         $body_this_img="<div class=\"admin_edit_img\">
        <button type=\"button\" class=\"btn btn-primary rename \" data-toggle=\"modal\" data-target=\"#renameModal\">переименовать название изображения: $value</button><br>
       
<br><img class='img_this' src='$value' width='400'><br><div class='description_this_img'>$descr_this_img_out</div><br>
<button type=\"button\" class=\"btn btn-primary add_description \" data-toggle=\"modal\" data-target=\"#add_descriptionModal\">добавить/изменить описание изображения : $value</button>
<br>$count</div>";

         if (($count%2)==0){

          echo "<div class='wrap_img even'> $body_this_img</div>";} 
         else
          {echo "<div class='wrap_img odd'> $body_this_img</div>";}
        $count++;
        }

} else {  
   //режим пользователя

    $dir = __DIR__;
    $scandir = scandir($dir);
    unset($scandir[0]);
    unset($scandir[1]);
   //echo print_r($scandir);
     $count=1;
    foreach ( $scandir as $value ) {
        
       
         if ((".php"=== substr($value, -4))||(".txt"=== substr($value, -4))||(".gif"===substr($value, -4)))
          { continue;}// пропускает все посторонние файлы кроме фотографий

              $descr_this_img_out="";
               $name_file_descr_this_img = substr($value,0, (strlen ($value) - 4)).".txt";
                //$descr_this_img = file_get_contents($name_file_descr_this_img);

               $alt=$mass_main_data[0]." фото ".$value;// содержание alt по умолчанию 

          if   (file_exists($name_file_descr_this_img)) {
                 $descr_this_img_out = file_get_contents($name_file_descr_this_img);
                 $descr_title_alt= explode(".", $descr_this_img_out);
                  
                  if (($count%2)==0){ // цветная черезполосица
              $alt=$descr_title_alt[0].' фото '.$value;
          echo "<div class='wrap_img even'><img class='img_this' src='$value' width='400' title='$descr_title_alt[0]' alt='$alt' ><br><div class='description_this_img'  >$descr_this_img_out</div><br>$count</div>";
               
       } else {echo "<div class='wrap_img odd'><img class='img_this' src='$value' width='400' title='$descr_title_alt[0]' alt='$alt' ><br><div class='description_this_img'>$descr_this_img_out</div><br>$count</div>";}
                  
          } else if (($count%2)==0){ // цветная черезполосица и title и alt по умолчанию
          
          echo "<div class='wrap_img even'><img class='img_this' src='$value' width='400' title='$mass_main_data[0] фото №$count' alt='$alt' ><br><div class='description_this_img'  >$descr_this_img_out</div><br>$count</div>";
               
       } else {echo "<div class='wrap_img odd'><img class='img_this' src='$value' width='400' title='$mass_main_data[0] фото №$count' alt='$alt' ><br><div class='description_this_img'>$descr_this_img_out</div><br>$count</div>";}
         
         $count++;
         }//end foreach
      }
    ?>
   
  </div>
</div>
</div>
<div class='page_footconst'></div>



 <div id='maximg'><div id="maximgX"><i class='fa fa-times-circle' aria-hidden='true'></i></div></div>
 <div id='panelupr'><div id="close_all_panel"><i class="fa fa-times-circle" aria-hidden="true"></i></div><div id='this_nomer'></div><div id='nazad'><i class='strelki fa fa-chevron-circle-up' aria-hidden='true'></i>
</div><div id='vpered'><i class='strelki fa fa-chevron-circle-down' aria-hidden='true'></i>
</div><div id='uveli4'><i class='strelki fa fa-search-plus' aria-hidden='true'></i>
</div><div id='umen'><i class='strelki fa fa-search-minus' aria-hidden='true'></i>
</div>
 <div id='vveditenomer'>все страницы>><div id='kolvostranitc_map'></div></div>
</div>
<div id='fon_maximg'></div>

<?php
 if (isset($_GET['admin'])) {
 echo '
<!-- Modal edit name img-->
<div class="modal fade" id="renameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body modal_window modal_window_rename">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save_rename">Save rename</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal description img-->
<div class="modal fade" id="add_descriptionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body modal_window modal_window_description">
      <div class="name_this_img"></div>
      <br>
        <textarea rows="10" cols="45" name="description_this_img"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save_description_img">Save description</button>
      </div>
    </div>
  </div>
</div>';
}
?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/gallery.js"></script>
    <?php
    if (!isset($_GET['admin'])) {
      echo '<div class="counters">
         <!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(54973954, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/54973954" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
      </div>';
    }
    ?>
  </body>
</html>