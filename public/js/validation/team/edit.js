$("#team_edit").validate({
    rules:{
        team_code: {
            required: true,
            minlength:3,
            digits: true
        },
        team_name: {
            required: true,
            minlength: 3
        }
    },
    
    errorElement: "em",
    errorPlacement: function ( error, element ) {
        // Add the `help-block` class to the error element
        error.addClass( "help-block" );
        error.addClass( "error-box-custom" );

        // Add `has-feedback` class to the parent div.form-group
        // in order to add icons to inputs
        element.parents( ".magic-span" ).addClass( "has-feedback" );

        if ( element.prop( "type" ) === "checkbox" ) {
            error.insertAfter( element.parent( "label" ) );
        } else {
            error.insertAfter( element );
        }

        // Add the span element, if doesn't exists, and apply the icon classes to it.
        if ( !element.next( "span" )[ 0 ] ) {
            var span = $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" );
            span.insertAfter( element );
        }
    },
    success: function ( label, element ) {
        // Add the span element, if doesn't exists, and apply the icon classes to it.
        if ( !$( element ).next( "span" )[ 0 ] ) {
            $( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
        }
    },
    highlight: function ( element, errorClass, validClass ) {
        $( element ).parents( ".magic-span" ).addClass( "has-error" ).removeClass( "has-success" );
        $( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
        $( element ).next( "span" ).next("em").addClass("error-box-custom");
    },
    unhighlight: function ( element, errorClass, validClass ) {
        $( element ).parents( ".magic-span" ).addClass( "has-success" ).removeClass( "has-error" );
        $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
        $( element ).next( "span" ).next("em").removeClass("error-box-custom");
    }
});

$.validator.setDefaults( {
    submitHandler: function (form) {
        form.submit();
    }
} );