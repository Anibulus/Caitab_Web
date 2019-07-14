function actualizarProducto()
{
	var a=document.getElementById("codigo").value;
	if(codigo!=null){
	var f=document.getElementById("productos");
	f.action="actualizar.php";
	f.submit();
	}
	else{
		alert("Necesitas llenar el campo codigo para usar este boton");
	}
}

function eliminarProducto()
{
	var d=document.getElementById("codigo").value;
	if(codigo!=null){
	var a=document.getElementById("productos");
	a.action="eliminar.php";
	a.submit();
	}
	else{
		alert("Necesitas llenar el campo codigo para usar este boton");
	}
}

function consulta()
{
	var d=document.getElementById("codigo").value;
	if(codigo!=null){
	var a=document.getElementById("productos");
	a.action="consulta.php";
	a.submit();
	}
	else{
		alert("Necesitas llenar el campo codigo para usar este boton");
	}
}

function consultarT(){
	var a=document.getElementById("productos");
	a.action="consultarTodo.php";
	a.submit();
}
