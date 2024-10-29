let myChart = {};
let myChart2 = {};

document.addEventListener("DOMContentLoaded", () => {

	mostrarInstalacion();
	cuadroGeneral();
	placasSolares();
	baterias();
	inversores();
	reguladores();
	sortableFramework();
	analizarContenedor();
	alertaProduccion();
	intervaloComprobacionProduccion();
	generarPdfRegistros();
	mostrarDIVSiExisteAlertaConfigurada();

});

window.CerrarSesion = function () {

	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function () {

		if (this.readyState == 4 && this.status == 200) {

			let respuesta = this.responseText;
			if (respuesta) {
				location.href = "./helios_index.php";
			}
		}
	};

	xmlhttp.open("GET", "./ajaxFiles/cerrar_sesion.php?cls=true");
	xmlhttp.send();

}

function mostrarInstalacion() {


	// ********************* PETICION AJAX PARA COMPROBAR SI EXISTE INSTALACION

	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function () { // cuando se recibe la respuesta
		if (this.readyState == 4 && this.status == 200) {

			let existeId = JSON.parse(this.responseText); // RESPUESTA PHP true o false -> 1 || 0

			if (existeId) {
				existeInstalacion();
			} else {
				noExisteInstalacion();
			}


		}
	}

	xmlhttp.open("GET", "./ajaxFiles/instalacion.php?installation=true");
	xmlhttp.send();


}

function existeInstalacion() {

	let contenido = document.getElementById("yesInstallation");
	let estilo = window.getComputedStyle(contenido);

	if (estilo.display == "none") {
		contenido.style.display = "";
	}

	datosInstalacion();
}

function noExisteInstalacion() {

	let contenido = document.getElementById("noInstallation");
	let estilo = window.getComputedStyle(contenido);

	if (estilo.display == "none") {
		contenido.style.display = "";
	} else {
		contenido.style.display = "none";
	}

}

function cuadroGeneral() {

	let botonCreacion = document.getElementById("botonCrear");
	let cuadroGeneral = document.getElementById("cuadroGeneral");
	let footer = document.getElementsByTagName("footer")[0]; // para quitar margin top al hacer click

	// if(document.getElementById("noInstallation").style.display == "none"){
	// 	footer.style.marginTop = 0;
	// }

	botonCreacion.addEventListener("click", () => {
		footer.style.marginTop = 0;
		cuadroGeneral.style.display = "";
		crearPlantillaDiseno();
	})
}

function placasSolares() {

	let contenedor12v = document.getElementById("placas12V");
	let contenedor24v = document.getElementById("placas24V");
	let nombres12v = document.getElementById("nombresplacas12V");
	let nombres24v = document.getElementById("nombresplacas24V");


	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function () { // cuando se recibe la respuesta
		if (this.readyState == 4 && this.status == 200) {

			let respuesta = JSON.parse(this.responseText); // RESPUESTA PHP (string)

			respuesta.forEach(element => {

				if (element.includes("12")) {

					let imagen = document.createElement("img");
					let nombres = document.createElement("div");

					if (parseInt(element.substring(30, 33)) < 100) {

						imagen.classList.add("col", "list-group-item", "v12");
						imagen.setAttribute("alt", "placa_12v");
						imagen.setAttribute("src", element.substring(1, element.length));
						imagen.setAttribute("data-id", element.substring(30, 32));
						contenedor12v.appendChild(imagen);

						nombres.classList.add("col-3");
						nombres.innerHTML = element.substring(30, 33);
						nombres12v.appendChild(nombres);

					} else {
						imagen.classList.add("col", "list-group-item", "v12");
						imagen.setAttribute("alt", "placa_12v");
						imagen.setAttribute("src", element.substring(1, element.length));
						imagen.setAttribute("data-id", element.substring(30, 33));
						contenedor12v.appendChild(imagen);

						nombres.classList.add("col-3");
						nombres.innerHTML = element.substring(30, 34);
						nombres12v.appendChild(nombres);
					}

				} else {
					let imagen = document.createElement("img");
					let nombres = document.createElement("div");

					imagen.classList.add("col", "list-group-item", "v24")
					imagen.setAttribute("data-id", element.substring(30, 33))
					imagen.setAttribute("alt", "placa_24v");
					imagen.setAttribute("src", element.substring(1, element.length));
					contenedor24v.appendChild(imagen);

					nombres.classList.add("col-3");
					nombres.innerHTML = element.substring(30, 34);
					nombres24v.appendChild(nombres);
				}

			});

		}
	}

	xmlhttp.open("GET", "./ajaxFiles/instalacion.php?placas=true");
	xmlhttp.send();

}

