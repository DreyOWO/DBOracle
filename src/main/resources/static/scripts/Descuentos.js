$(document).ready(function() {
    // define dataset
    var dataset = [
      {
        nombre: "Descuento 1",
        progreso: "1/5",
        proxima_recompensa: "5%",
        acciones: '<button class="btn btn-success"><i class="fas fa-pen"></i></button><button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>'
    },
      {
        nombre: "Descuento 2",
        progreso: "3/5",
        proxima_recompensa: "5%",
        acciones: '<button class="btn btn-success"><i class="fas fa-pen"></i></button><button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>'
    },
      {
        nombre: "Descuento 3",
        progreso: "6/7",
        proxima_recompensa: "10%",
        acciones: '<button class="btn btn-success"><i class="fas fa-pen"></i></button><button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>'
    }
    ];
  
    // initialize DataTable
    var table = $("#dtDescuentos").DataTable({
      data: dataset,
      columns: [
        { data: "nombre" },
        { data: "progreso" },
        { data: "proxima_recompensa" },
        { data: "acciones" }
      ]
    });
  });
  