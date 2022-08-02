<!--
  Ersteller: Julian Helperstorfer
  Erstellt am: 26.07.2022+08:10
  Geändert von:
  Geändert am:
  Beschreibung: Formular zum Bewerben eines Jobs, mit Feldern für grundlegende Informationen des Bewerbers, Auswahlfeldern für Bildungsabchluss und Berufserfahrung, Auswahlmöglichkeiten von beherrschten Programmiersprachen
                und Upload-Feldern für Lebenslauf und weitere Dokumente
-->

<?php
/*
Template Name: Bewerbungsformular-Template
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

#platzhalter {
    height: 20px;
    width: 100px;
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


  <!-- Julian Helperstorfer: Formularelemente für grundlegende Daten -->
  <form action="#" method="POST" class="comment-form">

	  <?php wp_nonce_field( 'donation', 'check' ); 
    ?>

        <div id="container">

        <label for="anrede"><?php _e( 'Anrede *'); ?></label>
        <select name="anrede" id="anrede" required>
            <option value="">Auswählen...</option>
            <option value="H">Herr</option>
            <option value="F">Frau</option>
            <option value="D">Divers</option>
            <option value="K">keine Angabe</option>
        </select>

        <label for="vorname"><?php _e( 'Vorname *'); ?></label>
        <input id="vorname" type="text" name="vorname" required/>

        <label for="nachname"><?php _e( 'Nachname *'); ?></label>
        <input id="nachname" type="text" name="nachname" required/>

        <label for="email"><?php _e( 'E-Mail *'); ?></label>
        <input id="email" type="text" name="email" required/>

        <label for="berufserfahrung"><?php _e( 'Bisherige Berufserfahrung *'); ?></label>
        <select name="berufserfahrung" id="berufserfahrung" required>
            <option value="">Auswählen...</option>
            <option value="S">StudentIn</option>
            <option value="B">BerufseinsteigerIn</option>
            <option value="1">1-2 Jahre</option>
            <option value="3">3-5 Jahre</option>
            <option value="6">6-10 Jahre</option>
            <option value="11">11-15 Jahre</option>
            <option value="16">16 Jahre und mehr</option>
        </select>

        <label for="bildungsabschluss"><?php _e( 'Höchster Bildungsabschluss *'); ?></label>
        <select name="bildungsabschluss" id="bildungsabschluss" required>
            <option value="">Auswählen...</option>
            <option value="A">AHS-Matura</option>
            <option value="L">Lehrabschluss</option>
            <option value="BM">BHS-Matura (HAK, HBLW, HTL, ...)</option>
            <option value="BA">Bachelor Abschluss</option>
            <option value="M">Master-Abschluss</option>
            <option value="D">Doktorat</option>
            <option value="K">keiner der oben genannten</option>
            <option value="P">Pflichtschulabschlus</option>
        </select>

        <!--<label for="programmiersprachen[]"><?php _e( 'Programmiersprachen (Strg benutzen um mehrere auszuwählen)'); ?></label>
        <select multiple name="programmiersprachen[]">
            <option value="J">Java</option>
            <option value="P">Progress ABL</option>
            <option value="T">TypeScript</option>
            <option value="JS">JavaScript</option>
            <option value="C">C</option>
            <option value="C++">C++</option>
            <option value="C#">C#</option>
            <option value="V">Viual Basic</option>
        </select>-->

        <label for="programmiersprachen"><?php _e( 'Programmiersprachen'); ?></label>
        <div id=programmiersprachen>
            <input id="Java" type="checkbox" name="java"/>
            <label for="java"><?php _e( 'Java'); ?></label>  
            <br>
            <input id="progressabl" type="checkbox" name="progressabl"/>
            <label for="progressabl"><?php _e( 'Progress ABL'); ?></label>  
            <br>
            <input id="typeScript" type="checkbox" name="typeScript"/>
            <label for="typeScript"><?php _e( 'TypeScript'); ?></label>  
            <br>
            <input id="javascript" type="checkbox" name="javascript"/>
            <label for="javascript"><?php _e( 'JavaScript'); ?></label>  
            <br>
            <input id="c" type="checkbox" name="c"/>
            <label for="c"><?php _e( 'C'); ?></label>  
            <br>
            <input id="cplusplus" type="checkbox" name="cplusplus"/>
            <label for="cplusplus"><?php _e( 'C++'); ?></label>  
            <br>
            <input id="csharp" type="checkbox" name="csharp"/>
            <label for="csharp"><?php _e( 'C#'); ?></label>  
            <br>
            <input id="visualbasic" type="checkbox" name="visualbasic"/>
            <label for="visualbasic"><?php _e( 'Visual Basic'); ?></label>  
        </div>

        <label for="sonstige"><?php _e( 'Sonstige Programmiersprachen: (mit "," trennen falls Sie mehrere angeben möchten)'); ?></label>
        <input id="sonstige" type="text" name="sonstige"/>

        <label for="lebenslauf"><?php _e( 'Lebenslauf'); ?></label>
        <input id="lebenslauf" type="file" name="lebenslauf" required/>

        <label for="unterlagen"><?php _e( 'Weitere Unterlagen (Zeugnis, Bewerbungsschreiben, ...)'); ?></label>
        <input id="unterlagen" type="file" name="unterlagen"/>

        <div class="platzhalter"></div>

        <div margin-top="20px" class="g-recaptcha" data-sitekey="6LeyIBwhAAAAAGikJCsoGI5qzEBD2kjkQImFbwD0"></div>

	    <input id="submit" type="submit" name="send_bewerbung" id="submit" class="submit" value="<?php esc_attr_e( 'Submit', 'msk' ); ?>" />
    </div>
  </form>
</div>

<?php get_footer(); ?>

