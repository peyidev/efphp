<?php
require_once __DIR__.'/vendor/autoload.php';
use phpFastCache\CacheManager;

// Setup File Path on your config files


class Cache{


    function setData($data){

        $actual_link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        CacheManager::setDefaultConfig("path","../cache");
        CacheManager::setDefaultConfig("storage","Files");

        $InstanceCache = CacheManager::getInstance('files');

        $key = $actual_link;
        $CachedString = $InstanceCache->getItem($key);


        if (!is_null($CachedString->get())) {

            return  $CachedString->get();

        }else{
            $CachedString->set($data)->expiresAfter(10);//in seconds, also accepts Datetime
            $InstanceCache->save($CachedString);
        }

        return $data;

    }

    function getData(){


        $actual_link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        CacheManager::setDefaultConfig("path","../cache");
        CacheManager::setDefaultConfig("storage","Files");

        $InstanceCache = CacheManager::getInstance('files');

        $key = $actual_link;
        $CachedString = $InstanceCache->getItem($key);


        if (!is_null($CachedString->get())) {
            return  $CachedString->get();

        }
    }

}


$c = new Cache();
$c->getData();