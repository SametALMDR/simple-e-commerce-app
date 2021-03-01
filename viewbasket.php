<?php

require_once 'autoload.php';

$app            = new App\EcommerceApp();
$rawProducts    = $_SESSION['products'] ?? [];
$products       = [];
$BasketCount    = \Controller\BasketController::getBasketCount();

foreach($rawProducts as $pid => $count){
    $product = $app->getProductsTable()->getRowById($pid);
    switch($product->category){
        case 'cellphone':
            $products[] = [
                'count' => $count['count'],
                'info'  => new \Product\CellPhone($product)
            ];
            break;
        case 'animalFood':
            if ($product->subCategory === 'dog'){
                $products[] = [
                    'count' => $count['count'],
                    'info'  => new \Product\DogFood($product)
                ];
            } elseif ($product->subCategory === 'cat'){
                $products[] = [
                    'count' => $count['count'],
                    'info'  => new \Product\CatFood($product)
                ];
            }
            break;
    }
}

include('view/header.php');
include('view/basket.php');
include('view/footer.php');
