async function fetchInsertarEdificio(obj) {
    let req = await fetch("/PFinal/PHP/Controlador/InsertarEdificio.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json; charset=UTF-8"
        },
        body: JSON.stringify(obj)
    })
    const res = await req.text();
    //return res;
    return JSON.stringify(res);
}

function objEdificio() {
    return{
        nombreEdificio: document.getElementById("nomEdificio").value
    };
}

document.forms[0].addEventListener("submit", async (e) =>{
    e.preventDefault();
    console.log(objEdificio())
    let res = await fetchInsertarEdificio(objEdificio());
    alert(res);
    document.forms[0].submit();
});