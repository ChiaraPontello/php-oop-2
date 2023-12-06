<?php
class Product{
    protected float $price;
    private int $discount =0;
    protected int $quantity;
public function __construct($price, $quantity){
        $this->price = $price;
        $this->quantity = $quantity;
}
public function setDiscount($perc){
    if($perc < 5 || $perc > 100){
        throw new Exception('Your precentage is out of range.');
    }else  {
        $this->discount = $perc;
    }
}
public function getDiscount(){
    return $this->discount;
}

}
?>