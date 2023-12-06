<?php
include __DIR__.'/Genre.php';
include __DIR__.'/Product.php';
class Movie extends Product
{
    private $id;
    private $title;
    private $overview;
    private $vote_average;
    private $poster_path;
    private $original_language;
    private $genres;

    function __construct($id, $title, $overview, $vote, $language, $image, $genres, $quantity, $price) 
    {
        $this ->id = $id;
        $this -> title = $title;
        $this ->overview = $overview;   
        $this ->vote_average = $vote;
        $this ->poster_path = $image;
        $this ->original_language= $language;
        $this->genres = $genres;
    }
    public function getVote()
    {
        $vote = ceil($this->vote_average / 2);
        $template = '<p>';
        for ($n = 1; $n <= 5; $n++) {
            
                $template .= $n <= $vote ? '<i class="fa-solid fa-star"></i>' : '<i class="fa-regular fa-star"></i>';
            
        }
        $template .= '</p>';
        return $template;
    }
    private function formatGenres(){
        $template = "<p>";
        for ($n = 0; $n < count($this->genres); $n++){
            $template .= $this->genres[$n]->drawGenre();
        }
        $template .="<p>";
        return $template;
    }
    public function printCard(){

        $error = '';
        if(ceil($this->vote_average)< 7){
            try {
                $this->setDiscount(10);
            }catch(Exception $e){
                $error = 'Eccezione:' . $e->getMessage();
            }
        }
        $sconto - $this->getDiscount();
        $image = $this ->poster_path;
        $title = strlen ($this ->title) > 28 ? substr($this->title, 0, 28) . '...' : $this->title;
        $content = substr($this->overview, 0, 100) . "...";
        $custom = $this ->getVote();
        $genre = $this->formatGenres();
        $price = $this->price;
        $quantity = $this->quantity;
        include __DIR__. '/../Views/card.php';
   
}

public static function fetchAll(){

    $movieString = file_get_contents(__DIR__ .'/movie_db.json');
    $movieList = json_decode($movieString, true);

    $movies = [];
    $genres = Genre::fetchAll();
    foreach( $movieList as $item){
        $moviegenres = [];
        while (count($moviegenres) < count($item['genre_ids'])){
            $index = rand(0, count($genres) -1);
            $rand_genre = $genres[$index];
            if(!in_array($rand_genre, $moviegenres)){
                $moviegenres[] = $rand_genre;
            }
        }
        $quantity = rand(0, 100);
        $price = rand(5, 200);
        $movies[] = new Movie($item ['id'], $item ['title'],$item ['overview'],$item ['vote_average'], $item ['original_language'], $item ['poster_path'], $price, $quantity, $genres);
    }
    return $movies;
    }
}







?>