function baterias() {

	let imagenesBaterias = document.getElementById("imgBaterias");


	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function () { // cuando se recibe la respuesta
		if (this.readyState == 4 && this.status == 200) {

			let respuesta = JSON.parse(this.responseText); // RESPUESTA PHP (string)

			respuesta.forEach(element => {

				let imagen = document.createElement("img");

				imagen.classList.add("col", "list-group-item", "bateria")
				imagen.setAttribute("data-id", element.substring(21, 26))
				imagen.setAttribute("alt", "bateria")
				imagen.setAttribute("src", element.substring(1, element.length));
				imagenesBaterias.appendChild(imagen);

			});

		}
	}

	xmlhttp.open("GET", "./ajaxFiles/instalacion.php?baterias=true");
	xmlhttp.send();

}

function inversores() {

	let imagenesInv = document.getElementById("imgInversores");


	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function () { // cuando se recibe la respuesta
		if (this.readyState == 4 && this.status == 200) {

			let respuesta = JSON.parse(this.responseText); // RESPUESTA PHP (string)

			respuesta.forEach(element => {

				let imagen = document.createElement("img");

				imagen.classList.add("col", "list-group-item", "inversor")
				imagen.setAttribute("data-id", element.substring(23, 35));
				imagen.setAttribute("src", element.substring(1, element.length));
				imagenesInv.appendChild(imagen);

			});

		}
	}

	xmlhttp.open("GET", "./ajaxFiles/instalacion.php?inversores=true");
	xmlhttp.send();

}

function reguladores() {

	let imagenesReg = document.getElementById("imgReguladores");

	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function () { // cuando se recibe la respuesta
		if (this.readyState == 4 && this.status == 200) {

			let respuesta = JSON.parse(this.responseText); // RESPUESTA PHP (string)

			respuesta.forEach(element => {

				let imagen = document.createElement("img");

				imagen.classList.add("col", "list-group-item", "regulador")
				imagen.setAttribute("data-id", element.substring(34, 38));
				imagen.setAttribute("src", element.substring(1, element.length));
				imagenesReg.appendChild(imagen);

			});

		}
	}

	xmlhttp.open("GET", "./ajaxFiles/instalacion.php?reguladores=true");
	xmlhttp.send();

}

function crearPlantillaDiseno() {

	let elemento = document.getElementById("CD"); // elemento para dimensiones de referencia
	let altura = elemento.offsetHeight;
	let anchura = elemento.offsetWidth;

	let plantilla = document.getElementById("contenedorDispositivos");
	plantilla.style.cssText = `height:${altura}px;width:${anchura + 150}px;`
}

function sortableFramework() {

	const placas12V = document.getElementById("placas12V");
	const placas24V = document.getElementById("placas24V");
	const baterias = document.getElementById("imgBaterias");
	const inversor = document.getElementById("imgInversores");
	const regulador = document.getElementById("imgReguladores");

	const contenedorDispositivos = document.getElementById("aparatos");

	Sortable.create(placas12V, {
		group: {
			name: "dispositivos",
			pull: "clone",
			put: false


		},
		animation: 200,
		easing: "cubic-bezier(0.34, 1.56, 0.64, 1)",
		sort: false


	});

	Sortable.create(placas24V, {
		group: {
			name: "dispositivos",
			pull: "clone",
			put: false
		},
		animation: 200,
		easing: "cubic-bezier(0.34, 1.56, 0.64, 1)",
		sort: false



	});

	Sortable.create(baterias, {
		group: {
			name: "dispositivos",
			pull: "clone",
			put: false

		},
		animation: 200,
		easing: "cubic-bezier(0.34, 1.56, 0.64, 1)",
		sort: false



	});

	Sortable.create(inversor, {
		group: {
			name: "dispositivos",
			pull: "clone",
			put: false
		},
		animation: 200,
		easing: "cubic-bezier(0.34, 1.56, 0.64, 1)",
		sort: false

	});

	Sortable.create(regulador, {
		group: {
			name: "dispositivos",
			pull: "clone",
			put: false
		},
		animation: 200,
		easing: "cubic-bezier(0.34, 1.56, 0.64, 1)",
		sort: false

	});

	// Campo de creación

	Sortable.create(contenedorDispositivos, {
		group: {
			name: "dispositivos",
		},
		animation: 200,
		easing: "cubic-bezier(0.34, 1.56, 0.64, 1)",
		onAdd: function (evt) {
			var item = evt.item;

			item.addEventListener("click", () => {
				item.parentNode.removeChild(item);
			})
		},
	});
}

function analizarContenedor() {

	let contenedorPlantilla = document.getElementById("aparatos");
	let botonRegistrarInstalacion = document.getElementById("botonRegistrarInstalacion");
	let valoresFinales = {};

	contenedorPlantilla.addEventListener("mouseover", () => {

		let valores = [];
		let hijos = contenedorPlantilla.childNodes

		hijos.forEach(hijo => {
			let dataID = hijo.getAttribute("data-id");
			valores.push(dataID);

		})
		valoresFinales = mostrarInformacion(valores)

	})



	botonRegistrarInstalacion.addEventListener("click", () => { registrarInstalacion(valoresFinales.boolWatts, valoresFinales.boolBats, valoresFinales.boolReg, valoresFinales.boolInv, valoresFinales.arrWatts, valoresFinales.arrBat, valoresFinales.inversor, valoresFinales.regulador) });

}

