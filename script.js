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

//calling the API in async

const form = document.querySelector('.form-js');
const inputTtl = document.querySelector('#title');
const inputAuthor = document.querySelector('#author');
const inputPages = document.querySelector('#pages');

//listening to the submit event to prefent default behavior 

form.addEventListener('submit', e =>{
    e.preventDefault();
    addBook(inputTtl.value, inputAuthor.value, inputPages.value)
    .then(apiResponse => {
        if(!apiResponse.result){
            console.error('Erreur lors de l\'ajout')
            return;
        }
    })

})


async function callApi(method, data){
    try{
        const response = await fetch("api.php", {
            method: method,
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }) 
        return response.json();

    }
    catch(error){
        console.error('error')
    }

}

function addBook(bookTitle, bookAuthor, pageNb){
    const data = {
        action: 'addBook',
        bookTitle: bookTitle,
        bookAuthor: bookAuthor,
        pageNb: pageNb
    };
    return callApi('PUT', data)
}







