<?php
include 'vendor/autoload.php';
use Phpfastcache\CacheManager;
use Phpfastcache\Config\ConfigurationOption;

// Setup File Path on your config files
// Please note that as of the V6.1 the "path" config 
// can also be used for Unix sockets (Redis, Memcache, etc)
CacheManager::setDefaultConfig(new ConfigurationOption([
    'path' => '/var/www/phpfastcache.com/dev/tmp', // or in windows "C:/tmp/"
]));

// In your class, function, you can call the Cache
$InstanceCache = CacheManager::getInstance('files');

$key = "product_page";
$CachedString = $InstanceCache->getItem($key);

if (!$CachedString->isHit()) {
    $CachedString->set('Datos Cacheado')->expiresAfter(5);//in seconds, also accepts Datetime
    $InstanceCache->save($CachedString); // Save the cache item just like you do with doctrine and entities

    echo 'FIRST LOAD // WROTE OBJECT TO CACHE // RELOAD THE PAGE AND SEE // ';
    echo $CachedString->get();

} else {
    echo 'READ FROM CACHE // ';
    echo $CachedString->get();// Will print 'First product'
}