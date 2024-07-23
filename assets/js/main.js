/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 


function agregar_producto(){
    alert("Se agregara un producto")
}

$(document).ready(function(){
    
    var texto = document.getElementById("boton_agregar").innerhtml;
    console.log(texto);
    console.log($("#boton_agregar").html());
    
    $(".btn-agregar").on("click", fuction(){
        $("#label").show();
    });
    
});
 */