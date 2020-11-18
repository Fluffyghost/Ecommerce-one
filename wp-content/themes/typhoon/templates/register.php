<?php /* Template Name: Register */ get_header(); ?>

  	<div class="content">

        <section class='loginWrap rel' style="background-image:url('<?php echo get_field('login_bg'); ?>');">
            <div class="grid-container">
                <div class="grid-x align-middle">

                    <div class='small-12 medium-12 large-12 cell loginBox'>

                      <div class='innerBox whiteBg'>

                          <h1 class='center h2 title marB25'>Create account</h1>

                          <?php if ( is_user_logged_in() ) { ?>

                              <p class='center marT40'>You are already registered.</p>

                              <div class='buttons'>
                                  <a class='orangeB buttonMar marT40' href="<?php echo get_home_url(); ?>/my-account">My account</a>
                                  <a class='orangeB marL20 marT40' href="<?php echo wp_logout_url( home_url()); ?>">Logout</a>
                              </div>

                           <?php } else { ?>



                              <?php if ( ! defined( 'ABSPATH' ) ) { exit; } do_action( 'woocommerce_before_customer_login_form' ); ?>

                              <form method="post" id='registerform' class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >


                                  <?php do_action( 'woocommerce_register_form_start' ); ?>
                                  <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
                                      <label class='dtext marB10 block'>Username<span class='star'>*</span></label>
                                      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                          <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                                      </p>
                                  <?php endif; ?>
                                      <label class='dtext marB10 block'>Email<span class='star'>*</span></label>
                                      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                          <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                                      </p>
                                  <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
                                      <label class='dtext marB10 block'>Password<span class='star'>*</span></label>
                                      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                          <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" placeholder="Password" id="reg_password" autocomplete="new-password" />
                                      </p>
                                  <?php else : ?>
                                      <p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>
                                  <?php endif; ?>
                                  <?php do_action( 'woocommerce_register_form' ); ?>
                                  <p>By creating an account, you agree to Typhoon’s <a class='underline' href='<?php echo get_site_url(); ?>/privacy-policy'>Privacy Policy</a> and <a class='underline' href='<?php echo get_site_url(); ?>/terms-conditions'>Terms of Use</a>.</p>
                                  <p class="woocommerce-FormRow form-row">
                                      <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                                      <button type="submit" class="greyB marT40 marB30 alCen woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
                                  </p>
                                  <?php do_action( 'woocommerce_register_form_end' ); ?>
                                  <p class='dtext center'>Already have an account? <a class='blue' href="<?php echo get_site_url(); ?>/login"><u>Login here</u></a></p>
                                  <p class='center dtext'>Trade customer? <a class='underline' href="<?php echo get_site_url(); ?>/apply-for-a-trade-account">Apply here</a></p>
                              </form>

                          <?php } ?>

                        </div>
                    </div>

                </div>
            </div>
        </section>

  	</div>

<?php get_footer(); ?>
