$(function(reg) {

$.validator.addMethod("alphabetsnspace", function(value, element) {
        return this.optional(element) || /^[A-Za-zА-Яа-яЁё0-9]\S*$/i.test( value );
        }, "Это поле должно содержать только буквы и цифры" );

$.validator.addMethod("alphabetsnspace_add", function(value, element) {
        return this.optional(element) || /^\w\S+$/i.test(value);
    },"Это поле должно содержать не менее 6 символов");

$.validator.addMethod( "lettersonly", function( value, element ) {
            return this.optional( element ) || /^[A-Za-zА-Яа-яЁё]+$/i.test( value );
        }, "Это поле должно содержать только 2 буквы" );

    $("#reg").validate({
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
            conf_pass: {
                required: true,
                minlength: 6,
                equalTo: "#pass",
            },
            email: {
                required: true,
                email: true,
            },
            name: {
                required: true,
                minlength: 2,
                maxlength: 2,
                lettersonly: true,
            },
        },
    });

    $( document ).ready(function() {
        $("#regist").click(
            function(){
            sendAjaxForm('reg', 'check.php');
            return false; 
            }
        );
    });
    function sendAjaxForm(id_form, url) {
    jQuery.ajax({
        url:     "check.php", 
        type:     "POST", 
        dataType: "json", 
        data: jQuery("#"+id_form).serialize(),  
        success: function(response) { 
            return response.json();
            },
        error: function(response) { 
        }
    }); 
    }
});
    