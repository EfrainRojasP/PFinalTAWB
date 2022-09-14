async function fetchCargarActividadNodo() {
    let req = await fetch("/PFinal/PHP/Controlador/CargarActividades.php", {
        method: "POST"
    })
    const res = req.json();
    return res;
}

function cargarActividades(obj){
    const selecAct = document.getElementById("actividad");
    const option = new Option(obj.nombreActividad, obj.idActividad);
    selecAct.appendChild(option);
}

function cargar() {
    fetchCargarActividadNodo().then(res => {
        res.forEach(element => {
            cargarActividades(element);
        });
    })
}

cargar();