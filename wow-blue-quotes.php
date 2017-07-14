<?php
/*
Plugin Name: WoW Blue Quotes
Plugin URI: 
Description: Add a blue quote to your post or comments like battle.net forums, using [bluequote][/bluequote].
Version: 1.1
Date: Sep 26, 2011
Author: jGarp
Author URI: 
*/ 

function getBlueQuotes($text) {
    
    $text_start = '<div class="wowbq-bluequote">';
	$text_end = '</div><div class="wowbq-clear"></div>';
	
	/* Remplace tags*/
	$text = str_replace('<bluequote>', '[bluequote]<p>', $text);
	$text = str_replace('</bluequote>', '</p>[/bluequote]', $text);
	
	/* Fix divs inside paragraphs issues */
	$text = str_replace('<p>[bluequote]', '[bluequote]<p>', $text);
	$text = str_replace('[/bluequote]</p>', '</p>[/bluequote]', $text);

	/* Create blue quote */
	$text = str_replace('[bluequote]', $text_start, $text);
	$text = str_replace('[/bluequote]', $text_end, $text);

    return $text;
}

/* Add Filter to content and comments. */
add_filter('the_content', 'getBlueQuotes');
add_filter('comment_text', 'getBlueQuotes');

/* load style */
wp_enqueue_style('wow-blue-quotes-custom-css', plugins_url('style.css', __FILE__));

/* load jquery.corner script */
wp_enqueue_script('wow-blue-quotes-jquery.corner', plugins_url('/js/jquery.corner.js', __FILE__), array('jquery') );

/* load custom script */
wp_enqueue_script('wow-blue-quotes-custom-js', plugins_url('/js/custom.js', __FILE__), array('jquery', 'wow-blue-quotes-jquery.corner') );
?>