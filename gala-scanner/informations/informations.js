function handleConfirm(elemId) {
    const elem = document.getElementById(elemId)

    if (elem.getAttribute('data-confirmed') == 'false') {
        console.log("Confirming")
        elem.setAttribute('src', "../../img/confirmed-icon.png")
        elem.setAttribute('data-confirmed', "true")
    } else {
        console.log("Noped...")
        elem.setAttribute('src', "../../img/confirm-icon.png")
        elem.setAttribute('data-confirmed', "false")
    }
}

function __init__confirmButtons() {
    const buttons = document.querySelectorAll('.icon-confirm')
    buttons.forEach(button => {
        const status = button.getAttribute('data-confirmed')
        if (status == 'false') {
            button.setAttribute('src', "../../img/confirm-icon.png")
        } else {
            button.setAttribute('src', "../../img/confirmed-icon.png")
        }
    })
}

__init__confirmButtons();