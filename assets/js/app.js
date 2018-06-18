 /**
  * 
  * 
  * render module
  * 
  * 
*/
var Render = function() {
    // data team
    var team = {
        table: "all",
        query: "select",
        data: []
    }
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
                            <label class="col-form-label">Nome del team</label>
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

        getObjTeam: function() {
            return team;
        },

        getObjPlayers: function() {
            return players;
        },

        teamPage: function() {
            main.innerHTML = `
            <div class="container-fluid py-4 team-page">
                <h2>Team</h2>
                <div>
                   <ul></ul>
                </div>
            </div>
            `
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
    // data my team
    var myTeam = {
            table: 'squadre',
            query: 'insert',
            data: []
        };
        
    var myTeamObj = {
            data: []
        };

    return {
        getNameTeam: function() {
            // name team
            var nameTeam = document.getElementById('nameTeam');
            // select h3
            var h3 = document.querySelector('#recordTeam h3');
            // add value
            h3.textContent = `${nameTeam.value}`;
            // save data
            myTeam.data[0] = nameTeam.value;
        },

        getPlayer: function(player, playerObj) {
            // select list player
            var listPlayer = document.querySelector('.list-player');
            // save data
            myTeam.data.push(player);
            myTeamObj.data.push(playerObj);
            // output list player
            for (var i = 0; i < myTeamObj.data.length; i++) {
                player = `
                <li class="list-group-item">
                    <div class="d-flex align-items-center player-full-name">
                        <i class="fas fa-user-tie fa-2x"></i>
                        <p>${myTeamObj.data[i].cognome}</p>
                    </div>
                    <div class="d-flex align-items-center player-role">
                        <i class="fas fa-futbol fa-2x"></i>
                        <p>${myTeamObj.data[i].posizione}</p>
                    </div>
                </li>
                `;
            }
            listPlayer.innerHTML += player;
            // add button save
            if (myTeamObj.data.length == 3 ) {
                listPlayer.innerHTML += `<button class="btn btn-block btn-fanta mt-4" id="saveTeam">Salva squadra</button>`;
                // disable add player button
                var addPlayer = document.getElementById('addPlayer');
                addPlayer.setAttribute('disabled', '');
            }
        },

        getObjTeam: function() {
            return myTeam;
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

        // instance Render and Editor
        var render = Render();
        var editor = Editor();

        /*----------HOME PAGE----------------*/
        var team = render.getObjTeam();
        ajaxCall('json.php', JSON.stringify(team), getID);
        // functtion get ID user
        function getID(data) {
            var json = JSON.parse(data);
            console.log(json);
            // id user
            var idUser = json.utente.id;
            // id team
            var id = json.squadra.id;
            // check id 
            if ( id == undefined) {
                // render home page
                render.homePage();
                // ajax call for players
                var players = render.getObjPlayers();
                ajaxCall('json.php', JSON.stringify(players), getOptions);
                // getOptions function
                function getOptions(data) {
                    let select = document.getElementById('players');
                    select.innerHTML = data;
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

                //event form player
                var formPlayer = document.getElementById('formPlayer')
                formPlayer.addEventListener('submit', function(e) {
                    e.preventDefault();
                    // select input value
                    var playerID = document.getElementById('players');
                    var player = document.querySelector(`option[value='${playerID.value}']`);
                    var playerText = player.textContent;
                    var playerArr = playerText.split(',');
                    // create array player for call ajax
                    var player;
                    // create obj player for list
                    var playerObj = {};
                    // add value
                    player = playerID.value;
                    playerObj.cognome = playerArr[0];
                    playerObj.posizione = playerArr[1];
                    editor.getPlayer(player, playerObj);
                    // event save team
                    var saveTeam = document.getElementById('saveTeam');
                    if (saveTeam) {
                        saveTeam.addEventListener('click', function() {
                            var myTeam = editor.getObjTeam();
                            myTeam.data.splice(1,0,idUser); 
                            ajaxCall('json.php', JSON.stringify(myTeam), redirectTeamPage);
                            // redirect team page
                            function redirectTeamPage(){
                                render.teamPage();
                            }
                        });
                    }
                });
            } else {
                render.teamPage();
            }
        }


        /*-----------TEAM PAGE----------------*/

    });
})();