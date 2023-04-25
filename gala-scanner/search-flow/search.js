function handleInput() {
    const input = document.getElementById('searchInput');
    const id = input.value;
    
    if (id != '') {
        fetch(`./handle-search.php?id=${id}`)
            .then(res => res.json())
            .then(data => {
                if (data == null) {
                    console.log('Error.')
                    return 'An error occurred during the process.';
                } else {
                    console.log(data)
                }
            })
    }
}