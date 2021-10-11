<?php $pager->setSurroundCount(2) ?>
<nav aria-label="Page navigation">
    <div class="pagination-wrap">
        <ul class="pagination" >
            <?php if ($pager->hasPrevious()) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getPrevious() ?>"  aria-label="<?= lang('Pager.previous') ?>">
                        <span  aria-hidden="true">
                            <i class="fas fa-angle-left"></i>
                        </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php foreach ($pager->links() as $link) : ?>
                <li class="page-item">
                    <a class="page-link<?= $link['active'] ? ' active' : '' ?>" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a>
                </li>
            <?php endforeach; ?>
            <?php if ($pager->hasNext()) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
                        <span aria-hidden="true">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </li>
             <?php endif; ?>
        </ul>
    </div>
</nav>