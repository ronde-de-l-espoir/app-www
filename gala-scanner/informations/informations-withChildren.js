const people = document.querySelectorAll('.person-accountability');
people.forEach(person => {
    person.addEventListener('click', () => {
        const icon = person.getElementsByTagName('img')[0];
        let url = icon.getAttribute('src');
        if (person.getAttribute('data-hasPaid') == "0") {
            if (person.getAttribute('data-isSelected') == 0) {
                url = '../../img/person-selected-icon.png';
                icon.setAttribute('src', url);
                person.setAttribute('data-isSelected', '1');
            } else if (person.getAttribute('data-isSelected') == 1) {
                url = '../../img/person-icon.png';
                icon.setAttribute('src', url);
                person.setAttribute('data-isSelected', '0');
            }
        }
        updatePrice();
    })
})

function updatePrice() {
    const display = document.getElementById('price-display');
    const pricesCard = document.querySelectorAll('.person-accountability');
    
    let totalPrice = 0;
    
    pricesCard.forEach(priceCard => {
        if (priceCard.getAttribute('data-isSelected') == 1) {
            const price = priceCard.querySelectorAll('.card-price')[0].innerText;
            totalPrice += parseInt(price);
        }
    })

    display.value = totalPrice + '€'
}

// handle submit instead of default
document.getElementById('form-payment').addEventListener('submit', (event) => {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    const formObject = Object.fromEntries(formData.entries());
    const totalPrice = formObject.totalPrice;

    const accounts = document.querySelectorAll('.person-accountability');
    if (accounts[0].getAttribute('data-hasPaid') != 0) {
        console.warn("Error: Le dépendant a déjà payé");
        return;
    }
    
    let selectedAccounts = [];
    accounts.forEach(account => {
        if (account.getAttribute('data-isSelected') == 1) {
            selectedAccounts.push(account.getAttribute("data-id"));
        }
    })

    if (selectedAccounts.length == 0) {
        console.warn("Error: Personne n'a été sélectionné");
        return;
    }
    
    if (selectedAccounts.includes(accounts[0].getAttribute('data-id')) == false) {
        console.warn("Error: Le dépendant n'est pas séléctionné");
        return;
    }
    
    console.log(selectedAccounts);
    console.log(JSON.stringify(selectedAccounts))

    fetch(`./handleConfirmDBChange.php?ids=${JSON.stringify(selectedAccounts)}`)
        .then(res => res.json())
        .then(data => console.log(data))
        .then(() => window.location = `./informations.php?id=${accounts[0].getAttribute('data-id')}`)

})

function __init__confirmButtons() {
    const button = document.getElementById('confirm-payment')
    const people = document.querySelectorAll('.person-accountability')
    if (people[0].getAttribute('data-hasPaid') == 1) {
        button.style.backgroundImage = "url(../../img/confirmed-icon.png)"
    }
}

updatePrice();

__init__confirmButtons();