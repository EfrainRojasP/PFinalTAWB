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

function iniciarSimulacion() {
    luz.textContent = medidasAleatorias(15, 100);
    humedad.textContent = medidasAleatorias(49, 101);
    temp.textContent = medidasAleatoriasDecimal(0, 48, 2);
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

start.addEventListener("click", () => {
    start.disabled = true;
    detener.disabled = false;
    iniFechaLectura();
    simulacion = setInterval(iniciarSimulacion, 1000);
})

detener.addEventListener("click", () => {
    detener.disabled = true;
    agregar.disabled = false;
    clearInterval(simulacion);
    simulacion = null;
})

