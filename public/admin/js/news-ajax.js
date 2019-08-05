$( function () {
	var url = $( "#organization_select option:selected" ).attr( 'data-url' );
	getActivities( url );
} );

$( '#organization_select' ).on( 'change', function () {
	var url = $( "#organization_select option:selected" ).attr( 'data-url' );
	getActivities( url );
} );

function getActivities( url ) {
	$.ajax( {
		headers: {
			'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
		},
		type: "GET",
		url: url,
		success: function ( data, textStatus, xhr ) {
			$( '#activity_id' ).find( 'option' ).remove();
			$.each( data, function ( k, v ) {
				if(v.activity_id == 0){
					$( '#activity_id' ).append( '<option value="' + v.activity_id + '" selected="true" disabled="disabled">' + v.name + '</option>' );
				}
				else{
					$( '#activity_id' ).append( '<option value="' + v.activity_id + '">' + v.name + '</option>' );
				}
			} );
		}
	} );
}

