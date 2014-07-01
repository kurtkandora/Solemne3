function GuardarPrecios(vuelo) {

	switch(vuelo) {
		case 6547:
			sessionStorage.setItem('Vuelo', vuelo);
			sessionStorage.setItem('Destino', "Santiago de Chile - Ciudad de México");
			sessionStorage.setItem('Descripcion', "ida y vuelta");
			sessionStorage.setItem('Precio', "529695");
			break;
		case 4544:
			sessionStorage.setItem('Vuelo', vuelo);
			sessionStorage.setItem('Destino', "Santiago de Chile - Lima");
			sessionStorage.setItem('Descripcion', "ida y vuelta");
			sessionStorage.setItem('Precio', "134796");
			break;
		case 2446:
			sessionStorage.setItem('Vuelo', vuelo);
			sessionStorage.setItem('Destino', "Santiago de Chile - Buenos Aires");
			sessionStorage.setItem('Descripcion', "ida y vuelta");
			sessionStorage.setItem('Precio', "108796");
			break;
		case 2578:
			sessionStorage.setItem('Vuelo', vuelo);
			sessionStorage.setItem('Destino', "Santiago de Chile - Sao Paulo");
			sessionStorage.setItem('Descripcion', "ida");
			sessionStorage.setItem('Precio', "98862");
			break;
		case 2659:
			sessionStorage.setItem('Vuelo', vuelo);
			sessionStorage.setItem('Destino', "Santiago de Chile - Río de Janeiro");
			sessionStorage.setItem('Descripcion', "ida y vuelta");
			sessionStorage.setItem('Precio', "125456");
			break;
		default:
			break;
	}
	sessionStorage.setItem('Cantidad', document.getElementById(vuelo).value);
	sessionStorage.setItem('Total', sessionStorage.getItem('Precio') * sessionStorage.getItem('Cantidad'));
}

function valrun() {

	var M = 0, S = 1, dvcomp;
	var dv = document.getElementById("dv").value;
	var run = document.getElementById("rut").value;
	switch(dv) {
		case 'k':
			dv = 'K';
			break;
		default:
			break;
	}
	for (; run; run = Math.floor(run / 10))
		S = (S + run % 10 * (9 - M++ % 6)) % 11;
	dvcomp = S ? S - 1 : 'K';
	if (dv == dvcomp) {
		document.getElementById("err_rut").innerHTML = '';
	} else {
		document.getElementById("err_rut").innerHTML = 'Run Incorrecto';
	}
}

function validarnombre(nombre) {
	var patrondenombre = /^([a-z ñáéíóú]{2,60})$/i;
	if ((nombre.value.match(patrondenombre)) && (nombre.value != '')) {
		document.getElementById("errnombre").innerHTML = '';
	} else {
		document.getElementById("errnombre").innerHTML = 'Nombre Incorrecto';
		nombre.focus();
	}
}

function validarapellido(apellido) {
	var patrondeapellido = /^([a-z ñáéíóú]{2,60})$/i;
	if ((apellido.value.match(patrondeapellido)) && (apellido.value != '')) {
		document.getElementById("errapellido").innerHTML = '';
	} else {
		document.getElementById("errapellido").innerHTML = 'Apellidos Incorrectos';
		apellido.focus();
	}
}

function validarnumero(numero) {
	var patronnumero = /^[0-9]+$/;
	if ((numero.value.match(patronnumero)) && (numero.value != '')) {
		document.getElementById("err_numero").innerHTML = '';
	} else {
		document.getElementById("err_numero").innerHTML = 'Numero Incorrecto';
		numero.focus();
	}
}

function validaremail(email) {
	var patronmail = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
	if ((email.value.match(patronmail)) && (email.value != '')) {
		document.getElementById("err_email").innerHTML = '';
	} else {
		document.getElementById("err_email").innerHTML = 'Email Incorrecto';
		email.focus();
	}
}

