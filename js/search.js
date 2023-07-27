// -------------------------------
// LIMITING NB OF LETTER IN CARDS
// -------------------------------

document.addEventListener("DOMContentLoaded", function () {
    const h3Elements = document.querySelectorAll(".limited-characters-js");

    h3Elements.forEach(function (h3) {
        const maxCharacters = 40;
        const text = h3.textContent;

        if (text.length > maxCharacters) {
            h3.textContent = text.substring(0, maxCharacters) + "...";
        }
    });
});




//----------------------------
// DYNAMIC NAVBAR
//----------------------------




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
// SEARCHBAR ON SEARCH PAGE
//------------------------------------------


const searchInput = document.querySelector('.search__input');
const catalogList = document.querySelector('.catalog__lst');
const catalog = document.querySelector('.catalog')

/**
 * Async function fetching data in the API
 * @param {string} method  method used to fetch the api
 * @param {object} data will be converted to json
 * @returns the result fetched from the api in json format
 */
async function callApi(method, data) {
    try {
        const response = await fetch("api.php", {
            method: method,
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        return response.json();

    }
    catch (error) {
        console.error('error')
    }

}


// Searching in the API if there's a match with the searchString

searchInput.addEventListener('keyup', async (e) => {
    const searchString = e.target.value.toLowerCase();
    const response = await callApi('post', {
        action: 'search',
        request: searchString
    });
    displayBooks(response['books']);
    if (searchString === '') {
        displayBooks([]);
    }
});




/**
 * Function displaying books 
 * @param {array} books array containing every book present in the db
 * @returns a string containing the book
 */


function displayBooks(books) {
    const htmlString = books.map((book) => {
        return `
            <li class="card__wrap">
            <a class="card__lnk" href="product-page.php?id=${book.id_book}">
            <img class="card__img" src="${book.image_url}">
            <h3 class="card__ttl">${book.title_book}</h3>
            <p class="card__txt">${book.author_name}</p>
                    </a>
                    </li>
                    `;
    })
        .join('');

    const ulElement = document.createElement('ul');
    ulElement.classList.add('catalog__lst', 'catalog__lst--spacing');
    ulElement.innerHTML = htmlString;

    catalog.innerHTML = '';
    catalog.appendChild(ulElement);
    console.log(searchInput.value)
    if (searchInput.value === ""){
        catalog.removeChild(catalog.firstChild)
    }

}



