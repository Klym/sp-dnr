<nav>
    <a href="news.php" class="newsNavItemLink">
        <div class="newsNavItem">
            <?=(!isset($_GET["type"]) || $_GET["type"] <= 0) ? "<div class=\"active\"></div>" : ""; ?>
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
<div class="newsNavItem<? if (!is_null($from)) echo " active"; ?>">
    <div class="newsNavItemMark"></div>
    <div class="newsNavItemText">Фильтр</div>
</div>
<div id="filterForm">
	<?
	   $monthes = Array("Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь");
	   $years = $news->getYears();
	?>
    <form action="news.php" method="get" name="filter">
        <p>От:</p>
        <select name="startDay">
        	<? for ($i = 1; $i <= 31; $i++) { ?>
                <option <?=($i == $_GET["startDay"]) ? "selected" : ""; ?>><?=$i; ?></option>
			<? } ?>
        </select>
        <select name="startMonth">
            <? for ($i = 0; $i < 12; $i++) { ?>
                <option value="<?=$i + 1; ?>" <?=($i + 1 == $_GET["startMonth"]) ? "selected" : ""; ?>><?=$monthes[$i]; ?></option>
			<? } ?>
        </select>
        <select name="startYear">
            <? for ($i = $years["max"]; $i >= $years["min"]; $i--) { ?>
            	<option <?=($i == $_GET["startYear"]) ? "selected" : ""; ?>><?=$i; ?></option>
            <? } ?>
        </select>
        
        <div id="endDate">
            <p>До:</p>
            <select name="endDay">
        	<? for ($i = 1; $i <= 31; $i++) { ?>
                <option <?=($i == $_GET["endDay"]) ? "selected" : ""; ?>><?=$i; ?></option>
			<? } ?>
            </select>
            <select name="endMonth">
                <? for ($i = 0; $i < 12; $i++) { ?>
                    <option value="<?=$i + 1; ?>" <?=($i + 1 == $_GET["endMonth"]) ? "selected" : ""; ?>><?=$monthes[$i]; ?></option>
                <? } ?>
            </select>
            <select name="endYear">
                <? for ($i = $years["max"]; $i >= $years["min"]; $i--) { ?>
                    <option <?=($i == $_GET["endYear"]) ? "selected" : ""; ?>><?=$i; ?></option>
                <? } ?>
            </select>
        </div>
        <p><label>
        	<input type="checkbox" name="exactDate" <?=($_GET["exactDate"] == "on") ? "checked" : ""; ?>>
            	<span class="checkboxText">Точная дата</span>
			</label></p>
        <select name="type">
			<option value="0">Выберите категорию</option>
        	<? foreach($categories as $cat) : ?>
            	<option value="<?=$cat->getId(); ?>" <?=($cat->getId() == $_GET["type"]) ? "selected" : "";s ?>><?=$cat->getTitle(); ?></option>
            <? endforeach; ?>
        </select>
        <input type="submit" value="Фильтровать">
    </form>
</div>