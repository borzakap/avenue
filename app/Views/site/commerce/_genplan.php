<section>
    <div class="w-100 pt-50 pb-50 position-relative">
        <div class="container">
            <div class="sections-schema">
                <?php if(!is_null($genplan->commerce_plan)) : ?>
                <?= img(['src' => 'images/plans/'.$genplan->commerce_plan->image_name, 'class' => 'img-fluid', 'width' => $genplan->commerce_plan->image_width, 'height' => $genplan->commerce_plan->image_height]) ?>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 <?= $genplan->commerce_plan->image_width ?> <?= $genplan->commerce_plan->image_height ?>">
                    <?php foreach($genplan->sections as $section) : ?>
                    <a xlink:href="<?= url_to('commerce-section', $section->slug) ?>">
                        <polygon data-slug="#" points="<?= $section->commerce_poligon ?>"></polygon>
                    </a>                        
                    <?php endforeach; ?>
                </svg>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>