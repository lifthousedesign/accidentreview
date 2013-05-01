<?php

  define('ASSETS_PATH', dirname(__FILE__));
  define('CONFIG_FILE_PATH', realpath(ASSETS_PATH . '/../../config/config.php'));
  
  if(is_file(CONFIG_FILE_PATH)) {
    require_once CONFIG_FILE_PATH;
  } // if
  
  if(!defined('COMPRESS_ASSET_REQUESTS')) {
    define('COMPRESS_ASSET_REQUESTS', true);
  } // if

  if(COMPRESS_ASSET_REQUESTS && extension_loaded('zlib') && !((boolean) ini_get('zlib.output_compression'))) {
    @ob_start('ob_gzhandler');
  } else {
    ob_start();
  } // if
  
  // Turn magic quotes OFF
  if(version_compare(PHP_VERSION, '6.0.0', '<') && @get_magic_quotes_gpc()) {
    @set_magic_quotes_runtime(0);
  } // if
  
  header("Content-type: text/css; charset: UTF-8");
  header("Cache-Control: max-age=8640000");
  header("Expires: " . gmdate("D, d M Y H:i:s", time() + 8640000) . " GMT");
  
  $files = array(
    ASSETS_PATH . '/stylesheets/print.css',
    ASSETS_PATH . '/modules/system/stylesheets/print.css',
    ASSETS_PATH . '/modules/resources/stylesheets/print.css',
  );
  
  $modules = isset($_GET['modules']) && $_GET['modules'] ? explode(',', trim($_GET['modules'], ',')) : null;
  
  $d = dir(ASSETS_PATH . '/modules');
  while(($entry = $d->read()) !== false) {
    if($entry == '.' || $entry == '..' || $entry == 'system' || $entry == 'resources') {
      continue;
    } // if
    
    if($modules && !in_array($entry, $modules)) {
      continue;
    } // if
    
    $files[] = ASSETS_PATH . '/modules/' . $entry . '/stylesheets/print.css';
  } // while
  $d->close();
  
  
  foreach($files as $file) {
    if(!is_file($file)) {
      continue;
    } // if
    
    print "\n\n/** File: " . substr($file, strlen(ASSETS_PATH) + 1) . " **/\n\n";
    
    if(function_exists('file_get_contents')) {
      print file_get_contents($file);
    } else {
      $f = fopen($file, 'r');
      $filesize = filesize($file);
      if($filesize) {
        print fread($f, $filesize);
      } // if
      fclose($f);
    } // if
  } // foreach

?>