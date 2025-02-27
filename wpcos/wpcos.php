<?php
/**
Plugin Name: WPCOS
Plugin URI: https://www.laobuluo.com/2186.html
Description: WordPress同步附件内容远程至腾讯云COS云存储中，实现网站数据与静态资源分离，提高网站加载速度。站长互助QQ群： <a href="https://jq.qq.com/?_wv=1027&k=5gBE7Pt" target="_blank"> <font color="red">594467847</font></a>
Version: 1.1
Author: 老部落（By:老赵）
Author URI: https://www.laobuluo.com
*/

require_once 'wpcos_actions.php';
register_activation_hook(__FILE__, 'wpcos_set_options');
register_deactivation_hook(__FILE__, 'wpcos_restore_options');
add_action('upgrader_process_complete', 'wpcos_upgrade_options');
if (substr_count($_SERVER['REQUEST_URI'], '/update.php') <= 0) {
	add_filter('wp_handle_upload', 'wpcos_upload_attachments');
	add_filter('wp_generate_attachment_metadata', 'wpcos_upload_and_thumbs');
}
add_filter( 'wp_update_attachment_metadata', 'wpcos_upload_and_thumbs' );
add_filter('wp_unique_filename', 'wpcos_unique_filename');
add_action('delete_attachment', 'wpcos_delete_remote_attachment');
add_action('admin_menu', 'wpcos_add_setting_page');
add_filter('plugin_action_links', 'wpcos_plugin_action_links', 10, 2);