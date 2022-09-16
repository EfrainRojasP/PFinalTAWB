const horas = document.getElementById("horas");
const min = document.getElementById("minutos");
const seg = document.getElementById("seg");

const btnComenzar = document.getElementById("start");
const btnStop = document.getElementById("stop");

let cronometro = null;

let hrs = 0;
let minutos = 0;
let miliseg = 0;
let segundos = 0;

function refactor(num) {
    const re = "0" + num;
    return re.substring(re.length - 2);
}

function insertaTiempo() {
    horas.textContent = refactor(hrs);
    min.textContent = refactor(minutos);
    seg.textContent = refactor(miliseg);
}


function incrementaHora() {
    if(hrs === 59){
        hrs = 0;
    } else {
        ++hrs;
    }
}

function incrementaMinuto() {
    if(minutos === 10){
        minutos = 0;
        incrementaHora();
    } else {
        ++minutos;
    }
}



function milisegundos() {
    if(miliseg === 99){
        miliseg = 0;
        incrementaMinuto();
    } else {
        ++miliseg;
    }
    insertaTiempo();
}


btnComenzar.addEventListener("click", () =>{
    cronometro = setInterval(milisegundos, 10);
});

btnStop.addEventListener("click", () =>{
    clearInterval(cronometro);
    cronometro = null;
});