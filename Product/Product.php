<?php
namespace Product;

class Product implements iProduct {

    private $id;
    private $name;
    private $price;
    private $currency;
    private $status;
    private $category;
    private $subCategory;

    public function __construct($details = null){
        if ($details !== null ){
            $this->id = $details->id;
            $this->name = $details->name;
            $this->price = $details->price;
            $this->currency = $details->currency;
            $this->status = $details->status;
            $this->category = $details->category;
            $this->subCategory = !(empty($details->subCategory))? $details->subCategory :"";
        }
    }

    public function getProductId() : int {
        return $this->id;
    }

    public function getName() : string {
        try {
            if (is_null($this->name)){
                Throw new \Exception('Product name is null', 5001);
            }
            return $this->name;
        } catch (\Exception $e){
            if ($e->getCode() === 5001){
                return '-';
            } else {
                return $this->name;
            }
        }
    }

    public function getPrice() : float {
        return $this->price;
    }

    public function getCurrency() : string {
        return $this->currency;
    }

    public function getProductStatus() : int {
        return $this->status;
    }

    public function productStatus(): string {
        return $this->status === 1 ? 'Available' : 'Not Available';
    }

    public function getCategory() : string {
        return $this->category;
    }

    public function getSubCategory() : string {
        return empty($this->subCategory) ? "-" : $this->subCategory;
    }

    public function __get($name){
        if (isset($this->$name)){
            $this->cpu;
        } else {
            return null;
        }
    }

}
