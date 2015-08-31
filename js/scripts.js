// JavaScript Document
window.onload = function() {
	if (document.getElementById("partners")) {
		partners();
	}
}

function partners() {
	var banners = document.getElementById("banners");
	var imgs = banners.getElementsByTagName("img");
	var width = 0;
	// Устанавливаем ширину блока баннеров
	for (var i = 0; i < imgs.length; i++) {
		width += imgs[i].width + 8;
	}
	banners.style.width = width + 1 + "px";
	// Определяем стандартный сдвиг блока баннеров
	var margin = banners.offsetLeft;
	var flag = false;	// Отвечает за определения вышел ли первый баннер из виду пользователя
	
	window.setInterval(function() {
		margin -= 1;
		var node = imgs[0].parentNode;
		if (margin < 25 && !flag) {
			// Если первый баннер стартанул, клонируем его и пихаем в конец очереди
			var clone = node.cloneNode(true);
			banners.style.width = banners.clientWidth + clone.firstChild.width + 16 + "px";
			clone.style.marginRight = 8 + "px";
			banners.appendChild(clone);
			flag = true;
		}
		if ((-margin + 25 - 8) == imgs[0].width) {
			// Если первый баннер уехал, сбрасыаем сдвиг на стандартный и удаляем его из очереди
			margin = 25;
			banners.removeChild(node);
			flag = false;
		}
		banners.style.left = margin + "px";
	}, 15);
}