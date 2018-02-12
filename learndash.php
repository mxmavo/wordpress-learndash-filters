<?php

/**
 * Learndash overriding Course Grid template
 *
 */
add_filter( 'learndash_template', 'yourfunction_learndash_course_grid_course_list', 99, 5 );
function yourfunction_learndash_course_grid_course_list( $filepath, $name, $args, $echo, $return_file_path ) {

	if ( 'course_list_template' === $name ) {
		return get_template_directory() . '/yourname_course_list_template.php';
	}
	return $filepath;
}


/**
 *  Learndash custom previous link
 *
 */
add_filter('learndash_previous_post_link', function( $link ) {

	add_filter( 'learndash_previous_post_link', function( $link, $permalink, $link_name, $post ) {
		return '<a href="'. $permalink .'" class="prev-link" rel="prev">< ' . _x( 'Previous', 'lesson navigation', ’yourdomain’ ) . '</a>';
	}, 10, 4);

}, 5, 1);



/**
 * After quiz is completed override resultText field value with json animation
 */

add_filter( 'comment_text', function( $resultText ) {

	$json_anim = esc_url( get_post_meta( get_the_ID(), 'json_animation', 1 ) );

	if ( ! empty( $json_anim ) ) {
		$resultTextfinal[] = '<div class="results-animated" data-path="' . $json_anim .'"></div>';

		$resultTextfinal[]= $resultText;

		$resultText = join( '',$resultTextfinal );
	}

	return $resultText;

}, 5, 1);
