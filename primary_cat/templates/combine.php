<html>
    <body>
        <div class="wrap">
            <h2>Please Choose a primary category for a post</h2>


			<!-- Data was echoed out onto the html page to prove it was passing through -->
			Welcome <?php echo $_GET["cat"]; ?><br>
			hello <?php echo $_GET["name"]; ?><br>
			howaya <?php echo 'Post ID: '.$_GET['pp']; ?><br>

			<?php $post_id = $_GET["pp"]; ?>
			<h1><?php echo $post_id; ?></h1>

			<?php $cat_id = $_GET["cat"]; ?>
			<h1><?php echo $cat_id; ?></h1>


			<?php 

				// $table => 'wp_posts';

				// $data = array(
				// 	'primary_category' => $GET['cat']
		  //       );
 
		  //       $where = array(
		  //       	'ID' => $GET['pp']
		  //       );

				// global $wpdb;
				// $wpdb->update( $table, $data, $where, array( '%d' ), array( '%d' ));


				global $wpdb;

				// $wpdb->update(
				//    "wp_posts",
				// 	array(
				// 		"post_title" => "Updated Title"
				// 	),
				// 	array(
				// 		"id" => 3
				// 	)
				// );

				$wpdb->update( $wpdb->posts, array("post_title" => "Modified Post Title"), array("ID" => 5), array("%s"), array("%d") );
        				
			?>

			
		</div>
	</body>
</html>