function mostrarInformacion(valores) {


	let arrayWatajes = [];
	let arrayBaterias = [];
	let arrayInversor = [];
	let arrayRegulador = [];
	let valorInversor = ""; // para no hacer el substring en el propio objeto

	let verificadorWattajes = false;
	let verificadorBaterias = false;
	let verificadorRegulador = false;
	let verificadorInversor = false;

	let cajaInformacionWatts = document.getElementById("informacionWatts");
	let cajaInformacionBaterias = document.getElementById("informacionBaterias");
	let cajaInformacionRegulador = document.getElementById("informacionRegulador");
	let cajaInformacionInversor = document.getElementById("informacionInversor");


	valores.forEach(valor => {

		if (!isNaN(parseInt(valor)) && !/[a-zA-Z]/.test(valor)) {
			arrayWatajes.push(valor);
		}
		if (/^\d{3}[a-zA-Z]{2}$/.test(valor)) {

			let soloNumero = valor.substring(0, 3);
			arrayBaterias.push(soloNumero);
		}

		if (/inversor_(12|24|48)V/.test(valor)) {
			arrayInversor.push(valor);
		}

		if (/^PWM/.test(valor) || /^MPPT/.test(valor)) {

			if (valor == "PWM.") valor = "PWM";
			arrayRegulador.push(valor);
		}
	});


	if (!comprobarVoltajes(arrayWatajes)) {
		cajaInformacionWatts.innerHTML = "Te recomendamos no mezclar voltajes. Puede provocar incopatibilidades o una mala optimización";
	} else {
		try {
			let sumaWattajes = arrayWatajes.reduce((acc, numero) => { return parseInt(acc) + parseInt(numero) })
			cajaInformacionWatts.innerHTML = "Wattaje de instalacion: " + sumaWattajes + "W";
			verificadorWattajes = true;
		} catch (error) {
			cajaInformacionWatts.innerHTML = "Wattaje de instalacion: " + 0 + "W";
		}
	}

	if (!comprobarBaterias(arrayBaterias)) {
		cajaInformacionBaterias.innerHTML = "Acuerdate de incluir baterias a tu instalación";
	} else {
		let capacidadTotal = 0;
		arrayBaterias.forEach(bat => {
			capacidadTotal += parseInt(bat.substring(0, 3))
		})

		cajaInformacionBaterias.innerHTML = "Capacidad de almacenamiento solar: " + capacidadTotal + "ah";
		verificadorBaterias = true;
	}

	if (comprobarRegulador(arrayRegulador)) {
		cajaInformacionRegulador.innerHTML = "Has incluido un regulador de tipo " + arrayRegulador[0];
		verificadorRegulador = true;
	} else {
		if (arrayRegulador.length > 1) {
			cajaInformacionRegulador.innerHTML = "Elige un único regulador";
		} else {
			cajaInformacionRegulador.innerHTML = "Acuerdate de incluir un regulador";
		}
	}

	if (comprobarInversor(arrayInversor)) {
		cajaInformacionInversor.innerHTML = "Has incluido un inversor de " + arrayInversor[0].substring(9, 13);
		valorInversor = arrayInversor[0].substring(9, 13);
		verificadorInversor = true;
	} else {
		if (arrayInversor.length > 1) {
			cajaInformacionInversor.innerHTML = "Elige un único inversor";
		} else {
			cajaInformacionInversor.innerHTML = "Acuerdate de incluir un inversor";
		}
	}

	let valoresRegistro = {
		"arrWatts": arrayWatajes,
		"arrBat": arrayBaterias,
		"inversor": valorInversor,
		"regulador": arrayRegulador[0],
		"boolWatts": verificadorWattajes,
		"boolBats": verificadorBaterias,
		"boolReg": verificadorRegulador,
		"boolInv": verificadorInversor
	}

	return valoresRegistro;
}

function comprobarVoltajes(watajes) {

	let verif_12v = false;
	let verif_24v = false;

	watajes.forEach(watt => {
		if (parseInt(watt) <= 200) {
			verif_12v = true;
		}
		if (parseInt(watt) > 200) {
			verif_24v = true;
		}
	})

	if (verif_12v && verif_24v) {
		return false;
	}
	return true;
}

function comprobarBaterias(baterias) {

	if (baterias.length == 0) {
		return false;
	} else {
		return true;
	}
}

function comprobarRegulador(reginv) {

	let contadorRegulador = 0;

	if (reginv.length == 0) {
		return false;
	}

	reginv.forEach(item => {
		if (item.includes("MPP") || item.includes("PWM")) contadorRegulador++
	})

	if (contadorRegulador == 1) {
		return true;
	} else {
		return false;
	}
}

