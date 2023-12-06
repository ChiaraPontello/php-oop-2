<div class="col-12 col-md-4 col-lg-3">
    <div class="card">
        <img src="<?= $image ?>" class="card-img-top my-ratio" alt="<?= $title ?>">
        <div class="card-body">
            <?php
            if($error){?>
            <div class="alert alert-danger">
                <?= $error ?>
            </div>
           <?php }?>
            <h5 class="card-title">
                <?= $title ?>
            </h5>
            <p class="card-text">
                <?= $content ?>
            </p>
            <div>
                <?= $custom ?>
               </div>
                <div>
                    <?= $genre ?>
                </div>
                <div class="d-flex justify-content-between align-items-flex-start">
                    <div>Quantità
                        <?= $quantity ?>
                    </div>
                    <div>$
                    <?= $price ?>
                    <?php if ($sconto > 0){?>
                        <div>Sconto :
                            <?= $sconto ?> %
                        </div>
                   <?php }?>
                    </div>
                </div>
            </div>
        
        </div>
    
</div>