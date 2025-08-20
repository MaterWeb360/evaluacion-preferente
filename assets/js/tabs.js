let links = document.querySelectorAll('.estudia_tab-link');
links.forEach(link => {
    link.addEventListener('click', (event) => {
        event.preventDefault();
        let pos = link.getAttribute('data-pos');
        document.getElementById('numcarreras').innerText = numCarreras[pos];
    });
});