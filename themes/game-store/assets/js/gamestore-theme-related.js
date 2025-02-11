// Dark Mode Style
let styleMode = localStorage.getItem('styleMode');
const styleToggle = document.querySelector('.header-mod-switcher');

const enableDarkStyle = () => {
	document.body.classList.add('dark-mode-gamestore');
	localStorage.setItem('styleMode', 'dark');
};

const disableDarkStyle = () => {
	document.body.classList.remove('dark-mode-gamestore');
	localStorage.setItem('styleMode', null);
};

if (styleToggle) {
	styleToggle.addEventListener('click', () => {
		styleMode = localStorage.getItem('styleMode');
		if (styleMode !== 'dark') {
			enableDarkStyle();
		} else {
			disableDarkStyle();
		}
	});
}

if (styleMode === 'dark') {
	enableDarkStyle();
}

document.addEventListener('DOMContentLoaded', () => {
	const searchContainer = document.querySelector('.popup-games-search-container');
	const searchResults = document.querySelector('.popup-search-results');
	const searchInput = document.getElementById('popup-search-input');
	const openButton = document.querySelector('.header-search');
	const closeButton = document.getElementById('close-search');
	const titleElement = document.querySelector('.search-popup-title');

	const showPlaceholders = () => {
		searchResults.innerHTML = '';
		for (let i = 0; i < 12; i++) {
			const placeholder = document.createElement('div');
			placeholder.className = 'game-placeholder';
			searchResults.appendChild(placeholder);
		}
	};

	const renderGames = games => {
		searchResults.innerHTML = '';
		games.forEach(game => {
			const gameDiv = document.createElement('div');
			gameDiv.className = 'game-result';

			gameDiv.innerHTML = `
			<a href="${game.link}">
				<div class="game-featured-image">${game.thumbnail}</div>
				<div class="game-meta">
					<div class="game-price">${game.price}</div>
					<h3>${game.title}</h3>
					<div class="game-platforms">${game.platforms}</div>
				</div>
			</a>
			`;
			searchResults.appendChild(gameDiv);
		});
	};

	const loadDefaultGames = () => {
		fetch(gamestore_params.ajaxurl, {
			method: 'POST',
			header: {
				'Content-Type': 'application/x-www-form-urlncoded',
			},
			body: new URLSearchParams({
				action: 'load_latest_games',
			}),
		})
			.then(response => response.json())
			.then(data => {
				if (data.success) {
					renderGames(data.data);
				}
			})
			.catch(error => console.log('Error fetching latest games', error));
	};

	openButton.addEventListener('click', () => {
		searchContainer.style.display = 'block';
		titleElement.textContent = 'You might be interested';

		showPlaceholders();

		fetch(gamestore_params.ajaxurl, {
			method: 'POST',
			header: {
				'Content-Type': 'application/x-www-form-urlncoded',
			},
			body: new URLSearchParams({
				action: 'load_latest_games',
			}),
		})
			.then(response => response.json())
			.then(data => {
				if (data.success) {
					renderGames(data.data);
				}
			})
			.catch(error => console.log('Error fetching latest games', error));
	});

	searchInput.addEventListener('input', () => {
		const searchItem = searchInput.value;
		titleElement.textContent = 'Search Results';

		showPlaceholders();

		fetch(gamestore_params.ajaxurl, {
			method: 'POST',
			header: {
				'Content-Type': 'application/x-www-form-urlncoded',
			},
			body: new URLSearchParams({
				action: 'search_games_by_title',
				search: searchItem,
			}),
		})
			.then(response => response.json())
			.then(data => {
				if (data.success && data.data.length > 0) {
					titleElement.textContent = 'Search Results';
					renderGames(data.data);
				} else {
					titleElement.textContent = 'Nothing was found. You might be interested in';
					showPlaceholders();
					loadDefaultGames();
				}
			})
			.catch(error => console.log('Error fetching latest games', error));
	});

	closeButton.addEventListener('click', () => {
		searchContainer.style.display = 'none';
		searchResults.innerHTML = '';
	});
});
