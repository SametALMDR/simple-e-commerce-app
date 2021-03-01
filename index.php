<?php

require_once 'autoload.php';

$app            = new App\EcommerceApp();
$rawProducts    = $app->getProductsTable()->getAllRows();
$products       = [];
$BasketCount    = \Controller\BasketController::getBasketCount();

foreach($rawProducts as $product){
    switch($product->category){
        case 'cellphone':
            $products[] = new \Product\CellPhone($product);
            break;
        case 'animalFood':
            if ($product->subCategory === 'dog'){
                $products[] = new \Product\DogFood($product);
            } elseif ($product->subCategory === 'cat'){
                $products[] = new \Product\CatFood($product);
            }
            break;
    }
}

include('view/header.php');
include('view/products.php');
include('view/footer.php');
