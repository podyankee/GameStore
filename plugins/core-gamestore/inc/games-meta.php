<?php

add_filter('woocommerce_product_data_tabs', 'add_gamestore_tab');

function add_gamestore_tab($tabs)
{
	$tabs['gamestore'] = array(
		'label' => 'Gamestore',
		'target' => 'gamestore_product_data',
		'class' => array('show_if_simple', 'show_if_variable'),
		'priority' => 21,
	);
	return $tabs;
}

add_action('woocommerce_product_data_panels', 'add_gamestore_tab_content');

function add_gamestore_tab_content()
{
	global $post;
	echo ' <div id="gamestore_product_data" class="panel woocommerce_options_panel">';
	echo '<div class="options_group">';

	//Simple Text Field

	woocommerce_wp_text_input(
		array(
			'id' => '_gamestore_publisher',
			'label' => __('Publisher', 'core-gamestore'),
			'description' => __('Enter the publisher of the game', 'core-gamestore'),
			'desc_tip' => true,
			'placeholder' => 'e.g. Ubisoft',
		)
	);

	//Multicheckbox field

	echo '<p class="form-field"> <label><strong>' . __('Select Platforms', 'core_gamestore') . '</strong></label>';
	$platforms = array('Xbox', 'PC', 'Playstation');
	foreach ($platforms as $platform) {
		woocommerce_wp_checkbox(
			array(
				'id' => '_platform_' . strtolower($platform),
				'label' => $platform,
				'description' => sprintf(__('Available on %s', 'core-gamestore'), $platform),
			)
		);
	}
	echo '</p>';

	echo '</div>';
	echo '</div>';
}

add_action('woocommerce_process_product_meta', 'save_gamestore_tab_fields');

function save_gamestore_tab_fields($post_id)
{
	if (isset($_POST['_gamestore_publisher'])) {
		update_post_meta($post_id, '_gamestore_publisher', sanitize_text_field($_POST['_gamestore_publisher']));
		$platforms = array('Xbox', 'PC', 'Playstation');
		foreach ($platforms as $platform) {
			$checkbox_value = isset($_POST['_platform_' . strtolower($platform)]) ? 'yes' : 'no';
			update_post_meta($post_id, '_platform_' . strtolower($platform), $checkbox_value);
		}
	}
}
