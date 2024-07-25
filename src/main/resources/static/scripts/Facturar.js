
try {

    $(document).ready(function () {
        $("#divUsaCredito").hide();
        var table;
        DatatableDetalles();
    });

    function DatatableDetalles(){
        $("#dtDetalles").DataTable().destroy();
        table = $("#dtDetalles").DataTable({
            "stateSave": false,
            "info": "",
            "language": {"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"},
            "scrollY": '100%',
            "scrollCollapse": true,
            "processing": true,
            "ordering": false,
            "paging": false,
            "searching": false,
            "autoWidth": true,
            "deferRender": true,
            "destroy": true,
            "order": [[1, "asc"], [2, 'desc']],
            "columns": [
                 {
                     data: "Cantidad",
                    "orderable": false,
                    render: function (data, type, row) {
                        let ipt = '<input class="form-control cantidad-input" value ='+ row.Cantidad +'>' 
                        return ipt;
                    }
                },
                
                {
                    data:"Descripcion",
                    "orderable": false,
                    render: function (data, type, row) {
                        
                        let ipt = '<input class="form-control" value="'+ row.Descripcion.replace(/-/g, " ") +'">';
                        return ipt;
                    }
                },
                
                {
                    data:"PrecioUnitario",
                    "orderable": false,
                    render: function (data, type, row) {
                        let ipt = '<input class="form-control precio-unitario-input" value ='+ row.PrecioUnitario +'>' 
                        return ipt;
                    }
                },
                
                {
                    data:"ImpuestoUnitario",
                    render: function (data, type, row) {
                        let ipt = '<input class="form-control impuesto-input" disabled value ='+ row.ImpuestoUnitario +'>' 
                        return ipt;
                    }
                },
                
                {
                    data:"PrecioConImpuesto",
                    render: function (data, type, row) {
                        let ipt = '<input class="form-control precioConImpuesto-input" value ='+ row.PrecioConImpuesto +'>' 
                        return ipt;
                    }
                },
                
                {
                    data: "TotalFinal",
                    render: function (data, type, row) {
                        let ipt = '<input class="form-control total-final-input" value ='+ row.TotalFinal +'>' 
                        return ipt;
                    }
                },
                
                {
                    //Acciones
                    data: null,
                    "orderable": false,
                    render: function (data, type, row) {
                        let btn = '<button type="button" class="btn btn-outline-danger button-badge eliminarLinea" title="Eliminar Línea"> <i class="fas fa-trash"></i>';
                       
                        return btn;
                    }
                },
                {
                    data: 'TarifaImpuesto',
                    render: function (data, type, row) {
                        let ipt = '<input  class="form-control impuestoValor" value ='+ (row.TarifaImpuesto) / 100  +'>' 
                        return ipt;
                    }
                },
                {
                    data: 'Cabys',
                    render: function (data, type, row) {
                        let ipt = '<input  class="form-control codigoCabys" value ='+ row.Cabys +'>' 
                        return ipt;
                    }
                },
                {
                    data: 'IdMoneda',
                    render: function (data, type, row) {
                        let ipt = '<input  class="form-control idMonedaDetalle" value ='+ row.IdMoneda  +'>' 
                        return ipt;
                    }
                },
                {
                    data: 'IdDetalle',
                    render: function (data, type, row) {
                        let ipt = '<input  class="form-control idDetalle" value ='+ row.IdDetalle  +'>' 
                        return ipt;
                    }
                },
                

            ],
            
            "columnDefs": [
                {
                    //Cantidad
                    "targets": [0],
                    "width": "2%"
                },
                {
                    //Descripción
                    "targets": [1],
                    "width": "10%"
                },
                {
                    //Precio Unitario
                    "targets": [2],
                    "width": "4%"
                },
                {
                    //Impuesto Unitario
                    "targets": [3],
                    "width": "4%"
                },
                {
                    //Precio con Impuesto
                    "targets": [4],
                    "width": "4%"
                },
                {
                    //Total Final
                    "targets": [5],
                    "width": "4%"
                },
                {
                    //Acciones
                    "targets": [6],
                    "width": "2%"
                    
                },
                {
                    //Tarifa Iva, Cabys, Moneda, IdDetalle
                    "targets": [7,8,9,10],
                    "width": "1%",
                    "class": "hide_me"
                    
                    
                }
                
            ]
        
        });
        
        $('#dtDetalles').on('click', '.eliminarLinea', function () {
            var row = $(this).closest('tr');
            table.row(row).remove().draw();
        });
        
        $('#dtDetalles tbody').on('keyup', '.cantidad-input', function () {
            let cantidad = $(this).val();
            let precioUnitario = Number($(this).closest('tr').find('.precio-unitario-input').val());
            let impuesto = $(this).closest('tr').find('.impuesto-input').val();
            let precioConImp = $(this).closest('tr').find('.precioConImpuesto-input').val();
            let total = $(this).closest('tr').find('.total-final-input').val();
            let impuestoValor = Number($(this).closest('tr').find('.impuestoValor').val());
            
            if (cantidad > 0 || cantidad == ""){
                let calcPrecioXCant = Number(precioUnitario * cantidad);
                let calcImp = calcPrecioXCant * impuestoValor;
                let calcPrecioFinal = calcPrecioXCant + Number(calcImp);
                let calcImpUnitario = precioUnitario * Number(impuestoValor);
                let impUnitario = precioUnitario + Number(calcImpUnitario);
                
                $(this).closest('tr').find('.precioConImpuesto-input').val(impUnitario);
                $(this).closest('tr').find('.impuesto-input').val(calcImpUnitario);
                $(this).closest('tr').find('.total-final-input').val(calcPrecioFinal);
                
            }
            else{
                $(this).closest('tr').find('.total-final-input').val(0);  
            }
        }); 
        
        $('#dtDetalles tbody').on('keyup', '.precio-unitario-input', function () {
            var row = $(this).closest("tr");
            let cantidad = $(this).closest('tr').find('.cantidad-input').val();
            let precioUnitario = Number($(this).val());
            let impuesto = $(this).closest('tr').find('.impuesto-input').val();
            let precioConImp = $(this).closest('tr').find('.precioConImpuesto-input').val();
            let total = $(this).closest('tr').find('.total-final-input').val();
            let impuestoValor = Number($(this).closest('tr').find('.impuestoValor').val());
            
            if (cantidad > 0 || cantidad == ""){
                let calcPrecioXCant = Number(precioUnitario * cantidad);
                let calcImp = calcPrecioXCant * impuestoValor;
                let calcPrecioFinal = calcPrecioXCant + Number(calcImp);
                let calcImpUnitario = precioUnitario * Number(impuestoValor);
                let impUnitario = precioUnitario + Number(calcImpUnitario);
                
                $(this).closest('tr').find('.precioConImpuesto-input').val(impUnitario);
                $(this).closest('tr').find('.impuesto-input').val(calcImpUnitario);
                $(this).closest('tr').find('.total-final-input').val(calcPrecioFinal);
                
               
            }
            else{
                $(this).closest('tr').find('.total-final-input').val(0);  
            }
        });
        
        table.columns.adjust().draw();
        
        
    }




    function ValidarAgregarLinea(){
        var tb = table.column(2).data();
        if (tb.length === 0) {
            AgregarLinea();
        } 
        else {
            let lista = $("#ddlDetalles").val();
            let arrDetalles = lista.split(";");
            let idMoneda = arrDetalles[3];
            let idMonedaValid = true;
            
            $('#dtDetalles tbody tr').each(function() {
                var monedaRow = $(this).closest('tr').find('.idMonedaDetalle').val()

                if (monedaRow != idMoneda) {
                    Toast("No puede ingresar un detalle con la moneda diferente","error");
                    idMonedaValid = false;
                    return false; 
                }
           
            });
            
            if(idMonedaValid){
                AgregarLinea();
            }
            
        }
        
    }

    function AgregarLinea() {
        let lista = $("#ddlDetalles").val()
        if (!lista) {
            Toast("Ingrese un detalle", "warning")
        } else {
            let arrDetalles = lista.split(";");
            let cantidad = 1;
            let descDetalle = arrDetalles[0].toString();
            let precioUnitario = Number(arrDetalles[1]);
            let tarifaImpuesto = Number(arrDetalles[2]); //1,2,4,8,13 %
            let impuestoUnitario = Number(precioUnitario * (tarifaImpuesto / 100));
            let precioConImpuesto = precioUnitario + (precioUnitario * (tarifaImpuesto / 100));
            let idMoneda = arrDetalles[3];
            let cabys = arrDetalles[4];
            let tipoDetalle = arrDetalles[5];
            let idDetalle = arrDetalles[6];

            let obj = {
                Cantidad: cantidad,
                Descripcion: descDetalle,
                PrecioUnitario: precioUnitario,
                ImpuestoUnitario: impuestoUnitario,
                PrecioConImpuesto: precioConImpuesto,
                TotalFinal: precioConImpuesto * cantidad,
                TarifaImpuesto: tarifaImpuesto,
                Cabys: cabys,
                IdMoneda: idMoneda,
                IdDetalle: idDetalle
            }


            table.row.add(obj);

            table.draw();
            //SumarDetalles();
        }


    }

//    function SumarDetalles(){
//        var subtotal = 0;
//        var data = table.rows().data();
//        for (var i = 0; i < data.length; i++) {
//          subtotal += parseFloat(data[i].PrecioUnitario);
//        }
//        $("#txtSubtotal").val(subtotal)
//    }
    
    function ObtenerDetalles() {
        let idMoneda = $("#ddlMoneda").val();

        if (idMoneda == "") {
            $("#ddlDetalles").empty();

        } else {

            let url = '/facturacion/detalles';
            let params = {
                "idMoneda": idMoneda
            }

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                data: params,
                contentType: 'application/json; charset=utf-8',
                success: function (data) {
                    $("#ddlDetalles").empty();

                    $.each(data, function (index, value) {
                        $('.catDetallesFactura').append($("<option></option>").val(value.nombre.replace(/ /g, "-") + ";" + value.precio + ";" + value.porcentajeImp + ";" + value.idMoneda + ";" + value.cabys + ";" + value.tipo_detalle + ";" + value.idDetalle).html(value.nombre));
                    });

                },

                error: function (xhr, status, error) {
                    Toast('Ocurrió un error obteniendo los detalles: ', 'error');
                }
            });
        }
    }

    function UsaCredito() {
        if ($("#chkUsaCredito").is(':checked')) {
            $("#divUsaCredito").show();
        } else {
            $("#divUsaCredito").hide();
        }
    }

    function ModalNuevoCliente() {
        $("#modalClienteAgregar").toggle();
    }

} catch (Exception) {
    Toast('Ocurrió un error general', 'error');
}