
$(document).ready(function(c) {

    $('#form_login').submit(function(){

        var key  = $('#key').val();
        var pass = $('#password').val();
        var hash = md5(pass+key);

        $('#password').val(hash);
        
    });

});
