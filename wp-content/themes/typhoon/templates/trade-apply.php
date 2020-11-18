<?php /* Template Name: Trade apply */ get_header(); ?>

  	<div class="content">

        <?php if ( is_user_logged_in() ) { ?>
            <section class='loginWrap rel' style="background-image:url('<?php echo get_field('login_bg'); ?>');">
        <?php } else { ?>
            <section class='loginWrap rel tradePad'>
            <div class='fixedBg tradeWrap' style="background-image:url('<?php echo get_field('login_bg'); ?>');"></div>
        <?php } ?>
            <!-- <div class='overlay'></div> -->
            <div class="grid-container pad60">
                <div class="grid-x align-middle">
                    <div class='small-12 medium-12 large-12 cell tradeBox'>

                        <div class='innerBox whiteBg'>
                            <h1 class='center h2 title marB25'>Apply for a Trade account</h1>
                            <p class='center'>Fill out the application form below and we will get in touch with you.</p>


                            <?php if ( ! defined( 'ABSPATH' ) ) { exit; } do_action( 'woocommerce_before_customer_login_form' ); ?>
                            <?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
                            <?php endif; ?>


                            <?php if ( is_user_logged_in() ) { ?>

                                <p class='marT40 center'>You are already logged in.</p>

                                <div class='buttons'>
                                    <a class='orangeB buttonMar marT40' href="<?php echo get_home_url(); ?>/">Return Home</a>
                                    <a class='orangeB marL20 marT40' href="<?php echo wp_logout_url( home_url()); ?>">Logout</a>
                                </div>

                            <?php } else { ?>
                                <?php echo do_shortcode('[contact-form-7 id="947" title="Trade account"]'); ?>
                            <?php } ?>

                        </div>
                        <?php do_action( 'woocommerce_after_customer_login_form' ); ?>
                    </div>
                </div>
            </div>
        </section>

  	</div>

<?php get_footer(); ?>
