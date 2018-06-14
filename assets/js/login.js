document.addEventListener('DOMContentLoaded', function(e){
    formValidation();
});

var formValidation = function (){
    let form = document.querySelector('#login-form');
    let userInput = document.querySelector("input[name=username]");
    let passInput = document.querySelector("input[name=password]");
    let valid = [false,false];

    //Focus user input
    userInput.focus();

    form.addEventListener('submit', function(e){
        //Prevent default to validate form
        e.preventDefault();
        //Lost focus in all inputs for handling their validation events
        userInput.blur();
        passInput.blur();
        //Call to validate() and check if form is validated
        if(!validate()){
            //Call fillErrorMessage() to show error message
            fillErrorMessage("Riempi tutti i campi");
        }
        else{
            //Send data as JSON to login.php page and
            //retrieve received response with receiveLogin()
            let json = {
                username: userInput.value,
                password: passInput.value,
            };
            //Call AJAX function and send JSON to form.action page
            ajaxCall(form.action,JSON.stringify(json),receiveLogin);
        }
    });
    //Event listener that validate single input
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
    //Event listener that validate single input
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
    //Function that validate all input forms
    function validate(){
        for (let i = 0; i < valid.length; i++) {
            if(valid[i] == false){
                return false;
            }
        }
        return true;
    }
    //Callback of AJAX call
    function receiveLogin(data){
        if(data == "ok"){
            window.location.replace("index.php");
        }
        else if(data == "errore"){
            fillErrorMessage("Username o password errati");
        }
        else{
            alert(data);
        }
    }
    //Function that show error messages
    function fillErrorMessage(msg){
        let message = document.querySelector(".error-message");
        message.textContent = msg;
        message.classList.add("fade-in");
    }
}

