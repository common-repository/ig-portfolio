<?php

add_action('admin_menu', 'ig_portfolio_submenu_page');

function ig_portfolio_submenu_page() {
    add_submenu_page( 'edit.php?post_type=project', 'IG Portfolio Settings', 'Settings', 'manage_options', 'ig-portfolio-settings-page', 'ig_portfolio_submenu_page_callback' );
    //call register settings function
    add_action( 'admin_init', 'register_ig_portfolio_settings' );
}

function register_ig_portfolio_settings() {
	//register our settings
	register_setting( 'ig-portfolio-settings-group', 'ig_portfolio_gallery_img_width' );
	register_setting( 'ig-portfolio-settings-group', 'ig_portfolio_gallery_img_heigth' );
	register_setting( 'ig-portfolio-settings-group', 'ig_portfolio_thumb_width' );
	register_setting( 'ig-portfolio-settings-group', 'ig_portfolio_thumb_heigth' );
}

function ig_portfolio_submenu_page_callback() {
?>
<div class="wrap">
<h2>IG Portfolio Settings</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'ig-portfolio-settings-group' ); ?>
    <?php do_settings_sections( 'ig-portfolio-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
            <th><?php esc_html_e('Projects Image', 'ig-portfolio');?></th>
            <td></td>
        </tr>
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Image Width', 'ig-portfolio');?></th>
        <td><input type="text" name="ig_portfolio_thumb_width" value="<?php echo esc_attr( get_option('ig_portfolio_thumb_width', '1024') ); ?>" /> px</td>
        </tr>
        
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Image Height', 'ig-portfolio');?></th>
        <td><input type="text" name="ig_portfolio_thumb_heigth" value="<?php echo esc_attr( get_option('ig_portfolio_thumb_heigth', '350') ); ?>" /> px</td>
        </tr>
        
        <tr valign="top">
            <th><?php esc_html_e('Portfolio Gallery Images', 'ig-portfolio');?></th>
            <td></td>
        </tr>
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Image Width', 'ig-portfolio');?></th>
        <td><input type="text" name="ig_portfolio_gallery_img_width" value="<?php echo esc_attr( get_option('ig_portfolio_gallery_img_width', '554') ); ?>" /> px</td>
        </tr>
         
        <tr valign="top">
        <th scope="row"><?php esc_html_e('Image Height', 'ig-portfolio');?></th>
        <td><input type="text" name="ig_portfolio_gallery_img_heigth" value="<?php echo esc_attr( get_option('ig_portfolio_gallery_img_heigth', '454') ); ?>" /> px</td>
        </tr>
    </table>
    <p><?php esc_html_e('Remember to regenerate your thumbnails after saved, you can use the free plugin:', 'ig-portfolio');?> <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">Regenerate Thumbnails</a></p>
    <?php submit_button(); ?>

</form>

</div>
<?php } ?>