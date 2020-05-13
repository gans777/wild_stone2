<?php
/* главная страница */
include ('classes/SimpleImage.php');
   $image = new SimpleImage();
$dir = "photos";
    $scandir = scandir($dir);
    unset($scandir[0]);
    unset($scandir[1]);
    // сортировка галер по убыванию времени добавления(последнего редактирования)
 $files=array();
 $files_path=array();
 foreach ($scandir as  $value) {
   $files_path[filemtime($dir."/".$value)]=$value;
   $files[]=filemtime($dir."/".$value);

 }
 arsort($files);
 $new_scandir=array();
  foreach ($files as $value) {
   $new_scandir[]=$files_path[$value];
 }
  $scandir=$new_scandir;
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="yandex-verification" content="eccfd442ab8b8f98" />
    <meta name="description" content="Выполняем облицовку и мощение природным камнем в Ростове-на-Дону: облицовка, мощение, садовые печи-барбекю, ступени, лестницы, садовые водопады - и прочий ландшафтный дизайн.">
    <meta name="keywords" content="песчанник, природный камень, облицовка, барбекю, мощение, ландшафтный дизайн" />

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Облицовка и мощение природным камнем в Ростове-на-Дону.</title>

    
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="css/uikit.min.css" />
         <link rel="icon" href="favicon.ico" type="image/x-icon">
        <script src="js/uikit.min.js"></script>
        <script src="js/uikit-icons.min.js"></script>
    <link href="css/index.css?rnd=898" rel="stylesheet">
      <script src="js/jquery-1.11.0.min.js"></script>
    
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-147735349-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-147735349-1');
</script>
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
    <header>
     <nav>
       <div class="logo">
         <a class ="logo_a" href="/">rostov-stone.ru</a>
       </div>
      <div class="header_fon"></div>
     </nav>
     <div class="masters_phone"><div class="inside_masters_phone">контакты: мастер-каменщик Юрий Ларионов - <a href="https://www.instagram.com/ura_masterklas?r=rostov-stone.ru" class="uk-icon-button" uk-icon="instagram" style="background-color: #bc2a8d; color: white;" title="Instagram"></a> , <a href="https://api.whatsapp.com/send?phone=79281570965" class="uk-icon-button" uk-icon="whatsapp" style="background-color: #4ac959; color: white;" title="whatsapp"></a>, тел.+79281570965.</div></div>
    </header>
    <div class="wrap_container">
      
    <div class="container">
      <div class="masters_phone center_advertisement"><div class="inside_masters_phone">Выполняем работы с природным камнем более полутора десятка лет.<br><br>  Облицовка стен, заборов, столбы, колонны,   мощение, дорожки, печи-барбекю, беседки, водопадные горки, ландшафтный дизайн.<br> </div><span> (ниже и везде на сайте представлены фото только наших работ)</span>
      </div>
      <div class="wrap_h1">
      <h1>Природный камень песчаник.</h1>

      </div>
   <div class="uk-child-width-1-2@s uk-child-width-1-3@m" uk-grid="masonry: true">
     <?php 
      foreach ($scandir as $value) {
        $dir_this = $dir."/".$value;
    $scandir_this_value = scandir($dir_this);
    unset($scandir_this_value[0]);
    unset($scandir_this_value[1]); 

    // проверяет есть ли в папке с таким же именем тумба
    
    if (!file_exists ("thumbs/".$scandir_this_value[2])) {
   $image->load($dir_this."/".$scandir_this_value[2]);
   $image->resizeToWidth(250);
   $image->save("thumbs/".$scandir_this_value[2]);
        }// генерирует тумбу если нет такой же первой в галлерее


// считывает имя галлереи из файла data.txt(подпись под тумбами)
        if (file_exists($dir_this.'/data.txt')){
      $main_data_from_this_gallery=file_get_contents($dir_this.'/data.txt');
      
if ($main_data_from_this_gallery){
  $mass_main_data_from_this_gallery= explode('||',$main_data_from_this_gallery);
  

} else { }

$gal_name=$mass_main_data_from_this_gallery[0];
} else { $gal_name="";}

       echo "<div><div class=\"uk-card uk-card-default uk-flex uk-flex-center uk-flex-middle one_thumb\" ><a href='photos/".$value."/' time_load='".date ("F d Y H:i:s.", filemtime($dir."/".$value))."'><img src='thumbs/".$scandir_this_value[2]."' alt='".$gal_name."'><div class=\"gal_name\">".$gal_name."</div></a></div></div>";
      }
    ?>
       
</div>
   </div> <!-- end div.container -->
 </div><!-- end div.wrap_container -->
 <div class="counters">
   
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
 </div>
 <script src="js/index.js"></script>
  </body>
  </html>