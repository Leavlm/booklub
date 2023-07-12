// import { callApi } from "./submit";


// Nav bar on mobile device

const burger = document.getElementById('header');
const nav = document.getElementById('nav');

burger.addEventListener('click', function () {
    // const list = document.querySelector('.nav__lst--js');
    nav.classList.toggle('hide')
});

const croix = document.getElementById('nav__close');
croix.addEventListener('click', function () {
    nav.classList.toggle('hide')
});

//------------------------------------------
// Searchbar on the research page (local)
//------------------------------------------


const searchInput = document.querySelector('.search__input');
const catalogList = document.querySelector('.catalog__lst');
let booksDetails = [];



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

searchInput.addEventListener('keyup', (e) => {
    const searchString = e.target.value.toLowerCase();
    callApi('post', {
        action: 'search',
        request: searchString
    });
    // displayBooks(searchString);
})



// function display

// const displayBooks = (books) => {
//     const htmlString = books.map((book) => {
//         return `
//         <li class="card__wrap">
//         <a class="card__lnk" href="">
//         <picture>
//         <source srcset="${book.coverL}" media="(min-width: 769px)">
//         <img src="${book.coverS}" class="card__img" alt="couverture de livre">
//         </picture>
//         <h3 class="card__ttl">${book.title}</h3>
//         <p class="card__txt">${book.author}</p>
//         </a>
//         </li>
//         `;
//     })
//     .join('');
//         catalogList.innerHTML = htmlString;
//     }




// When there's a match between the searchbar and the filtered array, display the book


    
    
//     loadBooks();
    
    
    
    //------------------------------------------------------------
    //Searchbar on the research page linked to my own API
    //------------------------------------------------------------
    



























    // export async function callApi(method, data) {
    //     try {
    //         const response = await fetch("api.php", {
    //             method: method,
    //             headers: {
    //                 'Content-Type': 'application/json'
    //             },
    //             body: JSON.stringify(data)
    //         })
    //         return response.json();
            
    //     }
    //     catch (error) {
    //         console.error('error')
    //     }
        
    // }
    
    // const form = document.querySelector('.search-form-js');
    
    // form.addEventListener('submit', e => {
    //     e.preventDefault();
    // searchBook(searchInput.value)
    // .then(apiResponse => {
    //     if (!apiResponse.result) {
    //         console.error('Erreur lors de la recherche')
    //         return;
    //     }
    // })
    // const loadBooks = async () => {
    //     try {
    //         const res = await fetch('list.json');
    //         booksDetails = await res.json();
    //         displayBooks(booksDetails)
    //     } catch (err) {
    //         console.error(err)
    //     }
    // }
    


// function searchBook(string) {
//     const data = {
//         action: 'searchBook',
//         input: string
//     };
//     return callApi('GET', data)
// }







// loadBooks();


