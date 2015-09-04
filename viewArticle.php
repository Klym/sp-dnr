<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/scripts.js"></script>
<script src="js/Partners.js"></script>
<title>Союз Предпринимателей ДНР - Новости</title>
</head>
<body>
	<div id="wrapper" class="news">
    	<header>
        	<div id="logo"></div>
            <div id="search">
            	<form method="get" name="searchForm"> 
                    <input type="search" name="search" placeholder="Поиск" name="keywords">
                    <input type="submit" value="">
				</form>
            </div>
        </header>
        <nav></nav>
        <div id="news">
            <section>
                <nav>
                    <a href="index.php">Главная</a> /
                    <a href="news.php">Новости</a> /
                    <a href="news.php">Мероприятия</a> / <span class="active">Заголовок мероприятия</span>
                </nav>
                <button id="eventReg">
                	<div id="pen"></div>
                    <div id="eventRegText"><p>Регистрация на мероприятие</p></div>
                </button>
                <article class="view">
                	<div class="newsTitle">Заголовок новости Заголовок новости Заголовок новости Заголовок
новости</div>
					<div class="newsInfo">Добавлено 26,11,2015 в 14,55 | <span class="eye"><img src="img/eye.png" width="28" height="20" alt="Просмотры"></span> 150 <span class="pull-right">| Мероприятие</span></div>
                    <p><img src="img/sea1.jpg" width="461" height="288" alt="Море 1" align="left" style="margin-right:5px;">Каждый веб-разработчик знает, что такое текст-«рыба». Текст этот, несмотря на название, не имеет никакого отношения к обитателям водоемов. Используется он веб-дизайнерами для вставки на интернет-страницы и демонстрации внешнего вида контента, просмотра шрифтов, абзацев, отступов и т.д. Так как цель применения такого текста исключительно демонстрационная, то и смысловую нагрузку ему нести совсем необязательно. Более того, нечитабельность текста сыграет на руку при оценке качества восприятия макета.

Самым известным «рыбным» текстом является знаменитый Lorem ipsum. Считается, что впервые его применили в книгопечатании еще в XVI веке. Своим появлением Lorem ipsum обязан древнеримскому философу Цицерону, ведь именно из его трактата «О пределах добра и зла» средневековый книгопечатник вырвал отдельные фразы и слова, получив текст-«рыбу», широко используемый и по сей день. Конечно, возникают некоторые вопросы, связанные с использованием Lorem ipsum на сайтах и проектах, ориентированных на кириллический контент – написание символов на латыни и на кириллице значительно различается.<br><br>
<img src="img/sea2.jpg" width="532" height="399" alt="Море 2" align="right">
И даже с языками, использующими латинский алфавит, могут возникнуть небольшие проблемы: в различных языках те или иные буквы встречаются с разной частотой, имеется разница в длине наиболее распространенных слов. Отсюда напрашивается вывод, что все же лучше использовать в качестве «рыбы» текст на том языке, который планируется использовать при запуске проекта. Сегодня существует несколько вариантов Lorem ipsum, кроме того, есть специальные генераторы, создающие собственные варианты текста на основе оригинального трактата, благодаря чему появляется возможность получить более длинный неповторяющийся набор слов.</p>
                </article>
            </section>
            <aside>
                <nav>
                	<div class="newsNavItem">
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
                <div class="line"></div>
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
                        <p><label><input type="checkbox"><span class="checkboxText">Точная дата</span></label></p>
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
            </aside>
        </div>
        <footer>
        	<div id="dnr-big-flag"></div>
            <div id="copyright">
            	<p>© Союз Предпринимателей ДНР<br>
                Использование любых материалов,<br>
                размещённых на данном сайте,<br>
                разрешается при условии ссылки<br>
                на sp-dnr.ru</p>
            </div>
            <address>
                <p>Адрес: ул. Лермонтова 25, Донецк, ДНР<br>
                Телефон: 071-356-22-22</p>
            </address>
        </footer>
    </div>
</body>
</html>
