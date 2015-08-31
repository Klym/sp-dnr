function Animation(banners, images) {
	this.banners = banners;					// Блок баннеров
	this.images = images;					// Массив изображений
	this.width = 0;							// Ширина блока баннеров
	this.maxWidth = 0;						// Ширина саого большого баннера
	this.offset = this.banners.offsetLeft;	// Текущий сдвиг блока
	this.interval;							// Объект интервала
	this.isTurned = false;					// Нужно ли менять направление
	this.flag = true;						// Создавать ли копию первого/последнего блока
	
	// Устанавливаем ширину блока баннеров
	for (var i = 0; i < this.images.length; i++) {
		if (this.images[i].width > this.maxWidth){
			this.maxWidth = this.images[i].width;
		}
		this.width += this.images[i].width + 8;
	}
	this.banners.style.width = this.width + this.maxWidth + 17 + "px";
	
	// Ф-ция запуска анимации баннеров влево
	// int delay - задержка сдвига баннеров
	this._startLeft = function(delay) {
		var self = this;
		this.interval = window.setInterval(function() {
			self.offset--;
			var node = self.images[0].parentNode;
			if (self.flag) {
				// Если первый баннер стартанул, клонируем его и пихаем в конец очереди
				var clone = node.cloneNode(true);
				clone.style.marginRight = 8 + "px";
				self.banners.appendChild(clone);
				self.flag = false;
			}
			if ((-self.offset + 25 - 8) >= self.images[0].width) {
				// Если последний баннер уехал, сбрасываем сдвиг на стандартный и удаляем его из очереди
				self.offset = 25;
				self.banners.removeChild(node);
				self.flag = true;
			}
			self.banners.style.left = self.offset + "px";
		}, delay);
	}
	
	// Ф-ция запуска анимации баннеров вправо
	this._startRight = function(delay) {
		var self = this;
		this.interval = window.setInterval(function() {
			self.offset++;
			var node = self.images[self.images.length - 1].parentNode;
			if (self.flag) {
				// Если последний баннер уехал, клонируем его и пихаем в начало очереди
				var clone = node.cloneNode(true);
				clone.style.marginRight = 8 + "px";
				self.offset -= clone.firstChild.width + 8;
				self.banners.insertBefore(clone, self.images[0].parentNode);
				self.flag = false;
			}
			if (self.offset >= 25) {
				// Если первый баннер уехал, удаляем его из очереди
				self.banners.removeChild(node);
				self.flag = true;
			}
			self.banners.style.left = self.offset + "px";
		}, delay);
	}
	
	// Ускоряем/запускаем движение вправо
	this.speedUpRight = function() {
		window.clearInterval(this.interval);
		if (this.isTurned) {
			this._startRight(0.1);
		} else {
			this.isTurned = true;
			this._startRight(15);
		}
	}
	
	// Замедляем движение вправо
	this.slowDownRight = function() {
		window.clearInterval(this.interval);
		this._startRight(15);
	}
	
	// Ускоряем/запускаем движение влево
	this.speedUpLeft = function() {
		window.clearInterval(this.interval);	
		if (this.isTurned) {
			this._startLeft(15);
		} else {
			this._startLeft(0.1);
		}	
		this.isTurned = false;
	}
	
	// Замедляем движение влево
	this.slowDownLeft = function() {
		window.clearInterval(this.interval);
		this._startLeft(15);
	}
	
	// Запуск анимации
	this.startAnimation = function(flag) {
		if (this.isTurned) {
			this._startRight(15);
		} else {
			this._startLeft(15);
		}
	}
	
	// Остановка анимации
	this.stopAnimation = function() {
		window.clearInterval(this.interval);
	}
}