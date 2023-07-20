const bar = document.getElementById('bar-web');
const nav = document.getElementById('navbar-web');

if(bar){
    bar.addEventListener('click', () => {
        nav.classList.add('active');
    })
}