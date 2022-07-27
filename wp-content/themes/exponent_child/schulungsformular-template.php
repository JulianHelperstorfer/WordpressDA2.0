<!--
  Ersteller: Julian Helperstorfer
  Erstellt am: 14.07.2022+10:50
  Geändert von:
  Geändert am:
  Beschreibung: Formular zur Anmeldung von Schulungen, mit automatischem Befüllen von Schulungsdaten, grundlegenden Daten der Firma, möglichem Hinzufügen von mehreren Teilnehmern, Stornobedingungen und Datenschutzerklärung,
                eingebettetem ReCaptcha und CSS für die Buttons
-->

<?php
/*
Template Name: Schulungsformular-Template
*/
?>


<style>
/*Julian Helperstorfer: CSS für die Buttons zum Hinzufügen/Entfernen von Teilnehmern mit Animation */
.button {
  position: relative;
  background-color: #4CAF50;
  border: none;
  font-size: 28px;
  color: #FFFFFF;
  width: 80px;
  height: 40px;
  text-align: center;
  transition-duration: 0.4s;
  text-decoration: none;
  overflow: hidden;
  cursor: pointer;
}

.button:after {
  content: "";
  background: #f1f1f1;
  display: block;
  position: absolute;
  padding-top: 300%;
  padding-left: 350%;
  margin-left: -20px !important;
  margin-top: -120%;
  opacity: 0;
  transition: all 0.8s
}

.button:active:after {
  padding: 0;
  margin: 0;
  opacity: 1;
  transition: 0s
}

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


