<?php
/*-------------------------------------------------------------------------
 * IG PORTFOLIO SHORTCODES
 -------------------------------------------------------------------------*/
// Add Shortcode
function ig_portfolio_shortcode( $atts ) {
    // Attributes
    extract( shortcode_atts(
        array(
            'style' => 'normal',
            'image' => 'true',
            'meta' => 'true',
            'perpage' => 12,
            ), $atts )
    );
    ob_start();
        global $paged;
        $query = new WP_Query( array (
        'post_type' => 'project',
        'posts_per_page' => $perpage,
        'paged' => $paged
        ) );
?>
<div class="ig-potfolio-page">
   <?php if ( $query->have_posts() ) {
    while ( $query->have_posts() ) : $query->the_post();?>

    <div id="project-<?php the_ID(); ?>" class="ig-portfolio">

            <?php if ( has_post_thumbnail() && $image=="true") : ?>
                <div class="image <?php if ( $style=="compact") { echo "left"; }; ?>">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                        <?php the_post_thumbnail('img-thumb'); ?>
                    </a>
                </div>
            <?php endif; ?>

                <div class="title">
                    <?php the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                </div>
            <?php if ( $style=="normal") : ?>
                <div class="text">
                    <?php
                        if  ( has_excerpt() ) :
                        the_excerpt();
                        else:
			            the_content();
                        endif;
		             ?>
                </div>
            <?php endif; ?>
            <?php if ( $style=="compact") : ?>
                <div class="text">
                    <?php if ( ! has_excerpt() ) { echo '<p>' . wp_trim_words( get_the_content(), 60, '...' ) . '</p>'; } else { the_excerpt();}?>
                </div>
            <?php endif; ?>
        
            <?php if ( $meta=="true") : ?>
                <div class="meta">
                <?php esc_html_e('Author:','ig-portfolio'); ?> <?php the_author(); ?><?php echo esc_html__(' &middot; ','ig-portfolio'); ?><?php esc_html_e('Date:','ig-portfolio'); ?> <?php echo get_the_date(); ?> <?php ig_portfolio_get_terms() ?>
                </div><!-- .meta -->
            <?php endif; ?>
        
    </div><!-- .ig-portfolio -->

            <?php endwhile;
            //pagination
            $big = 999999999; // need an unlikely integer
            echo paginate_links( array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'type'   => 'list',
                'current' => max( 1, get_query_var('paged') ),
                'total' =>  $query->max_num_pages
            ) );?>

    <?php  wp_reset_postdata(); ?>
</div><!-- .ig-portfolio-page -->
    <?php $cleanvar = ob_get_clean();
    return $cleanvar;
    }
}
add_shortcode( 'ig-portfolio', 'ig_portfolio_shortcode' );

/*-------------------------------------------------------------------------
 * IG PORTFOLIO GALLERY SHORTCODES
 -------------------------------------------------------------------------*/
function ig_portfolio_gallery_shortcode( $atts, $content = null ) {
    // Attributes
    extract( shortcode_atts(
        array(
            'cat' => '',
            'perpage' => 12,
            ), $atts )
    );
    // start
    ob_start();
    if ( $cat ) {
        $query = new WP_Query( array(
        'showposts' => $perpage,
        'post_status' => 'publish',
        'post_type' => 'project',
        'tax_query' => array(
            array(
            'taxonomy' => 'portfolio',
            'field' => 'slug',
            'terms' => array($cat))
            ))
        );
    } else {
        $query = new WP_Query( array(
            'showposts' => $perpage,
            'post_status' => 'publish',
            'post_type' => 'project')
        );
    };?>
<div class="ig-portfolio-gallery">
   <?php if ( $query->have_posts() ) {
    while ( $query->have_posts() ) : $query->the_post();?>
        <div class="gallery-project">
        <?php if ( has_post_thumbnail()) : ?>
            <div class="gallery-image">
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                    <?php the_post_thumbnail('img-gallery'); ?>
                </a>
            </div>
      <?php endif; ?>
            <div class="title">
                <?php the_title( sprintf( '<strong><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></strong>' ); ?>
            </div>
        </div>
    <?php endwhile;
    wp_reset_postdata(); ?>
 </div>
    <?php $cleanvar = ob_get_clean();
    return $cleanvar;
    }
}
add_shortcode( 'ig-portfolio-gallery', 'ig_portfolio_gallery_shortcode' );