function comprobarInversor(reginv) {

	let contadorInversor = 0;

	if (reginv.length == 0) {
		return false;
	}

	reginv.forEach(item => {
		if (item.includes("inversor")) contadorInversor++
	})

	if (contadorInversor == 1) {
		return true;
	} else {
		return false;
	}
}


function registrarInstalacion(verifPlacas, verifBat, verifReg, verifInv, arrPlacas, arrBaterias, inversor, regulador) {

	let idInstalacion = document.getElementById("idInstalacion").innerHTML;

	let contador75W = 0;
	let contador160W = 0;
	let contador200W = 0;

	let contador300W = 0;
	let contador450W = 0;
	let contador600W = 0;

	let cantidadPlacas = 0;
	let potenciaTotal = 0;

	let cantidadBaterias = 0;
	let capacidadBaterias = 0;


	let valoresFinalesRegistro = {};

	if (verifPlacas && verifBat && verifReg && verifInv) {

		arrPlacas.forEach(placa => {
			switch (placa) {
				case "75":
					contador75W++;
					break;
				case "160":
					contador160W++;
					break;
				case "200":
					contador200W++;
					break;
				case "300":
					contador300W++;
					break;
				case "450":
					contador450W++;
					break;
				case "600":
					contador600W++
					break;
				default:
					break;
			}
		})

		cantidadPlacas = arrPlacas.length;
		potenciaTotal = arrPlacas.reduce((acc, num) => { return parseInt(acc) + parseInt(num) })
		cantidadBaterias = arrBaterias.length;

		if (arrBaterias.length == 1) {
			capacidadBaterias = parseInt(arrBaterias[0].substring(0, 3));
		} else {
			capacidadBaterias = arrBaterias.reduce((acc, num) => { return (parseInt(acc) + parseInt(num)) });
		}


		valoresFinalesRegistro = {
			"idInst": parseInt(idInstalacion),
			"75": contador75W,
			"160": contador160W,
			"200": contador200W,
			"300": contador300W,
			"450": contador450W,
			"600": contador600W,
			"cantidadPlacas": cantidadPlacas,
			"potenciaTotal": potenciaTotal,
			"cantidadBaterias": cantidadBaterias,
			"capacidadBaterias": capacidadBaterias,
			"regulador": regulador,
			"inversor": inversor
		}


		// PETICION AJAX PARA REGISTRAR INSTALACION EN BBDD 

		var xmlhttp = new XMLHttpRequest();

		xmlhttp.onreadystatechange = function () { // cuando se recibe la respuesta
			if (this.readyState == 4 && this.status == 200) {

				let respuesta = this.responseText;
				if (respuesta) {
					console.log("Instalacion registrada correctamente");
					window.location.href = "./helios_userPanel.php";
				} else {
					console.log("Hubo fallo en el registro");
				}

			}
		}

		var datos = "";
		datos += "datosReg=" + JSON.stringify(valoresFinalesRegistro);


		xmlhttp.open("POST", "./ajaxFiles/instalacion.php");
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send(datos);

	} else {
		Swal.fire({
			icon: "error",
			title: "Oops!...",
			text: "Revisa tus dispositivos",
			footer: 'Recuerda cumplir con todos los requisitos de creación'
		});
	}


}

function datosInstalacion() {

	let voltajeBase = document.getElementById("voltajeBase");
	let potenciaInstalada = document.getElementById("potenciaInstalada");
	let numeroPlacas = document.getElementById("numeroPlacas");
	let capacidadAlmacenamiento = document.getElementById("capacidadAlmacenamiento");
	let tipoRegulador = document.getElementById("tipoRegulador");
	let voltajeInversor = document.getElementById("voltajeInversor");


	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function () { // cuando se recibe la respuesta
		if (this.readyState == 4 && this.status == 200) {

			let respuesta = JSON.parse(this.responseText); // RESPUESTA PHP (string)

			if (respuesta[0]['200W'] != 0 || respuesta[0]['300W'] != 0 || respuesta[0]['600W'] != 0) {
				voltajeBase.innerHTML = "12V";
			} else {
				voltajeBase.innerHTML = "24V";
			}

			potenciaInstalada.innerHTML = respuesta[0]['potenciaTotal'];
			numeroPlacas.innerHTML = respuesta[0]['cantidadPlacas'];
			capacidadAlmacenamiento.innerHTML = respuesta[0]['capacidadBaterias'];
			tipoRegulador.innerHTML = respuesta[0]['regulador'];
			voltajeInversor.innerHTML = respuesta[0]['inversor'];

			DiferenciaTiempoRegistro(potenciaInstalada);

		}
	}

	xmlhttp.open("GET", "./ajaxFiles/instalacion.php?datosInstalacion=true");
	xmlhttp.send();


}

