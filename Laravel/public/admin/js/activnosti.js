//Delete confirmation
function ConfirmDelete(user) {
    var x = confirm("Сигурни ли сте че искате да изтриете "+(user ? user : '')+" ?");
    if (x)
      return true;
    else
      return false;
}  

//change register button text
	var registerButtonText = $('#register_button').html();
    $( 'select[name="organization"]').on('change',function() {
        var selectedOrgOption = ($( 'select[name="organization"]').find(":selected").val());
        // var registerButtonText = $('#register_button').html();
        if(selectedOrgOption != 0){
        	$('#register_button').html('Регистрирай се&nbsp;<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>').removeClass('btn-warning').addClass('btn-success');
        }
        else{
        	$('#register_button').html(registerButtonText).removeClass('btn-success').addClass('btn-warning');
        	
        }
    });
