function handleConfirm(elemId) {
    const elem = document.getElementById(elemId)

    // if (elem.getAttribute('data-confirmed') == 'false') {
    //     elem.setAttribute('src', "../../img/confirmed-icon.png")
    //     elem.setAttribute('data-confirmed', "true")
    // } else {
    //     elem.setAttribute('src', "../../img/confirm-icon.png")
    //     elem.setAttribute('data-confirmed', "false")
    // }
}

function __init__confirmButtons() {
    const buttons = document.querySelectorAll('.icon-confirm')
    buttons.forEach(button => {
        const status = button.getAttribute('data-confirmed')
        // if (status == 'false') {
        //     button.setAttribute('src', "../../img/confirm-icon.png")
        // } else {
        //     button.setAttribute('src', "../../img/confirmed-icon.png")
        // }
    })
}

const people = document.querySelectorAll('.person-accountability')
people.forEach(person => {
    person.addEventListener('click', () => {
        const icon = person.getElementsByTagName('img')[0]
        let url = icon.getAttribute('src')
        if (person.getAttribute('data-hasPaid') == "0") {
            if (person.getAttribute('data-isSelected') == 0) {
                url = '../../img/person-selected-icon.png'
                icon.setAttribute('src', url)
                person.setAttribute('data-isSelected', '1')
            } else if (person.getAttribute('data-isSelected') == 1) {
                url = '../../img/person-icon.png'
                icon.setAttribute('src', url)
                person.setAttribute('data-isSelected', '0')
            }
        }
        updatePrice()
    })
})

function updatePrice() {
    const display = document.getElementById('price-display')
    const pricesCard = document.querySelectorAll('.person-accountability')
    
    let totalPrice = 0
    
    pricesCard.forEach(priceCard => {
        if (priceCard.getAttribute('data-isSelected') == 1) {
            const price = priceCard.querySelectorAll('.card-price')[0].innerText
            totalPrice += parseInt(price);
        }
    })

    display.value = totalPrice
}

updatePrice()

__init__confirmButtons();