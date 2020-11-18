<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>


<div id="product-<?php the_ID(); ?>" <?php wc_product_class( $product ); ?>>

	<div class='show-for-small-only'>
      <a class='backprod underline' onclick="javascript:window.history.go(-1)">Back to products</a>
	</div>

	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>

	<!-- data-sticky-container
	data-sticky data-margin-top="0" -->

	<div class="summary entry-summary">
	    <div class='sticky'>
					<?php
					/**
					 * Hook: woocommerce_single_product_summary.
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 * @hooked WC_Structured_Data::generate_product_data() - 60
					 */
					do_action( 'woocommerce_single_product_summary' );
					?>
					<div class='productInfoToggleSection'>
							<div class='prodTog'>
									<p class='largep dtext droptitle semi'>Product description <span class="material-icons desdown">keyboard_arrow_down</span><span class="material-icons desup">keyboard_arrow_up</span></p>
									<div class='prodesDrop'>
											<?php the_content(); ?>
									</div>
									<div class='shopLine'></div>
							</div>
					</div>
					<div class='productInfoToggleSection'>
							<div class='featTog'>
									<p class='largep dtext droptitle semi'>Features <span class="material-icons featdown">keyboard_arrow_down</span><span class="material-icons featup">keyboard_arrow_up</span></p>
									<div class='featDrop featTog'>
											<?php echo get_field('product_feature'); ?>
									</div>
									<div class='shopLine'></div>
							</div>
					</div>
					<div class='productInfoToggleSection'>
							<div class='shipTog'>
									<p class='largep dtext droptitle semi'>Shipping and returns <span class="material-icons shipdown">keyboard_arrow_down</span><span class="material-icons shipup">keyboard_arrow_up</span></p>
									<div class='shipDrop'>
											<?php
													if (get_field('shipping_product')) {
															echo get_field('shipping_product');
													} else {
															echo get_field('shipping_global','options');
													}
											?>
									</div>
									<div class='shopLine'></div>
							</div>
					</div>
					<div class='productInfoToggleSection'>
							<div class='downTog'>
									<p class='largep dtext droptitle semi'>Downloads <span class="material-icons dodown">keyboard_arrow_down</span><span class="material-icons doup">keyboard_arrow_up</span></p>
									<div class='downDrop'>
											<?php
													if (get_field('downloads_product')) {
															echo get_field('downloads_product');
													} else {
															echo get_field('downloads_global','options');
													}
											?>
									</div>
									<div class='shopLine'></div>
							</div>
					</div>
					<div class='productInfoToggleSection'>
							<div class='shareTog'>
									<p class='largep dtext droptitle semi'>Share <span class="material-icons sharedown">keyboard_arrow_down</span><span class="material-icons shareup">keyboard_arrow_up</span></p>
									<div class='shareDrop'>
											<a class='shareicon face' target='_blank' href="https://www.facebook.com/sharer/sharer.php?u=<?php echo the_permalink(); ?>"><i class="fab fa-facebook-f"></i></a>
											<a class='shareicon twit' target='_blank' href="https://twitter.com/intent/tweet?text=<?php echo the_permalink();  ?>"><i class="fab fa-twitter"></i></a>
											<a class='shareicon linked' target='_blank' href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo the_permalink(); ?>"><i class="fab fa-linkedin-in"></i></a>
									</div>
									<div class='shopLine'></div>
							</div>
					</div>
			</div>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>

	<!-- <div class="modal">
      <div class="modal-overlay modal-toggle"></div>
      <div class="modal-wrapper modal-transition">
          <div class='modal-body'>
              <div class='grid-container'>
                  <div class='grid-x align-middle smW'>
                      <div class='small-12 medium-12 large-12 cell textCol'>



													<div id="reviews" class="woocommerce-Reviews">

															</?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
																	<div id="review_form_wrapper">
																			<div id="review_form">
																					</?php
																					$commenter    = wp_get_current_commenter();
																					$comment_form = array(
																						/* translators: %s is product title */
																						'title_reply'         => have_comments() ? esc_html__( 'Write a review', 'woocommerce' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'woocommerce' ), get_the_title() ),
																						/* translators: %s is product title */
																						'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'woocommerce' ),
																						'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
																						'title_reply_after'   => '</span>',
																						'comment_notes_after' => '',
																						'label_submit'        => esc_html__( 'Submit review', 'woocommerce' ),
																						'logged_in_as'        => '',
																						'comment_field'       => '',
																					);

																					$name_email_required = (bool) get_option( 'require_name_email', 1 );
																					$fields              = array(
																						'author' => array(
																							'label'    => __( 'Name', 'woocommerce' ),
																							'type'     => 'text',
																							'value'    => $commenter['comment_author'],
																							'required' => $name_email_required,
																						),
																						'email'  => array(
																							'label'    => __( 'Email', 'woocommerce' ),
																							'type'     => 'email',
																							'value'    => $commenter['comment_author_email'],
																							'required' => $name_email_required,
																						),
																					);

																					$comment_form['fields'] = array();

																					foreach ( $fields as $key => $field ) {
																						$field_html  = '<p class="comment-form-' . esc_attr( $key ) . '">';
																						$field_html .= '<label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] );

																						if ( $field['required'] ) {
																							$field_html .= '&nbsp;<span class="required">*</span>';
																						}

																						$field_html .= '</label><input id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field['type'] ) . '" value="' . esc_attr( $field['value'] ) . '" size="30" ' . ( $field['required'] ? 'required' : '' ) . ' /></p>';

																						$comment_form['fields'][ $key ] = $field_html;
																					}

																					$account_page_url = wc_get_page_permalink( 'myaccount' );
																					if ( $account_page_url ) {
																						/* translators: %s opening and closing link tags respectively */
																						$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'woocommerce' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
																					}

																					if ( wc_review_ratings_enabled() ) {
																						$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your overall rating', 'woocommerce' ) . ( wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '' ) . '</label><select name="rating" id="rating" required>
																							<option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
																							<option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
																							<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
																							<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
																							<option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
																							<option value="1">' . esc_html__( 'Very poor', 'woocommerce' ) . '</option>
																						</select></div>';
																					}

																					$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Write your review', 'woocommerce' ) . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></p>';

																					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
																					?>
																		  </div>
																	</div>
															</?php else : ?>
																	<p class="woocommerce-verification-required"></?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>
															</?php endif; ?>

												  </div>

                      </div>
                  </div>
              </div>
              <button class="modal-close" type="button" data-open="reviewModal">
								  <span class="material-icons">close</span>
              </button>
          </div>
      </div>
  </div> -->


	<div class="reveal modal" id="reviewModal" data-reveal>
			<button class="closeB" type="button" data-close>
					<span class="material-icons">close</span>
			</button>
			<div id="reviews" class="woocommerce-Reviews">

					<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
							<div id="review_form_wrapper">
									<div id="review_form">
											<?php
											$commenter    = wp_get_current_commenter();
											$comment_form = array(
												/* translators: %s is product title */
												'title_reply'         => have_comments() ? esc_html__( 'Write a review', 'woocommerce' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'woocommerce' ), get_the_title() ),
												/* translators: %s is product title */
												'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'woocommerce' ),
												'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
												'title_reply_after'   => '</span>',
												'comment_notes_after' => '',
												'label_submit'        => esc_html__( 'Submit review', 'woocommerce' ),
												'logged_in_as'        => '',
												'comment_field'       => '',
											);

											$name_email_required = (bool) get_option( 'require_name_email', 1 );
											$fields              = array(
												'author' => array(
													'label'    => __( 'Name', 'woocommerce' ),
													'type'     => 'text',
													'value'    => $commenter['comment_author'],
													'required' => $name_email_required,
												),
												'email'  => array(
													'label'    => __( 'Email', 'woocommerce' ),
													'type'     => 'email',
													'value'    => $commenter['comment_author_email'],
													'required' => $name_email_required,
												),
											);

											$comment_form['fields'] = array();

											foreach ( $fields as $key => $field ) {
												$field_html  = '<p class="comment-form-' . esc_attr( $key ) . '">';
												$field_html .= '<label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] );

												if ( $field['required'] ) {
													$field_html .= '&nbsp;<span class="required">*</span>';
												}

												$field_html .= '</label><input id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field['type'] ) . '" value="' . esc_attr( $field['value'] ) . '" size="30" ' . ( $field['required'] ? 'required' : '' ) . ' /></p>';

												$comment_form['fields'][ $key ] = $field_html;
											}

											$account_page_url = wc_get_page_permalink( 'myaccount' );
											if ( $account_page_url ) {
												/* translators: %s opening and closing link tags respectively */
												$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'woocommerce' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
											}

											if ( wc_review_ratings_enabled() ) {
												$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your overall rating', 'woocommerce' ) . ( wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '' ) . '</label><select name="rating" id="rating" required>
													<option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
													<option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
													<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
													<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
													<option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
													<option value="1">' . esc_html__( 'Very poor', 'woocommerce' ) . '</option>
												</select></div>';
											}

											$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Write your review', 'woocommerce' ) . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></p>';

											comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
											?>
									</div>
							</div>
					<?php else : ?>
							<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>
					<?php endif; ?>
			</div>
	</div>


	<!-- <button class='mgreyB' data-toggle="off-canvas">Filter</button> -->
	<div class="off-canvas position-right reviewsoffcanvas" id="off-canvas" data-off-canvas>
		  <button class='closeReviews'><span class="material-icons">close</span></button>
		  <?php global $comment; ?>
	    <ul>
					<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
							<div id="comment-<?php comment_ID(); ?>" class="comment_container">

								<?php
								/**
								 * The woocommerce_review_before hook
								 *
								 * @hooked woocommerce_review_display_gravatar - 10
								 */
								do_action( 'woocommerce_review_before', $comment );
								?>

								<div class="comment-text">

									<?php
									/**
									 * The woocommerce_review_before_comment_meta hook.
									 *
									 * @hooked woocommerce_review_display_rating - 10
									 */
									do_action( 'woocommerce_review_before_comment_meta', $comment );

									/**
									 * The woocommerce_review_meta hook.
									 *
									 * @hooked woocommerce_review_display_meta - 10
									 */
									do_action( 'woocommerce_review_meta', $comment );
									do_action( 'woocommerce_review_before_comment_text', $comment );

									/**
									 * The woocommerce_review_comment_text hook
									 *
									 * @hooked woocommerce_review_display_comment_text - 10
									 */
									do_action( 'woocommerce_review_comment_text', $comment );
									do_action( 'woocommerce_review_after_comment_text', $comment );
									?>


								</div>
							</div>
				  </li>
		  </ul>
			<button class='whiteGHB modal-toggle marT30' data-open="reviewModal">Write a review</div>
	</div>

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
