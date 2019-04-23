$( function () {
	var url = $( "#category_select option:selected" ).attr( 'data-url' );
	getSubCategories( url );
} );

$( '#category_select' ).on( 'change', function () {
	var url = $( "#category_select option:selected" ).attr( 'data-url' );
	getSubCategories( url );
} );

function getSubCategories( url ) {
	$.ajax( {
		headers: {
			'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
		},
		type: "GET",
		url: url,
		success: function ( data, textStatus, xhr ) {
			$( '#subcategory_id' ).find( 'option' ).remove();
			$.each( data, function ( k, v ) {
				$( '#subcategory_id' ).append( '<option value="' + v.subcategory_id + '">' + v.name + '</option>' );
			} );
		}
	} );
}