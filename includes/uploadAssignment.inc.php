<?php

session_start();

require 'db.inc.php';

$idAssignment = $_GET['idAssignment'];
$idUsers = $_SESSION['idUsers'];
$uidUsers = $_SESSION['uidUsers'];

$sql = "SELECT * FROM assignments WHERE idAssignment=?;";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)) {
     $_SESSION['error'] = 'sqlerror1';
     header("Location: /Edumo/assignment.php?idAssignment=$idAssignment");
     exit();
}

mysqli_stmt_bind_param($stmt, "s", $idAssignment);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

$nameAssignment = $row['nameAssignment'];


function delete_files($target) {
    if(is_dir($target)){
        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

        foreach( $files as $file ){
            delete_files( $file );
        }

        rmdir( $target );
    } elseif(is_file($target)) {
        unlink( $target );
    }
}

if(isset($_POST['upload']))
{
   if($_POST['foldername'] != "")
   {
        $foldername='../uploads/'.$_POST['foldername'];
        if(!is_dir($foldername)) mkdir($foldername, 0777, true);
        foreach($_FILES['files']['name'] as $i => $name)
        {
            if(strlen($_FILES['files']['name'][$i]) > 1)
            {  move_uploaded_file($_FILES['files']['tmp_name'][$i],$foldername."/".$name);
            }
        }
        $pathdir = $foldername.'/';
     //Enter the name to creating zipped directory

     $name = rand().'@'.$idUsers.'@'.$idAssignment.'.zip';

          $dir = '../uploads/'.$name;

        $zipcreated = $dir;
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
        delete_files($foldername);

        $sql = "INSERT INTO files (nameFiles, urlFiles) VALUES (?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
             $_SESSION['error'] = 'sqlerror2';
             header("Location: /Edumo/assignment.php?idAssignment=$idAssignment");
             exit();
        }

        $nameFile = $uidUsers.'@'.$nameAssignment;

        mysqli_stmt_bind_param($stmt, "ss", $nameFile, $name);
        mysqli_stmt_execute($stmt);

/*
 * php delete function that deals with directories recursively
 */

      $_SESSION['error'] = 'none';
     header("Location: /Edumo/assignment.php?idAssignment=$idAssignment");
     exit();
   }
   else
   $_SESSION['error'] = 'emptyfolder';
   header("Location: /Edumo/assignment.php?idAssignment=$idAssignment");
   exit();
}
