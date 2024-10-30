<?php
/**
 * Welcome Screen Class
 */
add_action('admin_menu', 'ig_portfolio_submenu_welcome_page');

function ig_portfolio_submenu_welcome_page() {
    global $ig_portfolio_welcome_page;
    $ig_portfolio_welcome_page = add_submenu_page( 'edit.php?post_type=project', 'IG Portfolio', 'Getting Started', 'manage_options', 'ig-portfolio-getting-started', 'ig_portfolio_submenu_welcome_page_callback' );
}
function ig_portfolio_submenu_welcome_page_callback() {
?>

<div class="wrap about-wrap">
        <h1><?php esc_html_e( 'IG Portfolio', 'ig-portfolio'); ?></h1>
        <p><?php esc_html_e( 'Thank you to use our plugin for your website.', 'ig-portfolio'); ?></p>
<?php include ('sections/welcome-intro.php'); ?>
<?php include ('sections/welcome-free-resources.php'); ?>
<?php include ('sections/welcome-footer.php'); ?>
</div>
<?php } ?>