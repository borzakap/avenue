<?php foreach ($layouts as $layout) : ?>
    <?php if(!isset($carusel) || $carusel != 1) : ?>
    <div class="col-sm-12 col-md-6 col-lg-4">
    <?php else : ?>
    <div class="col">
    <?php endif; ?>
        <div class="layouts-box">
            <span class="layoutsfav" data-layout-id="<?= $layout->id ?>">
                <svg width="33" height="30" viewBox="0 0 33 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.94727 9.32787V9.32761C1.9471 8.37496 2.13682 7.43184 2.50534 6.55336C2.87386 5.67488 3.41379 4.87867 4.09356 4.21125C4.77333 3.54384 5.57932 3.01861 6.46441 2.66627C7.34951 2.31393 8.29595 2.14155 9.24844 2.15919L9.2663 2.15952L9.28418 2.15942C10.4344 2.15332 11.5728 2.39175 12.624 2.85891C13.6751 3.32608 14.6149 4.01131 15.3812 4.8692L16.4999 6.12171L17.6186 4.8692C18.3849 4.01131 19.3247 3.32608 20.3758 2.85891C21.427 2.39175 22.5654 2.15332 23.7156 2.15942L23.7335 2.15952L23.7514 2.15919C24.7038 2.14155 25.6503 2.31393 26.5354 2.66627C27.4205 3.01861 28.2265 3.54384 28.9062 4.21125C29.586 4.87867 30.1259 5.67488 30.4944 6.55336L31.8777 5.9731L30.4944 6.55336C30.863 7.43184 31.0527 8.37496 31.0525 9.32761V9.32787C31.0525 13.0169 28.8495 16.4221 25.6368 19.6868C24.0499 21.2994 22.2738 22.8212 20.5062 24.2784C20.0065 24.6903 19.504 25.0998 19.0065 25.5053C18.1438 26.2084 17.2961 26.8993 16.5045 27.569C15.6701 26.8573 14.7736 26.1243 13.8622 25.3792C13.4098 25.0093 12.9538 24.6364 12.4998 24.2617C10.7315 22.8018 8.95472 21.2817 7.36655 19.6717C4.15181 16.4126 1.94727 13.0187 1.94727 9.32787Z" stroke="#A77B2B" stroke-width="3"/>
                </svg>
            </span>
            <div class="image-box w-100 position-relative overflow-hidden">
                <figure class="image-wraper">
                    <img class="img-fluid w-100" src="/images/layouts/<?= $layout->image_2d ?>" alt="<?= $layout->title ?>">
                </figure>
                <a href="<?= route_to('App\Controllers\Layouts::view', $layout->slug) ?>" title=""><i class="fas fa-search-plus"></i></i></a>
            </div>
            <div class="layout-info w-100">
                <?php if($layout->price > 0) : ?>
                <div class="pannel-price">
                    <span><?= $layout->price ?> $/м<sup>2</sup></span>
                </div>
                <?php endif; ?>
                <div class="pannel-area">
                    <span><?= lang('Site.Layouts.Texts.Rooms', ['count' => $layout->rooms]) ?>,</span>
                    <span><?= $layout->all_area ?> м<sup>2</sup></span>
                </div>
                <div class="pannel-location">
                    <span><?= $layout->withSection()->section->title ?></span>
                    <span><?= lang('Site.Layouts.Texts.Floors') ?> <?= $layout->withFloorImage()->floor_image->image_code ?></span>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
