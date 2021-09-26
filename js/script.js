function showCard(card, button) {
    card.classList.remove('scale-out')
    card.classList.add('scale-in')
    button.classList.add('scale-out')
}

function updateHost(input) {
    input.parentElement.classList.remove("ok")
    input.parentElement.classList.remove("nok")
    input.parentElement.classList.add("pending")
    fetch(new Request("updateHost.php", {
        method:"POST",
        body:new FormData(input.form),
        mode:"cors"
    })).then(response => {
        input.parentElement.classList.remove("pending")
        if (response.ok) {
            input.parentElement.classList.add("ok")
        } else {
            input.parentElement.classList.add("nok")
        }
    })
}