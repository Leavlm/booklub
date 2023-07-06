// Nav bar on mobile device

const burger = document.getElementById('header');
const nav = document.getElementById('nav');

burger.addEventListener('click', function (){
    // const list = document.querySelector('.nav__lst--js');
    nav.classList.toggle('hide')
});

const croix = document.getElementById('nav__close');
croix.addEventListener('click', function(){
    nav.classList.toggle('hide')
});


// Searchbar on the research page (local)

const searchInput = document.querySelector('.search__input');
const catalogList = document.querySelector('.catalog__lst');
let booksDetails = [];

// When something is typed in the searchbar, look for the value in the searchbar in the filtered book array

searchInput.addEventListener('keyup', (e) => {
    const searchString = e.target.value.toLowerCase();
    const filteredBooks = booksDetails.filter((book) => {
        return (book.title.toLowerCase().includes(searchString) || book.author.toLowerCase().includes(searchString))
    })
    displayBooks(filteredBooks);
})
const loadBooks = async () => {
    try{
        const res = await fetch('list.json');
        booksDetails = await res.json();
        displayBooks(booksDetails)
    } catch(err){
        console.error(err)
    }
}

// When there's a match between the searchbar and the filtered array, display the book

const displayBooks = (books) => {
    const htmlString= books.map((book) => {
        return `
        <li class="card__wrap">
                    <a class="card__lnk" href="">
                    <picture>
                    <source srcset="${book.coverL}" media="(min-width: 769px)">
                    <img src="${book.coverS}" class="card__img" alt="couverture de livre">
                </picture>
                        <h3 class="card__ttl">${book.title}</h3>
                        <p class="card__txt">${book.author}</p>
                    </a>
                </li>
        `;
    })
    .join('');
    catalogList.innerHTML = htmlString;
}

loadBooks();







