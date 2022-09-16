async function fetchCargarEspacios() {
    let req = await fetch("/PFinal/PHP/Controlador/CargarEspacio.php", {
        method: "POST"
    })
    const res = req.json();
    return res;
}

function cargarEspacio(obj){
    const selecEsp = document.getElementById("espacio");
    const option = new Option("Numero Espacio: " + obj.NumEspacio + 
                               " | Nombre Edificio: " + obj["Edificio"].nombreEd +
                               " | Rango del nodo: " + obj["Nodos"][0].rangoNodo, 
                              obj.IdEspacio);
    selecEsp.appendChild(option);
}

function cargar() {
    fetchCargarEspacios().then(res => {
        res.forEach(element => {
            cargarEspacio(element);
        });
    })
}

cargar();