<?php

session_start();

header('Content-type: application/json');

require_once '../autoload.php';

$controller = new \Controller\BasketController();

if(isset($_POST['addToBasket'])){
    $status = $controller->addToBasket($_POST['pid'],$_POST['count'] ?? 1);
    $count  = \Controller\BasketController::getBasketCount();
    if($status){
        echo json_encode(['status' => true,'message' => 'Product successfully added to the basket.', 'count' => $count]);
    }else{
        echo json_encode(['status' => false,'message' => 'Product could not added to the basket.']);
    }
}

if(isset($_POST['removeFromBasket'])){
    $status = $controller->removeFromBasket($_POST['pid']);
    $count  = \Controller\BasketController::getBasketCount();
    if($status){
        echo json_encode(['status' => true,'message' => 'Product successfully removed to the basket.', 'count' => $count]);
    }else{
        echo json_encode(['status' => false,'message' => 'Product could not removed to the basket.']);
    }
}

if(isset($_POST['updateQuantity'])){
    $info = $controller->updateQuantity($_POST['pid'],$_POST['quantity']);
    $count  = \Controller\BasketController::getBasketCount();
    if($info->status){
        echo json_encode(['status' => true,'message' => 'Product successfully updated.','price' => $info->price, 'count' => $count]);
    }else{
        echo json_encode(['status' => false,'message' => 'Product could not updated.']);
    }
}

if(isset($_POST['getBasketSummary'])){
    $products = $controller->getBasketSummary();
    echo json_encode(['data' => $products]);
}
