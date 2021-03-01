<?php

namespace App;

session_start();

use Config\Config;
use DB\DB;

final class EcommerceApp extends Config {

    private $productsTable;

    public function __construct(){
        $this->productsTable = new DB('DB','products');
    }

    public function getProductsTable(){
        return $this->productsTable;
    }

    public static function redirect($url,$code){
        header("Location:".$url,TRUE,$code);
    }

}
