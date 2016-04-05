<?php
/**
 * The file is for creating the portfolio post type meta. 
 * Meta output is defined on the portfolio single editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 *  
 * @package WordPress
 * @subpackage Charmed
 * @author ThemeBeans
 */
 
add_action('add_meta_boxes', 'bean_metabox_post');
function bean_metabox_post(){

$prefix = '_bean_';




/*===================================================================*/
/*  PORTFOLIO FORMAT SETTINGS							   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'portfolio-type',
	'title' =>  __('Portfolio Format', 'charmed'),
	'description' => __('', 'charmed'),
	'page' => 'post',
	'context' => 'side',
	'priority' => 'core',
	'fields'   => array(
		array(  
			'name' => __('Gallery','charmed'),
			'desc' => __('','charmed'),
			'id' => $prefix.'portfolio_type_gallery',
			'type' => 'checkbox',
			'std' => true 
			),
		array(  
			'name' => __('Video','charmed'),
			'desc' => __('','charmed'),
			'id' => $prefix.'portfolio_type_video',
			'type' => 'checkbox',
			'std' => false 
			),							
	)
);
bean_add_meta_box( $meta_box );





/*===================================================================*/
/*  PORTFOLIO META SETTINGS							   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'portfolio-meta',
	'title' =>  __('Portfolio Settings', 'charmed'),
	'description' => __('', 'charmed'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array( 
			'name' => __('Gallery Images:','charmed'),
			'desc' => __('Upload, reorder and caption the post gallery.','charmed'),
			'id' => $prefix .'portfolio_upload_images',
			'type' => 'images',
			'std' => __('Browse & Upload', 'charmed')
			),
		array(
			'name'     => __('Date:', 'charmed'),
			'id' => $prefix.'portfolio_date',
			'type' => 'checkbox',
			'desc' => __('Display the date.', 'charmed'),
			'std' => false 
			),
		array(
			'name' => __('Views:', 'charmed'),
			'id' => $prefix.'portfolio_views',
			'type' => 'checkbox',
			'desc' => __('Display the view count.', 'charmed'),
			'std' => false 
			),
		array(
			'name' => __('Categories:', 'charmed'),
			'id' => $prefix.'portfolio_cats',
			'type' => 'checkbox',
			'desc' => __('Display the portfolio categories.', 'charmed'),
			'std' => false 
			),
		array(
			'name' => __('Tags:', 'charmed'),
			'id' => $prefix.'portfolio_tags',
			'type' => 'checkbox',
			'desc' => __('Display the portfolio tags.', 'charmed'),
			'std' => false 
			),
		array(  
			'name' => __('Role:','charmed'),
			'desc' => __('Display the role.','charmed'),
			'id' => $prefix.'portfolio_role',
			'type' => 'text',
			'std' => ''
			),
		array(  
			'name' => __('Client:','charmed'),
			'desc' => __('Display the client meta.','charmed'),
			'id' => $prefix.'portfolio_client',
			'type' => 'text',
			'std' => ''
			),	
		array(  
			'name' => __('URL:','charmed'),
			'desc' => __('Display a URL to link to.','charmed'),
			'id' => $prefix.'portfolio_url',
			'type' => 'text',
			'std' => ''
			),	
		array(  
			'name' => __('External URL:','charmed'),
			'desc' => __('Link this portfolio post to an external URL. For example, link this post to your Behance portfolio post.','charmed'),
			'id' => $prefix.'portfolio_external_url',
			'type' => 'text',
			'std' => ''
			),				
	)
);
bean_add_meta_box( $meta_box );
 
 
 
 
/*===================================================================*/
/*  VIDEO POST FORMAT SETTINGS						   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'bean-meta-box-portfolio-video',
	'title' => __('Video Settings', 'charmed'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',	
	'fields' => array(
		array(
			'name' => __('Embed 1:', 'charmed'),
			'desc' => __('Insert your embeded code here.', 'charmed'),
			'id' => $prefix . 'portfolio_embed_code',
			'type' => 'textarea',
			'std' => ''
			),
		array(
			'name' => __('Embed 2:', 'charmed'),
			'desc' => __('Insert your embeded code here.', 'charmed'),
			'id' => $prefix . 'portfolio_embed_code_2',
			'type' => 'textarea',
			'std' => ''
			),
		array(
			'name' => __('Embed 3:', 'charmed'),
			'desc' => __('Insert your embeded code here.', 'charmed'),
			'id' => $prefix . 'portfolio_embed_code_3',
			'type' => 'textarea',
			'std' => ''
			),
		array(
			'name' => __('Embed 4:', 'charmed'),
			'desc' => __('Insert your embeded code here.', 'charmed'),
			'id' => $prefix . 'portfolio_embed_code_4',
			'type' => 'textarea',
			'std' => ''
			),
		array(
			'name' => __('Video Shortcodes:', 'charmed'),
			'desc' => __('Insert any <a target="blank" href="https://codex.wordpress.org/Video_Shortcode">video shortcodes</a> here.', 'charmed'),
			'id' => $prefix . 'portfolio_video_shortcodes',
			'type' => 'textarea',
			'std' => ''
			),		
	),
	
);
bean_add_meta_box( $meta_box );
} // END function bean_metabox_post()