<?php
/*
Plugin Name: Linkf.it URL Shortener Widget
Plugin URI: http://linkf.it
Description: Use the Linkf.it URL Shortener widget to allow your users to shorten your links so they can share them on sites such as Twitter, Facebook, etc..
Author: Derek Bourgeois
Version: 1.0.1
Author URI: http://ibourgeois.com/
*/
?>
<?php

class linkfit_url_shortener extends WP_Widget {
	
	public function __construct() {
		parent::__construct(
	 		'linkfit_url_shortener', // Base ID
			'Linkf.it Widget', // Name
			array( 'description' => __( 'A simple URL Shortener widget powered by Linkf.it', 'text_domain' ), ) // Args
		);
	}

 	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Linkf.it URL Shortener', 'text_domain' );
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		?>
		<?php
						
			/*$linkfit = file_get_contents("http://linkf.it/widget.php");
			echo ($linkfit);*/
		
		?>
		
		<iframe src="http://linkf.it/widget.php" height="180px"></iframe>
				
		
		<?php
		echo $after_widget;
	}

}

add_action( 'widgets_init', create_function( '', 'register_widget( "linkfit_url_shortener" );' ) );


?>