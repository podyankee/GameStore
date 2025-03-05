<?php

/***
 * Plugin Name: Gamestore General
 * Description: Core Code for Gamestore
 * Version: 1.0
 * Author: Kostyantin
 * Author URI: designerccc@yandex.ru
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */



function gamestore_remove_dashboard_widgets()
{
	global $wp_meta_boxes;

	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['normal']['high']['rank_math_dashboard_widget']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_site_health']);
}

add_action('wp_dashboard_setup', 'gamestore_remove_dashboard_widgets');

// Allow SVG uploads
function gamestore_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'gamestore_mime_types');

// Fix SVG display in media library
function gamestore_fix_svg()
{
	echo '<style>
      .attachment-266x266, .thumbnail img {
          width: 100% !important;
          height: auto !important;
      }
  </style>';
}
add_action('admin_head', 'gamestore_fix_svg');

// Register Custom Post Type News
function gamestore_register_news_post_type()
{
	$labels = array(
		'name'                  => _x('Новости', 'Post Type General Name', 'gamestore'),
		'singular_name'         => _x('Новость', 'Post Type Singular Name', 'gamestore'),
		'menu_name'             => __('Новости', 'gamestore'),
		'name_admin_bar'        => __('Новость', 'gamestore'),
		'archives'              => __('Архив новостей', 'gamestore'),
		'attributes'            => __('Атрибуты новости', 'gamestore'),
		'all_items'             => __('Все новости', 'gamestore'),
		'add_new_item'          => __('Добавить новость', 'gamestore'),
		'add_new'               => __('Добавить новую', 'gamestore'),
		'edit_item'             => __('Редактировать новость', 'gamestore'),
		'view_item'             => __('Просмотр новости', 'gamestore'),
		'search_items'          => __('Поиск новостей', 'gamestore'),
		'not_found'             => __('Новости не найдены', 'gamestore'),
		'not_found_in_trash'    => __('В корзине новости не найдены', 'gamestore'),
		'featured_image'        => __('Изображение новости', 'gamestore'),
		'set_featured_image'    => __('Установить изображение', 'gamestore'),
	);

	$args = array(
		'label'                 => __('Новости', 'gamestore'),
		'description'           => __('Новости компании или сайта', 'gamestore'),
		'labels'                => $labels,
		'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-megaphone',
		'show_in_admin_bar'     => true,
		'show_in_rest'          => true,
		'has_archive'           => true,
		'rewrite'               => array('slug' => 'news'),
	);

	register_post_type('news', $args);
}
add_action('init', 'gamestore_register_news_post_type', 0);

//Register Taxonomy "News Category"

function gamestore_register_news_category_taxonomy()
{
	$labels = array(
		'name'                       => _x('Категории новостей', 'Taxonomy General Name', 'gamestore'),
		'singular_name'              => _x('Категория новостей', 'Taxonomy Singular Name', 'gamestore'),
		'menu_name'                  => __('Категории', 'gamestore'),
		'all_items'                  => __('Все категории', 'gamestore'),
		'parent_item'                => __('Родительская категория', 'gamestore'),
		'add_new_item'               => __('Добавить новую категорию', 'gamestore'),
		'edit_item'                  => __('Редактировать категорию', 'gamestore'),
		'update_item'                => __('Обновить категорию', 'gamestore'),
		'search_items'               => __('Поиск категорий', 'gamestore'),
	);

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true, // Древовидная структура (категории)
		'public'                     => true,
		'show_ui'                    => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'          		 => true,
		'show_in_rest'               => true,
		'show_admin_column'          => true,
		'rewrite'                    => array('slug' => 'news-category'),
	);

	register_taxonomy('news_category', array('news'), $args);
}
add_action('init', 'gamestore_register_news_category_taxonomy', 0);
