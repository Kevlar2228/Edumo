<?php
//Enter the name of directory
   $pathdir = "../test/";
//Enter the name to creating zipped directory

     $name = '../'.rand().'@2@27.zip';

   $zipcreated = $name;
//Create new zip class
   $newzip = new ZipArchive;
   if($newzip -> open($zipcreated, ZipArchive::CREATE ) === TRUE) {
      $dir = opendir($pathdir);
      while($file = readdir($dir)) {
         if(is_file($pathdir.$file)) {
            $newzip -> addFile($pathdir.$file, $file);
         }
      }
      $newzip ->close();
   }


?>
