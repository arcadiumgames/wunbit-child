<?php 

add_action( 'wp_enqueue_scripts', 'salient_child_enqueue_styles');
function salient_child_enqueue_styles() {
	
		$nectar_theme_version = nectar_get_theme_version();
		
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array('font-awesome'), $nectar_theme_version);

    if ( is_rtl() ) 
   		wp_enqueue_style(  'salient-rtl',  get_template_directory_uri(). '/rtl.css', array(), '1', 'screen' );
}

// Remove Breadcrumpbs BBPress
function mycustom_breadcrumb_options() {
	// Home - default = true
	$args['include_home']    = false;
	// Forum root - default = true
	$args['include_root']    = true;
	// Current - default = true
	$args['include_current'] = true;

	return $args;
}

add_filter('bbp_before_get_breadcrumb_parse_args', 'mycustom_breadcrumb_options' );

//this function removes the "this topic contains..." and "this forum contains..."  text
function no_description ($retstr) {
	$retstr="" ;
	return $retstr ;
	}
	
add_filter ('bbp_get_single_topic_description', 'no_description' ) ;
add_filter ('bbp_get_single_forum_description', 'no_description' ) ;

//This function changes the text wherever it is quoted
function change_translate_text( $translated_text ) {
	if ( $translated_text == 'Your account has the ability to post unrestricted HTML content.' ) {
	$translated_text = '';
	}
	if ( $translated_text == 'Oh bother! No topics were found here!' ) {
	$translated_text = '';
	}
	return $translated_text;
}
add_filter( 'gettext', 'change_translate_text', 20 );

?>