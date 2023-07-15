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


/**
 * 
 * @param {string} method  method used to fetch the api
 * @param {object} data will be converted the result to json
 * @returns the result fetched from the api in json format
 */
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


searchInput.addEventListener('keyup', async (e) => {
    const searchString = e.target.value.toLowerCase();
    const response = await callApi('post', {
        action: 'search',
        request: searchString
    });
    // console.log(response['books']);
    displayBooks(response['books']); // Appeler la fonction d'affichage avec les données reçues de l'API
});

// searchInput.addEventListener('keyup', (e) => {
//     const searchString = e.target.value.toLowerCase();
//     callApi('post', {
//         action: 'search',
//         request: searchString
//     });
//     // displayBooks(searchString);
// })



function displayBooks(books){
    const htmlString = books.map((book) => {
        return `
        <li class="card__wrap">
        <a class="card__lnk" href="">
        <h3 class="card__ttl">${book.title_book}</h3>
        <p class="card__txt">${book.author_name}</p>
                </a>
                </li>
                `;
            })
            .join('');
                catalogList.innerHTML = htmlString;
}



