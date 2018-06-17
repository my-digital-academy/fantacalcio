 /**
  * 
  * 
  * render module
  * 
  * 
*/
var Render = function() {
    // data players
    var players = {
            table: 'calciatori',
            query: 'select',
            data: []
        };

    // select tag main
    var main = document.querySelector('main');
    
    return {
        homePage: function() {
            // create page
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
                            <label class="col-form-label">Calciatore</label>
                            <select class="form-control" name="role" id="players" disabled></select>
                            <button class="btn btn-block btn-fanta mt-4" id="addPlayer">Aggiungi</button>
                        </form>
                    </div>
                    <div class="col-lg-6 d-flex flex-column" id="recordTeam">
                        <h3></h3>
                        <div>
                            <ul class="list-group list-group-flush list-player"></ul>
                        </div>
                    </div>
                </div>
            </div>
            `;
        },

        getObjPlayers: function() {
            return players;
        },

        getPlayers: function(playerList) {
            // select
            var select = document.getElementById('players');
            // save data
            players.data.push(playerList);
            for (var i = 0; i < players.data.length; i++) {
                playerList = `
                <option name="role">${players.data[i].surname} ${players.data[i].name}, ${players.data[i].role}</option>
                `
                select.innerHTML += playerList;
            }
        },

        teamPage: function() {
            main.innerHTML = `<h1>Squadra</h1>`
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
    // data team
    var team = {
        name: {
            table: 'squadre',
            query: 'insert',
	        data: ''
        },
        player: {
            table: 'tesserati',
            query: 'insert',
	        data: []
        }
    };
		

    return {
        getNameTeam: function() {
            // select input value
            var nameTeam = document.getElementById('nameTeam');
            // select h3
            var h3 = document.querySelector('#recordTeam h3');
            // add value
            h3.textContent = `${nameTeam.value}`;
            // save data
            team.name.data = nameTeam.value;
        },

        getPlayer: function(player) {
            // select list player
            var listPlayer = document.querySelector('.list-player');
            // save data
            team.player.data.push(player);
            // output list player
            for (var i = 0; i < team.player.data.length; i++) {
                player = `
                <li class="list-group-item">
                    <div class="d-flex align-items-center player-full-name">
                        <i class="fas fa-user-tie fa-2x"></i>
                        <p>${team.player.data[i].cognome} ${team.player.data[i].nome}</p>
                    </div>
                    <div class="d-flex align-items-center player-role">
                        <i class="fas fa-futbol fa-2x"></i>
                        <p>${team.player.data[i].posizione}</p>
                    </div>
                </li>
                `;
            }
            listPlayer.innerHTML += player;
            // add button save
            if (team.player.data.length == 3 ) {
                listPlayer.innerHTML += `<button class="btn btn-block btn-fanta mt-4" id="saveTeam">Salva squadra</button>`;
                // disable add player button
                var addPlayer = document.getElementById('addPlayer');
                addPlayer.setAttribute('disabled', ''); 
            }
        },

        getTeam: function() {
            return team;
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
        // ajax call for players
        var players = render.getObjPlayers();
        ajaxCall('json.php', JSON.stringify(players), test);
        // test function
        function test(param) {
            var json = JSON.parse(param);
            // get players obj
            var playersList = {};
            // get values
            for (var i = 0; i < json.calciatori.length; i++) {
                playersList.surname = json.calciatori[i].cognome;
                playersList.name = json.calciatori[i].nome;
                playersList.role = json.calciatori[i].posizione;
                render.getPlayers(playersList);
            }
        }

        // event form name team
        var formTeam = document.getElementById('formTeam');
        var formSelectDisabled = document.querySelector('#formPlayer select');
        formTeam.addEventListener('keyup', function(e) {
            // select element
            var recordTeam = document.getElementById('recordTeam');
            // add class
            recordTeam.classList.add('home-record');
            // editor home page
            editor.getNameTeam();
            // disabled
            formSelectDisabled.removeAttribute('disabled');
            if (e.target.value == '') {
                recordTeam.classList.remove('home-record');
                formSelectDisabled.setAttribute('disabled', '');
            }
        });

/*         //event form player
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
            namePlayer.value = '';
            surnamePlayer.value = '';
            role.value = '';
            // event save team
            var saveTeam = document.getElementById('saveTeam');
            if (saveTeam) {
                saveTeam.addEventListener('click', function() {
                    var team = editor.getTeam();
                    ajaxCall('json.php', JSON.stringify(team), scrivi);
                    

                    function scrivi(a){
                        console.log(a);
                    }
                });
            }
        }); */
    });
})();