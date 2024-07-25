try{
    var dataSet = [
        { Nombre: "Servicios Profesionales", Moneda: "Colones", Impuesto: 13, Cabys: 8399000000000, Precio: 1000 },
        { Nombre: "Electricista", Moneda: "Colones", Impuesto: 13, Cabys: 8399000000001, Precio: 1000 },
        { Nombre: "Mantenimiento de jardines", Moneda: "Colones", Impuesto: 15, Cabys: 811016000, Precio: 25000 },
        { Nombre: "Servicios de limpieza", Moneda: "Dólares", Impuesto: 10, Cabys: 721015000, Precio: 50 },
        { Nombre: "Servicios de contabilidad", Moneda: "Colones", Impuesto: 13, Cabys: 691010000, Precio: 50000 },
        { Nombre: "Servicios de diseño gráfico", Moneda: "Dólares", Impuesto: 10, Cabys: 841112000, Precio: 200 },
        { Nombre: "Servicios de traducción", Moneda: "Euros", Impuesto: 21, Cabys: 921109000, Precio: 100 },
        { Nombre: "Servicios de fontanería", Moneda: "Colones", Impuesto: 13, Cabys: 839907000, Precio: 30000 },
        { Nombre: "Servicios de carpintería", Moneda: "Colones", Impuesto: 13, Cabys: 839904000, Precio: 40000 },
        { Nombre: "Servicios de programación", Moneda: "Dólares", Impuesto: 10, Cabys: 851410000, Precio: 1000 }
      ];
      

    var table;
    $(document).ready(function(){
        DatatableServicios();
      
      
    });
    
    function DatatableServicios() {
        $("#dtServicios").DataTable().destroy();

        table = $("#dtServicios").DataTable({
            stateSave: true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json",
                
            },
            "scrollY": '270px',
            "scrollCollapse": true,
            "processing": true,
            "ordering": true,
            "paging": false,
            "searching": true,
            "pageLength": 10,
            "autoWidth": true,
            "deferRender": true,
            "order": [[1, "asc"], [2, 'desc']],
            "data": dataSet,
            "columns": [
                 {
                    data: "Nombre",
                    orderable: false,
                },
                
                {
                    data: "Moneda",
                    orderable: false,
                    sercheable: false
                },
                
                {
                    data: "Impuesto",
                    orderable: false,
                    sercheable: false
                },
                
                {
                    data: "Cabys",
                    orderable: false,
                    sercheable: false
                },
                
                {
                    data: "Precio",
                    orderable: false,
                    sercheable: false
                },
                
                {
                    data: null,
                    "orderable": false,
                    render: function (data, type, row) {
                        let btn = '<button type="button" class="btn btn-outline-danger button-badge btnAcciones eliminarServicio" title="Eliminar"> <i class="fas fa-trash"></i>';
                        btn += " ";
                        btn += ' <button type="button" class="btn btn-outline-success button-badge btnAcciones editarServicio" title="Editar"> <i class="fas fa-pencil-alt"></i>'
                        
                        return btn;
                    }
                }

            ],
            
            "columnDefs": [
                {
                    "targets": [0],
                    "width": "10%"
                },
                {
                    "targets": [1],
                    "width": "2%"
                },
                {
                    "targets": [2],
                    "width": "4%"
                },
                {
                    "targets": [3],
                    "width": "4%"
                },
                {
                    "targets": [4],
                    "width": "4%"
                },
                {
                    "targets": [5],
                    "width": "4%"
                },
                
                
                
            ]
            
            
           
        });

        $('#dtServicios').on('click', '.eliminarServicio', function () {
            var row = $(this).closest('tr');
            messageAsk("Eliminar Servicio","¿Desea eliminar el servicio?","question",EliminarServicio)
            function EliminarServicio(){
                table.row(row).remove().draw();
            }
        });
        
        
        table.columns.adjust().draw();
    
    }
    
    function messageAsk(title,message,type,callbackFunc){
        Swal.fire({
            title: title,
            text: message,
            icon: type,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No',
            confirmButtonText: 'Sí'
            }).then((result) => {
            if (result.isConfirmed) {
              callbackFunc();
            }
          })
    }  
    
    function ActualizarPrecioFinal(){
        let imp = $("#txtImpServicio").val() / 100;
        let precio = parseFloat($("#txtPrecioServicio").val());
        let totalImp = (precio * imp);
        $("#txtPrecioFinalServicio").val(0);
        $("#txtPrecioFinalServicio").val(precio + totalImp);
    }
    
    function ActualizarPrecioFinalImp(){
        let imp = $("#txtImpServicio").val() / 100;
        let precio = parseFloat($("#txtPrecioServicio").val());
        let totalImp = (precio * imp);
        $("#txtPrecioFinalServicio").val(0);
        $("#txtPrecioFinalServicio").val(precio + totalImp);
    }
    
    
}
catch (Exception){
    console.log('Ocurrió un error general')
}