function DiferenciaTiempoRegistro(potenciaInstalada) {

	let tiempoActualMilisegundos = new Date().getTime();
	let tiempoActualSegundos = Math.floor(tiempoActualMilisegundos / 1000);
	let verif = false;

	let segundosDía = 24 * 60 * 60;


	/* ************************** PETICION AJAX TIME STAMP PARAMETRO */

	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function () {

		if (this.readyState == 4 && this.status == 200) {

			let timeStampSegudnos = this.responseText;
			let diferenciaTiempo = 0;
			diferenciaTiempo = tiempoActualSegundos - timeStampSegudnos;


			if (!timeStampSegudnos) {
				peticionApiRegistroProducciones(potenciaInstalada, verif = true)
			} else if (diferenciaTiempo < segundosDía) {
				peticionApiRegistroProducciones(potenciaInstalada, verif = false);
			} else {
				peticionApiRegistroProducciones(potenciaInstalada, verif = true);
			}
		}
	};

	xmlhttp.open("GET", "./ajaxFiles/registroProduccionSolar.php?getTime=true");
	xmlhttp.send();

}

function peticionApiRegistroProducciones(potenciaInstalada, verif) {

	let potenciaActual = document.getElementById("potenciaActual");
	let energiasolardiaria = document.getElementById("energiaDiaria");
	let energiasolarMensual = document.getElementById("energiaMensual");
	let autonomia = document.getElementById("autonomia");
	let eficiencia = document.getElementById("eficiencia");
	let precioActualElectricidadMW = document.getElementById("precioElectricidadMegaWatio");
	let precioActualElectricidadKW = document.getElementById("precioElectricidadKiloWatio");
	let costoenergiaGeneradaInstalacion = document.getElementById("costoInstalacion");
	let costoenergiaCompradaRed = document.getElementById("costosRedElectrica");
	let ahorroCostos = document.getElementById("ahorroCostos");
	let contaminacionEvitada = document.getElementById("emisionesEvitadas");


	let latitud = document.getElementById("latitud").innerText;
	let longitud = document.getElementById("longitud").innerHTML;
	let numeroPlacas = document.getElementById("numeroPlacas").innerHTML;
	let potencia = potenciaInstalada.innerHTML;
	let voltajeBase = document.getElementById("voltajeBase").innerHTML.substring(0, 2);
	let capacidadAlmacenamiento = document.getElementById("capacidadAlmacenamiento").innerHTML;

	let jsonValoresObjeto = JSON.parse(document.getElementById("preciodelaluzAPI").innerHTML); // ****************** API PRECIODELALUZ.ORG
	let jsonValoresArray = Object.values(jsonValoresObjeto);



	let totalEnergiaSolarDiaria = 0;
	let contadorPromedio = 0;
	let eficienciaPanel = 0.2;
	let areaPanel = 1.482 * 0.676;
	let energiaDiariaProducida = 0;
	let capacidadBateriasKWh = ((capacidadAlmacenamiento * voltajeBase) / 1000);
	let promedioHorasDeSolDia = 7.37;


	let contador = 0;
	let verficadorFechaMayor = false;
	let ahora = new Date();
	let hora_ahora = ahora.getHours();



	if (verif) {


		// ************************** SI NO EXISTEN PARAMETROS YA REGISTRADOS
		// ****************************************** PETICION AJAX API PRODUCCIONES SOLARES ******************************************

		const xhr = new XMLHttpRequest();
		xhr.withCredentials = true;

		xhr.addEventListener('readystatechange', function () {

			if (this.readyState === this.DONE) {

				// ******************************************** RESPUESTA API

				let res = this.responseText;
				let respuesta1Array = Object.values(JSON.parse(res));

				JSON.parse(res).forecasts.forEach(forecasts => {

					let fecha = new Date(forecasts.period_end);

					if (fecha.getTime() > ahora.getTime() && verficadorFechaMayor == false) {
						if (contador == 3) {
							potenciaActual.innerHTML = forecasts.pv_estimate;
							verficadorFechaMayor = true;
						}
						contador++;
					}

					if (contadorPromedio < 49) {
						totalEnergiaSolarDiaria += parseFloat(forecasts.pv_estimate);
						contadorPromedio++;
					}

				})

				energiaDiariaProducida = (((eficienciaPanel * areaPanel * (totalEnergiaSolarDiaria / 24)) * numeroPlacas) * promedioHorasDeSolDia).toFixed(3); // 24 hace referencia a las horas del dia
				energiasolardiaria.innerHTML = energiaDiariaProducida;
				energiasolarMensual.innerHTML = ((energiaDiariaProducida * 30) / 1000).toFixed(2);
				autonomia.innerHTML = (capacidadBateriasKWh / ((energiaDiariaProducida / 1000))).toFixed(2);
				eficiencia.innerHTML = ((energiaDiariaProducida / totalEnergiaSolarDiaria) * 100).toFixed(2);
				contaminacionEvitada.innerHTML = ((energiaDiariaProducida * 30) / 1000).toFixed(2) * 0.5;

				for (let valor in jsonValoresObjeto) { // API PRECIODELALUZ.ORG

					if (jsonValoresObjeto[valor]['hour'].includes(hora_ahora) && jsonValoresObjeto[valor]['hour'].substring(3, 6) == (hora_ahora + 1)) {
						precioActualElectricidadMW.innerHTML = jsonValoresObjeto[valor]['price']
						precioActualElectricidadKW.innerHTML = (jsonValoresObjeto[valor]['price']) / 1000
						costoenergiaGeneradaInstalacion.innerHTML = ((energiaDiariaProducida / 1000) * ((jsonValoresObjeto[valor]['price']) / 1000)).toFixed(2);

						document.getElementById("rangoConsumos").addEventListener("change", () => {

							let valorSlide = document.getElementById("rangoConsumos").value;
							document.getElementById("slideValor").innerHTML = valorSlide;
							costoenergiaCompradaRed.innerHTML = (valorSlide * ((jsonValoresObjeto[valor]['price']) / 1000)).toFixed(2);
							ahorroCostos.innerHTML = ((valorSlide * ((jsonValoresObjeto[valor]['price']) / 1000)).toFixed(2) - ((energiaDiariaProducida / 1000) * ((jsonValoresObjeto[valor]['price']) / 1000)).toFixed(2)).toFixed(2);
						})

					}
				}

				// ******************************************* GRAFICO ENERGÍA ESTIMADA SEMANAL

				const ctxPower = document.getElementById('myPowerChart');

				myChart2 = new Chart(ctxPower, {
					type: "line",
					data: {
						labels: respuesta1Array[0].map(row => {
							let periodo = row.period_end;
							return periodo.substring(11, 16);
						}),
						datasets: [{
							label: "WEEKLY PV ESTIMATE (Watts)",
							data: respuesta1Array[0].map(row => {
								return (row.pv_estimate)
							}),
							backgroundColor: [
								'rgba(255, 99, 132, 0.2)',
								'rgba(255, 159, 64, 0.2)',
								'rgba(255, 205, 86, 0.2)',
								'rgba(75, 192, 192, 0.2)',
								'rgba(54, 162, 235, 0.2)',
								'rgba(153, 102, 255, 0.2)',
								'rgba(201, 203, 207, 0.2)'
							],
							borderColor: [
								'rgb(255, 99, 132)',
								'rgb(255, 159, 64)',
								'rgb(255, 205, 86)',
								'rgb(75, 192, 192)',
								'rgb(54, 162, 235)',
								'rgb(153, 102, 255)',
								'rgb(201, 203, 207)'
							],
							borderWidth: 1,

						}]
					},
					options: {
						scales: {
							y: {
								beginAtZero: true
							}
						}
					}
				});

				// ***************************** CHART JS PRECIO DE LA LUZ *****************************


				const ctx = document.getElementById('myChart');

				myChart = new Chart(ctx, {
					type: "line",
					data: {
						labels: jsonValoresArray.map(row => {
							return row.hour;
						}),
						datasets: [{
							label: "PRECIO DIARIO €/MWh",
							data: jsonValoresArray.map(row => {
								return row.price;
							}),
							backgroundColor: [
								'rgba(255, 99, 132, 0.2)',
								'rgba(255, 159, 64, 0.2)',
								'rgba(255, 205, 86, 0.2)',
								'rgba(75, 192, 192, 0.2)',
								'rgba(54, 162, 235, 0.2)',
								'rgba(153, 102, 255, 0.2)',
								'rgba(201, 203, 207, 0.2)'
							],
							borderColor: [
								'rgb(255, 99, 132)',
								'rgb(255, 159, 64)',
								'rgb(255, 205, 86)',
								'rgb(75, 192, 192)',
								'rgb(54, 162, 235)',
								'rgb(153, 102, 255)',
								'rgb(201, 203, 207)'
							],
							borderWidth: 1,

						}]
					},
					options: {
						scales: {
							y: {
								beginAtZero: true
							}
						}
					}
				});


				console.log("Peticion API realizada");

				// ****************************************** PETICION AJAX PARA REGISTRAR EN BBDD PRODUCCIONES ********* 

				var xmlhttp = new XMLHttpRequest();

				xmlhttp.onreadystatechange = function () { // cuando se recibe la respuesta
					if (this.readyState == 4 && this.status == 200) {
						let respuesta1 = JSON.parse(this.responseText); // RESPUESTA PHP						
						if (respuesta1) console.log("registro existoso")
					}
				}


				var datos = "";
				datos += "produccionesSolares=" + res;

				xmlhttp.open("POST", "./ajaxFiles/registroProduccionSolar.php");
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlhttp.send(datos);

				//revisarAlertaSolarGenerarCorreo();
			}
		});

		xhr.open('GET', `https://solcast.p.rapidapi.com/pv_power/forecasts?api_key=BVmB-tcESGysIBkXlXKRzH1JNGIVOajb&capacity=${potencia}&latitude=${latitud}&longitude=${longitud}&tilt=23&format=json`);
		xhr.setRequestHeader('X-RapidAPI-Key', '2cc5021f2cmsh928421a24af316fp188f44jsn69ce79c8f254');
		xhr.setRequestHeader('X-RapidAPI-Host', 'solcast.p.rapidapi.com');

		xhr.send();

	} else {

		// ************************** SI EXISTEN PARAMETROS YA REGISTRADOS
		// ****************************************** PETICION AJAX PHP PARAMETROS SOLARES ******************************************

		var xmlhttp = new XMLHttpRequest();

		xmlhttp.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {

				let respuesta2 = JSON.parse(this.responseText); // ******************************************* RESPUESTA PHP (string)
				let respuesta2Array = Object.values(respuesta2);

				respuesta2.forecasts.forEach(forecasts => {

					let fecha = new Date(forecasts.period_end).getTime();

					if (fecha > ahora.getTime() && verficadorFechaMayor == false) {
						if (contador == 3) {
							potenciaActual.innerHTML = forecasts.pv_estimate;
							verficadorFechaMayor = true;
						}
						contador++;
					}

					if (contadorPromedio < 48) {
						totalEnergiaSolarDiaria += parseFloat(forecasts.pv_estimate);
						contadorPromedio++;
					}

				})



				energiaDiariaProducida = (((eficienciaPanel * areaPanel * (totalEnergiaSolarDiaria / 24)) * numeroPlacas) * promedioHorasDeSolDia).toFixed(3); // 24 hace referencia a las horas del dia
				energiasolardiaria.innerHTML = energiaDiariaProducida;
				energiasolarMensual.innerHTML = ((energiaDiariaProducida * 30) / 1000).toFixed(2);
				autonomia.innerHTML = (capacidadBateriasKWh / ((energiaDiariaProducida / 1000))).toFixed(2);
				eficiencia.innerHTML = ((energiaDiariaProducida / totalEnergiaSolarDiaria) * 100).toFixed(2);
				contaminacionEvitada.innerHTML = ((energiaDiariaProducida * 30) / 1000).toFixed(2) * 0.5;

				const ctxPower = document.getElementById('myPowerChart'); // ******************************************* GRAFICO ENERGÍA ESTIMADA SEMANAL

				myChart2 = new Chart(ctxPower, {
					type: "line",
					data: {
						labels: respuesta2Array[0].map(row => {
							let periodo = row.period_end;
							return periodo.substring(11, 16);
						}),
						datasets: [{
							label: "WEEKLY PV ESTIMATE (Watts)",
							data: respuesta2Array[0].map(row => {
								return (row.pv_estimate)
							}),
							backgroundColor: [
								'rgba(255, 99, 132, 0.2)',
								'rgba(255, 159, 64, 0.2)',
								'rgba(255, 205, 86, 0.2)',
								'rgba(75, 192, 192, 0.2)',
								'rgba(54, 162, 235, 0.2)',
								'rgba(153, 102, 255, 0.2)',
								'rgba(201, 203, 207, 0.2)'
							],
							borderColor: [
								'rgb(255, 99, 132)',
								'rgb(255, 159, 64)',
								'rgb(255, 205, 86)',
								'rgb(75, 192, 192)',
								'rgb(54, 162, 235)',
								'rgb(153, 102, 255)',
								'rgb(201, 203, 207)'
							],
							borderWidth: 1,

						}]
					},
					options: {
						scales: {
							y: {
								beginAtZero: true
							}
						}
					}
				});


				for (let valor in jsonValoresObjeto) { // API PRECIODELALUZ.ORG

					if (jsonValoresObjeto[valor]['hour'].includes(hora_ahora) && jsonValoresObjeto[valor]['hour'].substring(3, 6) == (hora_ahora + 1)) {
						precioActualElectricidadMW.innerHTML = jsonValoresObjeto[valor]['price']
						precioActualElectricidadKW.innerHTML = (jsonValoresObjeto[valor]['price']) / 1000
						costoenergiaGeneradaInstalacion.innerHTML = ((energiaDiariaProducida / 1000) * ((jsonValoresObjeto[valor]['price']) / 1000)).toFixed(2);

						document.getElementById("rangoConsumos").addEventListener("change", () => {

							let valorSlide = document.getElementById("rangoConsumos").value;
							document.getElementById("slideValor").innerHTML = valorSlide;
							costoenergiaCompradaRed.innerHTML = (valorSlide * ((jsonValoresObjeto[valor]['price']) / 1000)).toFixed(2);
							ahorroCostos.innerHTML = ((valorSlide * ((jsonValoresObjeto[valor]['price']) / 1000)).toFixed(2) - ((energiaDiariaProducida / 1000) * ((jsonValoresObjeto[valor]['price']) / 1000)).toFixed(2)).toFixed(2);
						})

					}
				}

				// ***************************** CHART JS PRECIO DE LA LUZ *****************************


				const ctx = document.getElementById('myChart');

				myChart = new Chart(ctx, {
					type: "line",
					data: {
						labels: jsonValoresArray.map(row => {
							return row.hour;
						}),
						datasets: [{
							label: "PRECIO DIARIO €/MWh",
							data: jsonValoresArray.map(row => {
								return row.price;
							}),
							backgroundColor: [
								'rgba(255, 99, 132, 0.2)',
								'rgba(255, 159, 64, 0.2)',
								'rgba(255, 205, 86, 0.2)',
								'rgba(75, 192, 192, 0.2)',
								'rgba(54, 162, 235, 0.2)',
								'rgba(153, 102, 255, 0.2)',
								'rgba(201, 203, 207, 0.2)'
							],
							borderColor: [
								'rgb(255, 99, 132)',
								'rgb(255, 159, 64)',
								'rgb(255, 205, 86)',
								'rgb(75, 192, 192)',
								'rgb(54, 162, 235)',
								'rgb(153, 102, 255)',
								'rgb(201, 203, 207)'
							],
							borderWidth: 1,

						}]
					},
					options: {
						scales: {
							y: {
								beginAtZero: true
							}
						}
					}
				});

				//revisarAlertaSolarGenerarCorreo();
			}
		}

		xmlhttp.open("GET", "./ajaxFiles/registroProduccionSolar.php?producciones=true");
		xmlhttp.send();
		console.log("registro existente");

	}
}



