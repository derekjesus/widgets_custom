<?php

/**
 * Duplicate this file as many times as you would like, just be sure to change the
 * HeaderContenPost class name to a custom name of your choice. Have fun! redrokk.com
 * 
 * Plugin Name: HeaderContenPost
 * Description: Contenido para el Header Conten Post
 * Author: Derek Salazar
 * Version: 1.0.0
 * Author URI: http://kepnix.com
 */
 

class HeaderContenPost extends WP_Widget {

	// constructor
	function HeaderContenPost() {
	        parent::WP_Widget(false, $name = __('Header Conten Post', 'wp_widget_plugin') );
    
	}

// widget form creation
function form($instance) {

// Check values
if( $instance) {
     $title = esc_attr($instance['title']);
     $textarea = $instance['textarea'];
} else {
     $title = '';
     $textarea = '';
}


?>  
  <p> 
<?php /* WWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWW Select de Etiquetas WWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWW  */ ?> 
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Selecciona una etiqueta:', 'wp_widget_plugin'); ?></label>
<select class="widefat"  id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>">
	<?php 
	$taxonomies= get_terms( array( 'taxonomy' => 'post_tag', 'hide_empty' => false, ) );
	foreach ( $taxonomies as $taxonomy => $tax ) {
			if ( $title== $tax->name ) {
					 
			?>	
				<option value="<?php echo $tax->name; ?>" selected>
				<?php echo $tax->name; ?>
				</option>
				<?php	
			}else{
			?>	
				<option value="<?php echo $tax->name; ?>">
				<?php echo $tax->name; ?>
				</option>
			<?php
			} 

		
		}
	 ?>
</select>
<?php /* WWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWW FIN Select de Etiquetas WWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWW  */ ?> 
 
 
 
 
 
<?php /* WWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWW Select de ordenar WWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWW  */ ?> 
<label for="<?php echo $this->get_field_id('textarea'); ?>"><?php _e('Seleccionar tipo de orden:', 'wp_widget_plugin'); ?></label>
<select class="widefat"  id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>">
	<?php 
	$taxonomies= array(  "rand",  "title",  "date" );
	foreach ( $taxonomies as $tax ) {
			if ( $textarea== $tax) {
					 
			?>	
				<option value="<?php echo $tax; ?>" selected>
				<?php echo $tax; ?>
				</option>
				<?php	
			}else{
			?>	
				<option value="<?php echo $tax; ?>">
				<?php echo $tax; ?>
				</option>
			<?php
			} 

		
		}
	 ?>
</select>
<?php /* WWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWW FIN Select de ordenar WWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWW  */ ?> 
 
 
</p>
<?php
}

	
function update($new_instance, $old_instance) {
      $instance = $old_instance;
      // Fields
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['textarea'] = strip_tags($new_instance['textarea']);
     return $instance;
}
	

