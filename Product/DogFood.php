<?php
namespace Product;

final class DogFood extends AnimalFood {

    public $race;

    public function __construct($details){
        $this->race = $details->raceType;
        parent::__construct($details);
    }

}
