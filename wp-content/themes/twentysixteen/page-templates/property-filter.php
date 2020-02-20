<?php 
/* Template Name: Property page Template */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	
<form id="form-id"  method="GET" action="" class="filterForm" onsubmit="myFunction()">
<?php 
$taxonomy = 'property_cat';
$terms = get_terms([
    'taxonomy' => $taxonomy,
    'hide_empty' => false,
]);

 if( $terms ) { ?> 
	<select name="categoryfilter">
	<option value="">Select category</option>
	<?php foreach ( $terms as $term ) : ?>
	<?php $termName = $term->name; 
	      $termSlug = $term->slug; 
	?>
	<option value="<?php echo $termSlug; ?>" <?php if ($_GET['categoryfilter'] == $termSlug) { echo 'selected="selected"'; } ?> ><?php echo $term->name; ?> </option> 
	<?php endforeach; ?>
	</select>
 <?php }
?>


<?php
$field_key = "field_5bfcf96faab44";
$field = get_field_object($field_key);

if( $field )
{ ?>
<select name="story">
<option value="">Select Story</option>
<?php
foreach( $field['choices'] as $k => $v )
{ ?>
<option value="<?php echo $k; ?>" <?php if ($_GET['story'] == $k) { echo 'selected="selected"'; } ?> ><?php echo $v; ?></option>
<?php }
?>
</select>
<?php }

?>


<input type="submit" value="Submit"/>
</form>

<?php if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{ ?>
		<ul class="property-inner" role="listbox">

                        <?php
					  $getTax = $_GET['categoryfilter'];
					  $getStory = $_GET['story'];
					  
					  if (!empty($getTax) && !isset($getStory)) {
					  $args = array(
						'post_type' => 'property',
						'posts_per_page' => -1,
						'tax_query' => array(
							array(
							'taxonomy' => 'property_cat',
							'field' => 'slug',
							'terms' => $getTax
							) 
						)
					);
					}
					elseif (!empty($getStory) && !isset($getTax)) {
						$args = array(
						'post_type' => 'property',
						'posts_per_page' => -1,
						
							meta_query => array(
							array(
								'key' => 'story_property',
								'value' => $getStory
							)
						)
					);
					}
					
					elseif (!empty($getStory) && !empty($getTax)) {
						$args = array(
						'post_type' => 'property',
						'posts_per_page' => -1,
						'tax_query' => array(
							array(
							'taxonomy' => 'property_cat',
							'field' => 'slug',
							'terms' => $getTax
							) 
						),
							meta_query => array(
							array(
								'key' => 'story_property',
								'value' => $getStory,
								'compare' 	=> 'LIKE',
							)
						)
					);
					}
					
					elseif (!isset($getStory) && !isset($getTax)) {
						$args = array(
						'post_type' => 'property',
						'posts_per_page' => -1
					);
					}
					
					else { 
					$args = array(
						'post_type' => 'property',
						'posts_per_page' => -1,
					);
					
					}
						?>
                        <?php $loop = new WP_Query($args); ?>
                        <?php if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>

                        <li class="propertylist">
                            <div class="pimage">
							<a href="<?php the_permalink(); ?>"><?php if ( has_post_thumbnail() ) {the_post_thumbnail();} ?></a>
						    </div>
							<div class="ptitle">
								<h2><?php echo get_the_title(); ?></h2>
							</div>
                        </li>

                        <?php endwhile; ?>
                        <?php else: ?>

                            <h1>No posts there!</h1>
                        <?php endif; ?>
                        <?php wp_reset_postdata(); ?>

                    </ul>
<?php }

?>
 
	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>
