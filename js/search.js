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
// Searchbar on the research page
//------------------------------------------


const searchInput = document.querySelector('.search__input');
const catalogList = document.querySelector('.catalog__lst');


/**
 * 
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


let prevSearchString = '';

searchInput.addEventListener('keyup', async (e) => {
    const searchString = e.target.value.toLowerCase();
    if (searchString !== prevSearchString) {
        const response = await callApi('post', {
            action: 'search',
            request: searchString
        });
        displayBooks(response['books']);
    }
    prevSearchString = searchString;
    if (searchString === '') {
        displayBooks([]);
    }
});







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
    catalogList.innerHTML = htmlString;
}



