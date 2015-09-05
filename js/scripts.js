// JavaScript Document
window.onload = function() {
	if (document.getElementById("partners")) {
		var banners = document.getElementById("banners");
		var images = banners.getElementsByTagName("img");
		
		var animation = new Animation(banners, images);
		animation.startAnimation();
		
		prev.onmouseover = function() {
			animation.speedUpRight();
		}
		prev.onmouseout = function() {
			animation.slowDownRight();
		}
		next.onmouseover = function() {
			animation.speedUpLeft();
		}
		next.onmouseout = function() {
			animation.slowDownLeft();
		}
		banners.onmouseover = function() {
			animation.stopAnimation();
		}
		banners.onmouseout = function() {
			animation.startAnimation();
		}
	}
	
	if (document.getElementById("search")) {
		var searchBlock = document.getElementById("search");
		searchForm.search.onfocus = function() {
			searchBlock.style.opacity = 1;
		}
		
		searchForm.search.onblur = function() {
			searchBlock.style.opacity = 0.9;
		}
	}
	
	if (document.getElementById("filterForm")) {
		var items = document.getElementsByClassName("newsNavItem");
		var filterDiv = items[items.length - 1];
		var filterForm = document.getElementById("filterForm")
		// Вешаем событие click на последний элемент навигации
		filterDiv.onclick = function() {
			if (filterDiv.getAttribute("class") == "newsNavItem") {
				// Если элемент не был нажат до этого, показываем форму фильтра
				filterDiv.setAttribute("class", "newsNavItem active");
				filterForm.style.display = "block";
			} else {
				// Иначе, прячем форму
				filterDiv.setAttribute("class", "newsNavItem");
				filterForm.style.display = "none";
			}
		}
		
		var endDate = document.getElementById("endDate");
		var paragraphs = filter.getElementsByTagName("p");
		// Вешаем событие change на checkbox отвечающий за диапазон дат
		filter.exactDate.onchange = function() {
			if (this.checked) {
				// Если он активен удаляем элементы с конечной датой
				filter.removeChild(endDate);
				paragraphs[0].innerText = "Дата:";
			} else {
				filter.insertBefore(endDate, this.parentNode.parentNode);
				paragraphs[0].innerText = "От:";
			}
		}
	}
	
	if (document.getElementById("regSection")) {
		var addButton = document.getElementById("addRepresentative");
		var fields = document.getElementsByClassName("representetive")[0];
		// Вешаем событие на кнопку добавления представителя
		addButton.onclick = function() {
			var copy = fields.cloneNode(true);	// Клонируем все поля
			var inputs = copy.getElementsByTagName("input");
			for (var i = 0; i < inputs.length; i++) {	// Устанавливаем стандартное значение всех полей
				inputs[i].value = "";
			}
			// Создаем кнопку удаления представителя
			var delButton = document.createElement("div");
			delButton.setAttribute("id", "delRepresentative");
			var delImg = new Image();
			delImg.src = "img/del.png";
			delImg.width = 35;
			delImg.height = 35;
			delImg.alt = "Удалить представителя";
			delButton.appendChild(delImg);
			var text = document.createElement("div");
			text.appendChild(document.createTextNode("Удалить"));
			delButton.appendChild(text);
			// Вставляем ее в скопированный блок
			copy.insertBefore(delButton, copy.firstChild);
			// Добавляем весь блок
			fields.parentNode.insertBefore(copy, this);
			// При нажатии на кнопку удаления, удаляем добавленный блок
			delButton.onclick = function() {
				this.parentNode.parentNode.removeChild(this.parentNode);
			}
		}
		
		// Разблокируем кнопку при устанавлении флажка, и наоборот
		appForm.confirm.onchange = function() {
			if (this.checked) {
				appForm.submit.disabled = false;
			} else {
				appForm.submit.disabled = true;
			}
		}
	}
}