<section>
    <div class="breadcrumb-wrap">
        <div class="breadcrumb-list-wrap">
            <?php if(isset($breadcrumbs) && is_array($breadcrumbs)) : ?>
            <?php 
                $all = count($breadcrumbs);
                $i = 0;
            ?>
            <ol class="breadcrumb">
                <?php foreach($breadcrumbs as $breadcrumb) : ?>
                    <li class="breadcrumb-item<?= (++$i == $all) ? ' active' : '' ?>"><a href="<?= $breadcrumb['url'] ?>" title=""><?= $breadcrumb['title'] ?></a></li>
                <?php endforeach; ?>
            </ol>
            <?php endif; ?>
        </div><!-- Page Top Wrap -->
    </div>
</section>
