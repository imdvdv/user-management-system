<nav class="page-navigation">
    <ul class="pagination">

        <?php if (!empty($first_page)): ?>
            <li class="page page_first arrow-page">
                <a class="page-link" href="<?= $first_page; ?>">
                    <i class="fa-solid fa-angles-left"></i>
                </a>
            </li>
        <?php endif;

        if (!empty($back)): ?>
            <li class="page page_previous arrow-page">
                <a class="page-link" href="<?= $back; ?>">
                    <i class="fa-solid fa-angle-left"></i>
                </a>
            </li>
        <?php endif;

        if (!empty($pages_left)): 
            foreach ($pages_left as $page_left): ?>
                <li class="page">
                    <a class="page-link" href="<?= $page_left['link']; ?>">
                        <?= $page_left['number']; ?>
                    </a>
                </li>
            <?php endforeach;
        endif;

        if (!empty($count_pages) && $count_pages > 1 && is_int($current_page)): ?>
            <li class="page active">
                <a class="page-link"><?= $current_page; ?></a>
            </li>
        <?php endif;

        if (!empty($pages_right)):
            foreach ($pages_right as $page_right): ?>
                <li class="page">
                    <a class="page-link" href="<?= $page_right['link']; ?>">
                        <?= $page_right['number']; ?>
                    </a>
                </li>
            <?php endforeach;
        endif;

        if (!empty($forward)): ?>
            <li class="page page_next arrow-page">
                <a class="page-link" href="<?= $forward; ?>">
                    <i class="fa-solid fa-angle-right"></i>
                </a>
            </li>
        <?php endif;

        if (!empty($last_page)): ?>
            <li class="page page_last arrow-page">
                <a class="page-link" href="<?= $last_page; ?>">
                    <i class="fa-solid fa-angles-right"></i>
                </a>
            </li>
        <?php endif; ?>
        
    </ul>
</nav>