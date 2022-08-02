<!--
  Ersteller: Julian Helperstorfer
  Erstellt am: 27.07.2022+11:45
  Geändert von:
  Geändert am:
  Beschreibung: 
-->

<?php
/*
Template Name: Job-Template
*/
?>


<style>

</style>


<?php get_header(); ?>


<div style="margin: 20px">

 
  <?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
 
 
  <div class="post page">
    <h2><?php the_title(); ?></h2>
    <?php the_content(); ?>
  </div>
 
 
  <?php endwhile; ?>
  <?php endif; ?>

 

</div>

<?php get_footer(); ?>

