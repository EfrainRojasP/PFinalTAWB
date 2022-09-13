async function fetchInsertarNodo(obj) {
    let req = await fetch("/PFinal/PHP/Controlador/InsertarNodo.php", {
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

function objNodo() {
    return{
        rangoNodo: parseInt(document.getElementById("rangoNodo").value),
        activiadad: document.getElementById("actividadNodo").selectedIndex
    };
}

document.forms[0].addEventListener("submit", async (e) =>{
    e.preventDefault();
    console.log(objNodo())
    let res = await fetchInsertarNodo(objNodo());
    alert(res);
    document.forms[0].submit();
});