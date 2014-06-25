<?php
/**
 * Template Name: Video Single
 *
 */
get_header(); ?>
<h1><?php the_title(); ?></h1><?php
$values = get_post_custom( $post->ID );
$selected = isset( $values['film_embed'] ) ? $values['film_embed'][0] : '';?>
<section><?php 
	if (isset($selected)) {
		echo $selected;
	}
	the_content(); ?>
</section><?php

get_footer();