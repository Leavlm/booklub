
//------------------------------------------
// TOGGLE DARK MODE
//------------------------------------------

const darkModeToggle = document.getElementById('dark-mode-toggle');
const isDarkMode = document.body.classList.contains('dark');
const iconElement = document.querySelector('.toggle-icon-js');
const logoElement = document.querySelector('.logo-js');
const catalogElements = document.querySelectorAll('.catalog-js');
const cardElements = document.querySelectorAll('.card-js');
const formElement = document.querySelector('.form-js');
const labelElements = document.querySelectorAll('.label-js');
const imgElement = document.querySelector('.img-js');
const navElement = document.querySelector('.nav-js');
const crossIcn = document.querySelector('.cross-js');
const ttlElement = document.querySelector('.ttl-js');
const listElement = document.querySelector('.list-js');

//Stocking dark mode into localstorage
function setDarkModePreference(isDarkMode) {
    localStorage.setItem('darkMode', isDarkMode);
}

// Function to load the dark mode preference from local storage
function loadDarkModePreference() {
    const isDarkMode = localStorage.getItem('darkMode') === 'true';
    darkModeToggle.checked = isDarkMode;
    toggleDarkMode(isDarkMode); // Apply dark mode based on the stored preference
}

function toggleDarkMode(isDarkMode) {
    document.body.classList.toggle('dark', isDarkMode);
    document.querySelector('.header').classList.toggle('dark', isDarkMode);
    if (iconElement) {
        iconElement.classList.toggle('fa-moon', !isDarkMode);
        iconElement.classList.toggle('fa-sun', isDarkMode);
    }

    if (logoElement) {
        logoElement.setAttribute('src', isDarkMode ? 'img/logo-lg.png' : 'img/petit-logo-blk.png');

    }

    if (navElement) {
        navElement.classList.toggle('light__nav', !isDarkMode);
        navElement.classList.toggle('dark__nav', isDarkMode);
    }

    if (crossIcn) {
        crossIcn.classList.toggle('light__nav', !isDarkMode);
        crossIcn.classList.toggle('dark__nav', isDarkMode);
    }

    if (ttlElement) {
        ttlElement.classList.toggle('light__ttl', isDarkMode);
        ttlElement.classList.toggle('dark__ttl', !isDarkMode);
    }

    if (listElement) {
        listElement.classList.toggle('light__list', isDarkMode);
        listElement.classList.toggle('dark__list', !isDarkMode);
        console.log(isDarkMode);
    }

    if (catalogElements) {
        catalogElements.forEach(element => {
            element.classList.toggle('dark__catalog', isDarkMode);
            element.classList.toggle('light__catalog', !isDarkMode);
        });
    }

    if (cardElements) {
        cardElements.forEach(element => {
            element.classList.toggle('dark__card', isDarkMode);
            element.classList.toggle('light__card', !isDarkMode);
        });
    }

    if (labelElements) {
        labelElements.forEach(element => {
            element.classList.toggle('dark__label', isDarkMode);
            element.classList.toggle('light__label', !isDarkMode);
        });
    }

    if (formElement) {
        formElement.classList.toggle('light__form', !isDarkMode);
        formElement.classList.toggle('dark__form', isDarkMode);
    }

    if (imgElement) {
        imgElement.setAttribute('src', isDarkMode ? "./img/couple-lightmode.png" : "./img/couple-darkmode.png");
    }
}

// Add event listener for the dark mode toggle
darkModeToggle.addEventListener('change', () => {
    const isDarkMode = darkModeToggle.checked;
    setDarkModePreference(isDarkMode);
    toggleDarkMode(isDarkMode);
});

// Load the dark mode preference when the page loads
document.addEventListener('DOMContentLoaded', () => {
    loadDarkModePreference();
});


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
const croix = document.getElementById('nav__close');



function showMenu() {
    const menu = document.querySelector('.nav');
    menu.classList.toggle('hide');
    menu.classList.toggle('show');
}

burger.addEventListener('click', showMenu)
croix.addEventListener('click', showMenu)




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

if (searchInput) {
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
}




/**
 * Function displaying books 
 * @param {array} books array containing every book present in the db
 * @returns a string containing the book
 */


