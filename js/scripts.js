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
}