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

  <div  class="tatsu-Hk3Rky84jq tatsu-section  tatsu-bg-overlay   tatsu-clearfix" data-title=""  data-headerscheme="background--dark"><div class='tatsu-section-pad clearfix' data-padding='{"d":"90px 0px 90px 0px"}' data-padding-top='90px'><div class="tatsu-row-wrap  tatsu-wrap tatsu-row-one-col tatsu-row-has-one-cols tatsu-medium-gutter tatsu-reg-cols  tatsu-clearfix tatsu-BkjAkyIVj9" ><div  class="tatsu-row " ><div  class="tatsu-column  tatsu-bg-overlay tatsu-one-col tatsu-column-image-none tatsu-column-effect-none  tatsu-rJ9AkJIEi5"  data-parallax-speed="0" style=""><div class="tatsu-column-inner " ><div class="tatsu-column-pad-wrap"><div class="tatsu-column-pad" ><div  class="tatsu-module tatsu-normal-button tatsu-button-wrap   tatsu-H1VGJL4i5   "><a class="tatsu-shortcode mediumbtn tatsu-button left-icon circular   bg-animation-none  " 
				href="bewerbungsformular" style= ""  aria-label="Anmelden" data-gdpr-atts={} >Bewerben</a><style>.tatsu-H1VGJL4i5 .tatsu-button{background-color: rgba(0,205,152,1);color: #ffffff ;}</style></div></div></div><div class = "tatsu-column-bg-image-wrap"><div class = "tatsu-column-bg-image" ></div></div><div class="tatsu-overlay tatsu-column-overlay tatsu-animate-none" ></div></div><style>.tatsu-row > .tatsu-rJ9AkJIEi5.tatsu-column{width: 100%;}.tatsu-rJ9AkJIEi5.tatsu-column > .tatsu-column-inner > .tatsu-column-overlay{mix-blend-mode: normal;}.tatsu-rJ9AkJIEi5 > .tatsu-column-inner > .tatsu-top-divider{z-index: 9999;}.tatsu-rJ9AkJIEi5 > .tatsu-column-inner > .tatsu-bottom-divider{z-index: 9999;}.tatsu-rJ9AkJIEi5 > .tatsu-column-inner > .tatsu-left-divider{z-index: 9999;}.tatsu-rJ9AkJIEi5 > .tatsu-column-inner > .tatsu-right-divider{z-index: 9999;}@media only screen and (max-width:1377px) {.tatsu-row > .tatsu-rJ9AkJIEi5.tatsu-column{width: 100%;}}@media only screen and (min-width:768px) and (max-width: 1024px) {.tatsu-row > .tatsu-rJ9AkJIEi5.tatsu-column{width: 100%;}}@media only screen and (max-width: 767px) {.tatsu-row > .tatsu-rJ9AkJIEi5.tatsu-column{width: 100%;}}</style></div></div></div></div><div class="tatsu-section-background-wrap"><div class = "tatsu-section-background" ></div></div><div class="tatsu-overlay tatsu-section-overlay"></div><style>.tatsu-Hk3Rky84jq .tatsu-section-pad{padding: 90px 0px 90px 0px;}.tatsu-Hk3Rky84jq .tatsu-section-offset-wrap{transform: translateY(-0px);}.tatsu-Hk3Rky84jq > .tatsu-bottom-divider{z-index: 9999;}.tatsu-Hk3Rky84jq > .tatsu-top-divider{z-index: 9999;}.tatsu-Hk3Rky84jq .tatsu-section-overlay{mix-blend-mode: normal;}</style></div>


</div>

<?php get_footer(); ?>

