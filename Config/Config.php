<?php

namespace Config;

class Config {

    private $appName        = 'E-commerce App';
    private $appDescription = 'This is a simple e-commerce app coded using PHP language.';
    private $appVersion     = '1.0';
    private $appAuthor      = 'Samet ALEMDAROĞLU';

    public function getAppName(){
        return $this->appName;
    }

    public function getAppDescription(){
        return $this->appDescription;
    }

    public function getAppVersion(){
        return $this->appVersion;
    }

    public static function getRootPath(){
        return dirname(__DIR__);
    }

    public function getAppAuthor(){
        return $this->appAuthor;
    }
}
