<style type="text/css">
    .form-control-feedback{
        pointer-events: all;
        cursor:pointer;
    }
    em{
        position: absolute !important;
    }
    em.error-box-custom{
        right: 0;
        top: -37px;
        width: auto;
        border-radius: 3px;
        padding: 5px;
        color:#fff !important;
        background-color: #a94442;
    }
</style>
<div class="row">
    <div class="col-xs-12">
        <div class="col-md-12">
            <h2>Editar perfil</h2>
        </div>
        <form id="worker_profile" role="form" action="" method="POST">
            <div class="form-group col-md-6 col-xs-12">
                <label class="control-label" for="worker_username">Usuario:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_username" id="worker_username" value="<?php echo $data['worker']->getUsername()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label class="control-label" for="worker_nif">NIF:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_nif" id="worker_nif" value="<?php echo $data['worker']->getNif()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label class="control-label" for="worker_password">Contraseña:</label>
                <div class="magic-span">
                    <input type="password" class="form-control" name="worker_password" id="worker_password" value="<?php echo $data['worker']->getPassword()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label class="control-label" for="worker_re_password">Confirmar contraseña:</label>
                <div class="magic-span">
                    <input type="password" class="form-control" name="worker_re_password" id="worker_re_password" value="<?php echo $data['worker']->getPassword()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label class="control-label" for="worker_name">Nombre:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_name" id="worker_name" value="<?php echo $data['worker']->getName()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label class="control-label" for="worker_surname">Apellido:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_surname" id="worker_surname" value="<?php echo $data['worker']->getSurname()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label class="control-label" for="worker_mobile">Mobile:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_mobile" id="worker_mobile" value="<?php echo $data['worker']->getMobile()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label class="control-label" for="worker_telephone">Teléfono:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_telephone" id="worker_telephone" value="<?php echo $data['worker']->getTelephone()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label class="control-label" for="worker_category">Categoría:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_category" id="worker_category" value="<?php echo $data['worker']->getCategory()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
            <label>Equipo:</label>
            <label class="form-control"><?php echo $data['worker']->getTeam()->getName(); ?></label>
            </div>
            
            <div class="col-xs-12">
                <input type="submit" class="btn btn-primary" value="Editar" name="worker_edit">
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $("#worker_profile").validate({
        rules:{
            worker_username: {
                required: true
            },
            worker_nif: {
                required: true
            },
            worker_password: {
                required: true
            },
            worker_re_password: {
                required: true
            },
            worker_name: {
                required: true
            },
            worker_surname: {
                required: true
            },
            worker_mobile: {
                required: true
            },
            worker_telephone: {
                required: true
            },
            worker_category: {
                required: true
            }
        },
        messages:{
            worker_username: "Por favor, el campo no puede estar vacio."
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
                span.mouseover(function(){
                    console.log("mamita");
                });
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
</script>
<?php
if (isset($data)) {
    if (array_key_exists("error", $data)) {
        echo '<div class="alert alert-danger" role="alert"><ul>';
        foreach ($data["error"] as $key => $error) {
            echo "<li>" . $error . "</li>";
        }
        echo '</ul></div>';
    }
}
?>