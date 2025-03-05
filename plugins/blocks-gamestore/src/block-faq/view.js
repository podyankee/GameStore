document.addEventListener("DOMContentLoaded", () => {
	const faqs = document.querySelectorAll(".faq-item");

	faqs.forEach((faq) => {
		const question = faq.querySelector(".faq-item-title");
		const answer = faq.querySelector(".faq-item-description");

		question.addEventListener("click", () => {
			question.classList.toggle("open");
			answer.classList.toggle("show");
		});
	});
});
