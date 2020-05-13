<?php
$dir="../photos";
unlink("../sitemap.xml");
$begin_text="<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">".PHP_EOL."<url>".PHP_EOL."<loc>https://".$_SERVER['SERVER_NAME']."/</loc>";
 file_put_contents('../sitemap.xml', PHP_EOL.$begin_text, FILE_APPEND);
  
  $begin_text="<lastmod>".date(DateTime::W3C,filectime("../index.php"))."</lastmod>".PHP_EOL."<changefreq>always</changefreq>".PHP_EOL."
 <priority>1.0</priority>".PHP_EOL."</url>";
  file_put_contents('../sitemap.xml', PHP_EOL.$begin_text, FILE_APPEND);

      	     
    $scandir = scandir($dir);
    unset($scandir[0]);
    unset($scandir[1]); 
print_r($scandir);
echo $_SERVER['SERVER_NAME'];
   foreach ($scandir as $value) {
   	// echo $value."<br>";
      $middle_text="<url>".PHP_EOL;
      $middle_text .= "<loc>https://".$_SERVER['SERVER_NAME']."/photos/".$value."/</loc>".PHP_EOL;
      $middle_text .= "<lastmod>".date(DateTime::W3C,filectime("../photos/".$value))."</lastmod>".PHP_EOL;
      $middle_text .= "<priority>0.8</priority>".PHP_EOL;
      $middle_text .= "</url>".PHP_EOL;
      file_put_contents('../sitemap.xml', PHP_EOL.$middle_text, FILE_APPEND);
   }
   file_put_contents('../sitemap.xml', PHP_EOL."</urlset>", FILE_APPEND);



?>