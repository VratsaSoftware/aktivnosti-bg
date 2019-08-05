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
        	$('#register_button').html('Регистрирай само потребител&nbsp;<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>').removeClass('btn-success').addClass('btn-warning');
        }
        else{
        	$('#register_button').html(registerButtonText).removeClass('btn-warning').addClass('btn-success');
        	
        }
    });

    //change register button text

    $('#activity').on('change',function() {
        if(!this.checked) {
            $('#button').html('Регистрирай само организация&nbsp;<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>').removeClass('btn-success').addClass('btn-warning');
        }
        else{
            $('#button').html('Продължи към стъпка 3&nbsp&nbsp;<span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span>').removeClass('btn-warning').addClass('btn-success');
        }
    });
