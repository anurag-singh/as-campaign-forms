<?php /*
    Template Name:  Save Tax Page

*/ ?>
<?php get_header('campaign-save-tax'); ?>

       
        <div class="alwns-msg">
            <div class="wper">
                <div class="alwns-bx">
                    <div class="alwns-msg-bx">
                        <h1>SIMPLEST WAY TO<br><strong>SAVE TAX</strong></h1>
                        <h3>Money Saved is Money Earned. Don’t let your<br>
							hard earned money go as taxes.</h3>
                    </div>
                    <h4>Save upto Rs 46,350 under section 80C of Income Tax Act
						Invest in the best Tax Saving (ELSS- Equity Linked Savings Schemes)
					Mutual Funds today</h4>
                </div>
            </div>
        </div>
        <div class="signup-sectn">
            <div class="wper">
                <div class="elss-Mf">
                    <?php 
                    if (have_posts()) : while (have_posts()) : the_post();
            			the_content();
            		endwhile;
            		endif;
                    ?>
                </div>
                <div class="singup-frm">
                    <div class="form-bx">
                        <div class="frm-title">To get expert advise on Tax Savings
                            <br /><strong>Sign up now</strong></div>
                        <div class="sgn-frm">
                            <?php
							     echo do_shortcode( '[display_campaign_form]' );
							?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

    <?php get_footer('campaign-save-tax'); ?>
