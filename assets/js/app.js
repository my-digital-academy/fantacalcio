 /**
  * 
  * 
  * render module
  * 
  * 
*/
var Render = function() {
    // select tag main
    var main = document.querySelector('main');
    
    return {
        homePage: function() {
            main.innerHTML = `
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-lg-6 d-flex flex-column home">
                        <h3>Crea la tua squadra</h3>
                        <form action="#" id="formTeam">
                            <label class="col-form-label">Nome della squadra</label>
                            <input class="form-control" type="text" id="nameTeam">
                        </form>
                        <h4>Inserisci giocatore</h4>
                        <form action="#" id="formPlayer">
                            <label class="col-form-label">Nome</label>
                            <input class="form-control" type="text" id="namePlayer" disabled>
                            <label class="col-form-label">Cognome</label>
                            <input class="form-control" type="text" id="surnamePlayer" disabled>
                            <label class="col-form-label">Ruolo</label>
                            <select class="form-control" name="role" id="rolePlayer" disabled>
                                <option name="role">Portiere</option>
                                <option name="role">Difensore</option>
                                <option name="role">Centrocampista</option>
                                <option name="role">Attaccante</option>
                            </select>
                            <button class="btn btn-block btn-fanta mt-4">Aggiungi</button>
                        </form>
                    </div>
                    <div class="col-lg-6 d-flex flex-column" id="recordTeam">
                        <h3></h3>
                        <div>
                            <ul class="list-group list-group-flush list-player">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            `;
        }
    }
};


/**
 * 
 * 
 * editor module
 * 
 * 
 */
var Editor = function() {
    var tesserati = [];
    var player;

    return {
        getNameTeam: function() {
            // select input value
            var nameTeam = document.getElementById('nameTeam');
            // select h3
            var h3 = document.querySelector('#recordTeam h3');
            // add value
            h3.textContent = `${nameTeam.value}`;
        },

        getPlayer: function(player) {
            // select list player
            var listPlayer = document.querySelector('.list-player');
            // push array 
            tesserati.push(player);
            for (var i = 0; i < tesserati.length; i++) {
                player = `
                <li class="list-group-item">
                    <div class="d-flex align-items-center player-full-name">
                        <i class="fas fa-user-tie fa-2x"></i>
                        <p>${tesserati[i].cognome} ${tesserati[i].nome}</p>
                    </div>
                    <div class="d-flex align-items-center player-role">
                        <i class="fas fa-futbol fa-2x"></i>
                        <p>${tesserati[i].posizione}</p>
                    </div>
                </li>
                `;
            }
            listPlayer.innerHTML += player;
        }
    }
};


/**
 * 
 * 
 * app module
 * 
 * 
*/
var App = (function() {
    document.addEventListener('DOMContentLoaded', function() {

        // instance Render
        var render = Render();
        var editor = Editor();

        // render home page
        render.homePage();

        // event form name team
        var formTeam = document.getElementById('formTeam');
        var formInputDisabled = document.querySelectorAll('#formPlayer input');
        var formSelectDisabled = document.querySelector('#formPlayer select');
        formTeam.addEventListener('keyup', function(e) {
            // select element
            var recordTeam = document.getElementById('recordTeam');
            // add class
            recordTeam.classList.add('home-record');
            // editor home page
            editor.getNameTeam();
            for (var i = 0; i < formInputDisabled.length; i++) {
                formInputDisabled[i].removeAttribute('disabled');
            }
            formSelectDisabled.removeAttribute('disabled');
            if (e.target.value == '') {
                recordTeam.classList.remove('home-record');
                for (var i = 0; i < formInputDisabled.length; i++) {
                formInputDisabled[i].setAttribute('disabled', '');
                }
                formSelectDisabled.setAttribute('disabled', '');
            }
        });

        //event form player
        var formPlayer = document.getElementById('formPlayer')
        formPlayer.addEventListener('submit', function(e) {
            e.preventDefault();
            // select input value
            var namePlayer = document.getElementById('namePlayer');
            var surnamePlayer = document.getElementById('surnamePlayer');
            var role = document.getElementById('rolePlayer');
            // create obj player
            var player = {};
            // add value
            player.cognome = surnamePlayer.value;
            player.nome = namePlayer.value;
            player.posizione = role.value;
            editor.getPlayer(player);
        });
    });
})();