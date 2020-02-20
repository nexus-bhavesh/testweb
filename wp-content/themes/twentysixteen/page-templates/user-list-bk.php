<?php 
/* Template Name: User List Template */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	
 <center>
         <h2 align="center">Users Data</h2>
         <table border="2">
           <tr align="center">
               <th>No </th> <th>Name</th> <th>Email</th> 
           </tr>
         
         <?php
 
               $rec_page=7; // Number of records to be displayed on a page
  
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
			$users = $wpdb->get_results( "SELECT * FROM wp_users LIMIT $start, $rec_page");
		
		foreach( $users as $row ) {
    $id = $row->ID;
	$name = $row->user_nicename;
	$email = $row->user_email;
    
                  echo "<tr>";
                  echo "<td align='center'width='100'>$id</td>"; 
                  echo "<td align='center' width='150'> $name</td>";
                  echo "<td align='center' width='150'> $email</td>";
                  echo "</tr>";
  }
		
              
 ?>
        </table>
<?php
		$total_recs = $wpdb->get_var( "select COUNT(*) from wp_users");
		
      //  $total_recs = mysql_num_rows($res); //count number of records
        $total_pages = ceil($total_recs / $rec_page); 
 
        echo "<a href='?paging=1'>". '|< '. "</a> "; // For 1st page 
 
         for ($i=1; $i<=$total_pages; $i++) 
         { 
              echo "<a href='?paging=".$i."'>". $i. "</a> "; 
         }; 
        echo "<a href='?paging=$total_pages'>". '>| '."</a> "; // For last page
?>
 </center>
 
	</main><!-- .site-main -->

	<?php // get_sidebar( 'content-bottom' ); ?>
	
</div><!-- .content-area -->

<?php get_footer(); ?>