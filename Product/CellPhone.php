<?php

namespace Product;

final class CellPhone extends Product {

    public $cpu;
    public $screenSize;
    public $os;
    public $ram;

    public function __construct($details){
        $this->cpu = $details->cpu.' 2500 Mhz';
        parent::__construct($details);
    }

}