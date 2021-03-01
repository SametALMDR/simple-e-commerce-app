<?php

require_once 'autoload.php';

if(empty($_GET['pid'])){
    \App\EcommerceApp::redirect('index.php',301);
}

$app         = new App\EcommerceApp();
$product     = $app->getProductsTable()->getRowById($_GET['pid']);
$BasketCount = \Controller\BasketController::getBasketCount();

switch ($product->category){
    case 'cellphone':
        $product = new \Product\CellPhone($product);
        break;
    case 'animalFood':
        if ($product->subCategory === 'dog'){
            $product = new \Product\DogFood($product);
        } elseif ($product->subCategory === 'cat'){
            $product = new \Product\CatFood($product);
        }
        break;
}

include('view/header.php');
include('view/product.php');
include('view/footer.php');
