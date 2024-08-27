document.getElementById('perfil-foto').addEventListener('click', function() {
    const menu = document.getElementById('perfil-menu');
    menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
});

document.addEventListener('click', function(event) {
    const menu = document.getElementById('perfil-menu');
    const perfilFoto = document.getElementById('perfil-foto');
    if (!perfilFoto.contains(event.target) && !menu.contains(event.target)) {
        menu.style.display = 'none';
    }
});

function clickMenu() {
    const menu = document.querySelector('#partes');
    const items = document.querySelectorAll('.item-menu');
    
    if (menu.classList.contains('show-menu')) {
        // Se o menu já está visível, oculta
        menu.classList.remove('show-menu');
        items.forEach(item => item.style.display = 'none');
    } else {
        // Se o menu está oculto, exibe
        menu.classList.add('show-menu');
        items.forEach(item => item.style.display = 'flex');
    }
}

function adjustMenuDisplay() {
    const items = document.querySelectorAll('.item-menu');
    if (window.innerWidth >= 920) {
        items.forEach(item => {
            item.style.display = 'flex'; // Exibe os itens como blocos em telas largas
        });
    } else {
        items.forEach(item => {
            item.style.display = ''; // Usa o valor de display definido no CSS em telas menores
        });
    }
}

// Ajusta a exibição do menu quando a página é carregada
window.addEventListener('load', adjustMenuDisplay);

// Ajusta a exibição do menu quando a tela é redimensionada
window.addEventListener('resize', adjustMenuDisplay);
