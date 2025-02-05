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
		'name'                  => _x('Новости', 'Post Type General Name', 'text_domain'),
		'singular_name'         => _x('Новость', 'Post Type Singular Name', 'text_domain'),
		'menu_name'             => __('Новости', 'text_domain'),
		'name_admin_bar'        => __('Новость', 'text_domain'),
		'archives'              => __('Архив новостей', 'text_domain'),
		'attributes'            => __('Атрибуты новости', 'text_domain'),
		'all_items'             => __('Все новости', 'text_domain'),
		'add_new_item'          => __('Добавить новость', 'text_domain'),
		'add_new'               => __('Добавить новую', 'text_domain'),
		'edit_item'             => __('Редактировать новость', 'text_domain'),
		'view_item'             => __('Просмотр новости', 'text_domain'),
		'search_items'          => __('Поиск новостей', 'text_domain'),
		'not_found'             => __('Новости не найдены', 'text_domain'),
		'not_found_in_trash'    => __('В корзине новости не найдены', 'text_domain'),
		'featured_image'        => __('Изображение новости', 'text_domain'),
		'set_featured_image'    => __('Установить изображение', 'text_domain'),
	);

	$args = array(
		'label'                 => __('Новости', 'text_domain'),
		'description'           => __('Новости компании или сайта', 'text_domain'),
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
		'name'                       => _x('Категории новостей', 'Taxonomy General Name', 'text_domain'),
		'singular_name'              => _x('Категория новостей', 'Taxonomy Singular Name', 'text_domain'),
		'menu_name'                  => __('Категории', 'text_domain'),
		'all_items'                  => __('Все категории', 'text_domain'),
		'parent_item'                => __('Родительская категория', 'text_domain'),
		'add_new_item'               => __('Добавить новую категорию', 'text_domain'),
		'edit_item'                  => __('Редактировать категорию', 'text_domain'),
		'update_item'                => __('Обновить категорию', 'text_domain'),
		'search_items'               => __('Поиск категорий', 'text_domain'),
	);

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true, // Древовидная структура (категории)
		'public'                     => true,
		'show_ui'                    => true,
		'show_in_rest'               => true,
		'show_admin_column'          => true,
		'rewrite'                    => array('slug' => 'news-category'),
	);

	register_taxonomy('news_category', array('news'), $args);
}
add_action('init', 'gamestore_register_news_category_taxonomy', 0);