function DesplegarDatos() {

	if (sessionStorage.getItem('Vuelo') != null) {

		var Vuelo = sessionStorage.getItem('Vuelo');
		var Destino = sessionStorage.getItem('Destino');
		var Descripcion = sessionStorage.getItem('Descripcion');
		var Precio = sessionStorage.getItem('Precio');
		var Cantidad = sessionStorage.getItem('Cantidad');
		var Total = sessionStorage.getItem('Total');
		document.getElementById("tabladecompra").innerHTML = 'Vuelo: ' + Vuelo + '<br /> Precio: ' + Destino + '<br /> Descripcion: ' + Descripcion + '<br /> Precio: $' + Precio + '<br /> Cantidad: ' + Cantidad + '<br /> Total: $' + Total + '<br/><br/>';

	} else {
		document.getElementById("articulomedio").innerHTML = '<h1>NO HA COMPRADO UN VUELO POR FAVOR ADQUIERA UNO ANTES DE CONTINUAR</h1><br /> <a href="precios.html">Volver</a>';
	}
}

function GuardarVenta() {
	//guardar datos en nuevas variables para no confundir si el usuario vuelve a la pagina de precios
	sessionStorage.setItem('Vuelov', sessionStorage.getItem('Vuelo'));
	sessionStorage.setItem('Destinov', sessionStorage.getItem('Destino'));
	sessionStorage.setItem('Descripcionv', sessionStorage.getItem('Descripcion'));
	sessionStorage.setItem('Preciov', sessionStorage.getItem('Precio'));
	sessionStorage.setItem('Cantidadv', sessionStorage.getItem('Cantidad'));
	sessionStorage.setItem('Totalv', sessionStorage.getItem('Total'));
	//borrar los datos viejos

	sessionStorage.removeItem('Vuelo');
	sessionStorage.removeItem('Destino');
	sessionStorage.removeItem('Descripcion');
	sessionStorage.removeItem('Precio');
	sessionStorage.removeItem('Cantidad');
	sessionStorage.removeItem('Total');

	//guardar datos del cliente
	sessionStorage.setItem('Run', document.getElementById('rut').value + '-' + document.getElementById('dv').value);
	sessionStorage.setItem('Nombre', document.getElementById('nombre').value + ' ' + document.getElementById('apellido').value);
	sessionStorage.setItem('Numero', document.getElementById('numero').value);
	sessionStorage.setItem('Email', document.getElementById('email').value);

}

function DesplegarVenta() {

	if (sessionStorage.getItem('Vuelov') != null) {

		var Vuelo = sessionStorage.getItem('Vuelov');
		var Destino = sessionStorage.getItem('Destinov');
		var Descripcion = sessionStorage.getItem('Descripcionv');
		var Precio = sessionStorage.getItem('Preciov');
		var Cantidad = sessionStorage.getItem('Cantidadv');
		var Total = sessionStorage.getItem('Totalv');

		var Run = sessionStorage.getItem('Run');
		var Nombre = sessionStorage.getItem('Nombre');
		var Numero = sessionStorage.getItem('Numero');
		var Email=sessionStorage.getItem('Email');
		
		document.getElementById("rut").innerHTML = Run;
		document.getElementById("nombre").innerHTML = Nombre;
		document.getElementById("numero").innerHTML = Numero;
		document.getElementById("email").innerHTML = Email;
		document.getElementById("Vuelo").innerHTML = Vuelo;
		document.getElementById("Destino").innerHTML = Destino;
		document.getElementById("Descripcion").innerHTML = Descripcion;
		document.getElementById("Precio").innerHTML = Precio;
		document.getElementById("Cantidad").innerHTML = Cantidad;
		
		document.getElementById("Total").innerHTML = Total;
		
		
	} else {
		document.getElementById("articulomedio").innerHTML = '<h1>NO HA COMPRADO UN VUELO POR FAVOR ADQUIERA UNO ANTES DE CONTINUAR</h1><br /> <a href="precios.html">Volver</a>';
	}
}
