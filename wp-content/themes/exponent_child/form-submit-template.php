<?php
/*
Template Name: form-submit-template
*/
?>
<?php get_header(); ?>
 
 
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
 
 
<div class="post page">
  <h2><?php the_title(); ?></h2>
  <?php the_content(); ?>
</div>
 
 
<?php endwhile; ?>
<?php endif; ?>
 
 
<?php echo "Form submitted!"; ?>
 
 
<?php get_footer(); ?>