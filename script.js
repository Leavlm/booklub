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



const searchInput = document.querySelector('.search__input');
const catalogList = document.querySelector('.catalog__lst');
let booksDetails = [];

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

const displayBooks = (books) => {
    const htmlString= books.map((book) => {
        return `
        <li class="card__wrap">
                    <a class="card__lnk" href="">
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

// searchInput.addEventListener('input', (e) => {
//     const value = e.target.value
//     console.log(value)
// })

//     fetch('list.json').then(res => res.json()).then(data => {
//         book = data.map(user =>{
//             const card = bookCardTemplate.content.cloneNode(true).children[0];
//             const bookTitle = document.querySelector("[data-header]");
//             const bookAuthor = document.querySelector("[data-body]");
//             bookTitle.innerHTML = user.title; 
//             bookAuthor.innerHTML = user.author;
//             bookCardContainer.append(card)
    
//     })
//     });


// async function searchBook(query){
//     if (query.length >= 3) {
//         const response = await fetch('booklub/list.json');
//         const bookList = await response.json();
//         if(Array.isArray(bookList)){
//             const suggestions = bookList.map((book) => )
//         }
//     }
// }

// async function searchCities(query) {
//     if (query.length >= 3) {
//         const response = await fetch(
//             `https://api.weatherapi.com/v1/search.json?key=dfb545a573604021be494635230205&q=${query}`
//         );
//         const cities = await response.json();
//         if (Array.isArray(cities)) {
//             const suggestions = cities
//                 .map(
//                     (city) =>
//                         `<button data-location="${city.name}, ${city.region}, ${city.country}">${city.name} (${city.region}), ${city.country}</button>`
//                 )
//                 .join("");
//             suggestionsList.innerHTML = suggestions;
//             const cityButtons = document.querySelectorAll(
//                 "#suggestions button"
//             );
