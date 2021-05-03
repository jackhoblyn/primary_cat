<!-- Simple form, very similar to the one used to update post with primary category -->
<!-- Instead of updating database, it pulls from database into a clickable list -->


<html>
  <body>
    <div class="wrap">
      <h2 style="margin: 1rem">Please choose a primary category to see all posts associated with it</h2>

      <div style="padding: 1rem">

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?page=view_primary_cat" method="post">
     
          <?php

            $args = array(
              'name' => 'cat',
              'hierarchical'=>2,
              'hide_empty'=>0
             );

             wp_dropdown_categories( $args); 

           ?>

        <input type="submit" name="submit" value="View" />

        </form>

        </div>
        <div style="margin: 1rem">


         <?php 


        if(isset($_POST['submit'])) {
          $msg = "Posts fetched from this primary category";
          ?><h1 style="color: blue"><?php echo $msg;?></h1><?php
          ?><p style="color: green"><?php print_r($_REQUEST);?></p><?php

          global $wpdb;

          // Once again, form parameter is saved as argument
          $pcat = $_POST["cat"];
          $cposts = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM wp_posts WHERE primary_category = %d", $pcat ) );

          // Display all relevant posts with href permalink
          foreach ( $cposts as $cpost ) { ?>
              <ul><a href="<?php echo esc_url( get_permalink($cpost->ID) ); ?>"><h1 style="color: black"><?php echo $cpost->post_title; ?></h1></a></ul><?php
          }

          }

          ?>
        </div>
      </div>
    </body>
</html>
