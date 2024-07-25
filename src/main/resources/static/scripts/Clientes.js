try{
    
    $(document).ready( function() {
       
    });
    
    function AgregarCliente(){
        
        $("#frmAgregarCliente").validate({
            rules: {
                txtNombreClienteNuevo: {
                    required: true
                },
                ddlTipoCedula: {
                    required: true
                },
                txtCedulaClienteNuevo: {
                    required: true
                },
                txtTelefonoClienteNuevo: {
                    required: true
                },
                txtCorreoClienteNuevo: {
                    required: true,
                    email:true
                }
            },
            messages: {
                txtNombreClienteNuevo: {
                    required: "Ingrese el nombre del cliente"
                },
                ddlTipoCedula: {
                    required: "Seleccione un tipo de cédula"
                },
                txtCedulaClienteNuevo: {
                    required: "Ingrese la cédula del cliente"
                },
                txtTelefonoClienteNuevo: {
                    required: "Ingrese el teléfono del cliente"
                },
                txtCorreoClienteNuevo: {
                    required:"Ingrese el correo del cliente",
                    email: "Correo electrónico inválido"
                }
            }
            
        });
        
        if($("#chkTieneCredito").is(':checked')){
            $("#txtDiasCreditoClienteNuevo").rules('add', {required: true});
            $("#txtLimiteCreditoClienteNuevo").rules('add', {required: true});
        }
        else{
            $("#frmAgregarCliente").validate().resetForm();
            $("#txtDiasCreditoClienteNuevo").rules('remove', 'required');
            $("#txtLimiteCreditoClienteNuevo").rules('remove', 'required');
            $("#txtDiasCreditoClienteNuevo").removeClass("error");
            $("#txtLimiteCreditoClienteNuevo").removeClass("error");
        }
        
        if (!$("#frmAgregarCliente").valid()) {
            Toast("Debe completar todos los campos","warning")
            return;
        }
        else{
            
            let model = {
                nombre:$('#txtNombreClienteNuevo').val(),
                idTipoIdent:$('#ddlTipoCedula').val(),
                identificacion:$('#txtCedulaClienteNuevo').val(),
                telefono:$('#txtTelefonoClienteNuevo').val(),
                correo:$('#txtCorreoClienteNuevo').val(),
                facturaElectronicamente:$("#chkClienteFactura").is(':checked'),
                tieneCredito:$("#chkTieneCredito").is(':checked'),
                diasCredito:parseInt($('#txtDiasCreditoClienteNuevo').val()),
                limiteCredito: parseFloat($('#txtLimiteCreditoClienteNuevo').val()),
                situacionHacienda:$('#lblSituacion').text()
            };
            
            Toast('Registrando Cliente...','info')
            $.ajax({
                    url: '/facturacion/guardarCliente',
                    data: JSON.stringify(model),
                    type: 'POST',
                    contentType: "application/json",
                    success: function(status) {
                        
                        if(status == "success"){
                            Toast("Cliente incluido satisfactoriamente","success");
                            LimpiarCamposAgregarCliente();
                        }
                        else{
                            Toast("Ocurrió un error al registrar el cliente: " + status,"error");
                        }
                        
                    },
                    error: function(xhr, status, error) {
                        Toast('Ocurrió un error al registrar el cliente: ','error'); 
                    }
            });
        }
        
    }
    
    function BuscarClienteHacienda(){
        $("#frmBuscarCliente").validate({
            rules: {
                txtCedulaBuscarClienteNuevo: {
                    required: true,
                    minlength:9
                }
            },
        });
        
        if(!$("#frmBuscarCliente").valid()){
            Toast('Ingrese una identificación','warning');
        }
        else{
            let identificacion = $('#txtCedulaBuscarClienteNuevo').val();
            WaitingDialog("Buscando Cliente...");
            $.ajax({
                    url: 'https://api.hacienda.go.cr/fe/ae',
                    type: 'GET',
                    data: {
                            'identificacion': identificacion
                    },
                    success: function(response) {
                            Toast('Se han obtenido los datos','success');
                            
                            if(!response.situacion.estado){
                                $('#lblSituacion').removeAttr('hidden');   
                                $('#lblSituacion').text('Validar Estado')
                            }
                            else{
                                $('#lblSituacion').text(response.situacion.estado)
                                $('#lblSituacion').removeAttr('hidden');
                            }
                            
                            $("#txtNombreClienteNuevo").val(response.nombre);
                            $("#ddlTipoCedula").val(response.tipoIdentificacion);
                            $("#txtCedulaClienteNuevo").val(identificacion);
                    },
                    error: function(xhr, status, error) {
                        Toast('Ocurrió un error: ' + xhr.responseJSON.status,'error'); 
                    }
            });
        }
        
    }
    
    function TieneCreditoCliente(){
        if($("#chkTieneCredito").is(':checked')){
            $("#txtDiasCreditoClienteNuevo").attr('disabled',false);
            $("#txtLimiteCreditoClienteNuevo").attr('disabled',false);
            $("#txtDiasCreditoClienteNuevo").val();
            $("#txtLimiteCreditoClienteNuevo").val();
            
        }
        else{
            $("#txtDiasCreditoClienteNuevo").attr('disabled',true);
            $("#txtLimiteCreditoClienteNuevo").attr('disabled',true);
            $("#txtDiasCreditoClienteNuevo").val(0);
            $("#txtLimiteCreditoClienteNuevo").val(0);
        }
    }
    
    function LimpiarCamposAgregarCliente(){
        $("#txtCedulaBuscarClienteNuevo").val(""),
        $('#txtNombreClienteNuevo').val("");
        $('#ddlTipoCedula').val("");
        $('#txtCedulaClienteNuevo').val("");
        $('#txtTelefonoClienteNuevo').val("");
        $('#txtCorreoClienteNuevo').val("");
        $('#txtDiasCreditoClienteNuevo').val(0);
        $('#txtLimiteCreditoClienteNuevo').val(0);
        $('#lblSituacion').attr("hidden",true);
        $('#lblSituacion').text('');

    }
    
    
}

catch(error){
    console.log("Ocurrió un error general: " + error);
}