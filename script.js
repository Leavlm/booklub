const burger = document.getElementById('header');
const nav = document.getElementById('nav');

burger.addEventListener('click', function (){
    // const list = document.querySelector('.nav__lst--js');
    nav.classList.toggle('hide')
});

const croix = document.getElementById('nav__close');
croix.addEventListener('click', function(){
    nav.classList.toggle('hide')
})