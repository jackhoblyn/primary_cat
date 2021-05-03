<html>
    <body>
        <div class="wrap">


          <!-- Very simple file with two dropboxes in a form which send to 
          combine.php to store the category_id in the post as a primary category-->

          <?php  

          global $wpdb;
          $msg = "Form Data Saved";

          if(isset($_POST['submit'])) {
            print_r($_REQUEST);


          $table = 'wp_posts';

          $data = array(
           'primary_category' => $_POST['cat']
              );

              $where = array(
               'ID' => $_POST['pp']
              );

          global $wpdb;
          $wpdb->update( $table, $data, $where, array( '%d' ), array( '%d' ));

          }

          ?>

          <?php echo $msg;?>

            <h2>Please choose a primary category for a post</h2>
        
                <h2><?php _e( 'Categories:', 'textdomain' ); ?></h2>
                 <form action="<?php echo $_SERVER['PHP_SELF']; ?>?page=primary_cat" method="post">
                   <!--  This textbox was used to make sure data passed to combine.php -->

                    <select name="pp" id="pp">
                      <!-- Select box of all posts -->
                      <?php
                          global $post;

                          $args = array( 
                          'numberposts' => 4,
                          'hierarchical'=> 2
                          );

                          $posts = get_posts($args);

                          foreach( $posts as $post ) : setup_postdata($post); ?>
                              <option value="<?php the_id(); ?>"><?php the_title(); ?></option>
                      <?php endforeach; ?>
                    </select>



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


            <div class="wrap">



            </div>


        
      </body>
</html>
