<?php
 /**
  * file_cache_example.php
  *
  * Demonstrates usage of phpFastCache with "file system" adapter
  */
 // Include composer autoloader
 require 'vendor/autoload.php';
  
 use phpFastCache\CacheManager;
  
 // Init default configuration for "files" adapter
 CacheManager::setDefaultConfig([
   "path" => "/cache"
 ]);
  
 // Get instance of files cache
 $objFilesCache = CacheManager::getInstance('files');
  
 $key = "welcome_message";
  
 // Try to fetch cached item with "welcome_message" key
 $CachedString = $objFilesCache->getItem($key);
  
 if (is_null($CachedString->get()))
 {
     // The cached entry doesn't exist
     $numberOfSeconds = 60;
     $CachedString->set("This website uses phpFaseCache!")->expiresAfter($numberOfSeconds);
     $objFilesCache->save($CachedString);
  
     echo "Not in cache yet, we set it in cache and try to get it from cache!</br>";
     echo "The value of welcome_message:" . $CachedString->get();
 }
 else
 {
     // The cached entry exists
     echo "Already in cache!</br>";
     echo "The value of welcome_message:" . $CachedString->get();
 }