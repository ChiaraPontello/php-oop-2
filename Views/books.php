<?php
include __DIR__ . '/Views/header.php';
include __DIR__ .'/Model/Book.php';
$books = Book::fetchAll();
?>

<section class="container">
    <h2>Book</h2>
    <div class="row gy-4">
        <?php foreach ($books as $book){
            $book->printCard($book->formatCard());
        } ?>
    </div>
</section>
<?php
include __DIR__ . '/Views/footer.php';
?>