$(function(auth) {

$.validator.addMethod("alphabetsnspace", function(value, element) {
        return this.optional(element) || /^[A-Za-zА-Яа-яЁё0-9]\S*$/i.test( value );
        }, "Это поле должно содержать только буквы и цифры" );

$.validator.addMethod("alphabetsnspace_add", function(value, element) {
        return this.optional(element) || /^\w\S+$/i.test(value);
    },"Это поле должно содержать не менее 6 символов");

    $("#auth").validate({
        rules: {
            login: {
                required: true,
                minlength: 6,
                alphabetsnspace_add: true,
            },
            pass: {
                required: true,
                minlength: 6,
                alphabetsnspace: true,
            },
        },
    });

    $( document ).ready(function() {
    $("auth_user").click(
        function(){
            sendAjaxAuth('auth', 'auth.php');
            return false; 
        }
        );
    });

    function sendAjaxAuth(id_form, url) {
    jQuery.ajax({
        url:     "auth.php", 
        type:     "POST", 
        dataType: "json", 
        data: jQuery("#"+id_form).serialize(),  
        success: function(response) { 
            return response.json();
        },
        error: function(response) { 
        },

    }); 
 }

});