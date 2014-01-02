<?php
/**
 * @package debian-sidebar
 * @version 0.1
 */
/*
Plugin Name: Debian Sidebar
Plugin URI: http://wordpress.org/plugins/debian-sidebar
Description: Add Debian media buttons to the right side of your website with style and ease.
Author: Željko Popivoda
Version: 0.1
License: GPLv2
Author URI: http://popivoda.com
*/
/*  Copyright 2012  Željko Popivoda  http://popivoda.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
/* This is edited version of Social sidebar, Thomas Davis
*/

add_action('admin_menu', 'debiansidebar');
if(!is_admin()){
	add_action('wp_print_scripts', 'include_debiansidebar');
	add_action('wp_footer', 'embed_debiansidebar');
} else {
add_action('wp_print_scripts', 'load_custom_scripts');
}
function load_custom_scripts() {
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'jflow' );
	wp_enqueue_script( 'jquery-ui-core' );
    wp_enqueue_script( 'jquery-ui-tabs' );
}
function include_debiansidebar(){
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script('debian-sidebar', '/wp-content/plugins/debian-sidebar/js/debian-sidebar.js');
}
function embed_debiansidebar(){
	if( get_option("social_offset")){
		$socialoffset = get_option("social_offset");
	} else {
		$socialoffset = 100;
	}
echo "

<script type=\"text/javascript\">
   (function ($) {
        $('body').debianSidebar({
            'top': '$socialoffset"."px',
            'debian-org': {";
				if( get_option("debian-org_image") ){
					echo "'image': '". get_option("debian-org_image"). "',";
				}
               echo "'link': '". get_option("debian-org_link"). "'
            },
            'why-debian': {";
				if(  get_option("why-debian_image") ){
					echo "'image': '". get_option("why-debian_image"). "',";
				}
               echo "'link': '". get_option("why-debian_link"). "'
            },
	    'download-debian': {";
				if(  get_option("download-debian_image") ){
					echo "'image': '". get_option("download-debian_image"). "',";
				}
               echo "'link': '". get_option("download-debian_link"). "'
            },
        });
   })(jQuery);
</script>";
}
function debiansidebar() {
  add_options_page('Debian Sidebar', 'Debian Sidebar', 'manage_options', 'debiansidebar', 'debiansidebar_options');
}
function debiansidebar_options() {
  if (!current_user_can('manage_options'))  {
    wp_die( __('You do not have sufficient permissions to access this page.') );
  }
  echo '<div class="wrap">';
    echo '<h2>Debian Sidebar</h2>';
?>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/flick/jquery-ui.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
jQuery(document).ready(function($){
	$("#tabs").tabs();
	$(".optionsform").click( function(){
		$("#optionsform").submit();
		event.preventDefault();
	})
});
</script>
  <?php
  
  echo '<form id="optionsform" method="post" action="options.php">';
  ?>
  <div class="wrap">
  <div id="tabs" style="width: 750px;">
    <ul>
        <li><a href="#info">Info</a></li>
        <li><a href="#tabs-1">Debian Media Buttons</a></li>
        <li><a href="#tabs-2">Options</a></li>
        <li style="margin-left: 1px; float: right;"><a href="" class="optionsform"  style="cursor: pointer;">Save</a></li>
    </ul>
	<div id="info">
	  If you would like a button to appear at the very least you need enter your Debian network links from the menu above.
	<br />
	<br />
	<br />
	<b>Debian sidebar Documentation</b>
	<ul>
	<li><a href="http://zeljko.popivoda.com/debian-sidebar-wordpress-plugin" target="_blank">Debian sidebar - Zeljko Popivoda blog</a></li>
	<li><a href="http://wordpress.org/extend/plugins/debian-sidebar" target="_blank">Debian sidebar - Wordpress plugins</a></li>
	</ul>
	<br />
	<br />
	<b>Documentation of Social sidebar</b>
	<ul>
	<li><a href="http://wordpress.org/extend/plugins/social-sidebar" target="_blank">Social sidebar - Wordpress plugin homepage</a></li>
	<li><a href="http://github.com/thomasdavis/Wordpress-Social-Sidebar" target="_blank">Social sidebar - GitHub Repository</a></li>
	</ul>
</div>
    <div id="tabs-1">
	<?php
	  echo '<table class="form-table">';
echo '<tr valign="top">
<th scope="row" style="width: 300px !important;">Debian <strong>Link</strong>:</th>
<td><input style="width: 400px;" type="text" name="debian-org_link" value="' . get_option('debian-org_link') .'" /></td>
</tr>';  
echo '<tr valign="top">
<th scope="row">Debian Image (optional):</th>
<td><input style="width: 400px;" type="text" name="debian-org_image" value="' . get_option('debian-org_image') .'" /></td>
</tr>'; 
echo '<tr valign="top">
<th scope="row">Why use Debian <strong>Link</strong>:</th>
<td><input style="width: 400px;" type="text" name="why-debian_link" value="' . get_option('why-debian_link') .'" /></td>
</tr>'; 
echo '<tr valign="top">
<th scope="row">Why use Debian Image (optional):</th>
<td><input style="width: 400px;" type="text" name="why-debian_image" value="' . get_option('why-debian_image') .'" /></td>
</tr>'; 
echo '<tr valign="top">
<th scope="row">Download Debian <strong>Link</strong>:</th>
<td><input style="width: 400px;" type="text" name="download-debian_link" value="' . get_option('download-debian_link') .'" /></td>
</tr>'; 
echo '<tr valign="top">
<th scope="row">Download Debian Image (optional):</th>
<td><input style="width: 400px;" type="text" name="download-debian_image" value="' . get_option('download-debian_image') .'" /></td>
</tr>'; 
echo '</table>';
?>
</div>
	<div id="tabs-2">
<?php
  echo '<table class="form-table">';
echo '<tr valign="top">
<th scope="row" style="width: 300px !important;">Pixels from the top (default: 100px):</th>
<td><input style="width: 200px;" type="text" name="social_offset" value="' . get_option('social_offset') .'" /> px</td>
</tr>';   
echo '</table>';
?>
</div>
</div>
  <?php wp_nonce_field('update-options'); ?>
  <?php
  
echo '<input type="hidden" name="action" value="update" />';
echo '<input type="hidden" name="page_options" value="debian-org_link,debian-org_image,why-debian_link,why-debian_image,download-debian_link,download-debian_image,social_offset,publica" />';
  echo '</div>';
echo '
</form>
</div>';
}
?>
