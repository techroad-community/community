<?php
/* Adv 250x250 */
add_action( 'widgets_init', 'widget_adv250x250_widget' );
function widget_adv250x250_widget() {
	register_widget( 'Widget_Adv250x250' );
}
class Widget_Adv250x250 extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'adv250x250-widget' );
		$control_ops = array( 'id_base' => 'adv250x250-widget' );
		parent::__construct( 'adv250x250-widget',discy_theme_name.' - Adv 250x250', $widget_ops, $control_ops );
	}
	
	public function widget( $args, $instance ) {
		extract( $args );
		$title    = apply_filters('widget_title', $instance['title'] );
		$adv_type = esc_attr($instance['adv_type']);
		$adv_href = esc_url($instance['adv_href']);
		$adv_img  = esc_attr(discy_image_url_id($instance['adv_img']));
		$adv_code = $instance['adv_code'];
		echo ($before_widget);
			if ($title) {
				echo ($title == "empty"?"<div class='empty-title'>":"").($before_title.($title == "empty"?"":esc_attr($title)).$after_title).($title == "empty"?"</div>":"");
			}else {
				echo "<h3 class='screen-reader-text'>".esc_html__("Adv 250x250","discy")."</h3>";
			}?>
			<div class="discy-ad-wrap">
				<div class="discy-ad">
					<?php if ($adv_type == "custom_image") {
						if ($adv_href != "") {?><a href="<?php echo esc_url($adv_href)?>"><?php }?>
							<img alt="<?php esc_attr_e("Adv","discy")?>" src="<?php echo ($adv_img)?>">
						<?php if ($adv_href != "") {?></a><?php }?>
					<?php }else {
						echo ($adv_code);
					}?>
				</div><!-- End discy-ad -->
				<div class="clearfix"></div>
			</div>
		<?php echo ($after_widget);
	}

	public function form( $instance ) {
		/* Save Button */
	}
}?>