<div class="mobBar">

    <button class="hamburger hamburger--spring" type="button">
        <span class="hamburger-box">
            <span class="hamburger-inner"></span>
        </span>
    </button>
    <a href="<?php echo get_home_url(); ?>"><img class='moblogo' src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png"></a>


        <div class='headerSearchButt iconhead largep'><span class="material-icons searchicon">search</span></div>
        <div class="searchDrop">
            <?php get_template_part( 'parts/search', 'form' ); ?>
        </div>



    <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>">
        <div class='cartCount'>
           <span class="material-icons-outlined">shopping_basket</span>
           <div class='countwrap'>
              <span class='header-cart-count'></span>
           </div>
        </div>
    </a>
    <div class='mobnav'>
        <button class="hamburger hamburger--spring" type="button">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
        <?php mob_nav(); ?>
        <!-- <div class='extranavwrap'>
            <div class='account marB20'>
                </?php if ( is_user_logged_in() ) { ?>
                    <a class='dtext' href='</?php echo get_site_url(); ?>/my-account'>My account</a>
                </?php } else { ?>
                    <a class='dtext' href='</?php echo get_site_url(); ?>/login'>My account</a>
                </?php } ?>
            </div>
            <a class='dtext extranav marB20' href="</?php echo get_site_url(); ?>/gift-cards">Gift cards</a>
            <a class='dtext extranav marB20' href="</?php echo get_site_url(); ?>/contact">Contact</a>
            <a class='dtext extranav' href="</?php echo get_site_url(); ?>/apply-for-a-trade-account/">Trade account</a>
        </div> -->
        <div class='currencymob'><?php echo do_shortcode('[woocs show_flags=1 style=3]'); ?></div>
    </div>
</div>

<div class='deskTop'>
    <div class='grid-container full pad90W'>
        <div class='grid-x align-middle topWrap'>
            <div class='large-12 cell'>
                <?php top_bar(); ?>
            </div>
        </div>
    </div>
</div>

<div class='deskBar whiteBg'>
    <div class='grid-container full pad90W'>
        <div class='grid-x align-middle deskWrap'>

            <div class='large-2 cell'>
                <a href="<?php echo get_home_url(); ?>"><img class='desklogo' src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png"></a>
            </div>
            <div class='large-8 cell flexmid'>
                <?php joints_top_nav(); ?>
            </div>
            <div class='large-2 cell flexend alignC'>

                <?php echo do_shortcode('[woocs show_flags=1 style=1]'); ?>

                <div class='searchHBox'>
                    <div class='headerSearchButt deskhide iconhead largep'><span class="material-icons">search</span></div>
                    <p class='headerSearchButt noMar dtext largep deskshow'>Search</p>
                    <div class="searchDrop">
                        <?php get_template_part( 'parts/search', 'form' ); ?>
                    </div>
                </div>

                <?php if ( is_user_logged_in() ) { ?>
                    <a class='deskhide dtext marL30 largep iconhead' href='<?php echo get_site_url(); ?>/my-account'><span class="material-icons">account_circle</span></a>
                    <a class='deskshow dtext marL30 largep' href='<?php echo get_site_url(); ?>/my-account'>Account</a>
                <?php } else { ?>
                    <a class='deskhide dtext marL30 largep iconhead' href='<?php echo get_site_url(); ?>/login'><span class="material-icons">account_circle</span></a>
                    <a class='deskshow dtext marL30 largep' href='<?php echo get_site_url(); ?>/login'>Account</a>
                <?php } ?>

                <a class="cart-contents marL30" href="<?php echo wc_get_cart_url(); ?>">
                    <div class='cartCount'>
                      <span class="material-icons-outlined">shopping_basket</span>
                       <div class='countwrap'>
                          <span class='header-cart-count'></span>
                       </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</div>
