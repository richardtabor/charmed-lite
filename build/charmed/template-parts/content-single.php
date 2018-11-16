<?php
/**
 * Template part for displaying single posts.
 *
 * @package Charmed
 */

//Log the view counts.
charmed_setPostViews(get_the_ID());

//Load the gallery media element, located in inc/template-tags.php
charmed_gallery($post->ID, 'port-full', 'portfolio-single' , '' , true);