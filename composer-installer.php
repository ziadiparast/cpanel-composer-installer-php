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
  *             Composer Configuration
  *     
  * ------------------------------------
  * 
  **/

$COMPOSER_HOME="$HOME/.config/composer";
$COMPOSER_SETUP_HASH="55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae";
$COMPOSER_DOWNLOAD_LINK="https://getcomposer.org/installer";


/**
 * 
 * Step 1 : Download Installer
 * 
 **/
 
if(!copy($COMPOSER_DOWNLOAD_LINK,'composer-setup.php')){
    die('Downloading installer has been failed!');
}

echo('[Passed] Download Installer <br/>');

/**
 * 
 * Step 1 : Verify Hash
 * 
 **/
 
if (hash_file('sha384', 'composer-setup.php') !== $COMPOSER_SETUP_HASH) { 
    unlink('composer-setup.php');
    die('Installer corrupt');
}

echo('[Passed] Verify Hash <br/>');


/**
 * 
 * Step 3 : Install Composer
 * 
 **/
 
putenv("COMPOSER_HOME=$COMPOSER_HOME");

if(!empty(exec("php composer-setup.php")) && !file_exists(__DIR_.'/composer.phar')){
        die('Installation failed!');
}

if(file_exists("$HOME/bin/composer")){
    unlink("$HOME/bin/composer");
}

rename(__DIR__.'/composer.phar',"$HOME/bin/composer");
unlink('composer-setup.php');
unlink('composer.phar');

echo('[Passed] Installation Completed <br/>');

