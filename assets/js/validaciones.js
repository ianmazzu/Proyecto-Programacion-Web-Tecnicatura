//$(document).ready(function() {
//    alert("Funcionando correctamente")
//})
$("#form_cat").submit(function () {
    var nombre = $("#categorias").val();

    if ($.trim(nombre) === "") {
        alert("Debe completar la categoria \n Ian Mazzucco")
        return false;
    }
    return true;
});

$("#form_prod").submit(function () {
    var producto = $("#nombre").val();
    var descripcion = $("#descripcion").val();
    var categoria = $("#categoria").val();

    var errores = [];

    if ($.trim(producto) === "") {
        errores.push("Debe ingresar el producto");

        if ($.trim(descripcion) === "")
            errores.push("Debe ingresar la descripcion");

        if ($.trim(categoria) === "")
            errores.push("Debe ingresar la categoria");

        if (errores.length > 0)
            errores.push("Ian Mazzucco");
        alert(errores.join("\n"));
        return false;
    }
    return true;
});
