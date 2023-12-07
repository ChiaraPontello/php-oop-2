<?php
include __DIR__ . "/Product.php";
include __DIR__ . "/Genre.php";
include __DIR__ ."/../Traits/DrawCard.php";
class Book extends Product{
    use DrawCard;
    private int $id;
    private string $image;
    private string $title;
    private array $authors;

    private string $overview;
    public function __construct($id, $image, $title, $authors, $overview,  $price, $quantity)
    {
        parent::__construct($price, $quantity);
        $this->id = $id;
        $this->image = $image;
        $this->title = $title;
        $this->authors = $authors;
        $this->overview = $overview;
    }
    public function getAuthors(){
        $template = "<p>";
        for ($n = 1; $n < count($this->authors); $n++) {
            $template .= '<span>' . $this->authors[$n] . ' - </span>';
        }
        $template .= "<p>";
        return $template;
    }

    public function formatCard(){
        $itemCard = [

            'image' => $this->image,
            'title' => $this->title,
            'custom2' =>  strlen($this->overview) > 28 ? substr($this->overview, 0, 28) . '...' : $this->overview,
            'custom' =>  $this->getAuthors(),
            'sconto' => $this->getDiscount(),
            'price' => $this->price,
            'quantity' => $this->quantity
        ];
        return $itemCard;
    }
    public static function fetchAll(){
        $BookList = file_get_contents(__DIR__ . "/books_db.json");
        $BookEl = json_decode($BookList, true);
        $Books = [];
        foreach ($BookEl as $item) {

            $quantity = rand(0, 35);
            $price = rand(5, 50);
            $Books[] = new Book($item['_id'], $item['thumbnailUrl'], $item['title'], $item['authors'], $item['longDescription'], $price, $quantity);
        }

        return $Books;
    }
}



?>