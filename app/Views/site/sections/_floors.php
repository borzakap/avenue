<section>
    <div class="w-100 pt-100 pb-100 position-relative">
        <div class="container">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <?php foreach ($floors as $floor) : ?>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-<?= $floor->id ?>-tab" data-toggle="pill" href="#pills-<?= $floor->id ?>" role="tab" aria-controls="pills-<?= $floor->id ?>" aria-selected="true"><?= $floor->image_code ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <?php foreach ($floors as $floor) : ?>
                    <div class="tab-pane fade" id="pills-<?= $floor->id ?>" role="tabpanel" aria-labelledby="pills-<?= $floor->id ?>-tab">
                        <div class="rotation-wrapper-outer">
                            <div class="rotation-wrapper-inner">
                                <div class="sections-schema">
                                    <?= img(['src' => 'images/sections/' . $floor->image_name, 'class' => 'img-fluid', 'width' => $floor->image_width, 'height' => $floor->image_height]) ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 <?= $floor->image_width ?> <?= $floor->image_height ?>">
                                        <?php foreach ($floor->withPoligons()->poligons as $poligon) : ?>
                                            <polygon data-id="<?= $poligon->id ?>" data-slug="<?= $poligon->slug ?>" points="<?= $poligon->poligon ?>"></polygon>                        
                                        <?php endforeach; ?>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div> 
        </div>
    </div>
</section>