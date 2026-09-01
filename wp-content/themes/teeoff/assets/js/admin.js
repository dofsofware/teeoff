(function ($) {
	'use strict';

	$( document ).on( 'click', '.teeoff-image-field__choose', function ( e ) {
		e.preventDefault();
		var $field = $( this ).closest( '.teeoff-image-field' );
		var $input = $field.find( '.teeoff-image-field__input' );
		var $preview = $field.find( '.teeoff-image-field__preview' );
		var $img = $preview.find( 'img' );
		var $remove = $field.find( '.teeoff-image-field__remove' );

		var frame = wp.media( {
			title: 'Choisir une image',
			button: { text: 'Utiliser cette image' },
			multiple: false,
		} );

		frame.on( 'select', function () {
			var attachment = frame.state().get( 'selection' ).first().toJSON();
			var url = ( attachment.sizes && attachment.sizes.medium ) ? attachment.sizes.medium.url : attachment.url;
			$input.val( attachment.id );
			$img.attr( 'src', url );
			$preview.show();
			$remove.show();
		} );

		frame.open();
	} );

	$( document ).on( 'click', '.teeoff-image-field__remove', function ( e ) {
		e.preventDefault();
		var $field = $( this ).closest( '.teeoff-image-field' );
		$field.find( '.teeoff-image-field__input' ).val( '' );
		$field.find( '.teeoff-image-field__preview' ).hide();
		$( this ).hide();
	} );
})( jQuery );
