<?php
include __DIR__.'/Genre.php';
class Movie {
    private $id;
    private $title;
    private $overview;
    private $vote_average;
    private $poster_path;
    private $original_language;

    function __construct($id, $title, $overview, $vote, $language, $image) 
    {
        $this ->id = $id;
        $this -> title = $title;
        $this ->overview = $overview;   
        $this ->vote_average = $vote;
        $this ->poster_path = $image;
        $this ->original_language= $language;
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
    public function printCard(){
        $image = $this ->poster_path;
        $title = $this ->title;
        $content = substr($this->overview, 0, 100) . "...";
        $custom = $this ->vote_average;
        include __DIR__. '/../Views/card.php';
    }
}

$movieString = file_get_contents(__DIR__ .'/movie_db.json');
$movieList = json_decode($movieString, true);

$movies = [];


foreach( $movieList as $item ){
    $movies[] = new Movie($item ['id'], $item ['title'],$item ['overview'],$item ['vote_average'], $item ['original_language'], $item ['poster_path']);
}
//echo $movies[0]->title;
?>