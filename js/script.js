function updateHost(input) {
    input.style.backgroundImage = 'url(img/wait.gif)'
    input.style.fontStyle = "italic"
    fetch(new Request("updateHost.php", {
        method:"POST",
        body:new FormData(input.form),
        mode:"cors"
    })).then(response => {
        if (response.ok) {
            input.style.backgroundImage = ''
            input.style.fontStyle = ""
        } else {
            input.style.backgroundImage = 'url(img/nok.png)'
        }
    })
}

function checkMask(input) {
    if (input.checkValidity()) {

    } else {
        input.setCustomValidity("Masque incorrect")
    }
}