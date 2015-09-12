<nav>
    <a href="news.php" class="newsNavItemLink">
        <div class="newsNavItem">
            <?=(!isset($_GET["type"])) ? "<div class=\"active\"></div>" : ""; ?>
            <div class="newsNavItemMark"></div>
            <div class="newsNavItemText">Все новости</div>
        </div>
	</a>
    <? foreach($categories as $cat) : ?>
    <a href="news.php?type=<?=$cat->getId(); ?>" class="newsNavItemLink">
        <div class="newsNavItem">
        	<?=($_GET["type"] == $cat->getId()) ? "<div class=\"active\"></div>" : ""; ?>
            <div class="newsNavItemMark"></div>
            <div class="newsNavItemText"><?=$cat->getTitle(); ?></div>
        </div>
	</a>
    <? endforeach; ?>
</nav>
<div class="delimiterLine"></div>
<div class="newsNavItem">
    <div class="newsNavItemMark"></div>
    <div class="newsNavItemText">Фильтр</div>
</div>
<div id="filterForm">
	<?
	   $monthes = Array("Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь");
	?>
    <form method="get" name="filter">
        <p>От:</p>
        <select>
        	<? for ($i = 1; $i <= 31; $i++) { ?>
                <option><?=$i; ?></option>
			<? } ?>
        </select>
        <select>
            <? for ($i = 0; $i < 12; $i++) { ?>
                <option value="<?=$i; ?>"><?=$monthes[$i]; ?></option>
			<? } ?>
        </select>
        <select>
            <option>2015</option>
            <option>2014</option>
        </select>
        
        <div id="endDate">
            <p>До:</p>
            <select>
                <option>1</option>
                <option>2</option>
            </select>
            <select>
                <option>Январь</option>
                <option>Февраль</option>
            </select>
            <select>
                <option>2015</option>
                <option>2014</option>
            </select>
        </div>
        <p><label><input type="checkbox" name="exactDate"><span class="checkboxText">Точная дата</span></label></p>
        <select>
            <option>Выберите категорию</option>
            <option>Все новости</option>
            <option>Новости союза</option>
            <option>Мероприятия</option>
            <option>Экономика</option>
        </select>
        <input type="submit" value="Фильтровать">
    </form>
</div>