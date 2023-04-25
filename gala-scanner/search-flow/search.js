function handleInput() {
    const input = document.getElementById('searchInput');
    const id = input.value;
    
    if (id != '') {
        fetch(`./handle-search.php?id=${id}`)
            .then(res => res.json())
            .then(data => {
                clearResults();
                displaySearchResults(data);
            })
    } else {
        clearResults();
    }
}

function clearResults() {
    const resultSection = document.querySelectorAll('.results-wrapper')[0];
    resultSection.innerHTML = '';
}

function displaySearchResults(data) {
    if (data == null) {
        console.log('An error occurred somewhere in the process.')
        return 0;
    } else {
        for (let i = 0; i < data.length; i++) {
            const uuid = data[i]['uuid'];
            const fname = data[i]['fname'];
            const lname = data[i]['lname'];

            const childrenAmount = 0;
            if (data[i]['hasChildren'] == 1) {
                console.log("It'll come");
                // do something here
            }

            const paymentIconPath = '../../img/payment-icon.png';
            if (data[i]['hasPaid'] == 1) {
                paymentIconPath = '../../img/already-paid-icon.png';
            }

            const html = createHTMLResult(uuid, fname, lname, childrenAmount, paymentIconPath)
            const resultSection = document.querySelectorAll('.results-wrapper')[0];
            
            resultSection.insertAdjacentHTML('afterbegin', html)
        }
    }
}

function createHTMLResult(uuid, fname, lname, childrenAmount, paymentIconPath) {
    
    const digits = uuid.split();
    let uuidFirst = '';
    let uuidSecond = '';
    for (let i = 0; i < uuid.length; i++) {
        if (uuidFirst.length < 5) {
            uuidFirst += uuid[i];
        } else {
            uuidSecond += uuid[i];
        }
    }

    let html = `
    <div class="result">
            <div class="code-display">
                <p>${uuidFirst}</p>
                <p>${uuidSecond}</p>
            </div>
            <div class="more-infos">
                <div id="id-display">
                    <p><span id="fname">${fname}</span>
                    <span id="lname">${lname}</span></p>
                </div>
                <div class="various-infos">
                    <div class="wrapper">
                        <img class="info-icon" src="${paymentIconPath}" alt="icon">
                        <div class="children">
                            <p id="childrenAmount">${childrenAmount}</p>
                            <img class="info-icon" src="../../img/person-icon.png" alt="icon">
                        </div>
                    </div>
                    <img class="info-icon" src="../../img/open-icon.png" alt="icon">
                </div>
            </div>
        </div>
    `;

    return html;

}