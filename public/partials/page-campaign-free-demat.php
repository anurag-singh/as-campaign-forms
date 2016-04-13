<?php /*
    Template Name:  Free Demat Campaign Page

*/ ?>
    <?php get_header('campaign-compact'); ?>
        <div class="signup-sectn">
            <div class="wper">
                <div class="bnr-img"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/campaign/free-acount.png" align="left" width="100%" class="accut-bnr" />
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
                <p class="bnr-cntnt hlfs">Get an Online Trading account at Zero Cost
                    <br><strong>Save Rs 200/-</strong></p>
                <p class="bnr-cntnt hlfs">No Annual Maintenance Cost on Demat Account for lifetime
                    <br> <strong>Save Rs 300/- per year</strong></p>
            </div>
        </div>

    <?php get_footer('campaign'); ?>
