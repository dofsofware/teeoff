<?php
defined( 'ABSPATH' ) || exit;

$items = array(
	'accessible'         => array( __( 'Accessible', 'teeoff' ), __( 'Services accessibles depuis un telephone classique, sans application ni smartphone requis.', 'teeoff' ) ),
	'sans-internet'      => array( __( 'Sans Internet', 'teeoff' ), __( "Les utilisateurs n'ont pas necessairement besoin d'une connexion Internet pour acceder aux services.", 'teeoff' ) ),
	'multilingue'        => array( __( 'Multilingue', 'teeoff' ), __( 'Les services peuvent etre proposes dans plusieurs langues locales.', 'teeoff' ) ),
	'accessible-partout' => array( __( 'Accessible partout', 'teeoff' ), __( 'Possibilite de toucher aussi bien les populations urbaines que rurales.', 'teeoff' ) ),
	'simple'             => array( __( 'Simple', 'teeoff' ), __( "L'utilisation repose sur une interface vocale intuitive, sans courbe d'apprentissage.", 'teeoff' ) ),
);
?>
<div class="why-grid">
	<?php foreach ( $items as $key => $item ) : ?>
		<div class="why-card">
			<span class="why-card__icon"><?php echo teeoff_why_icon_svg( $key ); ?></span>
			<h3><?php echo esc_html( $item[0] ); ?></h3>
			<p><?php echo esc_html( $item[1] ); ?></p>
		</div>
	<?php endforeach; ?>
</div>
