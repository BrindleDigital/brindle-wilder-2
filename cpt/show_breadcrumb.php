<?php
global $post;

?>
<ul class="breadcrumb">
  <li><a href="<?php echo get_home_url(); ?>">Home</a></li>
  <?php if ($post->post_parent) {
     breadcrump_page( $post );
  }?>
  <?php if (is_singular('portfolio')) {?>
    <li><a href="<?php echo get_permalink(21); ?>"><?php echo get_the_title(21); ?></a></li>
  <?php }?>
  <li><?php echo get_the_title(); ?></li>
</ul>

<?php
function breadcrump_page( $post ) {
  $format = '<li><a href="%s" title="%s">%s</a></li>';    
  $anc = array_map( 'get_post', array_reverse( (array) get_post_ancestors( $post ) ) );
  $links = array_map( 'get_permalink', $anc );
  foreach ( $anc as $i => $apost ) {
    $title = apply_filters( 'the_title', $apost->post_title );
    printf( $format, $links[$i], esc_attr($title), esc_html($title) );
  }
  //echo apply_filters( 'the_title', $post->post_title );
}
?>