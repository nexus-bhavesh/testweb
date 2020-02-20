<?php 
/* Template Name: Custom pagination with get post custom query */

get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
 <?php
               $rec_page=2; // Number of records to be displayed on a page
  
               if (isset($_GET["paging"]))
               {
                    $paging = $_GET["paging"]; 
               } 
               else
               { 
                       $paging=1;  
               }; 
  
               $start = ($paging-1) * $rec_page; 
         
         
         global $wpdb;    
      $myposts = $wpdb->get_results( "SELECT * FROM wp_posts WHERE 1=1 AND wp_posts.post_type = 'post' AND (wp_posts.post_status = 'publish') ORDER BY wp_posts.post_date DESC LIMIT $start, $rec_page");
    echo '<ul>';
    foreach( $myposts as $mypost ) {
   $postId = $mypost->ID;
   $content_post = get_post($postId);
   $postTitle = $content_post->post_title;
   $content = $content_post->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);
$postPermalink = get_permalink($postId);
$featured_img_url = get_the_post_thumbnail_url($postId,'medium'); 
    ?>
    <li style="margin-bottom: 20px;">
      <h3><?php echo $postId ." ". $postTitle; ?></h3>
      <?php if(!empty($featured_img_url)) { ?>
     <img src="<?php echo $featured_img_url; ?>">
     <?php } ?>
      <p><?php echo $content; ?></p>
      <a href="<?php echo $postPermalink; ?>">Read More</a>
    </li>
   <?php
  }
     echo '</ul>';
              
 ?>
        </table>
        <div class="pagination-custom">
<?php
    $total_recs = $wpdb->get_var( "select COUNT(*) from wp_posts WHERE wp_posts.post_type = 'post' AND wp_posts.post_status = 'publish' ");
    
      //  $total_recs = mysql_num_rows($res); //count number of records
        $total_pages = ceil($total_recs / $rec_page); 
 
        echo "<a href='?paging=1'>". '|< '. "</a> "; // For 1st page 
 
         for ($i=1; $i<=$total_pages; $i++) 
         { 
          if ($_GET['paging'] == $i) { $cls = "active"; } else { $cls = ""; }
              echo "<a class='".$cls."' href='?paging=".$i."'>". $i. "</a> "; 
         }; 
        echo "<a href='?paging=$total_pages'>". '>| '."</a> "; // For last page
?>
</div>
  </main><!-- .site-main -->

  <?php // get_sidebar( 'content-bottom' ); ?>
  
</div><!-- .content-area -->

<?php get_footer(); ?>