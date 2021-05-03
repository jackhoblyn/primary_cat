<html>
    <body>
        <div class="wrap">


          <!-- Very simple file with two dropboxes in a form which send to 
          combine.php to store the category_id in the post as a primary category-->


             <h2 style="margin: 1rem">Please choose a primary category to see all posts associated with it</h2>
              <div style="padding: 1rem">


                <form action="<?php echo $_SERVER['PHP_SELF']; ?>?page=view_primary_cat" method="post">
               <!--  This textbox was used to make sure data passed to combine.php -->



                <!-- Select box of all categories -->

                <?php

                $args = array(
                  'name' => 'cat',
                  'hierarchical'=>2
                 );

                 wp_dropdown_categories( $args); 

                 ?>

                <input type="submit" name="submit" value="Create" />

                </form>

              </div>
              <div style="margin: 1rem">


                 <?php 

              

                if(isset($_POST['submit'])) {
                  $msg = "Posts fetched from this primary category";
                  ?><h1 style="color: blue"><?php echo $msg;?></h1><?php
                  ?><p style="color: green"><?php print_r($_REQUEST);?></p><?php

                  global $wpdb;

                  $pcat = $_POST["cat"];

                  $cposts = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM wp_posts WHERE primary_category = %d", $pcat ) );

                  foreach ( $cposts as $cpost ) { ?>
                      <ul><a href="<?php echo esc_url( get_permalink($cpost->ID) ); ?>"><h1 style="color: black"><?php echo $cpost->post_title; ?></h1></a></ul><?php
                  }



                  
                  //Get all posts in a list where $post->primary_cat = cat->id

                  }

                ?>
              </div>


            


        
      </body>
</html>