   // display widget
function widget($args, $instance) {
	   extract( $args );
	   
	// these are the widget options
	$title = apply_filters('widget_title', $instance['title']);
	$textarea = $instance['textarea'];
	$args = array(
	'numberposts' => 4,
	'tag' => $title, 		
	'order'          => 'DESC',
	'orderby'        => $textarea
	);

	$latest_books = get_posts( $args );


	 
	$count_0 = 0;
	if ( $latest_books ) {
		
		
		
	?> 	<?php
		
	foreach ( $latest_books as $post ) :
	setup_postdata( $post ); 
			?>
	<?php if ( $count_0 ==0 ) { ?>	
 

<article class="hero-poster poster-article m-featured">
	  <div class="poster-figure"> 
		 <a href="<?php the_permalink($post->ID); ?>">

			<?php  /* wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww  */  ?>
			<?php if ( has_post_thumbnail() ) : ?>
			<?php
				$id = get_post_thumbnail_id();
				$alt = get_post_meta( $id, '_wp_attachment_image_alt', true);

				/* get the width of the largest cropped image to 
				   calculate the breakpoint */
				$hero_cropped_info = wp_get_attachment_image_src( $id, 'header_content_g_1920_733' );
				$breakpoint = absint( $hero_cropped_info[1] ) + 1;

				// pass the full image size to these functions
				$hero_full_srcset = wp_get_attachment_image_srcset( $id, 'full' );
				$hero_full_sizes = wp_get_attachment_image_sizes( $id, 'full' );

				// pass the cropped image size to these functions
				$hero_cropped_srcset = wp_get_attachment_image_srcset( $id, 'header_content_g_1920_733' );
				$hero_cropped_sizes = wp_get_attachment_image_sizes( $id, 'header_content_g_1920_733' );
			?>
			  <picture>
				<source media="(min-width: <?php echo $breakpoint; ?>px)" srcset="<?php echo esc_attr( $hero_full_srcset ); ?>" sizes="<?php echo esc_attr( $hero_full_sizes ); ?>" />
				<img srcset="<?php echo esc_attr( $hero_cropped_srcset ); ?>" alt="<?php echo esc_attr( $alt );?>" sizes="<?php echo esc_attr( $hero_cropped_sizes ); ?>" />
			  </picture>
			<?php endif; ?>
			<?php  /* wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww  */  ?>
		 </a>
	  </div>
	  <a href="<?php the_permalink($post->ID); ?>">
	  </a>
	  <header class="poster-content">
		 <a href="<?php the_permalink($post->ID); ?>">
		 </a>
		 <h2 class="poster-title">
			 <a href="<?php the_permalink($post->ID); ?>">
				<?php echo get_the_title($post->ID);  ?>
			 </a>
		 </h2>
		 <div class="poster-summary">
			<p><?php echo wp_trim_words( get_the_content(), 40, '...' ); ?></p>
		 </div>
	  </header>
</article>
 
	 <div class="section-hero-list">
	<?php } else  { ?>
		<article class="hero-poster poster-article">
		  <div class="poster-figure"> 
			 <a href="<?php the_permalink($post->ID); ?>">

				<?php  /* wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww  */  ?>
				<?php if ( has_post_thumbnail() ) : ?>
				<?php
					$id = get_post_thumbnail_id($post->ID);
					$alt = get_post_meta( $id, '_wp_attachment_image_alt', true);

					/* get the width of the largest cropped image to 
					   calculate the breakpoint */
					$hero_cropped_info = wp_get_attachment_image_src( $id, 'block_content_g_500_333' );
					$breakpoint = absint( $hero_cropped_info[1] ) + 1;

					// pass the full image size to these functions
					$hero_full_srcset = wp_get_attachment_image_srcset( $id, 'full' );
					$hero_full_sizes = wp_get_attachment_image_sizes( $id, 'full' );

					// pass the cropped image size to these functions
					$hero_cropped_srcset = wp_get_attachment_image_srcset( $id, 'block_content_g_500_333' );
					$hero_cropped_sizes = wp_get_attachment_image_sizes( $id, 'block_content_g_500_333' );
				?>
				  <picture>
					<source media="(min-width: <?php echo $breakpoint; ?>px)" srcset="<?php echo esc_attr( $hero_full_srcset ); ?>" sizes="<?php echo esc_attr( $hero_full_sizes ); ?>" />
					<img srcset="<?php echo esc_attr( $hero_cropped_srcset ); ?>" alt="<?php echo esc_attr( $alt );?>" sizes="<?php echo esc_attr( $hero_cropped_sizes ); ?>" />
				  </picture>
				<?php endif; ?>
				<?php  /* wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww  */  ?>
			 </a>
		  </div>
			 <a href="<?php the_permalink($post->ID); ?>">
			 </a>
			 <header class="poster-content">
			 <a href="<?php the_permalink($post->ID); ?>">
				</a>
				<h2 class="poster-title">
				<a href="<?php the_permalink($post->ID); ?>">
				</a>
				<a href="<?php the_permalink($post->ID); ?>">
				<?php echo get_the_title($post->ID);  ?></a>
				</h2>
			 </header>
		</article>	
	 	
		<?php 
		   if ($post === end($latest_books)) {
				echo "</div>";
			}
		 ?>	
	<?php } ?>	
		<?php
		$count_0 = $count_0+1;
		endforeach; 
	?><?php
		
		wp_reset_postdata();
	} ?>

<?php
	}
	
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("HeaderContenPost");')); 
?>