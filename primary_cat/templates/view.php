<html>
    <body>
        <div class="wrap">


          <!-- Very simple file with two dropboxes in a form which send to 
          combine.php to store the category_id in the post as a primary category-->

          <?php 

              
              $msg = "Form Data Saved";

              if(isset($_POST['submit'])) {
                print_r($_REQUEST);

                global $wpdb;

                $pcat = $_POST["cat"];

                $cposts = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM wp_posts WHERE primary_category = %d", $pcat ) );

                foreach ( $cposts as $cpost ) {
                    echo $cpost->post_title;
                }
                //Get all posts in a list where $post->primary_cat = cat->id

                }

              ?>

              <?php echo $msg;?>


             <h2>Please choose a primary category to see all posts associated with it</h2>


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


            


        
      </body>
</html>