<div style="margin: 20px">

 
  <?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
 
 
  <div class="post page">
    <h2><?php the_title(); ?></h2>
    <?php the_content(); ?>
  </div>
 
 
  <?php endwhile; ?>
  <?php endif; ?>

  <?php 
    $maxAnzTeilnehmer = 12; 
    $curTeilnehmer = 1;
  ?>
 
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

    <!-- Julian Helperstorfer: Speichern der automatisch mitgegebenen Daten der Schulung in Variablen für automatisches Befüllen von Schulungsdaten-->
	  <?php wp_nonce_field( 'donation', 'check' ); 
      $event_name = $_GET['event_name'];
      $event_date = $_GET['event_date'];
      $event_venue = $_GET['event_venue'];
    ?>

	  <div id="container">
      <label for="schulung"><?php _e( 'Schulung'); ?></label>
      <input id="schulung" type="text" name="schulung" disabled="true" value="<?php echo $event_name; ?>"/>

      <label for="termin"><?php _e( 'Termin'); ?></label>
      <input id="termin" type="date" name="termin" disabled="true" value="<?php echo $event_date; ?>"/>

      <label for="schulungsort"><?php _e( 'Schulungsort'); ?></label>
      <input id="schulungsort" type="text" name="schulungsort" disabled="true" value="<?php echo $event_venue; ?>"/>

      <label for="firmenname"><?php _e( 'Firmenname *'); ?></label>     
      <input id="firmenname" type="text" name="firmenname" required/>

      <label for="firmentelefon"><?php _e( 'Firmentelefon *'); ?></label>
      <input id="firmentelefon" type="number" name="firmentelefon" required/>

      <label for="firmenemail"><?php _e( 'Firmen E-Mail *'); ?></label>
      <input id="firmenemail" type="text" name="firmenemail" required/>

      <label for="firmenanschrift"><?php _e( 'Firmenanschrift *'); ?></label>
      <input id="firmenanschrift" type="text" name="firmenanschrift" required/>



      <!-- Julian Helperstorfer: Generieren der Formularelemente für Teilnehmerdaten -->
      <h2 id="teilnehmerHeading">TeilnehmerInnen <?php echo "(".$curTeilnehmer."/".$maxAnzTeilnehmer.")" ?></h2>
      <button class="button" type="button" onclick="increase();">+</button>
      <button class="button" type="button" onclick="decrease();">-</button>

		
      <div id="teilnehmerliste">
        <?php $i = 0; ?>

        <!-- Julian Helperstorfer: Elemente des 1.Teilnehmer werden auf required gesetzt, weil min. 1 Teilnehmer angemeldet werden muss -->
        <div id="<?php echo $i ?>">
          <h3><?php echo $i+1 ?>.</h3>

          <label for="vorname"><?php _e( 'Vorname *'); ?></label>
          <input class="vorname" type="text" name="vorname" required/>

          <label for="nachname"><?php _e( 'Nachname *'); ?></label>
          <input class="nachname" type="text" name="nachname" required/>

          <label for="email"><?php _e( 'E-Email *'); ?></label>
          <input class="email" type="text" name="email" required/>
                       
        </div>
        <?php $i++ ?>
      
        <!-- Julian Helperstorfer: die restlichen Teilnehmer-Elemente werden generiert ohne auf required gesetzt zu werden -->
        <?php while($i < $maxAnzTeilnehmer){?>
          <div id="<?php echo $i ?>">
            <h3><?php echo $i+1 ?>.</h3>

            <label for="vorname"><?php _e( 'Vorname'); ?></label>
            <input class="vorname" type="text" name="vorname" />

            <label for="nachname"><?php _e( 'Nachname'); ?></label>
            <input class="nachname" type="text" name="nachname" />

            <label for="email"><?php _e( 'E-Email'); ?></label>
            <input class="email" type="text" name="email" />
                       
          </div>
        <?php $i++;} ?>


        <script type="text/javascript">
          currentTeilnehmer = 1;
          var maxTeiln = <?php echo json_encode($maxAnzTeilnehmer); ?>;

          //Julian Helperstorfer: Nur die Elemente für den 1. Teilnehmer sollten von Anfang an angezeigt werden, deshalb werden die Restlichen versteckt
          function disableAllButFirst(){
            for(i=1;i<maxTeiln;i++){                
              document.getElementById(i).style.display = "none";
            }
          }
  
          //Julian Helperstorfer: Durch Drücken des Plus-Buttons wird das nächste Element angezeigt und die Variable für die aktuelle Teilnehmer-Anzahl (zeigt auf nächstes Element) erhöht
          function increase(){
            if(currentTeilnehmer<maxTeiln){
              document.getElementById(currentTeilnehmer).style.display = "";
              currentTeilnehmer++;
              document.getElementById("teilnehmerHeading").innerHTML = `TeilnehmerInnen (${currentTeilnehmer}/${maxTeiln})`;
            }
          }

          //Julian Helperstorfer: aktuelle Teilnehmer-Anzahl wird verringert (um auf das aktuell letzte aktivierte Element zu zeigen) und das aktuell letzte aktivierte Element wird versteckt
          function decrease(){
            if(currentTeilnehmer>1){
              currentTeilnehmer--;
              document.getElementById(currentTeilnehmer).style.display = "none";
              document.getElementById("teilnehmerHeading").innerHTML = `TeilnehmerInnen (${currentTeilnehmer}/${maxTeiln})`;
            }
          }

          window.onload = function() {
            var $recaptcha = document.querySelector('#g-recaptcha-response');
            if($recaptcha) {
              $recaptcha.setAttribute("required", "required");
            }
          };

          //Julian Helperstorfer: beim Laden der Seite werden alle vorgenerierten Teilnehmer-Elemente bis auf das 1. versteckt
          disableAllButFirst();
        </script>

	    </div>
         
      <br>

      <input id="stornobedingungen" type="checkbox" name="stornobedingungen" required/>
      <label for="stornobedingungen"><?php _e( 'Ja, ich habe die <a href="stornobedingungen">Stornobedingungen</a> von moveIT Software gelesen. *'); ?></label>  
      <br>
      <input id="datenschutz" type="checkbox" name="datenschutz" required/>
      <label for="datenschutz"><?php _e( 'Ja, ich habe die <a href="datenschutzerklarung">Datenschutzbestimmungen</a> von moveIT Software gelesen und stimme den darin erläuterten Erhebungen, Verarbeitungen und Nutzungen meiner Daten zu. *'); ?></label>  

      <br>
      <br>

      <div margin-top="20px" class="g-recaptcha" data-sitekey="6LeyIBwhAAAAAGikJCsoGI5qzEBD2kjkQImFbwD0"></div>

	    <input id="submit" type="submit" name="send_donation" id="submit" class="submit" value="<?php esc_attr_e( 'Submit', 'msk' ); ?>" />
    </div>
  </form>
</div>

<?php get_footer(); ?>

