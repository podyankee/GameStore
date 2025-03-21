document.addEventListener("DOMContentLoaded", function () {
	var swiperSimilar = new Swiper(".similar-games-list", {
		loop: false,
		autoplay: false,
		slidesPerView: 6,
		speed: 500,
		grabCursor: true,
		navigation: {
			nextEl: ".similar-right",
			prevEl: ".similar-left",
		},
	});
});
