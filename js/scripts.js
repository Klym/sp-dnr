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
	
	if (appForm) {
		var addButton = document.getElementById("addRepresentative");
		addButton.onclick = function() {
			var fields = document.getElementsByClassName("representetive")[0];
			var copy = fields.cloneNode(true);
			fields.parentNode.insertBefore(copy, this);
		}
		
		appForm.confirm.onchange = function() {
			if (this.checked) {
				appForm.submit.disabled = false;
			} else {
				appForm.submit.disabled = true;
			}
		}
	}
}