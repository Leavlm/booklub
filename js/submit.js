//calling the API in async

const form = document.querySelector('.form-js');
const inputTtl = document.querySelector('#title');
const inputAuthor = document.querySelector('#author');
const inputPages = document.querySelector('#pages');4
const inputs = document.querySelectorAll('.input-js')



function displayMessage(message, duration){
    const messageElement = document.getElementById('message');
    // Display the message
    messageElement.style.display = 'block';
    messageElement.textContent = message;

    // Hide the message after the specified duration
    setTimeout(function() {
      messageElement.style.display = 'none';
    }, duration);
  }



  

  // -----------------ABORTED--------
  // TESTING ADDING A BOOK IN ASYNC 
  // -----------------ABORTED--------
  //listening to the submit event to prevent default behavior 
// form.addEventListener('submit', e =>{
//     e.preventDefault();
//     addBook(inputTtl.value, inputAuthor.value, inputPages.value)
//     .then(apiResponse => {
//         if(!apiResponse.result){
//             console.error('Erreur lors de l\'ajout')
//             return;
//         }
//         inputs.value = "";
//         displayMessage('Votre livre a été ajouté !', 5000);

//     })

// })

// export async function callApi(method, data){
//     try{
//         const response = await fetch("api.php", {
//             method: method,
//             headers: {
//                 'Content-Type': 'application/json'
//             },
//             body: JSON.stringify(data)
//         }) 
//         return response.json();

//     }
//     catch(error){
//         console.error('error')
//     }

// }


// function addBook(bookTitle, bookAuthor, pageNb){
//     const data = {
//         action: 'addBook',
//         bookTitle: bookTitle,
//         bookAuthor: bookAuthor,
//         pageNb: pageNb,
//     };
//     return callApi('PUT', data)
// } 