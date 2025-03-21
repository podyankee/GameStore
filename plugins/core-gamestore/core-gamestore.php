<?php

/**
 * Plugin Name: Core Gamestore
 * Plugin URI: #
 * Description: Core Code for Gamestore
 * Author: Kostyantin
 * Version: 1.0
 * Author URI: designerccc@yandex.ru
 * License: GPLv2 or later
 * Text Domain: core-gamestore
 * Domain Path: /languages
 */

define('GAMESTORE_PLUGIN_URL', plugin_dir_url(__FILE__));
define('GAMESTORE_PLUGIN_PATH', plugin_dir_path(__FILE__));

require_once(GAMESTORE_PLUGIN_PATH . '/inc/games-search.php');
require_once(GAMESTORE_PLUGIN_PATH . '/inc/games-meta.php');
require_once(GAMESTORE_PLUGIN_PATH . '/inc/games-tax.php');
require_once(GAMESTORE_PLUGIN_PATH . '/inc/social-share.php');
require_once(GAMESTORE_PLUGIN_PATH . '/inc/news-term-meta.php');
