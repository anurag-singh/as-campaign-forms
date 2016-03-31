<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       www.anuragsingh.me
 * @since      1.0.0
 *
 * @package    As_Campaign_Forms
 * @subpackage As_Campaign_Forms/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    As_Campaign_Forms
 * @subpackage As_Campaign_Forms/public
 * @author     Anurag Singh <anuragsinghce@gmail.com>
 */
class As_Campaign_Forms_Public {

	var $hasError;

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in As_Campaign_Forms_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The As_Campaign_Forms_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/as-campaign-forms-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in As_Campaign_Forms_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The As_Campaign_Forms_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/as-campaign-forms-public.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( $this->plugin_name.'_jquery_validate', plugin_dir_url(__FILE__) . 'js/jquery.validate.min.js', array('jquery'), $this->version, true);

        wp_enqueue_script( $this->plugin_name.'_validation_rules', plugin_dir_url(__FILE__) . 'js/validation-rules.js', array('jquery'), $this->version, true);

        wp_enqueue_script( $this->plugin_name.'_jquery_lightbox', plugin_dir_url(__FILE__) . 'js/jquery.fancybox.js', array('jquery'), $this->version, true);
        //wp_enqueue_script($this->as_campaign, plugin_dir_url(__FILE__) .'as-campaign/public/js/as-campaign.js'));

	}

	/**
	 * Registers all shortcodes at once
	 *
	 * @return [type] [description]
	 */
	public function register_shortcodes() {
		//$this->loader->add_shortcode('display_campaign_form', $plugin_public, 'handleSignupForm');
		add_shortcode( 'display_campaign_form', array( $this, 'handleSignupForm' ) );
		//add_shortcode( 'nowhiring-howtoapply', array( $this, 'how_to_apply' ) );
	} // register_shortcodes()


	/**
     * Override wordpress default template
     *
     * @since    1.0.0
     */
    function override_templates_for_campaign_pages( $template ){
        // Check if its a plugin created page
        if ( is_page('campaign-mutual-funds') ) {
            $template = plugin_dir_path( __FILE__ ) .'/partials/page-campaign-mutual-fund.php';
        }

        if( is_page('campaign-tax-saving-mutual-funds')) {
            $template = plugin_dir_path(__FILE__) . '/partials/page-campaign-save-tax.php';
        }
        if( is_page('campaign-free-demat')) {
            $template = plugin_dir_path(__FILE__) . '/partials/page-campaign-free-demat.php';
        }

        if( is_page('campaign-thank-you')) {
        	$template = plugin_dir_path(__FILE__) . '/partials/page-campaign-thank-you.php';
        }
        return $template;
    }




	function handleSignupForm() {

        //if(('page-campaign.php')) {
        if ( is_page_template( 'page-templates/page-campaign-free-demat.php' )  ) {
            if($this->isFormSubmitted() && $this->isNonceSet()) {
                if($this->isFormValid()) {
                    $this->createPost();
                    $this->displayfreedematForm();
                } else {
                    $this->displayfreedematForm();
                }
            } else {
                $this->displayfreedematForm();
            }
        }

        elseif ( is_page('campaign-mutual-funds')  ) {
            if($this->isFormSubmitted() && $this->isNonceSet()) {
                if($this->isFormValid()) {
                	//$this->redirect_to_thank_you();
                    $this->createPost();
                    $this->displaymutualfundForm();
                } else {
                    $this->displaymutualfundForm();
                }
            } else {
                $this->displaymutualfundForm();
            }
        }

        elseif ( is_page_template( 'page-templates/page-campaign-save-tax.php' ) ) {
            if($this->isFormSubmitted() && $this->isNonceSet()) {
                if($this->isFormValid()) {
                    $this->createPost();
                    $this->displayTaxSavingForm();
                } else {
                    $this->displayTaxSavingForm();
                }
            } else {
                $this->displayTaxSavingForm();
            }
        }

        // Load when no condition is true
        else {
            if($this->isFormSubmitted() && $this->isNonceSet()) {
                if($this->isFormValid()) {
                    $this->createPost();
                    $this->displayDefaultForm();
                } else {
                    $this->displayDefaultForm();
                }
            } else {
                $this->displayDefaultForm();
            }
        }
    }

    function isFormSubmitted() {
        if( isset( $_POST['submitForm'] ) ) return true;
        else return false;
    }

    function isNonceSet() {
        if( isset( $_POST['nonce_field_for_front_end_new_post'] )  &&
            wp_verify_nonce( $_POST['nonce_field_for_front_end_new_post'], 'front_end_new_post' ) ) return true;
        else return false;
    }

    function isFormValid() {
        //Check all mandatory fields are present.
        if ( trim( $_POST['postTitle'] ) === '' ) {
            $error = 'Please enter a title.';
            $this->hasError = true;
        }
        else if ( trim( $_POST['signupMobile'] ) === '' ) {
            $error = 'Please enter the your mobile no.';
            $this->hasError = true;
        }
        // else if ( trim( $_POST['signupEmail'] ) === '' ) {
        //     $error = 'Please enter the your Email Id.';
        //     $hasError = true;
        // }
        //Check if any error was detected in validation.
        if($this->hasError == true) {
            echo '<div class="error">'.$error.'</div>';
        return false;
        }
        return true;
    }

    
