try{
    var dataSet = [
        { Nombre: "Arroz Blanco", Moneda: "Colones", Impuesto: 13, Cabys: 611810000, Precio: 1000, Cantidad: 20 },
        { Nombre: "Azúcar", Moneda: "Colones", Impuesto: 13, Cabys: 611920000, Precio: 1000, Cantidad: 20 },
        { Nombre: "Leche", Moneda: "Colones", Impuesto: 13, Cabys: 611710000, Precio: 2000, Cantidad: 15 },
        { Nombre: "Huevos", Moneda: "Colones", Impuesto: 13, Cabys: 611820000, Precio: 500, Cantidad: 30 },
        { Nombre: "Plátanos", Moneda: "Colones", Impuesto: 13, Cabys: 611250000, Precio: 500, Cantidad: 10 },
        { Nombre: "Manzanas", Moneda: "Colones", Impuesto: 13, Cabys: 611400000, Precio: 1000, Cantidad: 5 },
        { Nombre: "Pasta de dientes", Moneda: "Colones", Impuesto: 13, Cabys: 611830000, Precio: 1500, Cantidad: 10 },
        { Nombre: "Papel higiénico", Moneda: "Colones", Impuesto: 13, Cabys: 611840000, Precio: 2000, Cantidad: 10 },
        { Nombre: "Jabón de manos", Moneda: "Colones", Impuesto: 13, Cabys: 611850000, Precio: 1000, Cantidad: 15 },
        { Nombre: "Atún enlatado", Moneda: "Colones", Impuesto: 13, Cabys: 611610000, Precio: 1000, Cantidad: 5 }
      ];
      
      

    var table;
    $(document).ready(function(){
        var table
        DatatableServicios()
    });
    
    function DatatableServicios() {
        $("#dtProductos").DataTable().destroy();

        table = $("#dtProductos").DataTable({
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
                    data: "Cantidad",
                    orderable: false,
                    sercheable: false
                },
                
                {
                    data: null,
                    "orderable": false,
                    render: function (data, type, row) {
                        let btn = '<button type="button" class="btn btn-outline-danger button-badge btnAcciones eliminarProducto" title="Eliminar"> <i class="fas fa-trash"></i>';
                        btn += " ";
                        btn += ' <button type="button" class="btn btn-outline-success button-badge btnAcciones editarProducto" title="Editar"> <i class="fas fa-pencil-alt"></i>'
                        btn += ' <button type="button" class="btn btn-outline-info button-badge btnAcciones ajusteInventario" title="Ajustar Inventario"> <i class="fas fa-file"></i>'
                        
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
                {
                    "targets": [6],
                    "width": "4%"
                },
                
                
                
            ]
            
            
           
        });

        $('#dtProductos').on('click', '.eliminarProducto', function () {
            var row = $(this).closest('tr');
            messageAsk("Eliminar Producto","¿Desea eliminar el producto?","question",EliminarProducto)
            function EliminarProducto(){
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
        let imp = $("#txtImpProducto").val() / 100;
        let precio = parseFloat($("#txtPrecioProducto").val());
        let totalImp = (precio * imp);
        $("#txtPrecioFinalProducto").val(0);
        $("#txtPrecioFinalProducto").val(precio + totalImp);
    }
    
    function ActualizarPrecioFinalImp(){
        let imp = $("#txtImpProducto").val() / 100;
        let precio = parseFloat($("#txtPrecioProducto").val());
        let totalImp = (precio * imp);
        $("#txtPrecioFinalProducto").val(0);
        $("#txtPrecioFinalProducto").val(precio + totalImp);
    }
    
    
}
catch (Exception){
    console.log('Ocurrió un error general')
}