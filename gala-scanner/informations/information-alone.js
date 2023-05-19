console.log("-- Alone --")

document.getElementById('form-payment').addEventListener('submit', (event) => {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    const formObject = Object.fromEntries(formData.entries());
    const totalPrice = formObject.totalPrice;
    console.log(totalPrice);
})