<?php

/**
 * Plugin Name:       Blocks Gamestore
 * Description:       Example block scaffolded with Create Block tool.
 * Version:           0.1.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       blocks-gamestore
 *
 * @package CreateBlock
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

define('BLOCKS_GAMESTORE_PATH', plugin_dir_path(__FILE__));

require_once(BLOCKS_GAMESTORE_PATH . 'blocks.php');

add_filter('block_categories_all', function ($categories) {
	return array_merge($categories, [
		[
			'slug' => 'gamestore',
			'title' => 'GameStore'
		]
	]);
});


function create_block_blocks_gamestore_block_init()
{
	register_block_type(__DIR__ . '/build/block-header');
	register_block_type(__DIR__ . '/build/block-footer');
	register_block_type(__DIR__ . '/build/block-hero');
	register_block_type(__DIR__ . '/build/block-cta');
	register_block_type(__DIR__ . '/build/block-faq');
	register_block_type(__DIR__ . '/build/block-slider');
	register_block_type(__DIR__ . '/build/block-games-line', array('render_callback' => 'view_block_games_line'));
	register_block_type(__DIR__ . '/build/block-recent-news', array('render_callback' => 'view_block_recent_news'));
	register_block_type(__DIR__ . '/build/block-subscribe', array('render_callback' => 'view_block_subscribe'));
	register_block_type(__DIR__ . '/build/block-featured-products', array('render_callback' => 'view_block_featured_products'));
	register_block_type(__DIR__ . '/build/block-single-news', array('render_callback' => 'view_block_single_news'));
	register_block_type(__DIR__ . '/build/block-single-game', array('render_callback' => 'view_block_single_game'));
	register_block_type(__DIR__ . '/build/block-news-box', array('render_callback' => 'view_block_news_box'));
	register_block_type(__DIR__ . '/build/block-news-header', array('render_callback' => 'view_block_news_header'));
	register_block_type(__DIR__ . '/build/block-similar-products', array('render_callback' => 'view_block_similar_products'));
}
add_action('init', 'create_block_blocks_gamestore_block_init');
