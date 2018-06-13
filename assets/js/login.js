document.addEventListener('DOMContentLoaded', function(e){
    Form();
});

var Form = function (){
    let form = document.querySelector('#login-form');
    let userInput = document.querySelector("input[name=username]");
    let passInput = document.querySelector("input[name=password]");
    let valid = [false,false];

    form.addEventListener('submit', function(e){
        let message = document.querySelector('.error-message');
        if(validate()==false){
            e.preventDefault();
            message.textContent = 'Riempi tutti i campi';
            message.classList.add('fade-in');
        } 
    });
    userInput.addEventListener('blur',function(){
        if(userInput.value == ''){
            userInput.classList.add('error-border');
            userInput.classList.add('fade-in');
            valid[0] = false;
        }
        else{
            userInput.classList.remove('error-border');
            userInput.classList.add('fade-in');
            valid[0] = true;
        }
    });
    passInput.addEventListener('blur',function(){
        if(passInput.value == ''){
            passInput.classList.add('error-border');
            passInput.classList.add('fade-in');
            valid[1] = false;
        }
        else{
            passInput.classList.remove('error-border');
            passInput.classList.add('fade-in');
            valid[1] = true;
        }
    });

    function validate(){
        for (let i = 0; i < valid.length; i++) {
            if(valid[i] == false){
                return false;
            }
        }
        return true;
    }
}
