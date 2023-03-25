const firstMontantInput = document.getElementById('montant-1')
const secondMontantInput = document.getElementById('montant-2')
const errorText = document.getElementById('error-text')

function checkSame() {
    let montant1 = firstMontantInput.value
    let montant2 = secondMontantInput.value
    if (montant1 != montant2){
        errorText.classList.remove('hidden')
    } else {
        errorText.classList.add('hidden')
    }
}