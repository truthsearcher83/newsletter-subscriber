<?php

/**
 * Adds Foo_Widget widget.
 */
class Newsletter_Subscriber extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'newsletter_subscriber_widget', // Base ID
			esc_html__( 'Newsletter Subscriber', 'newsletter-subscriber' ), // Name
			array( 'description' => esc_html__( 'Newsletter Subscriber', 'newsletter-subscriber' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
                echo $args['before_title'];
                if(!empty($instance['title'])){
                    echo $instance['title'];
                }
                echo $args['after_title'];
		?> 
                    <div id="form-msg"></div>
                    <form id="subscriber-form" method="POST" action ="<?php echo plugins_url().'/newsletter-subscriber/includes/newsletter-subscriber-mailer.php';?>">
                        <div class="form-group">
                                <label for="name">Name: </label><br>
                                <input type="text" id="name" name="name" class="form-control" ><br/>
                        </div>
                        <div class="form-group">
                                <label for="email">Email: </label><br>
                                <input type="text" id="email" name="email" class="form-control" >
                        </div>
				<br>
				<input type="hidden" name="recipient" value="<?php echo $instance['recipient']; ?>">
				<input type="hidden" name="subject" value="<?php echo $instance['subject']; ?>">
				<input type="submit" class="btn btn-primary" name="subscriber_submit" value="Subscribe">
				<br><br>   
                    </form>
                <?php
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Newsletter Subscriber', 'newsletter-subscriber' );
		$subject = !empty($instance['subject']) ? $instance['subject'] : __('You have a new subscriber', 'newsletter-subscriber');
                $receipent = $instance['receipent'];
                ?>
		<p>
                    <label for = "<?php echo $this->get_field_id('title');?>"><?php  _e('Title' , 'newsletter-subscriber');?></label><br/>
                    <input type="text" id ="<?php echo $this->get_field_id('title');?>" name ="<?php echo $this->get_field_name('title');?>" value ="<?php echo esc_attr($title) ;?>">
		</p>
                <p>
                    <label for = "<?php echo $this->get_field_id('subject');?>"><?php  _e('Subject' , 'newsletter-subscriber');?></label><br/>
                    <input type="text" id ="<?php echo $this->get_field_id('subject');?>" name ="<?php echo $this->get_field_name('subject');?>" value ="<?php echo esc_attr($subject) ;?>">
		</p>
                <p>
                    <label for = "<?php echo $this->get_field_id('receipent');?>"><?php  _e('Receipent' , 'newsletter-subscriber');?></label><br/>
                    <input type="text" id ="<?php echo $this->get_field_id('receipent');?>" name ="<?php echo $this->get_field_name('receipent');?>" value ="<?php echo esc_attr($receipent) ;?>">
		</p>
                
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array(
                    "title"=>(!empty($new_instance['title']))? strip_tags($new_instance['title']) : '',
                    "subject"=>(!empty($new_instance['subject']))? strip_tags($new_instance['subject']) : '',
                    "receipent"=>(!empty($new_instance['receipent']))? strip_tags($new_instance['receipent']) : ''
                );
                return $instance ;
	}

} // class Foo_Widget