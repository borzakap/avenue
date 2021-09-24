<section>
    <div class="w-100 pt-100 pb-100 position-relative">
        <div class="container">
            <div class="sections-schema">
                <?php if(!is_null($genplan->leaving_plan)) : ?>
                <?= img(['src' => 'images/plans/'.$genplan->leaving_plan->image_name, 'class' => 'img-fluid', 'width' => $genplan->leaving_plan->image_width, 'height' => $genplan->leaving_plan->image_height]) ?>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 <?= $genplan->leaving_plan->image_width ?> <?= $genplan->leaving_plan->image_height ?>">
                    <?php foreach($genplan->sections as $section) : ?>
                    <a xlink:href="<?= url_to('layouts-section', $section->slug) ?>">
                        <polygon data-slug="#" points="<?= $section->leaving_poligon ?>"></polygon>
                    </a>                        
                    <?php endforeach; ?>
                </svg>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>