function alertaProduccion() {

	let valorInputRange = document.getElementById("inputRangeValue");
	let wattspan = document.getElementById("wattsalert");
	let botonalerta = document.getElementById("botonalerta");
	let notificaciones = document.getElementById("notificaciones");

	valorInputRange.addEventListener("change", () => {
		wattspan.innerHTML = valorInputRange.value;
	})

	botonalerta.addEventListener("click", () => {

		/* ************************** PETICION AJAX GUARDAR VALOR RANGE ELEGIDO */

		var xmlhttp = new XMLHttpRequest();

		xmlhttp.onreadystatechange = function () {

			if (this.readyState == 4 && this.status == 200) {

				let respuesta = this.responseText;
				notificaciones.innerHTML = "Alerta de produccion configurada";
				mostrarDIVSiExisteAlertaConfigurada();

			}
		};

		xmlhttp.open("GET", `./ajaxFiles/instalacion.php?alert=${parseInt(valorInputRange.value)}`);
		xmlhttp.send();

	})
}

function revisarAlertaSolarGenerarCorreo() {

	let valorOrigen = document.getElementById("potenciaActual").innerHTML;

	/* ************************** PETICION AJAX PARA COMPARAR PRODUCCIONES SOLARES */

	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function () {

		if (this.readyState == 4 && this.status == 200) {

			let respuesta = this.responseText;
			console.log(respuesta);

		}
	};

	xmlhttp.open("GET", `./ajaxFiles/instalacion.php?compare=${parseInt(valorOrigen)}`);
	xmlhttp.send();
}

