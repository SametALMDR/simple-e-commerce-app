<?php
namespace Controller;

use DB\DB;

class BasketController{

    /**
     * @return int
     * Returns the current basket count
     */
    public static function getBasketCount() : int {
        return count($_SESSION['products'] ?? []);
    }

    /**
     * @return array
     * Returns the basket summary products
     */
    public function getBasketSummary(): array {
        $rawProducts    = $_SESSION['products'] ?? [];
        $products       = [];

        foreach($rawProducts as $pid => $detail){
            $db = new DB('DB','products');
            $product = $db->getRowById($pid);
            $product->count = $detail['count'];
            $products[]     = $product;
        }
        return $products;
    }

    /**
     * @param int $pid
     * @param int $count
     * @return bool
     * Adds the selected product id to the basket
     */
    public function addToBasket(int $pid,int $count = 1): bool{
        $db = new DB('DB','products');
        if(!$db->isRowAvailable($pid)){
            return false;
        }
        $product = $db->getRowById($pid);
        if($product->status === 0){
            return false;
        }
        if($this->isInBasket($pid)){
            $_SESSION['products'][$pid]['count'] = $count + $_SESSION['products'][$pid]['count'];
        }else{
            $_SESSION['products'][$pid]['count'] = $count;
        }
        return true;
    }

    /**
     * @param int $pid
     * @return bool
     * Removes the selected product id from basket
     */
    public function removeFromBasket(int $pid): bool{
        unset($_SESSION['products'][$pid]);
        return true;
    }

    /**
     * @param int $pid
     * @param int $quantity
     * @return bool
     * Updates the basket quantity of the selected product
     */
    public function updateQuantity(int $pid,int $quantity): object {
        $db      = new DB('DB','products');
        $product = $db->getRowById($pid);
        if(isset($_SESSION['products'][$pid])){
            if($quantity === 0){
                $this->removeFromBasket($pid);
            }else{
                $_SESSION['products'][$pid]['count'] = $quantity;
            }
            return (object)['status'=> true, 'price' => $product->price * $quantity." ".$product->currency];
        }
        return (object)['status'=> false];
    }

    /**
     * @param int $pid
     * @return bool
     * Checks whether the product is in the basket
     */
    public function isInBasket(int $pid): bool {
        return isset($_SESSION['products'][$pid]) ? true : false;
    }

}
