<?php /* Template Name: Login */ get_header(); ?>

  	<div class="content">

        <section class='loginWrap rel' style="background-image:url('<?php echo get_field('login_bg'); ?>');">
            <div class='overlay'></div>
            <div class="grid-container">
                <div class="grid-x align-middle">
                    <div class='small-12 medium-12 large-12 cell loginBox'>

                        <div class='innerBox whiteBg'>
                            <h1 class='center h2 title marB25'>Sign in</h1>


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

                            		<form class="woocommerce-form woocommerce-form-login login" id='customlogin' method="post">

                              			<?php do_action( 'woocommerce_login_form_start' ); ?>
                                    <label class='dtext marB10 block'>Username:</label>
                              			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide marB30">
                                				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                              			</p>
                                    <label class='dtext marB10 block'>Password:</label>
                              			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                				<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
                              			</p>

                              			<?php do_action( 'woocommerce_login_form' ); ?>



                              			<a class='underline' href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><u><?php esc_html_e( 'Forgotten your password?', 'woocommerce' ); ?></u></a>


                                    <p class="form-row">
                                        <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                                        <button type="submit" class="greyB alCen marT40 marB30" name="login" value="<?php esc_attr_e( 'Sign in', 'woocommerce' ); ?>"><?php esc_html_e( 'Sign in', 'woocommerce' ); ?></button>
                                    </p>

                                    <p class='center dtext'>Don't have an account? <a class='underline' href="<?php echo get_site_url(); ?>/register">Create an account</a></p>
                                    <p class='center dtext'>Don't have a trade account? <a class='underline' href="<?php echo get_site_url(); ?>/apply-for-a-trade-account">Sign up</a></p>





                              			<?php do_action( 'woocommerce_login_form_end' ); ?>

                            		</form>

                            <?php } ?>

                        </div>
                        <?php do_action( 'woocommerce_after_customer_login_form' ); ?>
                    </div>
                </div>
            </div>
        </section>

  	</div>

<?php get_footer(); ?>
