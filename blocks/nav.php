<nav>
    <div class="<?= ($page == "index") ? "active" : "";  ?>">
        <a href="index.php" class="navButton">
            <div>Главная<div class="delimiter"></div></div>
        </a>
        <div class="hidden"></div>
    </div>
    
    <div class="<?= ($page == "news") ? "active" : "";  ?>">
        <a href="news.php" class="navButton">
            <div >
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
    
    <div class="<?= ($page == "committees") ? "active" : "";  ?>">
        <a href="committees.php" class="navButton">
            <div>
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
    
    <div class="<?= ($page == "about") ? "active" : "";  ?>">
        <a href="#" class="navButton">
            <div>
                О союзе
                <div class="delimiter"></div>
                <div class="navCircle"></div>
            </div>
        </a>
        <div class="hidden"></div>
    </div>
    
    <div class="<?= ($page == "applicationForm") ? "active" : "";  ?>">
        <a href="applicationForm.php" class="navButton">
        	<div>Регистрация в союзе</div>
		</a>
        <div class="hidden"></div>
    </div>
</nav>