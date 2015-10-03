<nav class="pagination">
    <ul>
        <a href="news.php?page=0" <?=$pagination->isPrevDisabled(); ?>>
            <li>&larr;&nbsp;Первая</li>
        </a>
        <a href="news.php?page=<?=$pagination->getPrev(); ?>" <?=$pagination->isPrevDisabled(); ?>>
            <li>&laquo;</li>
        </a>
        <? for ($c = 0, $i = $pagination->getFrom(); $c < $pagination->count; $i++, $c++) { ?>
            <a href="news.php?page=<?=$i; ?>">
                <li <?=($pagination->getSelected() == $i) ? "class=\"active\"" : 0; ?>><?=($i + 1); ?></li>
            </a>
        <? } ?>
        
        <a href="news.php?page=<?=$pagination->getNext(); ?>" <?=$pagination->isNextDisabled(); ?>>
            <li>&raquo;</li>
        </a>
        <a href="news.php?page=<?=$pagination->toEnd(); ?>" <?=$pagination->isNextDisabled(); ?>>
            <li>Последняя&nbsp;&rarr;</li>
        </a>
    </ul>
</nav>