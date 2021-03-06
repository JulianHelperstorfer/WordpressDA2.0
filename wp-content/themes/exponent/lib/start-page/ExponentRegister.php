<?php
/**
 * This class will save the purchase code to the database
 *
 * @since 1.0
 *
 * @package Exponent
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
if( !class_exists( 'ExponentRegister' ) ) {
	class ExponentRegister {
		private static $option_group_slug = 'exponent_register';

		private static $option_name = 'exponent_register';

		private static $option_section = 'be_start';

		private static $token;

		private static $theme_found = false;

		protected $core;

		function __construct($core)
		{
			$this->core = $core;
		}

		public function run() {		
			add_action('admin_init',array($this,'settings_field'));
			add_action('wp_ajax_be_save_purchase_code',array($this, 'save_purchase_code'));
			add_action('wp_ajax_be_newsletter_subscribe',array($this, 'be_newsletter_subscribe'));
			add_action( 'wp_ajax_BS_set_memory', array($this, 'ajax_set_memory_limit'), 10, 1 );
		}

		public function settings_field() {
			register_setting(self::$option_group_slug, self::$option_name,
				array($this, 'check_token')
			);

			add_settings_field('token',
				esc_html__( 'Token', 'exponent' ),
				array($this, 'render_token_field'),
				self::$option_group_slug
			);

		}


		public static function options_group_name() {
			return self::$option_group_slug;
		}

		public static function set_token($val) {
			self::$token = $val;
		}

		public static function get_token() {
			return self::$token;
		}


		public static function save_purchase_code() {
			$res = false; $msg = '';
			if ( ! check_ajax_referer( 'be_save_purchase_code', 'security' ) || !isset( $_POST['token'] ) ) {
				$msg .= '<div class="notic notic-warning ">Invalid Nonce</div>';
			}else{	
				//newsletter Email
				$email = $_POST['email'];
				if(!empty($email)){
					if( !is_email( $email ) ) {
						$msg .= '<div class="notic notic-error ">Not a valid email</div>';
					}else{
					//$response = wp_remote_get( "https://www.brandexponents.com/subscribe/be-subscribe.php?email=$email&list_name=$list_name" );
		
					$response = wp_remote_get( "https://brandexponents.com/api.php?email=$email" );
		
					$body = wp_remote_retrieve_body( $response );
		
					$response_data = json_decode($body)->code;
		
					if($response_data == 'duplicate_parameter')
					{
						$msg .= '<div class="notic notic-warning ">Unable to Save Email or Email Already in use</div>';
					}else{
						if( update_option('exponent_newsletter_email', $email ) ) {
							$msg .= '<div class="notic notic-success ">Email Saved Successfully</div>';
						} else {
							//$msg .= '<div class="notic notic-warning ">Unable to Save Email or Email Already saved</div>';
						}
					}
					}
				}
				//Purchase code verify
				if( empty( $_POST['token'] ) ) {
					$msg .= '<div class="notic notic-warning ">Purchase code can not be empty</div>';
				}else{
					$exponent_purchase_data = get_option('exponent_purchase_data', false );
					if(empty($exponent_purchase_data) || !be_is_theme_valid()){
						$vars = exponent_pk_verify_vars(true);
						$vars = "https://brandexponents.com/wp-json/beepapi/v1/purchase-verifier?verify_pk=1&purchase_key=".$_POST['token']."&".$vars;
						
						$response = wp_remote_get($vars);
						$body = wp_remote_retrieve_body( $response );
						$response_data = json_decode($body);
					
						if(200 == wp_remote_retrieve_response_code($response)){
							$purchase_code_data = array(
								'theme_purchase_code' => $_POST['token']
							);
							update_option('exponent_purchase_data', $purchase_code_data );
							update_option('exponent-theme-invalid','');
							update_option('exponent-theme_message','');
							$res = true;
							$msg .= '<div class="notic notic-success ">Purchase code saved successfully</div>';
						}else{
							$theme_message = 'Invalid Purchase code';
							if(!empty($response_data)  && !empty($response_data->theme_message)){
								$theme_message = $response_data->theme_message;
							}
							$msg .= '<div class="notic notic-warning ">'.$theme_message.'</div>';
						}
					}else{
						$msg .= '<div class="notic notic-success ">Purchase code is already saved successfully</div>';
					}
				}	
		    }
			wp_send_json(array(
				'res'=> $res,
				'msg'=>$msg
			),200);
		}	

		public function be_newsletter_subscribe() {
			if ( ! check_ajax_referer( 'subscribe_checker', 'security' ) ) {
				echo '<div class="notic notic-warning ">Invalid Nonce</div>';
				wp_die();
			}
			$email = $_POST['email'];
			$list_name = $_POST['list_name'];
			if( empty( $email ) ) {
				echo '<div class="notic notic-error ">Email cannot be empty</div>';
				wp_die();
			}		
			if( !is_email( $email ) ) {
				echo '<div class="notic notic-error ">Not a valid email</div>';
				wp_die();
			}
			//$response = wp_remote_get( "https://www.brandexponents.com/subscribe/be-subscribe.php?email=$email&list_name=$list_name" );

			$response = wp_remote_get( "https://brandexponents.com/api.php?email=$email" );

			$body = wp_remote_retrieve_body( $response );

			$response_data = json_decode($body)->code;

			if($response_data == 'duplicate_parameter')
			{
				echo '<div class="notic notic-warning ">Unable to Save Email or Email Already in use</div>';
			}else{
				if( update_option('exponent_newsletter_email', $email ) ) {
					echo '<div class="notic notic-success ">Email Saved Successfully</div>';
				} else {
					echo '<div class="notic notic-warning ">Unable to Save Email</div>';
				}
			}
			wp_die();
		}

	}
}
?>