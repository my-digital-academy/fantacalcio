var api = {
    formHome: {
        section: {
            title: 'Crea la tua squadra'
        },
        data: {
            formSquadra: {
                action: '#',
                input: {
                    label: 'Nome della squadra',
                    type: 'text',
                    name: 'nomeSquadra'
                },
                button: 'Aggiungi'
            },
            subTitle: 'Inserisci giocatori',
            formGiocatore: {
                action: '#',
                input: [
                    {
                        label: 'Nome',
                        type: 'text',
                        name: 'nomeGiocatore'
                    },
                    {
                        label: 'Cognome',
                        type: 'text',
                        name: 'cognomeGiocatore'
                    },
                    {
                        label: 'Ruolo',
                        type: 'text',
                        name: 'ruoloGiocatore'
                    }
                ],
                button: 'Aggiungi'
            }
        }
    },
    displayHome: {
        section: {
            title: 'Nome squadra'
        }
    }
}