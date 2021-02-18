<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package fastvideo
 */
    
/**
 * Display the first (single) category of post.
 */
if ( ! function_exists( 'fastvideo_first_category' ) ) :
function fastvideo_first_category() {
    $category = get_the_category();
    if ($category) {
      echo '<a href="' . get_category_link( $category[0]->term_id ) . '" title="' . sprintf( __( "View all posts in %s", 'fastvideo' ), $category[0]->name ) . '" ' . '>' . $category[0]->name.'</a> ';
    }    
}
endif;

/**
 * Get Post Views.
 */
if ( ! function_exists( 'fastvideo_get_post_views' ) ) :

function fastvideo_get_post_views($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return '<span class="view-count">0</span> View';
    }
    return '<span class="view-count">' . number_format($count) . '</span> ' . __('Views', 'fastvideo');
}

endif;

/**
 * Set Post Views.
 */
if ( ! function_exists( 'fastvideo_set_post_views' ) ) :

function fastvideo_set_post_views($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

endif;

/**
 * Home Widgets Title Link
 */
if ( ! function_exists( 'fastvideo_home_widget_title_link' ) ) :

function fastvideo_home_widget_title_link( $instance ) {

	if ( $instance['cat'] ) {

		// Get the category archive link.
		$title_link = get_category_link( $instance['cat'] );

	} elseif ( get_option( 'page_for_posts' ) ) {

		// 'page_for_posts' link
		$title_link = get_permalink( get_option( 'page_for_posts' ) );

	} else {

		// just throw to home
		$title_link = home_url( '/' );

	}

	return $title_link;

}

endif;

/**
 * Search Filter 
 */
if ( ! function_exists( 'fastvideo_search_filter' ) ) :

function fastvideo_search_filter($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}

add_filter('pre_get_posts','fastvideo_search_filter');

endif;

/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
if ( ! function_exists( 'fastvideo_custom_excerpt_length' ) ) :

function fastvideo_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'fastvideo_custom_excerpt_length', 999 );

endif;

/**
 * Add custom meta box.
 */
if ( ! function_exists( 'fastvideo_add_custom_meta_box' ) ) :

function fastvideo_add_custom_meta_box()
{
    add_meta_box("demo-meta-box", "Post Options", "fastvideo_custom_meta_box_markup", "post", "side", "high", null);
}

add_action("add_meta_boxes", "fastvideo_add_custom_meta_box");

endif;
/**
 * Displaying fields in a custom meta box.
 */
if ( ! function_exists( 'fastvideo_custom_meta_box_markup' ) ) :

function fastvideo_custom_meta_box_markup($object)
{
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

    ?>
        <div>

            <p>
            <label for="is_featured"><?php echo __('Featured this post on homepage', 'fastvideo'); ?> </label>
            <?php
                $checkbox_value1 = get_post_meta($object->ID, "is_featured", true);

                if($checkbox_value1 == "")
                {
                    ?>
                        <input name="is_featured" type="checkbox" value="true">
                    <?php
                }
                else if($checkbox_value1 == "true")
                {
                    ?>  
                        <input name="is_featured" type="checkbox" value="true" checked>
                    <?php
                }
            ?>
            </p>

        </div>
    <?php  
}

endif;

/**
 * Storing Meta Data.
 */
if ( ! function_exists( 'fastvideo_save_custom_meta_box' ) ) :

function fastvideo_save_custom_meta_box($post_id, $post, $update) {
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = "post";
    if($slug != $post->post_type)
        return $post_id;

    $meta_box_text_value = "";
    $meta_box_textarea_value = "";
    $meta_box_checkbox_value1 = "";
    $meta_box_checkbox_value2 = "";


    //if(isset($_POST["video_length"]))
    //{
    //    $meta_box_text_value = $_POST["video_length"];
    //}   
    //update_post_meta($post_id, "video_length", $meta_box_text_value);

    if(isset($_POST["is_featured"]))
    {
        $meta_box_checkbox_value1 = $_POST["is_featured"];
    }   
    update_post_meta($post_id, "is_featured", $meta_box_checkbox_value1);

    if(isset($_POST["is_portrait_thumb"]))
    {
        $meta_box_checkbox_value2 = $_POST["is_portrait_thumb"];
    }   
    update_post_meta($post_id, "is_portrait_thumb", $meta_box_checkbox_value2);    
}

add_action("save_post", "fastvideo_save_custom_meta_box", 10, 3);

endif;

/**
 * Enqueues scripts and styles.
 */
if ( ! function_exists( 'fastvideo_disable_specified_widgets' ) ) :

