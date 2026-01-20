<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package SKT BeFit
 */

get_header(); ?>

<div id="content">
    <div class="site-aligner">
    <section class="site-main content-left" id="sitemain">
			<?php if ( have_posts() ) : ?>
                <header class="page-header">
                   <?php
					the_archive_title( '<h1 class="entry-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				  ?>
                </header><!-- .page-header -->
				<div class="blog-post">
					<?php /* Start the Loop */ ?>
                    <?php while ( have_posts() ) : the_post(); 
						  get_template_part( 'content', get_post_format() );
						  endwhile;
					?>
                </div>
                <?php  
				// Previous/next post navigation.
				the_posts_pagination( array(
							'mid_size' => 2,
							'prev_text' => esc_html__( 'Back', 'skt-befit' ),
							'next_text' => esc_html__( 'Next', 'skt-befit' ),
							'screen_reader_text' => esc_html__( 'Posts navigation', 'skt-befit' )
				) );
			    else : get_template_part( 'no-results');
				endif; 
				?>
        </section>
        <div class="sidebar_right">
        <?php get_sidebar();?>
        </div><!-- sidebar_right -->
        <div class="clear"></div>
    </div><!-- site-aligner -->
</div><!-- content -->
	
<?php get_footer(); ?>