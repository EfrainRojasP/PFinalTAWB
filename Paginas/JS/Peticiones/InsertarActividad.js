async function fetchInsertarActividad(obj) {
    let req = await fetch("/PFinal/PHP/Controlador/InsertarActividad.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json; charset=UTF-8"
        },
        body: JSON.stringify(obj)
    })
    const res = await req.text();
    return res;
    //return JSON.stringify(res);
}

function objActividad() {
    return{
        nombreActividad: document.getElementById("nomActividad").value
    };
}

document.forms[0].addEventListener("submit", async (e) =>{
    e.preventDefault();
    console.log(objActividad())
    let res = await fetchInsertarActividad(objActividad());
    alert(res);
    document.forms[0].submit();
});