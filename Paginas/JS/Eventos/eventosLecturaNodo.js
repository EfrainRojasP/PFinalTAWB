const luz = document.getElementById("condLuz");
const humedad = document.getElementById("humedad");
const temp = document.getElementById("temperatura");
const start = document.getElementById("start");
const detener = document.getElementById("stop");
const fechaLectura = document.getElementById("fechaLectura");
const agregar = document.getElementById("agregarLectura");
const act = document.getElementById("actividad");
const esp = document.getElementById("espacio");

let simulacion = null;
let cont = 0;

act.selectedIndex = 0;
esp.selectedIndex = 0;

agregar.disabled = true;
detener.disabled = true;
start.disabled = true;

let idAHENH;

async function fectchInsertarAHEHN(obj) {
    let req = await fetch("/PFinal/PHP/Controlador/InsertarAHEHN.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json; charset=UTF-8"
        },
        body: JSON.stringify(obj)
    })
    const res = await req.text();
    if (res.includes("<b>")) {
        console.log(res);
        throw new Error('ERROR AL INSERTAR LA LECTURA, VUELVA A INTERLO MAS TARDE \n' + res);
    }
    return parseInt(res);
}

async function fetchInsertarLectura(obj) {
    let req = await fetch("/PFinal/PHP/Controlador/insertarLectura.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json; charset=UTF-8"
        },
        body: JSON.stringify(obj)
    })
    const res = await req.text();
    if (res.includes("<b>")) {
        throw new Error('ERROR AL INSERTAR LA LECTURA, VUELVA A INTERLO MAS TARDE \n' + res);
    }
    return res;
}

function objetoAHEHN() {
    return {
        idActividad: act.selectedIndex,
        idEHN: esp.selectedIndex,
        fechaLectura: fechaLectura.textContent
    }
}

function objetoLectura() {
    return {
        condLuz: parseFloat(luz.textContent),
        hum: parseFloat(humedad.textContent),
        temp: parseFloat(temp.textContent),
        idAHENH: idAHENH
    }
}

function fechaMYSQL(fecha, hora) {
    const fechaDividida = fecha.split("/");
    const year = fechaDividida[2];
    const mes = fechaDividida[1];
    const dia = fechaDividida[0];
    const fechaMYSQL = year + "-" + mes + "-" + dia + " " + hora;
    return fechaMYSQL;
}

function iniFechaLectura() {
    const date = new Date();
    const fecha = date.toLocaleDateString();
    const hora = date.toLocaleTimeString();
    console.log(hora);
    const content = fechaMYSQL(fecha, hora);
    fechaLectura.textContent = content;
}

function medidasAleatorias(max, min) {
    return Math.floor(Math.random() * (max - min) + min);
}

function medidasAleatoriasDecimal(max, min, decimales) {
    return (Math.random() * (max - min) + min).toFixed(decimales)
}

async function iniciarSimulacion() {
    try {
        luz.textContent = medidasAleatorias(15, 100);
        humedad.textContent = medidasAleatorias(49, 101);
        temp.textContent = medidasAleatoriasDecimal(0, 48, 2);
        const res = await fetchInsertarLectura(objetoLectura());
    } catch (error) {
        clearInterval(simulacion);
        simulacion = null;
        alert(error);
    }
    console.log("LUZ ", luz.textContent, " hum ", humedad.textContent, " temp ", temp.textContent);
}

function verificar(indexAct, indexEsp) {
    if (indexAct !== 0 && indexEsp !== 0) {
        start.disabled = false;
        esp.disabled = true;
        act.disabled = true;
    } else {
        agregar.disabled = true;
        start.disabled = true;
        detener.disabled = true
    }
}


agregar.addEventListener("click", () => {
    console.log(esp.selectedIndex + " " + act.selectedIndex);
});

esp.addEventListener("change", () => {
    const indexEsp = esp.selectedIndex;
    const indexAct = act.selectedIndex;
    verificar(indexAct, indexEsp);

})

act.addEventListener("change", () => {
    const indexEsp = esp.selectedIndex;
    const indexAct = act.selectedIndex;
    verificar(indexAct, indexEsp);
});

start.addEventListener("click", async () => {
    try {
        start.disabled = true;
        detener.disabled = false;
        iniFechaLectura();
        idAHENH = await fectchInsertarAHEHN(objetoAHEHN());
        simulacion = setInterval(iniciarSimulacion, 1000);
    } catch (error) {
        alert(error)
        return;
    }

})

detener.addEventListener("click", () => {
    detener.disabled = true;
    agregar.disabled = false;
    clearInterval(simulacion);
    simulacion = null;
})

