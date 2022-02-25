<?php
/*
Plugin Name: Random Post by Acortech
Plugin URI: https://www.acortech.it/products/wordpress/acortech-random-post
Description: Acortech Random Post allows you to get a redirect 307 url to a random post.
Author: Acor3
Version: 1.0.0
Author URI: https://www.acortech.it
Author License: GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*/

// based on article "WPBeginner >> Blog >> Tutorials How to Redirect Users to a Random Post in WordPress"
// http://www.wpbeginner.com/wp-tutorials/how-to-redirect-users-to-a-random-post-in-wordpress/


add_action('init','rpba_random_add_rewrite');
function rpba_random_add_rewrite() {
       global $wp;
       $wp->add_query_var('random');
       add_rewrite_rule('random/?$', 'index.php?random=1', 'top');
}

add_action('template_redirect','rpba_random_template');
function rpba_random_template() {
       if (get_query_var('random') == 1) {
               $posts = get_posts('post_type=post&orderby=rand&numberposts=1');
               $link = get_permalink($posts[0]);
               wp_redirect($link,307);
               exit;
       }
}
?>