function displayBooks(books) {
    const htmlString = books.map((book) => {
        return `
        <li class="card__wrap card-js ${isDarkMode ? 'light__card' : 'dark__card'}">
        <a class="card__lnk" href="product-page.php?id=${book.id_book}">
        <img class="card__img" src="${book.image_url}">
        <h3 class="card__ttl limited-characters-js ${isDarkMode ? 'dark__label' : 'light__label'}">${book.title_book}</h3>
        <p class="card__txt">${book.author_name}</p>
        </a>
        </li>
                    `;
    })
        .join('');

    const ulElement = document.createElement('ul');
    ulElement.classList.add('catalog__lst', 'catalog__lst--spacing', 'catalog-js');
    ulElement.innerHTML = htmlString;

    catalog.innerHTML = '';
    catalog.appendChild(ulElement);
    if (books.length == 0 && searchInput.value !== "") {
        ulElement.innerHTML = '<p>Aucun livre trouvé.</p>';
        const cta = document.createElement('div');
        catalog.appendChild(cta);
        cta.classList.add('cta', 'cta__position');
        cta.innerHTML = '<a href="new-book.php" class="cta__txt--little">Ajouter un livre</a>'
    }
    if (searchInput.value === "") {
        catalog.removeChild(catalog.firstChild)
    }

}


//  -------------------------
// SEARCHBAR ON ADD COPY PAGE
//  -------------------------


const searchInputDyn = document.querySelector('.search-js');
// const catalogListDyn = document.querySelector('.catalog__lst');
const catalogDyn = document.querySelector('.catalog-dyn')

// Searching in the API if there's a match with the searchString

if (searchInputDyn) {
    searchInputDyn.addEventListener('keyup', async (e) => {
        const searchString = e.target.value.toLowerCase();
        const response = await callApi('post', {
            action: 'search',
            request: searchString
        });
        getBookTitleDyn(response['books']);
        if (searchString === '') {
            getBookTitleDyn([]);
        }
    });
}

function getBookTitleDyn(books) {
    const htmlString = books.map((book) => {
        return `
            <li class="list">
            <a href="sellCopy.php?bookId=${book.id_book}">
            <h3 class="list__ttl limited-characters-js ${isDarkMode ? 'dark__label' : 'light__label'}">${book.title_book}</h3>
            <p class="list__author">${book.author_name}</p>
            </a>
            </li>
                        `;
    })
        .join('');

    const ulElement = document.createElement('ul');
    ulElement.classList.add('list__wrap');

    ulElement.innerHTML = htmlString;

    catalogDyn.innerHTML = '';
    catalogDyn.appendChild(ulElement);
    if (books.length == 0 && searchInputDyn.value !== "") {
        ulElement.innerHTML = '<p>Aucun livre trouvé.</p>';
        const cta = document.createElement('div');
        catalogDyn.appendChild(cta);
        cta.classList.add('cta', 'cta__position');
        cta.innerHTML = '<a href="new-book.php" class="cta__txt--little">Ajouter un livre</a>'
    }
    if (searchInputDyn.value === "") {
        catalogDyn.removeChild(catalogDyn.firstChild)
    }
    // if (searchInputDyn.value != "") {
    //     // Créez un élément pour l'icône de croix
    //     const clearIcon = document.createElement('i');
    //     clearIcon.classList.add('fa-solid', 'fa-xmark', 'list__cross'); // Définissez une classe pour l'icône (à styliser en CSS)
    //     // clearIcon.innerHTML = 'X'; // Utilisez un caractère ou une icône pour l'icône de croix

    //     // Ajoutez l'icône de croix à côté de searchInputDyn
    //     searchInputDyn.insertAdjacentElement('afterend', clearIcon);

    //     // Ajoutez un gestionnaire d'événements pour réinitialiser la valeur de l'entrée au clic sur l'icône
    //     clearIcon.addEventListener('click', () => {
    //         searchInputDyn.value = ''; // Réinitialise la valeur de l'entrée
    //     });

    //     // Vous pouvez également masquer l'icône de croix lorsque l'entrée est vide
    //     searchInputDyn.addEventListener('input', () => {
    //         if (searchInputDyn.value === '') {
    //             clearIcon.style.display = 'none';
    //         } else {
    //             clearIcon.style.display = 'inline'; // Affiche l'icône quand il y a du texte dans l'entrée
    //         }
    //     });
    // }

}

