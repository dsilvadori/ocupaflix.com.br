<?php
/**
 * Defines customizer options
 *
 * @package Customizer Library Demo
 */

function customizer_library_demo_options() {

	// Theme defaults
	$primary_color = '#00adef';
	$secondary_color = '#666';

	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Stores all the panels to be added
	$panels = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// More Examples
	$section = 'examples';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Theme Settings', 'fastvideo' ),
		'priority' => '10'
	);

	$options['logo'] = array(
		'id' => 'logo',
		'label'   => __( 'Logo', 'fastvideo' ),
		'section' => $section,
		'type'    => 'image',
		'default' => get_template_directory_uri().'/assets/img/logo.png'
	);

	$options['favicon'] = array(
		'id' => 'favicon',
		'label'   => __( 'Favicon', 'fastvideo' ),
		'section' => $section,
		'type'    => 'image',
		'default' => ''
	);	
	
	$layout_choices = array(
		'choice-1' => 'Responsive Layout',
		'choice-2' => 'Fixed Layout'
	);

	$date_format_choices = array(
		'choice-1' => 'xx days ago',
		'choice-2' => 'WordPress Settings'
	);	

	$options['site-layout'] = array(
		'id' => 'site-layout',
		'label'   => __( 'Site Layout', 'fastvideo' ),
		'section' => $section,
		'type'    => 'radio',
		'choices' => $layout_choices,
		'default' => 'choice-1'
	);

	$options['header-search-on'] = array(
		'id' => 'header-search-on',
		'label'   => __( 'Dispay header search', 'fastvideo' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
	);

	$options['featured-on'] = array(
		'id' => 'featured-on',
		'label'   => __( 'Display featured content on homepage', 'fastvideo' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
	);

	$options['all-posts-url'] = array(
		'id' => 'all-posts-url',
		'label'   => __( 'Page URL to display all recent posts', 'fastvideo' ),
		'section' => $section,
		'type'    => 'url',
		'default' => home_url() . '/latest',
	);	

	$options['home-button-on'] = array(
		'id' => 'home-button-on',
		'label'   => __( 'Display a button under home blocks', 'fastvideo' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
	);

	$options['home-button-text'] = array(
		'id' => 'home-button-text',
		'label'   => __( 'Button Text', 'fastvideo' ),
		'section' => $section,
		'type'    => 'text',
		'default' => 'Browse our latest videos',
	);	

	$options['home-button-url'] = array(
		'id' => 'home-button-url',
		'label'   => __( 'Button URL', 'fastvideo' ),
		'section' => $section,
		'type'    => 'url',
		'default' => home_url() . '/latest',
	);		

	$options['date-format'] = array(
		'id' => 'date-format',
		'label'   => __( 'Post date format', 'fastvideo' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $date_format_choices,
		'default' => 'choice-1'
	);		

	$options['footer-widgets-on'] = array(
		'id' => 'footer-widgets-on',
		'label'   => __( 'Display footer widgets', 'fastvideo' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
	);	

	//$options['example-range'] = array(
	//	'id' => 'example-range',
	//	'label'   => __( 'Example Range Input', 'fastvideo' ),
	//	'section' => $section,
	//	'type'    => 'range',
	//	'input_attrs' => array(
	//      'min'   => 0,
	//        'max'   => 10,
	//        'step'  => 1,
	//       'style' => 'color: #0a0',
	//	)
	//);

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Adds the panels to the $options array
	$options['panels'] = $panels;

	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );

	// To delete custom mods use: customizer_library_remove_theme_mods();

}
add_action( 'init', 'customizer_library_demo_options' );