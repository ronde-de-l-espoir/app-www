var attempt = 3; // Variable to count number of attempts.
// Below function Executes on click of login button.
function validate() {
    var password = document.getElementById("pwd").value;
    if (password == "LRDE2023") {
        location.href = './main.php'; // Redirecting to other page.
        return false;
    }
    else {
        attempt--; // Decrementing by one.
    }
}