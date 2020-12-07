$(document).ready(function() {
    var id, opcion;
    opcion = 4;
    tablaPersonas = $('#tablaPersonas').DataTable({
        "ajax":{
            "url":"bdd/crud.php",
            "method":'POST',
            "data":{opcion:opcion},
            "dataSrc":""
        },
        "columns":[
            {"data": "id"},
            {"data": "nombre"},
            {"data": "pais"},
            {"data": "edad"},
            {"defaultContent":
            "<div class='text-center'>"+
            "<div class='btn-group'><button style='font-size:80%; margin:2px;' class='btn btn-primary btnEditar'><span class='material-icons'>edit</span></button>"+
            "<button style='font-size:80%; margin:2px;' class='btn btn-danger btnBorrar'><span class='material-icons'>delete</span></button></div></div>"
            }
        ],
        //para cambiar al lenguaje espeñol
        "language":{
            "url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            /*
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrando de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate":{
                "sFirst":"Primero",
                "sLast":"Ultimo",
                "sNext":"Siguiente",
                "sPrevious":"Anterior"
            },
            "sProcessing":"Procesando...",
            */
        }
    });

$("#btnNuevo").click(function(){
    id=null;
    opcion = 1;//alta
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Persona");
    $("#modalcrud1").modal("show");

});

var fila; //capturar la fila para editar o borrar el registro

//boton EDITAR
$(document).on("click", ".btnEditar",function(){
 opcion = 2; //Editar
 fila = $(this).closest("tr");
 id = parseInt(fila.find('td:eq(0)').text());
 nombre = fila.find('td:eq(1)').text();
 pais = fila.find('td:eq(2)').text();
 edad = parseInt(fila.find('td:eq(3)').text());

 $("#nombre").val(nombre);
 $("#pais").val(pais);
 $("#edad").val(edad);
$(".modal-header").css("background-color", "#007bff");
$(".modal-header").css("color", "white");
$(".modal-title").text("Editar Persona");
$("#modalcrud1").modal("show");
});
//boton BORRAR
$(document).on("click", ".btnBorrar",function(){
    opcion = 3; //borrar
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    //var respuesta = confirm("¿Estas seguro de eliminar el registro:"+id+"?");
    $(".modal-title").text("¿Estas seguro de eliminar el registro : "+id+"?");
    $(".modal-header").css("background-color", "red");
    $(".modal-header").css("color", "white");
    $("#modalborrar").modal("show");
    });

    $("#formBorraUser").submit(function(e){
        e.preventDefault();

         $.ajax({
            url: "bdd/crud.php",
            type:"POST",
            dataType: "json",
            data:{opcion:opcion, id:id},
            success: function(){
                tablaPersonas.row(fila.parents('tr')).remove().draw();

            }
        });
         $("#modalborrar").modal("hide");
    });

//Actualizar
$("#formPersonas").submit(function(e){
           e.preventDefault();

           nombre = $.trim($("#nombre").val());
           pais = $.trim($("#pais").val());
           edad = $.trim($("#edad").val());
           $.ajax({
            url: "bdd/crud.php",
            type:"POST",
            dataType: "json",
            data:{nombre:nombre, pais:pais, edad:edad, id:id, opcion:opcion},
            success:function(data){
               //Opcion 1 con ajax reload
               tablaPersonas.ajax.reload(null, false);

               //Opcion 2
               /* console.log(data);
                id = data[0].id;
                nombre = data[0].nombre;
                pais = data[0].pais;
                edad = data[0].edad;
                if(opcion == 1){ tablaPersonas.row.add([id,nombre,pais,edad]).draw();}
                else{ tablaPersonas.row(fila).data([id,nombre,pais,edad]).draw();}
                */
            }
           });
           $("#modalcrud1").modal("hide");
});

});