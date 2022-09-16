const btnTabla = document.getElementById("verPromedio");

async function fetchTablaPromedio(obj) {
    try {
        let req = await fetch("/PFinal/PHP/Controlador/CargarTablaPromedio.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json; charset=UTF-8"
            },
            body: JSON.stringify(obj)
        })
        const res = await req.json();
        console.log(res);
        return res; 
    } catch (error) {
        console.log(error);
        throw new Error('ERROR AL CALCULAR LOS PROMEDIOS INTENTALO MAS TARDE \n');
    }
}

function objidAHENH(iDAHENH) {
    return{
        idAHENH: iDAHENH
    }
}


function cargarCabeceras(tabla) {
    const header = document.createElement('thead');
    tabla.appendChild(header);
    const cabeceras = ["Promedio condicion de luz (lm)", "Priomedio humedad (%)", 
        "Promedio temperatura (°C)", "Duracion promedio de la actividad (horas)"];
    const filaCabecera = header.appendChild(document.createElement("tr"));
    for (let i = 0; i < cabeceras.length; i++) {
        filaCabecera.appendChild(document.createElement("th")).
        appendChild(document.createTextNode(cabeceras[i]));
    }
}

function cargarCuerpoTabla(tabla, tablaRes) {
    const body = document.createElement("tbody");
    tabla.appendChild(body);
    const fila = body.appendChild(document.createElement("tr"));
    Object.entries(tablaRes).forEach(([key, value]) => {
        console.log(value);
        const celda = fila.appendChild(document.createElement("td"));
        const info = document.createTextNode(value);
        celda.appendChild(info);
    });
}

function cargarT(tabla, tablaRes) {
    console.log("object");
    cargarCabeceras(tabla);
    cargarCuerpoTabla(tabla, tablaRes);
}

btnTabla.addEventListener("click", async () => {
    try {
        const idAHENH = parseInt(window.localStorage.getItem("idAHENH"));
        const tablaRes = await fetchTablaPromedio(objidAHENH(idAHENH));
        const tbl = document.getElementById("tabla");
        cargarT(tbl, tablaRes);
    } catch (error) {
        alert(error);
    }
})