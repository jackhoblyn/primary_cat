<html>
  <body>
    <div class="wrap">
      <!-- Contains form with two select boxes for categories and posts, when submit 
      button is pressed, the ID of the category is saved as the posts primary_category-->

      <?php  

      global $wpdb;
      
      // Simple prompt to show user the form was successful, as well as the request sent
      if(isset($_POST['submit'])) {
        $msg = "Primary Category Saved";
        ?><h1 style="color: blue"><?php echo $msg;?></h1><?php
        ?><p style="color: green"><?php print_r($_REQUEST);?></p><?php
        
        //saves parameters from form as arguments for wpdb update query
        $table = 'wp_posts';

        $data = array(
         'primary_category' => $_POST['cat']
            );

            $where = array(
             'ID' => $_POST['pp']
            );

        global $wpdb;
        // Statement which updates the posts table with the paramaters
        $wpdb->update( $table, $data, $where, array( '%d' ), array( '%d' ));

      }

      ?>

      <h2 style="margin: 2rem">Please choose a primary category for a post</h2>

      <div style="margin: 2rem">
        <!-- The forms action is to basically post data to the same page it exists on -->
       <form action="<?php echo $_SERVER['PHP_SELF']; ?>?page=primary_cat" method="post">

        <select name="pp" id="pp">
          <!-- Select box of all posts -->
          <?php
              global $post;

              $args = array( 
              'numberposts' => 10,
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
          'hierarchical'=>2,
          'hide_empty'=>0
         );

         wp_dropdown_categories( $args); 

         ?>

            <input type="submit" name="submit" value="Create" />
        </form>
      </div>
    </div>        
  </body>
</html>
