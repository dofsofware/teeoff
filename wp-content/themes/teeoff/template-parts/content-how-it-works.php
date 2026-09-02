<?php
defined( 'ABSPATH' ) || exit;

$steps = array(
	array( __( 'L\'utilisateur appelle un numéro', 'teeoff' ), __( "Un simple appel téléphonique, depuis n'importe quel type de téléphone.", 'teeoff' ) ),
	array( __( 'Il choisit le service souhaité', 'teeoff' ), __( 'Un menu vocal simple guide l\'utilisateur vers le service recherché.', 'teeoff' ) ),
	array( __( 'Il interagit avec le système vocal dans sa langue', 'teeoff' ), __( "L'interface vocale comprend et répond dans la langue locale de l'utilisateur.", 'teeoff' ) ),
	array( __( "Il accède au service ou à l'information recherchée", 'teeoff' ), __( "L'utilisateur obtient une réponse claire, utile et immédiate.", 'teeoff' ) ),
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
