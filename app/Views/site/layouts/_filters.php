<div class="shop-filters-pagination-wrap d-flex flex-wrap justify-content-between w-100">
    <?= form_open(route_to($alias ?? 'layouts-filter', $residential->slug), ['id' => 'filter_send', 'name' => 'filter_send', 'method' => 'get']) ?>
    <div class="shop-filters d-flex flex-wrap align-items-center justify-content-center">
        <?php if(isset($rooms) && is_array($rooms)) : ?>
        <div class="filter-inner">
            <span><?= lang('Site.Layouts.Texts.RoomsCount') ?></span>
            <?php foreach ($rooms as $room) : ?>
                <input type="checkbox" name="rooms" id="rooms_<?= $room['rooms'] ?>" value="<?= $room['rooms'] ?>" class="filter-field">
                <label for="rooms_<?= $room['rooms'] ?>"><?= $room['rooms'] ?></label>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php if(isset($floors) && is_array($floors)) : ?>
        <div class="filter-inner">
            <span><?= lang('Site.Layouts.Texts.FloorsCount') ?></span>
            <?php foreach ($floors as $floor) : ?>
                <input type="checkbox" name="floors" id="floors_<?= $floor['image_code'] ?>" value="<?= $floor['image_code'] ?>" class="filter-field">
                <label for="floors_<?= $floor['image_code'] ?>"><?= $floor['image_code'] ?></label>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php if(isset($sections) && is_array($sections)) : ?>
        <div class="filter-inner">
            <span><?= lang('Site.Layouts.Texts.SectionsCount') ?></span>
            <?php foreach ($sections as $section) : ?>
                <input type="checkbox" name="sections" id="sections_<?= $section['id'] ?>" value="<?= $section['id'] ?>" class="filter-field">
                <label for="sections_<?= $section['id'] ?>"><?= $section['section_code'] ?></label>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <div class="filter-inner">
            <span><?= lang('Site.Layouts.Texts.Ordering') ?></span>
            <div class="slc-wrp">
                <select class="ordering filter-field">
                    <option value="all_area:asc"><?= lang('Site.Layouts.Texts.AllAreaAsc') ?></option>
                    <option value="all_area:desc"><?= lang('Site.Layouts.Texts.AllAreaDesc') ?></option>
                </select>
            </div>
        </div>
    </div>
    <?= form_close() ?>    
</div>            
