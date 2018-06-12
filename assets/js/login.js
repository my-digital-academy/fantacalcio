document.addEventListener('DOMContentLoaded', function(e){
    let form = document.querySelector('#login-form');
    let userInput = document.querySelector("input[name=username]");
    let passInput = document.querySelector("input[name=password]");

    form.addEventListener('submit', function(e){
        let message = document.querySelector('.error-message');
        if(userInput.value == '' && passInput.value == '' || userInput.value == '' || passInput.value == ''){
            e.preventDefault();
            message.textContent = 'Riempi tutti i campi';
            message.classList.add('fade-in');
        } 
    });
    userInput.addEventListener('blur',function(e){
        if(userInput.value == ''){
            userInput.classList.add('error-border');
            userInput.classList.add('fade-in');
        }
        else{
            userInput.classList.remove('error-border');
            userInput.classList.add('fade-in');
        }
    });
    passInput.addEventListener('blur',function(e){
        if(passInput.value == ''){
            passInput.classList.add('error-border');
            passInput.classList.add('fade-in');
        }
        else{
            passInput.classList.remove('error-border');
            passInput.classList.add('fade-in');
        }
    });
});
