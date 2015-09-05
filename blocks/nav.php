<nav>
    <div>
        <a href="index.php" class="navButton">
            <div class="<?= ($page == "index") ? "active" : "";  ?>">Главная<div class="delimiter"></div></div>
        </a>
        <div class="hidden"></div>
    </div>
    
    <div>
        <a href="news.php" class="navButton">
            <div class="<?= ($page == "news") ? "active" : "";  ?>">
                Новости
                <div class="delimiter"></div>
                <div class="navCircle"></div>
            </div>
        </a>
        <div class="hidden">
            <a href="news.php"><div>Новости союза</div></a>
            <a href="news.php"><div>Мероприятия</div></a>
            <a href="news.php"><div>Экономика</div></a>
            <a href="news.php"><div>Что-то</div></a>
        </div>
    </div>
    
    <div>
        <a href="committees.php" class="navButton">
            <div class="<?= ($page == "committees") ? "active" : "";  ?>">
                Комитеты
                <div class="delimiter"></div>
                <div class="navCircle"></div>
            </div>
        </a>
        <div class="hidden">
            <a href="committees.php"><div>Комитет 1</div></a>
            <a href="committees.php"><div>Комитет 2</div></a>
            <a href="committees.php"><div>Комитет 3</div></a>
        </div>
    </div>
    
    <div>
        <a href="#" class="navButton">
            <div class="<?= ($page == "about") ? "active" : "";  ?>">
                О союзе
                <div class="delimiter"></div>
                <div class="navCircle"></div>
            </div>
        </a>
        <div class="hidden"></div>
    </div>
    
    <div>
        <a href="applicationForm.php" class="navButton">
        	<div class="<?= ($page == "applicationForm") ? "active" : "";  ?>">Регистрация в союзе</div>
		</a>
        <div class="hidden"></div>
    </div>
</nav>