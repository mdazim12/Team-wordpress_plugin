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
 * Text Domain:       team
 * Domain Path:       /language
 */

 



add_action('wp_enqueue_scripts', 'register_script');
function register_script() {
    

    wp_register_style( 'boostrap', plugins_url('/css/bootstrap_min.css', __FILE__), false, '1.0.0', 'all');
    wp_register_style( 'pre_load', plugins_url('/css/simple-line-icons.css', __FILE__), false, '1.0.0', 'all');
    wp_register_style( 'main_css', plugins_url('/css/main_style.css', __FILE__), false, '1.0.0', 'all');
}


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
        'supports'              =>array('title','editor','thumbnail'),
    ));

    register_taxonomy('member','team_member',array(
        'labels'            =>array(
            'name'          =>'Member Type',
            'add_new_item'  =>'Add Member Type',
            'parent_item'   =>'Parent Member',
        ),
        'public'            =>true,
        'hierarchical'      =>true,
        
    ));
 }
 add_action('init','team_member');

 


   function team_member_shotcode( $atts ) {
    ob_start();
      $query = new WP_Query( array(
      'post_type'           => 'team_member',
      'posts_per_page'      => -1,
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
              <a href="<?php the_permalink(  );?>"><h5 class="mt-4 font-weight-medium mb-0"><?php the_title( );?></h5></a>
              <h6 class="subtitle mb-3">
                <?php
                    $member =get_the_terms(get_the_ID(),'member');
                    foreach ($member as $member_list ) {
                        $port_member =$member_list -> name;
                        $link = get_term_link( $member_list,'member' );
                        echo '<a href="'.$link.'">'.$port_member.'</a> ';
                    }
                ?>
              </h6>
              <p><?php echo wp_trim_words(get_the_content(),'20',' ' );?></p>
            </div>
          </div>
        </div>
      </div>


    <?php endwhile;
     }
    ?>

       <a class="btn btn-outline-secondary m-auto azim" href="http://">View all</a>
     
     
     
    </div>
  </div>
</div>




<?php $team = ob_get_clean();
        return $team;
    }
    
    add_shortcode( 'team_member', 'team_member_shotcode');


?>

<?php
  add_filter('single_template', 'wpse96660_single_template');
  function wpse96660_single_template($template)
  {
      if ('team_member' == get_post_type(get_queried_object_id()) && !$template) {
          // if you're here, you're on a singlar page for your costum post 
          // type and WP did NOT locate a template, use your own.~
          $template = get_template_directory_uri(  ) . '/inc/single.php';
      }
      return $template;
  }
?>








 

 
 

 


 


 






