<?php

/**
 * CCIP ( Cpanel Composer Installer PHP )
 * Github : https://github.com/ziadiparast/cpanel-composer-installer-php
 * Version : 1.0.0
 **/
 
 
  /**
  * ------------------------------------
  * 
  *             User Configuration
  *     
  * ------------------------------------
  * 
  **/
  
  $HOME="/home/user";
 
  /**
  * ------------------------------------
  * 
  *            Composer Configuration
  *     
  * ------------------------------------
  **/
  
  $COMPOSER = "~/bin/composer";
  $COMPOSER_HOME="$HOME/.config/composer";
  $COMPOSER_VERSION = shell_exec("$COMPOSER --version");
  
  if(empty($COMPOSER_VERSION)){
      die("composer doesn't exists");
  }
  if(!empty($_POST) && isset($_POST['workingDirectory'],$_POST['install'])){

      $WORKING_DIRECTORY = $_POST['workingDirectory'];
      if(!file_exists($_POST['workingDirectory'])){
          die('working directory doesn\'t exist!');
      }
      
      putenv("COMPOSER_HOME=$COMPOSER_HOME");
      if(!empty(shell_exec("$COMPOSER install --quiet --no-dev -d $WORKING_DIRECTORY 2>&1"))){
          die('Installing dependencies has been failed!');
      }
      
      die('Successfully installed');
  }
  
  
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Composer WebPanel</title>
</head>
<body>
<p>
    <?= $COMPOSER_VERSION ?>
</p>
<form action="" method="post">
    <label for="workingDirectoryInput">Working directory</label>
    <input id="workingDirectoryInput" type="text" name="workingDirectory" placeholder="/home/user/public_html" required>
    <button name="install" value="install" type="submit">Install</button>
</form>
</body>
</html>
