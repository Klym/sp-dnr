// JavaScript Document
var interval;
var isTurned = false;
window.onload = function() {
	if (document.getElementById("partners")) {
		startLeft(15, false);
		var next = document.getElementById("next");
		var banners = document.getElementById("banners");
		prev.onmouseover = speedUpRight;
		prev.onmouseout = slowDownRight;
		next.onmouseover = speedUpLeft;
		next.onmouseout = slowDownLeft;
		banners.onmouseover = stopAnimation;
		banners.onmouseout = startAnimation;
	}
}

// Ф-ция запуска анимации баннеров
// int delay - задержка сдвига баннеров
// bool flag - была ли запущенна анимация ранее.
function startLeft(delay, flag) {
	var banners = document.getElementById("banners");
	var imgs = banners.getElementsByTagName("img");
	var width = 0;
	var maxWidth = 0;
	// Устанавливаем ширину блока баннеров
	for (var i = 0; i < imgs.length; i++) {
		if (imgs[i].width > maxWidth){
			maxWidth = imgs[i].width;
		}
		width += imgs[i].width + 8;
	}
	banners.style.width = width + 1 + maxWidth + 16 + "px";
	// Определяем стандартный сдвиг блока баннеров
	var margin = banners.offsetLeft;
	// Запускаем анимацию	
	interval = window.setInterval(function() {
		margin--;
		var node = imgs[0].parentNode;
		if (margin < 25 && !flag) {
			// Если первый баннер стартанул, клонируем его и пихаем в конец очереди
			var clone = node.cloneNode(true);
			clone.style.marginRight = 8 + "px";
			banners.appendChild(clone);
			flag = true;
		}
		if ((-margin + 25 - 8) >= imgs[0].width) {
			// Если первый баннер уехал, сбрасыаем сдвиг на стандартный и удаляем его из очереди
			margin = 25;
			banners.removeChild(node);
			flag = false;
		}
		banners.style.left = margin + "px";
	}, delay);
}

function startRight(delay, flag) {
	var banners = document.getElementById("banners");
	var imgs = banners.getElementsByTagName("img");
	var width = 0;
	var maxWidth = 0;
	// Устанавливаем ширину блока баннеров
	for (var i = 0; i < imgs.length; i++) {
		if (imgs[i].width > maxWidth){
			maxWidth = imgs[i].width;
		}
		width += imgs[i].width + 8;
	}
	banners.style.width = width + 1 + maxWidth + 16 + "px";
	// Определяем стандартный сдвиг блока баннеров
	var margin = banners.offsetLeft;
	// Запускаем анимацию	
	interval = window.setInterval(function() {
		margin++;
		var node = imgs[imgs.length - 1].parentNode;
		if (node.lastChild.width - margin >= margin && !flag) {
			var clone = node.cloneNode(true);
			clone.style.marginRight = 8 + "px";
			margin = margin - clone.firstChild.width - 8;
			banners.insertBefore(clone, imgs[0].parentNode);
			flag = true;
		}
		if (margin == 25) {
			banners.removeChild(node);
			flag = false;
		}
		banners.style.left = margin + "px";
	}, delay);
}

function speedUpRight() {
	window.clearInterval(interval);
	if (isTurned) {
		startRight(0.1, true);
	} else {
		isTurned = true;
		startRight(15, true);
	}
}

function slowDownRight() {
	window.clearInterval(interval);
	startRight(15, true);
}

function speedUpLeft() {
	window.clearInterval(interval);	
	if (isTurned) {
		startLeft(15, true);
	} else {
		startLeft(0.1, true);
	}	
	isTurned = false;
}

function slowDownLeft() {
	window.clearInterval(interval);
	startLeft(15, true);
}

function startAnimation() {
	if (isTurned) {
		startRight(15, true);
	} else {
		startLeft(15, true);
	}
}

function stopAnimation() {
	window.clearInterval(interval);
}