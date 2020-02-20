<?php 
/* Template Name: WP query pagination */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	
  <?php
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $query = new WP_Query( array(
        'post_type' => 'post',
        'posts_per_page' => 2,
        'paged' => $paged
    ) );
?>

<?php if ( $query->have_posts() ) : ?>

<!-- begin loop -->
<?php while ( $query->have_posts() ) : $query->the_post(); ?>

    <h2><a href="<?php the_permalink(); ?>" title="Read"><?php the_title(); ?></a></h2>
    <?php the_excerpt(); ?>
    <?php echo get_the_date(); ?>

<?php endwhile; ?>
<!-- end loop -->

<!-- WHAT GOES HERE?????? -->
<div class="pagination">
    <?php 
        echo paginate_links( array(
            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
            'total'        => $query->max_num_pages,
            'current'      => max( 1, get_query_var( 'paged' ) ),
            'format'       => '?paged=%#%',
            'show_all'     => false,
            'type'         => 'plain',
            'end_size'     => 2,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => sprintf( '<i></i> %1$s', __( 'Newer Posts', 'text-domain' ) ),
            'next_text'    => sprintf( '%1$s <i></i>', __( 'Older Posts', 'text-domain' ) ),
            'add_args'     => false,
            'add_fragment' => '',
        ) );
    ?>
</div>

<?php wp_reset_postdata(); ?>

<?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

	</main><!-- .site-main -->

	<?php // get_sidebar( 'content-bottom' ); ?>
	
</div><!-- .content-area -->

<?php get_footer(); ?>