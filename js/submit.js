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

export async function callApi(method, data){
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