function growtheme_mailchimp_signup() {
    // Submit the Form
    wp_redirect( home_url( ) ); exit;
}


    function createPost() {
        //Get the details from the form which was posted
        $postTitle = $_POST['postTitle'];
        $contentOfPost = $_POST['postContent'];
        $mobileNo = $_POST['signupMobile'];
        $emailId    =    $_POST['signupEmail'];
        $referralPage = $_POST['signupRefererral'];
        $signupRefererralUrl = $_POST['signupRefererralUrl'];
        $campaignId = $_POST['campaignId'];
        $postSatus = 'publish'; //  in case you want to manually approve all posts;


        //Create the post in WordPress
        $post_id = wp_insert_post( array(
            'post_type'            => 'signup',
            'post_title'        => $postTitle,
            'post_content'      => $contentOfPost,
            'post_status'       => $postSatus ,
            // 'post_author'       => $currentuserid
        ));
        update_post_meta($post_id,'as_signup_form_referral_page_url', $signupRefererralUrl, true);
        update_post_meta($post_id,'as_signup_form_referral_page', $referralPage, true);
        update_post_meta($post_id,'as_signup_form_mobile_no', $mobileNo, true);
        update_post_meta($post_id,'as_signup_form_email', $emailId, true);
        update_post_meta($post_id,'as_signup_form_campaign_id', $campaignId, true);

        //wp_redirect( home_url( "successfully-form-submission" ) ); exit;
        // wp_redirect( home_url() ); exit;
        //wp_redirect( get_permalink( $post->ID )); exit;


        // $setupEmail = New As_Email();
        // $setupEmail->send_email();

        // $setupSms = New As_SMS();
        //$setupSms->send_sms();

       // wp_redirect( home_url( "campaign-thank-you" ) ); exit;
        add_action ('wp_loaded', 'growtheme_mailchimp_signup');

    }

    // public function form_success() {

        // if (createPost()) {
        //     alert ("hi");
        // }
        // else {
        //     alert("bye");
        // }
    // }




    //This function displays the HTML form.
    public function displayfreedematForm() {     ?>
        <form class="sinup-frm" action="" id="formpost" method="POST" enctype="multipart/form-data">
            <div class="int-fld">
                <label for="postTitle">Name</label>
                <input type="text" class="inpts" name="postTitle" id="postTitle" placeholder="Name*">
            </div>
            <div class="int-fld">
                <label for="signupMobile">Mobile</label>
                <input type="text" class="inpts" name="signupMobile" id="signupMobile" placeholder="Mobile No.*">
            </div>
            <div class="int-fld">
                <label for="signupEmail">Email</label>
                <input type="text" class="inpts" name="signupEmail" id="signupEmail" placeholder="Email">
            </div>
            <div class="int-fld">
                <label for="postContent">City</label>
                <input type="text" class="inpts" name="postContent" id="postContent" placeholder="City">
            </div>
            <div class="int-fld">
                <label>&nbsp;</label>
                <input type="submit" name="submitForm" id="submitForm" value="Submit" class="sbmt-btn" onClick="ga('send', 'event', { eventCategory: 'form', eventAction: 'submitted', eventLabel: 'demat'});">
            </div>
            <?php
                 // Get the current page URL
                global $wp;
                $current_url = home_url(add_query_arg(array(),$wp->request));
            ?>
            <input type="hidden" name="signupRefererralUrl" id="signupRefererralUrl" value="<?php echo $current_url; ?>">
            <input type="hidden" name="signupRefererral" id="signupRefererral" value="<?php echo get_the_title(); ?>">
            <input type="hidden" name="campaignId" id="campaignId" value="3778">
            <?php wp_nonce_field( 'front_end_new_post' , 'nonce_field_for_front_end_new_post'); ?>
        </form>
    <?php
    }

    public function displaymutualfundForm() {     ?>
        <form class="sinup-frm" action="" id="formpost" method="POST" enctype="multipart/form-data">
            <div class="int-fld">
                <label for="postTitle">Name</label>
                <input type="text" class="inpts" name="postTitle" id="postTitle" placeholder="Name*">
            </div>
            <div class="int-fld">
                <label for="signupMobile">Mobile</label>
                <input type="text" class="inpts" name="signupMobile" id="signupMobile" placeholder="Mobile No.*">
            </div>
            <div class="int-fld">
                <label for="signupEmail">Email</label>
                <input type="text" class="inpts" name="signupEmail" id="signupEmail" placeholder="Email">
            </div>
            <div class="int-fld">
                <label for="postContent">City</label>
                <input type="text" class="inpts" name="postContent" id="postContent" placeholder="City">
            </div>
            <div class="int-fld">
                <label>&nbsp;</label>
                <input type="submit" name="submitForm" id="submitForm" value="Submit" class="sbmt-btn" onClick="ga('send', 'event', { eventCategory: 'form', eventAction: 'submitted', eventLabel: 'mutualfunds'});">
            </div>
            <?php
                 // Get the current page URL
                global $wp;
                $current_url = home_url(add_query_arg(array(),$wp->request));
            ?>
            <input type="hidden" name="signupRefererralUrl" id="signupRefererralUrl" value="<?php echo $current_url; ?>">
            <input type="hidden" name="signupRefererral" id="signupRefererral" value="<?php echo get_the_title(); ?>">
            <input type="hidden" name="campaignId" id="campaignId" value="3779">
            <?php wp_nonce_field( 'front_end_new_post' , 'nonce_field_for_front_end_new_post'); ?>
        </form>
    <?php
    }

    public function displayTaxSavingForm() {     ?>
        <form class="sinup-frm" action="" id="formpost" method="POST" enctype="multipart/form-data">
            <div class="int-fld">
                <label for="postTitle">Name</label>
                <input type="text" class="inpts" name="postTitle" id="postTitle" placeholder="Name*">
            </div>
            <div class="int-fld">
                <label for="signupMobile">Mobile</label>
                <input type="text" class="inpts" name="signupMobile" id="signupMobile" placeholder="Mobile No.*">
            </div>
            <div class="int-fld">
                <label for="signupEmail">Email</label>
                <input type="text" class="inpts" name="signupEmail" id="signupEmail" placeholder="Email">
            </div>
            <!-- <div class="int-fld">
                <label for="postContent">City</label>
                <input type="text" class="inpts" name="postContent" id="postContent" placeholder="City">
            </div> -->
            <div class="int-fld">
                <label>&nbsp;</label>
                <input type="submit" name="submitForm" id="submitForm" value="Submit" class="sbmt-btn" onClick="ga('send', 'event', { eventCategory: 'form', eventAction: 'submitted', eventLabel: 'mutualfunds'});">
            </div>
            <?php
                 // Get the current page URL
                global $wp;
                $current_url = home_url(add_query_arg(array(),$wp->request));
            ?>
            <input type="hidden" name="signupRefererralUrl" id="signupRefererralUrl" value="<?php echo $current_url; ?>">
            <input type="hidden" name="signupRefererral" id="signupRefererral" value="<?php echo get_the_title(); ?>">
            <input type="hidden" name="campaignId" id="campaignId" value="13880">
            <?php wp_nonce_field( 'front_end_new_post' , 'nonce_field_for_front_end_new_post'); ?>
        </form>
    <?php
    }

    public function displayDefaultForm() {     ?>
        <form class="sinup-frm" action="" id="formpost" method="POST" enctype="multipart/form-data">
            <div class="input-bx">
                <label class="rm-font-icn" for="postTitle">&#xe020;</label>
                <input type="text" name="postTitle" id="postTitle" placeholder="Name*">
            </div>
            <div class="input-bx">
                <label class="rm-font-icn" for="signupMobile"></label>
                <input type="text" name="signupMobile" id="signupMobile" placeholder="Mobile No.*">
            </div>

            <div class="input-bx">
                <label class="rm-font-icn" for="signupEmail">&#xe017;</label>
                <input type="text" name="signupEmail" id="signupEmail" placeholder="Email">
            </div>
            <div class="input-bx">
                <label class="rm-font-icn" for="postContent">&#xe03b;</label>
                <input type="text" name="postContent" id="postContent" placeholder="Tell us more">
            </div>
            <div class="input-bx">
                <input type="submit" name="submitForm" id="submitForm" value="Submit" class="btn">
            </div>
            <?php
                 // Get the current page URL
                global $wp;
                $current_url = home_url(add_query_arg(array(),$wp->request));
            ?>
            <input type="hidden" name="signupRefererralUrl" id="signupRefererralUrl" value="<?php echo $current_url; ?>">
            <input type="hidden" name="signupRefererral" id="signupRefererral" value="<?php echo get_the_title(); ?>">
            <input type="hidden" name="campaignId" id="campaignId" value="1932">
            <?php wp_nonce_field( 'front_end_new_post' , 'nonce_field_for_front_end_new_post'); ?>
        </form>

    <?php
	}
}
