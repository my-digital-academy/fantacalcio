 /**
  * 
  * 
  * modulo Render
  * 
  * 
*/
var Render = function(api) {
    
    var formHome = api.formHome;
    var displayHome = api.displayHome;

    return {
        formSquadra: function() {
            var colForm = document.getElementById('colForm');
            // h3
            var h3 = document.createElement('h3');
            h3.textContent = formHome.section.title;
            // form squadra
            var formS = document.createElement('form');
            formS.setAttribute('action', formHome.data.formSquadra.action);
            formS.setAttribute('id', 'formSquadra');
            var labelS = document.createElement('label');
            labelS.classList.add('col-form-label');
            labelS.textContent = formHome.data.formSquadra.input.label;
            var inputS = document.createElement('input');
            inputS.classList.add('form-control');
            inputS.setAttribute('type', formHome.data.formSquadra.input.type);
            inputS.setAttribute('id', 'squadra');
            var buttonS = document.createElement('button');
            buttonS.classList.add('btn', 'btn-fanta', 'mt-4');
            buttonS.textContent = formHome.data.formSquadra.button;
            //h4
            var h4 = document.createElement('h4');
            h4.textContent = formHome.data.subTitle;
            // form giocatore
            var formG = document.createElement('form');
            formG.setAttribute('action', formHome.data.formGiocatore.action);
            formG.setAttribute('id', 'formGiocatore');
            for (var i = 0; i < formHome.data.formGiocatore.input.length; i++) {
                var label = document.createElement('label');
                label.classList.add('col-form-label');
                label.textContent = formHome.data.formGiocatore.input[i].label;
                var input = document.createElement('input');
                input.classList.add('form-control');
                input.setAttribute('type', formHome.data.formGiocatore.input[i].type);
                // append
                formG.appendChild(label);
                formG.appendChild(input);
            }
            // button
            var buttonG = document.createElement('button');
            buttonG.classList.add('btn', 'btn-fanta', 'mt-4');
            buttonG.textContent = formHome.data.formGiocatore.button;
            // 
            colForm.appendChild(h3);
            colForm.appendChild(formS);
            formS.appendChild(labelS);
            formS.appendChild(inputS);
            formS.appendChild(buttonS);
            colForm.appendChild(h4);
            colForm.appendChild(formG);
            formG.appendChild(buttonG);

        },

        displaySquadra: function() {
            var colRegistrazione = document.getElementById('colRegistrazione');
            // h3
            var h3 = document.createElement('h3');
            h3.setAttribute('id', 'nomeSquadra');
            h3.textContent = displayHome.section.title;
            // append
            colRegistrazione.appendChild(h3);
        }
    }
}(api);


/**
 * 
 * 
 *  modulo editor
 * 
 * 
 */
var Editor = (function(api, Render) {


    return {

    }
})(api, Render);


/**
 * 
 * 
 * modulo app
 * 
 * 
*/
var App = (function(Render) {
    document.addEventListener('DOMContentLoaded', function() {
        
        Render.formSquadra();
        Render.displaySquadra();


    });

})(Render, Editor);