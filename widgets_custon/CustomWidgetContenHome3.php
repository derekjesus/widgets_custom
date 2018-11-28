<?php

/**
 * Duplicate this file as many times as you would like, just be sure to change the
 * HomeConten1 class name to a custom name of your choice. Have fun! redrokk.com
 * 
 * Plugin Name: HomeConten3
 * Description: Contenido para el home bloque tipo 3
 * Author: Derek Salazar
 * Version: 1.0.0
 * Author URI: http://kepnix.com
 */

class HomeContenBlock3 extends WP_Widget {

	// constructor
	function HomeContenBlock3() {
	        parent::WP_Widget(false, $name = __('Home Conten block 3', 'wp_widget_plugin') );
    
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
 
'tag' => $title,
'orderby' => $textarea,
'order'    => 'ASC'
);

$latest_books = get_posts( $args );


 
$count_0 = 0;
if ( $latest_books ) {
	
	
	
?> 	<?php
	
    foreach ( $latest_books as $post ) :
        setup_postdata( $post ); 

		?>

<?php if ( $count_0 ==0 ) { ?>	
 <div class="row backgroundv2 ">
<?php } else  { ?>
	
	<div class="col-xs-12 col-sm-4 col-lg-3 cont0a">
			<div class="grid_hover">
				<figure class="effect-selena">
				<?php 
			$thumbnail_attr = array(  'class' => 'img-fluid full_100w ');
			$attachment = get_the_post_thumbnail($post->ID, "large", $thumbnail_attr); 
			echo  $attachment; 
				?> 
					<figcaption>
					<h2 class="hover0t hover1t site-title"><?php echo get_the_title($post->ID);  ?></h2>
					<div class="hover0c  cont2">
						 
							<a class="btn btn-default cuad_cont_headr_home" href="<?php the_permalink($post->ID); ?>">
							 
							 
							</a>
						 
					</div>	
					</figcaption>			
				</figure>
			</div>
	</div>	


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
add_action('widgets_init', create_function('', 'return register_widget("HomeContenBlock3");')); 
?>