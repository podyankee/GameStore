document.addEventListener("DOMContentLoaded", () => {
	var swiperGameSlider = new Swiper(".game-single-slider", {
		loop: true,
		slidesPerView: 1,
		speed: 300,
		keyboardControl: true,
		navigation: {
			nextEl: ".swiper-game-next",
			prevEl: ".swiper-game-prev",
		},
		keyboard: {
			enable: true,
			onlyInViewport: true,
		},
	});
});
