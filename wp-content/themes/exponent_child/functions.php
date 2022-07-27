<?php
/**
* Child theme stylesheet einbinden in Abhängigkeit vom Original-Stylesheet
*/


function child_theme_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-theme-css', get_stylesheet_directory_uri() . '/style.css' , array('parent-style'));
	//wp_enqueue_style( 'child-print-css', get_stylesheet_directory_uri() . '/print.css');
	}
	add_action( 'wp_enqueue_scripts', 'child_theme_styles' );

?>

<?php
function exponent_child_styles() {
wp_deregister_style( 'parent-style');
wp_register_style('parent-style', get_template_directory_uri(). '/style.css');
wp_enqueue_style('parent-style', get_template_directory_uri(). '/style.css');
wp_enqueue_style( 'childtheme-style', get_stylesheet_directory_uri().'/style.css', array('parent-style') );
}
add_action( 'wp_enqueue_scripts', 'exponent_child_styles' );
?>

<!-- Funktion um die Daten des Schulungsformulars zu bearbeiten -->
<?php function process_schulungsformular() {
	if ( ! isset( $_POST['send_donation'] ) || ! isset( $_POST['check'] ) )  {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['check'], 'donation' ) ) {
		return;
	}

    /*
	$don = intval( $_POST['donate'] );
	$url = wp_get_referer();

	// Donation amount is too low.
	if ( $don < 0 ) {
		$url = add_query_arg( 'error1', 'less', wp_get_referer() );

	// Donation amount is too high.
	} elseif ( $don > 10000 ) {
		$url = add_query_arg( 'error1', 'much', wp_get_referer() );

	// Everything's OK, let's do the work...
	} else {
		$current_pool = intval( get_option( 'pool_value', 0 ) );
		update_option( 'pool_value', $current_pool + $don );
		$url = add_query_arg( 'success', 1, wp_get_referer() );
	}

    */
	// Redirect user back to the form, with an error or success marker in $_GET.
	wp_safe_redirect( $url );
	exit();
}
add_action( 'template_redirect', 'process_schulungsformular' );