async function fetchCargarActividadNodo() {
    let req = await fetch("/PFinal/PHP/Controlador/CargarEspacio.php", {
        method: "POST"
    })
    const res = req.json();
    return res;
}

function cargarActividades(obj){
    const selecEsp = document.getElementById("espacio");
    const option = new Option(obj.NumEspacio, obj.IdEspacio);
    selecEsp.appendChild(option);
}

function cargar() {
    fetchCargarActividadNodo().then(res => {
        res.forEach(element => {
            cargarActividades(element);
        });
    })
}

cargar();