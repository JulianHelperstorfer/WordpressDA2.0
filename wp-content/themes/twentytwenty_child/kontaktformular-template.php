<!--
  Ersteller: Julian Helperstorfer
  Erstellt am: 27.07.2022+11:00
  Geändert von:
  Geändert am:
  Beschreibung: Formular zur Kontaktaufnahme mit Feldern für Grundinformationen und Feld für die Nachricht
-->

<?php
/*
Template Name: Kontaktformular-Template
*/
?>




<style>


.submit {
  margin-top: 20px;
}

#g-recaptcha-response {
    display: block !important;
    position: absolute;
    margin: -78px 0 0 0 !important;
    width: 302px !important;
    height: 76px !important;
    z-index: -999999;
    opacity: 0;
}

</style>


<?php get_header(); ?>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script type="text/javascript">
    window.onload = function() {
            var $recaptcha = document.querySelector('#g-recaptcha-response');
            if($recaptcha) {
              $recaptcha.setAttribute("required", "required");
            }
          };
</script>


<!-- Julian Helperstorfer: Klasse zum Einlesen und in Variable laden von JSON-Datei für Übersetzung -->
<?php 
  class language {

    public $data;

    function __construct($language) {
        ini_set("allow_url_fopen", true);

        $filename = get_stylesheet_directory_uri() . "/" . $language . ".json";
  

        $this->data = json_decode(file_get_contents($filename));


    }

    function translate() {
          return $this->data;
    }
  }

?>

<div style="margin: 20px">

 
  <?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
 
 
  <div class="post page">
    <h2><?php the_title(); ?></h2>
    <?php the_content(); ?>
  </div>
 
 
  <?php endwhile; ?>
  <?php endif; ?>

 
  <!-- Julian Helperstorfer: Fehlerbehandlung -->
  <?php 
  /*if ( isset( $_GET['error1'] ) ) {
	  $error = sanitize_title( $_GET['error1'] );

	  switch ( $error ) {
		  case 'less' :
			  $message = __( 'We need a positive amount.', 'msk' );
			  break;

		  case 'much' :
			  $message = __( 'Thanks, but we do not need that much money.', 'msk' );
			  break;

		  default :
			  $message = __( 'Something went wrong.', 'msk' );
			  break;
	  }

	  printf( '<div class="error"><p>%1$s</p></div>', esc_html( $message ) );
  }*/?>

<!-- Julian Helperstorfer: Einlesen der JSON-Datei, je nach Sprachangabe, in $lang Variable -->
<?php
  $language = new language("de");
  $lang = $language->translate();

  //echo $lang->Actions->New;
?>
  <!-- Julian Helperstorfer: Formularelemente für grundlegende Daten -->
  <form action="#" method="POST" class="comment-form">

	  <?php wp_nonce_field( 'donation', 'check' ); 
    ?>

        <div id="container">

        <label for="anrede"><?php echo $lang->FormElements->Salutation . " *"; ?></label>
        <select name="anrede" id="anrede" required>
            <option value=""><?php echo $lang->FormElements->Choose; ?></option>
            <option value="H"><?php echo $lang->FormElements->Mr; ?></option>
            <option value="F"><?php echo $lang->FormElements->Mrs; ?></option>
            <option value="D"><?php echo $lang->FormElements->Diverse; ?></option>
            <option value="K"><?php echo $lang->FormElements->NoInformation; ?></option>
        </select>

        <label for="vorname"><?php echo $lang->FormElements->Name . " *"; ?></label>
        <input id="vorname" type="text" name="vorname" required/>

        <label for="nachname"><?php echo $lang->FormElements->Lastname . " *"; ?></label>
        <input id="nachname" type="text" name="nachname" required/>

        <label for="email"><?php echo $lang->FormElements->EMail . " *"; ?></label>
        <input id="email" type="text" name="email" required/>

        <label for="message"><?php echo $lang->FormElements->Message . " *"; ?></label>
        <textarea rows=20 cols=5 id="message" name="message" required></textarea>

        <div margin-top="20px" class="g-recaptcha" data-sitekey="6LeyIBwhAAAAAGikJCsoGI5qzEBD2kjkQImFbwD0"></div>

	    <input id="submit" type="submit" name="send_bewerbung" id="submit" class="submit" value="<?php esc_attr_e( 'Submit', 'msk' ); ?>" />
    </div>
  </form>
</div>

<?php get_footer(); ?>

