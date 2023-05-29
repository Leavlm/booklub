const burger = document.getElementById('header');

burger.addEventListener('click', function (){
    const nav = document.getElementById('nav');
    // const list = document.querySelector('.nav__lst--js');
    nav.classList.toggle('hide')
});