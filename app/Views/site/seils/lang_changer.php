<ul class="topbar-links mb-0 list-unstyled d-inline-flex">
    <?php foreach($langes as $lange) : ?>
    <li><a class="lang-changer<?= ($lange['text'] == $cur_lang) ? ' active' : '' ?>" href="<?= $lange['url'] ?>" title=""><?= $lange['text'] ?></a></li>
    <?php endforeach; ?>
</ul>
