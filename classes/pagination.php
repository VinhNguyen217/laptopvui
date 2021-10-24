<div class="paging">
    <?php
    if ($current_page > 3) {
        $first_page = 1; ?>
        <a href="?<?= $ids ?>=<?= $id ?>&per_page=<?= $item_per_page ?>&page=<?= $first_page ?>">First</a>
    <?php
    }
    if ($current_page > 1) {
        $prev_page = 1; ?>
        <a href="?<?= $ids ?>=<?= $id ?>&per_page=<?= $item_per_page ?>&page=<?= $prev_page ?>">Prev</a>
    <?php }
    ?>
    <?php for ($num = 1; $num <= $totalPage; $num++) { ?>
        <?php if ($num != $current_page) { ?>
            <?php if ($num > $current_page - 2 && $num < $current_page + 2) { ?>
                <a href="?<?= $ids ?>=<?= $id ?>&per_page=<?= $item_per_page ?>&page=<?= $num ?>"><?= $num ?></a>
            <?php } ?>
        <?php } else { ?>
            <strong><?= $num ?></strong>
    <?php }
    }
    ?>
    <?php
    if ($current_page < $totalPage - 1) {
        $next_page = $current_page + 1; ?>
        <a href="?<?= $ids ?>=<?= $id ?>&per_page=<?= $item_per_page ?>&page=<?= $next_page ?>">Next</a>
    <?php }
    if ($current_page < $totalPage - 3) {
        $end_page = $totalPage;
    ?>
        <a href="?<?= $ids ?>=<?= $id ?>&per_page=<?= $item_per_page ?>&page=<?= $end_page ?>">Last</a>
    <?php
    }
    ?>

</div>
<style>
    .paging {
        float: right;
        margin-right: 20px;
    }

    .paging a {
        background-color: #edd1d1;
        padding: 5px 12px;
    }

    .paging a:hover {
        background-color: #ff6c6c;
    }

    .paging strong {
        background-color: #ff6c6c;
        padding: 4px 11px;
    }
</style>