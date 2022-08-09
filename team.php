<?php
/**
 * Plugin Name:       Team Member
 * Plugin URI:        #
 * Description:       This is plugin for Orbit Technology .
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Md Azim
 * Author URI:        https://github.com/mdazim12
 * License:           GPL v2 or later
 * License URI:       https://github.com/mdazim12
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       my-basics-plugin
 * Domain Path:       team
 */

 

 function team_member(){
    register_post_type('team_member',array(
        'labels'                =>array(
            'menu_name'         =>'Team Member',
            'name'              =>'Team Member',
            'add_new'           =>'Add Member',
            'all_items'         =>'All Team Member',
            'add_new_items'     =>'Add New'
        ),
        'public'                =>true,
        'menu_icon'             =>'dashicons-groups',
        'supports'              =>array('title','editor','thumbnail','custom-fields',),
    ));
 }
 add_action('init','team_member');

 function san_all_link(){
    //css links
    wp_enqueue_style( 'boostrap',get_template_directory_uri().'/css/bootstrap_min.css' ); 
    wp_enqueue_style( 'pre_load',get_template_directory_uri().'/css/simple-line-icons.css' ); 
    wp_enqueue_style( 'main_css',get_template_directory_uri().'/css/main_style.css' ); 
   }
   add_action('wp_enqueue_scripts','san_all_link' );


   function service_shotcode( $atts ) {
    ob_start();
    $query                  = new WP_Query( array(
      'post_type'           => 'team_member',
      'posts_per_page'      => 3,
      'order'               => 'ASC',
    ));
     ?>

<div class="py-5 team4">
  <div class="container">
    <div class="row">

    <?php if ( $query -> have_posts()) {
        while($query-> have_posts(  )) : $query-> the_post(  ); ?>
    <div class="col-lg-3 mb-4">
        <div class="row">
          <div class="col-md-12">
              <?php the_post_thumbnail( 'thumb', array( 'class' => 'img-fluid rounded-circle' ) );?>
          </div>
          <div class="col-md-12 text-center">
            <div class="pt-2">
              <h5 class="mt-4 font-weight-medium mb-0"><?php the_title( );?></h5>
              <h6 class="subtitle mb-3">Property Specialist</h6>
              <p><?php the_excerpt(  );?></p>
            </div>
          </div>
        </div>
      </div>


    <?php endwhile;
     }
    ?>

      
      <!-- column  -->
      
      <!-- column  -->
      <!-- column  -->
     
     

      <a class="btn btn-outline-secondary m-auto" href="http://">View all</a>
    </div>
  </div>
</div>

<?php $team = ob_get_clean();
        return $team;
    }
    
    add_shortcode( 'service', 'service_shotcode');


?>








 

 
 

 


 


 






