fetch('./handle-search.php?id=017521348')
    .then(res => res.json())
    .then(data => console.log(data['id']))