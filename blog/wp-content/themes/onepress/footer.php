<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package OnePress
 */

$hide_footer = false;
$page_id = get_the_ID();

if ( is_page() ){
    $hide_footer = get_post_meta( $page_id, '_hide_footer', true );
}

if ( onepress_is_wc_active() ) {
    if ( is_shop() ) {
        $page_id =  wc_get_page_id('shop');
        $hide_footer = get_post_meta( $page_id, '_hide_footer', true );
    }
}

if ( ! $hide_footer ) {
    ?>
    <footer class="footer">
    <div class="container">
        <div class="footer-menu-wraper">
            <div class="footer-logo">
                <a href="">
                <img src="http://localhost/blog/wp-content/uploads/2019/01/logo.png" class="img-responsive">
                </a>
            </div>
            <div class="footer-menu">
                <ul class="menu">
                <?php  $host = $_SERVER['HTTP_HOST'];?>
                <li><a href="http://13.126.99.14/wealthtree/">HOME</a></li>
                <li><a href="/wealthtree/index.php/home/aboutus">ABOUT US</a></li>
                <li><a href="/wealthtree/index.php/home/faq">FAQ</a></li>
                <li><a href="/wealthtree/index.php/home/scheme">SCHEMES</a></li>
                <li><a href="/wealthtree/index.php/home/open_calc">CALCULATOR</a></li>
                <li><a href="/wealthtree/blog">BLOG</a></li>
                <li><a href="/wealthtree/index.php/home/contact_us">CONTACT US</a></li> 
            </ul> 
            </div>
        </div>
        <div class="footer-social-wraper">
            <div class="footer-social-box">
                <div class="top-social-bar footer-social-bar">
                    <h6 class="border-hding">Lets Get Social</h6>
                    <ul>
                        <li><a href="https://www.facebook.com/WealthTree-Technologies-Pvt-Ltd-686869851669514/" class="facebook" target="_blank"></a></li>
                        <li><a href="#" class="g-plus" target="_blank"></a></li>
                        <li><a href="#" class="twitter" target="_blank"></a></li>
                        <li><a href="https://www.instagram.com/pmawas/?hl=en" class="insta" target="_blank"></a></li>
                    </ul>
                </div>
                <div class="copy-right-wraper">
                    <p>© Copyright 2018 company - All Rights Reservedd.</p>
                </div>
            </div>
        </div>

    </footer><!-- #colophon -->
    <?php
}
/**
 * Hooked: onepress_site_footer
 *
 * @see onepress_site_footer
 */
do_action( 'onepress_site_end' );
?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
