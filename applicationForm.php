<?php
require("blocks/connect.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/scripts.js"></script>
<script src="js/Partners.js"></script>
<title>Союз Предпринимателей ДНР - Заявка на регистрацию в союзе</title>
</head>
<body>
	<div id="wrapper" class="smallbg">
    	<? include("blocks/header.php"); ?>
        <? $page = "applicationForm"; include("blocks/nav.php"); ?>
        <section id="regSection">
            <header>
                <div class="parallelogram"></div>
                <div class="headerText">Заявка на регистрацию в союзе</div>
                <div class="regLine"></div>
            </header>
            <form method="post" name="appForm" id="appForm">
            	<div id="appFormFields">
                    <div>
                        <label>
                            <span>Название предприятия*</span>
                            <input type="text" name="title" class="wide">
                        </label>
                    </div>
                    <div>
                        <label>
                            <span>Регистрационный номер или ИНН предпринимателя*</span>
                            <input type="text" name="inn" class="middle">
                        </label>
                    </div>
                    <div>
                        <label>
                            <span>Основной род деятельности</span>
                            <input type="text" name="occupation" class="wide">
                        </label>
                    </div>
                    <div>
                        <label>
                            <span>Дополнительный род деятельности</span>
                            <input type="text" name="dopOccupation" class="wide">
                        </label>
                    </div>
                    <div>
                        <label>
                            <span>Средняя численность персонала*</span>
                            <input type="text" name="staff" class="short">
                        </label>
                    </div>
                    <fieldset>
                        <legend>Руководитель</legend>
						<div>
                            <label>
                                <span>Имя*</span>
                                <input type="text" name="name" class="middle">
                            </label>
                        </div>
                        <div>
                            <label>
                                <span>Фамилия*</span>
                                <input type="text" name="surname" class="middle">
                            </label>
                        </div>
                        <div>
                            <label>
                                <span>Отчество*</span>
                                <input type="text" name="patronymic" class="middle">
                            </label>
                        </div>
                        <div>
                            <label>
                                <span>E-Mail*</span>
                                <input type="email" name="email" class="middle">
                            </label>
                        </div>
                        <div>
                            <label>
                                <span>Телефон*</span>
                                <input type="tel" name="tel" class="middle">
                            </label>
                        </div>
                    </fieldset>
                    <fieldset>
                    	<legend>Представители</legend>
                        <div class="representetive">
                        	<!--<div id="delRepresentative">
                                <img src="img/del.png" width="35" height="35" alt="Удалить представителя">
                                <div>Удалить</div>
                            </div>-->
                            <div>
                                <label>
                                    <span>Имя</span>
                                    <input type="text" name="reprName" class="middle">
                                </label>
                            </div>
                            <div>
                                <label>
                                    <span>Фамилия</span>
                                    <input type="text" name="reprSurname" class="middle">
                                </label>
                            </div>
                            <div>
                                <label>
                                    <span>Отчество</span>
                                    <input type="text" name="reprPatronymic" class="middle">
                                </label>
                            </div>
                            <div>
                                <label>
                                    <span>Телефон</span>
                                    <input type="tel" name="reprTel" class="middle">
                                </label>
                            </div>
						</div>
                        <div id="addRepresentative">
                            <img src="img/add.png" width="34" height="34" alt="Добавить представителя" align="left">
                            <span>Добавить еще представителя</span>
                        </div>
					</fieldset>
					<div class="noteField">
                        <label>
                            <span>Примечание</span>
                            <textarea name="note" class="wide"></textarea>
                        </label>
					</div>
                    <div id="regButtons">
                        <div class="checkbox">
                            <input type="checkbox" name="confirm" id="confirm"><label for="confirm">Согласен с условиями союза</label>
                        </div>
                        <input type="submit" name="submit" value="Зарегистрироваться" disabled>
					</div>
                </div>
            </form>
        </section>
        <? include("blocks/footer.php"); ?>
    </div>
</body>
</html>