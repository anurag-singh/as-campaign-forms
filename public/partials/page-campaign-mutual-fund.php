<?php /*
	Template Name:  Mutual Fund Campaign Page

*/ ?>
    <?php get_header('campaign'); ?>
    	<div class="pg-slogn">
            <div class="wper">
                <h1>Invest In Mutual Funds Kyunki Khushiyon Ka Mahal Jaldbaazi Main Nahi Banta</h1>
            </div>
        </div>
        <div class="signup-sectn">
            <div class="wper">
                <div class="bnr-img"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/campaign/taj-image.png" align="left" width="100%" class="accut-bnr" />
                </div>
                <div class="singup-frm">
                    <div class="form-bx">
                        <div class="frm-title">To invest in prosperity
                            <br /><strong>Sign up now</strong>
                        </div>
                        <div class="sgn-frm">
                            <?php
							     echo do_shortcode( '[display_campaign_form]' );
							?>						
                        </div>
                    </div>
                </div>
                <p class="bnr-cntnt">By investing as low as <strong><span class="font-icn">&#xf156;</span> 10/ day</strong>, you can become a <strong>Crorepati</strong> in the next <strong>22 years!</strong></p>
            </div>			
        </div>

        <!-- <a href="javascript:void(0);" class="js-open-modal campaign-thanks" data-modal-id="mutual-funds">Click Me</a>
            <div id="mutual-funds" class="modal-box">
			  <header> <a href="javascript:void(0);" class="js-modal-close close">×</a>
			    <h3>Pop Up One</h3>
			  </header>
			  <div class="modal-body">
			    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut commodo at felis vitae facilisis. Cras volutpat fringilla nunc vitae hendrerit. Donec porta id augue quis sodales. Sed sit amet metus ornare, mattis sem at, dignissim arcu. Cras rhoncus ornare mollis. Ut tempor augue mi, sed luctus neque luctus non. Vestibulum mollis tristique blandit. Aenean condimentum in leo ac feugiat. Sed posuere, est at eleifend suscipit, erat ante pretium turpis, eget semper ex risus nec dolor. Etiam pellentesque nulla neque, ut ullamcorper purus facilisis at. Nam imperdiet arcu felis, eu placerat risus dapibus sit amet. Praesent at justo at lectus scelerisque mollis. Mauris molestie mattis tellus ut facilisis. Sed vel ligula ornare, posuere velit ornare, consectetur erat.</p>
			  </div>
			  <footer> <a href="javascript:void(0);" class="btn btn-small js-modal-close">Close</a> </footer>
			</div> -->

    <?php get_footer('campaign'); ?>



    
