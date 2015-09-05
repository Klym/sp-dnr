<nav>
    <div class="newsNavItem">
        <div class="active"></div>
        <div class="newsNavItemMark"></div>
        <div class="newsNavItemText">Все новости</div>
    </div>
    <div class="newsNavItem">
        <div class="newsNavItemMark"></div>
        <div class="newsNavItemText">Новости союза</div>
    </div>
    <div class="newsNavItem">
        <div class="newsNavItemMark"></div>
        <div class="newsNavItemText">Мероприятия</div>
    </div>
    <div class="newsNavItem">
        <div class="newsNavItemMark"></div>
        <div class="newsNavItemText">Экономика</div>
    </div>
    <div class="newsNavItem">
        <div class="newsNavItemMark"></div>
        <div class="newsNavItemText">Что-то</div>
    </div>
</nav>
<div class="delimiterLine"></div>
<div class="newsNavItem">
    <div class="newsNavItemMark"></div>
    <div class="newsNavItemText">Фильтр</div>
</div>
<div id="filterForm">
    <form method="get" name="filter">
        <p>От:</p>
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