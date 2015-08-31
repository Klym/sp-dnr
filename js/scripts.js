// JavaScript Document
window.onload = function() {
	if (document.getElementById("partners")) {
		var banners = document.getElementById("banners");
		var images = banners.getElementsByTagName("img");
		
		var animation = new Animation(banners, images);
		animation.startAnimation(false);
		
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
			animation.startAnimation(true);
		}
	}
}