function fastvideo_disable_specified_widgets( $sidebars_widgets ) {

    if ( isset($sidebars_widgets['homepage']) ) {
        if ( is_home() && is_array($sidebars_widgets['homepage']) ) {
            foreach($sidebars_widgets['homepage'] as $i => $widget) {
                if( (strpos($widget, 'happythemes-') === false) ) {
                    unset($sidebars_widgets['homepage'][$i]);
                }
            }

        }
    }

    if ( isset($sidebars_widgets['footer-1']) ) {
        if ( is_array($sidebars_widgets['footer-1']) ) {
            foreach($sidebars_widgets['footer-1'] as $i => $widget) {
                if(strpos($widget, 'happythemes-home-') !== false) {
                    unset($sidebars_widgets['footer-1'][$i]);
                }
            }
        } 
    }

    if ( isset($sidebars_widgets['footer-2']) ) {
        if ( is_array($sidebars_widgets['footer-2']) ) {
            foreach($sidebars_widgets['footer-2'] as $i => $widget) {
                if(strpos($widget, 'happythemes-home-') !== false) {
                    unset($sidebars_widgets['footer-2'][$i]);
                }
            }

        }   
    }

    if ( isset($sidebars_widgets['footer-3']) ) {

        if ( is_array($sidebars_widgets['footer-3']) ) {
            foreach($sidebars_widgets['footer-3'] as $i => $widget) {
                if(strpos($widget, 'happythemes-home-') !== false) {
                    unset($sidebars_widgets['footer-3'][$i]);
                }
            }

        }   
    }

    if ( isset($sidebars_widgets['footer-4']) ) {
        if ( is_array($sidebars_widgets['footer-4']) ) {
            foreach($sidebars_widgets['footer-4'] as $i => $widget) {
                if(strpos($widget, 'happythemes-home-') !== false) {
                    unset($sidebars_widgets['footer-4'][$i]);
                }
            }

        }   
    }

    if ( isset($sidebars_widgets['sidebar-1']) ) {
        if ( is_array($sidebars_widgets['sidebar-1']) ) {
            foreach($sidebars_widgets['sidebar-1'] as $i => $widget) {
                if(strpos($widget, 'happythemes-home-') !== false) {
                    unset($sidebars_widgets['sidebar-1'][$i]);
                }
            }
        }                    
    }

    return $sidebars_widgets;
}
add_filter( 'sidebars_widgets', 'fastvideo_disable_specified_widgets' );

endif;

/** 
 * Create a new page on theme activation.
 */
if (isset($_GET['activated']) && is_admin()){
    add_action('init', 'fastvideo_create_initial_pages');
}
function fastvideo_create_initial_pages() {

    $pages = array( 
         // Page Title and URL (a blank space will end up becomeing a dash "-")
        'All Categories' => array(
            // Page Content           // Template to use (if left blank the default template will be used)
            'Browse our latest videos by category' => 'page-templates/all-categories.php'),

        'Latest' => array(
            'Browse our latest videos' => 'page-templates/all-posts.php'),

    );

    foreach($pages as $page_url_title => $page_meta) {

        $id = get_page_by_title($page_url_title);

        foreach ($page_meta as $page_content=>$page_template){

            $page = array(
                'post_type'   => 'page',
                'post_title'  => $page_url_title,
                'post_name'   => $page_url_title,
                'post_status' => 'publish',
                'post_content' => $page_content,
                'post_author' => 1,
                'post_parent' => ''
            );

            if(!isset($id->ID)){
                $new_page_id = wp_insert_post($page);
                if(!empty($page_template)){
                    update_post_meta($new_page_id, '_wp_page_template', $page_template);
                }
            }
        }
    }
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
if ( ! function_exists( 'fastvideo_categorized_blog' ) ) :

function fastvideo_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'fastvideo_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,
            // We only need to know if there is more than one category.
            'number'     => 2,
        ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'fastvideo_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so fastvideo_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so fastvideo_categorized_blog should return false.
        return false;
    }
}

endif;

/**
 * Flush out the transients used in fastvideo_categorized_blog.
 */
if ( ! function_exists( 'fastvideo_category_transient_flusher' ) ) :

function fastvideo_category_transient_flusher() {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient( 'fastvideo_categories' );
}
add_action( 'edit_category', 'fastvideo_category_transient_flusher' );
add_action( 'save_post',     'fastvideo_category_transient_flusher' );

endif;

/**
 * Detect if post content has video embed.
 */
if ( ! function_exists( 'fastvideo_has_embed' ) ) :

function fastvideo_has_embed( $post_id = false ) {
    if( !$post_id )
        $post_id = get_the_ID();
    else
        $post_id = absint( $post_id );
    if( !$post_id )
        return false;
 
    $post_meta = get_post_custom_keys( $post_id );
 
    foreach( $post_meta as $meta ) {
        if( '_oembed' != substr( trim( $meta ) , 0 , 7 ) )
            continue;
        return true;
    }
    return false;
}

endif;

/**
 * Output the embed class.
 */
if ( ! function_exists( 'fastvideo_embed_class' ) ) :

function fastvideo_embed_class() {

    global $has_embed;

    $content = get_the_content();

    preg_match  ('/<iframe(.+)\"/', $content, $matches);
    if (!empty($matches)) {
        $has_embed = true;
    }

    preg_match  ('/<object(.+)\"/', $content, $matches);
    if (!empty($matches)) {
        $has_embed = true;
    }

    preg_match  ('/<video(.+)\"/', $content, $matches);
    if (!empty($matches)) {
        $has_embed = true;
    }

    preg_match  ('/<embed(.+)\"/', $content, $matches);
    if (!empty($matches)) {
        $has_embed = true;
    }

    if( $has_embed == true || fastvideo_has_embed() == true ) { echo "has-embed"; } else { echo "no-embed clear"; };

}

endif;

/**
 * Add link to Admin Bar.
 */

if ( ! function_exists( 'fastvideo_custom_toolbar_link' ) ) :

function fastvideo_custom_toolbar_link($wp_admin_bar) {
    $args = array(
        'id' => 'happythemes',
        'title' => 'Upgrade to PRO version &rarr;', 
        'href' => 'https://www.freshthemes.com/themes/fastvideo', 
        'meta' => array(
            'class' => 'happythemes', 
            'title' => '',
            'target'=> '_blank',
            )
    );
    $wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'fastvideo_custom_toolbar_link', 999);

endif;