function intervaloComprobacionProduccion() {
	setInterval(() => {
		let potenciaActualGenerada = document.getElementById("potenciaActual").innerHTML;
		let fecha = new Date();
		let horaActual = fecha.getHours();

		if (potenciaActualGenerada != "" && horaActual > 12 & horaActual < 20) {
			console.log(potenciaActualGenerada + "hora actual" + horaActual);
			revisarAlertaSolarGenerarCorreo();
		}
		console.log("alerta configurada");
	}, 1800000);

}

function generarPdfRegistros() {

	document.getElementById("registros").addEventListener("click", () => {
		window.location.href = './pdfgenerator/pdfmaker.php';

	})
}

function mostrarDIVSiExisteAlertaConfigurada() {

	let filaAlerta = document.getElementById("configuracionAlerta");
	let elementoAlerta = document.getElementById("alertaConfigurada");

	/* ************************** PETICION AJAX PARA COMPARAR PRODUCCIONES SOLARES */

	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function () {

		if (this.readyState == 4 && this.status == 200) {

			let respuesta = this.responseText;

			if (JSON.parse(respuesta) != null) {
				filaAlerta.style.display = "";
				elementoAlerta.innerHTML = "Tienes una alerta configurada en " + respuesta + "W";
			}

		}
	};

	xmlhttp.open("GET", `./ajaxFiles/instalacion.php?exists`);
	xmlhttp.send();
}













