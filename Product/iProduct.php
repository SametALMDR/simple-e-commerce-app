<?php
namespace Product;

interface iProduct {

    public function getPrice() : float;
    public function getCurrency() : string;

    public function getCategory() : string;

    public function getName() : string;
    public function productStatus(): string;

}
