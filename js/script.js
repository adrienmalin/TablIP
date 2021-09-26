function showCard(card, button) {
    card.classList.remove('scale-out')
    card.classList.add('scale-in')
    button.classList.add('scale-out')
}

function updateHost(input) {
    if (input.form.checkValidity()) {
        var td = input.parentElement
        var tr = td.parentElement
        tr.classList.remove("ok")
        tr.classList.remove("nok")
        tr.classList.add("pending")
        fetch(new Request("updateHost.php", {
            method:"POST",
            body:new FormData(input.form),
            mode:"cors"
        })).then(response => {
            tr.classList.remove("pending")
            if (response.ok) {
                tr.classList.add("ok")
                var linkInput = tr.getElementsByTagName('input')[7]
                var linkA = tr.getElementsByTagName('a')[0]
                linkA.href = linkInput.value
            } else {
                tr.classList.add("nok")
            }
        })
    } else {
        input.form.reportValidity()
    }
}