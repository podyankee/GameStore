<?php

// Popup View

function gamestore_footer_search_popup()
{
?>

<div class="popup-games-search-container">
	<span id="close-search"></span>
	<div class="search-container">
		<div class="search-bar wrapper">
			<h2 class="search-label">Search</h3>
				<input type="text" name="gsme-title" id="popup-search-input" placeholder="Search for games" />
				<p class="search-popup-title">You might be interested</p>
		</div>
		<div class="search-results-wrapper">
			<div class="popup-search-results wrapper"></div>
		</div>
	</div>
</div>

<?php

}

add_action('wp_footer', 'gamestore_footer_search_popup');

// Load latest 18 Games

function load_latest_games()
{
	$args = array(
		'post_type' => 'product',
		'posts_per_page' => 18,
		'post_status' => 'publish',
		'orderby' => 'rand',
	);
	$games_query = new WP_Query($args);

	$result = array();
	if ($games_query->have_posts()) {
		while ($games_query->have_posts()) {
			$games_query->the_post();

			$product = wc_get_product(get_the_ID());

			$result[] = array(
				'link' => get_the_permalink(),
				'thumbnail' => $product->get_image('full'),
				'price' => $product->get_price_html(),
				'title' => get_the_title(),
			);
		}
	}
	wp_reset_postdata();

	wp_send_json_success($result);
}
add_action('wp_ajax_load_latest_games', 'load_latest_games');
add_action('wp_ajax_nopriv_load_latest_games', 'load_latest_games');


// Search Games by Title

function search_games_by_title()
{
	$search_term = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
	$args = array(
		'post_type' => 'product',
		'posts_per_page' => -1,
		'post_status' => 'publish',
		's' => $search_term,
	);
	$games_query = new WP_Query($args);

	$result = array();
	if ($games_query->have_posts()) {
		while ($games_query->have_posts()) {
			$games_query->the_post();

			$product = wc_get_product(get_the_ID());

			$result[] = array(
				'link' => get_the_permalink(),
				'thumbnail' => $product->get_image('full'),
				'price' => $product->get_price_html(),
				'title' => get_the_title(),
			);
		}
	}
	wp_reset_postdata();

	wp_send_json_success($result);
}
add_action('wp_ajax_search_games_by_title', 'search_games_by_title');
add_action('wp_ajax_nopriv_search_games_by_title', 'search_games_by_title');