<?php get_header(); ?>

    <div class="content">

      <section class='sizeCharts'>
          <div class='grid-container full pad90W'>
               <div class='grid-x pad10'>
                    <div class='large-12 cell padT10'>
                        <?php if ( function_exists('yoast_breadcrumb') ) {
                            yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
                        } ?>
                    </div>
                </div>
           </div>
           <div class='grid-container'>
              <div class='grid-x padT80 midW'>
                  <div class='small-12 medium-12 large-12 cell'>
                      <h1 class='center dtext marB30'>Size Guide</h1>
                      <div class='center marB40'>
                          <?php echo get_field('size_intro','options'); ?>
                      </div>
                  </div>
              </div>
              <div class='grid-x lgW padB90'>
                  <div class='small-12 medium-12 large-12 cell'>
                      <div class='hidemed'>
                          <div class='chartCats'>

                            <?php
                                $taxonomy = 'sizechart_cat';
                                $terms = get_terms( $taxonomy, array(
                                   'orderby' => 'name',
                                   'order'   => 'ASC',
                                ));
                                if ( $terms && !is_wp_error( $terms ) ) :
                                $current_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            ?>
                                <ul class='sizehcartcats'>
                                    <?php foreach ( $terms as $term ) { ?>
                                        <?php $term_link = get_term_link($term); if($current_link == $term_link){ ?>
                                            <li class="active">
                                        <?php } else { ?>
                                            <li>
                                        <?php } ?>
                                            <a href="<?php echo $term_link; ?>"><?php echo $term->name; ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php endif;?>

                          </div>
                      </div>
                      <div class='showmed'>
                          <div class='catBox postdropdown'>
                              <select name="size_cat" onchange="location = this.value;">
                                 <option value="0">Categories</option>
                                 <?php
                                     $size_cat = get_terms( array(
                                         'taxonomy' => 'sizechart_cat',
                                         'hide_empty' => false,
                                         'orderby'   => 'name',
                                         // 'parent' => 20
                                     ) );
                                     $sector = isset($_GET['size_cat']) ? $_GET['size_cat'] : 0;
                                     foreach ($size_cat as $key => $value) {
                                  ?>
                                      <option value="<?php echo get_site_url();?>/sizechart-cats/<?php echo $value->slug; ?>" <?php selected($sector, $value->term_id); ?> ><?php echo $value->name; ?></option>
                                  <?php } ?>

                              </select>
                          </div>
                      </div>
                  </div>
              </div>

              <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                  <div class='grid-x lgW padB80'>
                      <div class='small-12 medium-12 large-12 cell'>

                        <?php if( have_rows('new_chart')): ?>
                            <?php while ( have_rows('new_chart')) : the_row(); ?>

                                <p class='h3 center dtext marB30' id="<?php echo get_sub_field('cat_name'); ?>"><?php the_title(); ?></p>
                                <?php if( get_sub_field('chart_img')) : ?>
                                    <img class='chartImg marB30' src="<?php echo get_sub_field('chart_img'); ?>" />
                                <?php endif; ?>
                                <p class='largep dtext center marB20'>Find your size</p>
                                <div class='buttons marB30'>
                                    <?php if ( get_sub_field('button_name_one')) { ?>
                                        <button class='cm lgreyB activeBorder'><?php echo get_sub_field('button_name_one'); ?></button>
                                        <button class='inch lgreyB'><?php echo get_sub_field('button_name_two'); ?></button>
                                    <?php } else { ?>
                                        <button class='cm lgreyB activeBorder'>cm</button>
                                        <button class='inch lgreyB'>Inches</button>
                                    <?php } ?>
                                </div>

                                <div class='tableWrap'>
                                    <table class='inchesTable marB90' border="0">
                                    <thead>
                                        <tr>
                                            <?php if( have_rows('inch_title')): $i = 1; ?>
                                                <?php while ( have_rows('inch_title')) : the_row(); ?>
                                                   <td class='tit_<?php echo $i; ?>'><?php echo get_sub_field('title'); ?></td>
                                                <?php $i++; endwhile; ?>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if( have_rows('inch_row')): $i = 1; ?>
                                           <?php while ( have_rows('inch_row')) : the_row(); ?>
                                                <tr>
                                                    <?php if( have_rows('inch_measurement')): $i = 1; ?>
                                                        <?php while ( have_rows('inch_measurement')) : the_row(); ?>
                                                            <td class='inch_<?php echo $i; ?>'><?php echo get_sub_field('measurements'); ?></td>
                                                        <?php $i++; endwhile; ?>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php $i++; endwhile; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                    <table class='cmTable marB90 showtable'>
                                    <thead class='blackBg'>
                                       <tr>
                                           <?php if( have_rows('cm_title')): $i = 1; ?>
                                               <?php while ( have_rows('cm_title')) : the_row(); ?>
                                                  <td class='tit_<?php echo $i; ?>'><?php echo get_sub_field('title'); ?></td>
                                               <?php $i++; endwhile; ?>
                                           <?php endif; ?>
                                       </tr>
                                    </thead>
                                    <tbody>
                                        <?php if( have_rows('cm_row')): $i = 1; ?>
                                           <?php while ( have_rows('cm_row')) : the_row(); ?>
                                                <tr>
                                                    <?php if( have_rows('cm_measurement')): $i = 1; ?>
                                                        <?php while ( have_rows('cm_measurement')) : the_row(); ?>
                                                            <td class='cm_<?php echo $i; ?>'><?php echo get_sub_field('measurements'); ?></td>
                                                        <?php $i++; endwhile; ?>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php $i++; endwhile; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                </div>


                            <?php endwhile; ?>
                        <?php endif; ?>

                      </div>
                  </div>

              <?php endwhile; ?>
                    <?php joints_page_navi(); ?>
              <?php else : ?>
                    <?php get_template_part( 'parts/content', 'missing' ); ?>
              <?php endif; ?>


          </div>
      </section>

      <?php get_template_part( 'parts/customer', 'info' ); ?>


		</div>

<?php get_footer(); ?>
