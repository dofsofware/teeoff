<?php
defined( 'ABSPATH' ) || exit;

$steps = array(
	array( __( 'L\'utilisateur appelle un numero', 'teeoff' ), __( "Un simple appel telephonique, depuis n'importe quel type de telephone.", 'teeoff' ) ),
	array( __( 'Il choisit le service souhaite', 'teeoff' ), __( 'Un menu vocal simple guide l\'utilisateur vers le service recherche.', 'teeoff' ) ),
	array( __( 'Il interagit avec le systeme vocal dans sa langue', 'teeoff' ), __( "L'interface vocale comprend et repond dans la langue locale de l'utilisateur.", 'teeoff' ) ),
	array( __( "Il accede au service ou a l'information recherchee", 'teeoff' ), __( "L'utilisateur obtient une reponse claire, utile et immediate.", 'teeoff' ) ),
);
?>
<div class="steps-grid">
	<?php foreach ( $steps as $i => $step ) : ?>
		<div class="step-card">
			<span class="step-card__number"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
			<span class="step-card__icon"><?php echo teeoff_step_icon_svg( $i + 1 ); ?></span>
			<h3><?php echo esc_html( $step[0] ); ?></h3>
			<p><?php echo esc_html( $step[1] ); ?></p>
		</div>
	<?php endforeach; ?>
</div>
