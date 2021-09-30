<section>
    <div class="w-100 pt-100 pb-100 position-relative">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-12">
                    <p class="title d-sm-none d-md-block"><?= lang('Site.Sections.Page.Floors') ?></p>
                    <ul class="nav flex-md-column nav-pills" id="pills-tab" role="tablist">
                        <?php foreach ($floors as $floor) : ?>
                            <li class="nav-item"">
                                <a class="nav-link" id="pills-<?= $floor->id ?>-tab" data-toggle="pill" href="#pills-<?= $floor->id ?>" role="tab" aria-controls="pills-<?= $floor->id ?>" aria-selected="true"><?= $floor->image_code ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-md-8 col-12">
                    <div class="tab-content" id="pills-tabContent">
                        <?php foreach ($floors as $floor) : ?>
                            <div class="tab-pane fade" id="pills-<?= $floor->id ?>" role="tabpanel" aria-labelledby="pills-<?= $floor->id ?>-tab">
                                <div class="rotation-wrapper-outer">
                                    <div class="rotation-wrapper-inner">
                                        <div class="sections-schema">
                                            <?= img(['src' => 'images/plans/' . $floor->image_name, 'class' => 'img-fluid', 'width' => $floor->image_width, 'height' => $floor->image_height]) ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 <?= $floor->image_width ?> <?= $floor->image_height ?>">
                                                <?php foreach ($floor->withLayoutsPoligons()->poligons as $poligon) : ?>
                                                    <polygon data-id="<?= $poligon->id ?>" data-slug="<?= $poligon->slug ?>" data-rooms="<?= $poligon->rooms ?>" data-action="<?= route_to('layout-load') ?>" points="<?= $poligon->plan_poligon ?>"></polygon>                        
                                                <?php endforeach; ?>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div> 
                </div>
                <div class="col-md-2 col-12">
                </div>
            </div>
        </div>
    </div>
</section>