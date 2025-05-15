// --- Gestione JSON ricevuto ---
function onJson(json) {
    const contenuto = document.querySelector("#contenuto");
    contenuto.innerHTML = ''; // pulisce prima di caricare nuovi elementi
    let conteggio = 0;

    if (json.length === 0) {
        mostraMessaggioVuoto(contenuto);
        return;
    }

    json.forEach(gioco => {
        const elemento = creaElementoGioco(gioco);
        contenuto.appendChild(elemento);
        conteggio++;
    });

    aggiornaEventiEliminazione(contenuto, conteggio);
}

// --- Crea singolo elemento della lista ---
function creaElementoGioco(gioco) {
    const elemento = document.createElement('div');
    elemento.classList.add('desideri');

    // Nome gioco
    const nome = document.createElement('span');
    nome.textContent = gioco.title;
    nome.classList.add('nomi');
    elemento.appendChild(nome);

    // Immagine
    const immagine = document.createElement('img');
    immagine.src = gioco.image;
    elemento.appendChild(immagine);

    // Bottone elimina
    const bottoneElimina = document.createElement('button');
    bottoneElimina.textContent = "Elimina";
    bottoneElimina.classList.add('btn_elimina');
    elemento.appendChild(bottoneElimina);

    return elemento;
}

// --- Mostra messaggio lista vuota ---
function mostraMessaggioVuoto(contenitore) {
    const messaggio = document.createElement('p');
    messaggio.textContent = "La tua lista è vuota, aggiungi un gioco alla tua lista";
    messaggio.classList.add('vuoto');
    contenitore.appendChild(messaggio);
}

// --- Gestione eliminazione ---
function aggiornaEventiEliminazione(contenitore, conteggioIniziale) {
    const bottoni = contenitore.querySelectorAll(".btn_elimina");
    let conteggio = conteggioIniziale;

    bottoni.forEach(bottone => {
        bottone.addEventListener('click', () => {
            const elemento = bottone.closest('.desideri');
            const nomeGioco = elemento.querySelector('span').textContent;

            elemento.remove();
            conteggio--;

            eliminaElemento(nomeGioco);

            if (conteggio === 0) {
                mostraMessaggioVuoto(contenitore);
            }

            console.log(`Elementi rimanenti: ${conteggio}`);
        });
    });
}

// --- Elimina elemento da server ---
function eliminaElemento(nomeGioco) {
    console.log(`Elimino: ${nomeGioco}`);
    const dati = new FormData();
    dati.append('nome_elemento', nomeGioco);
    dati.append('_token', csrf_token);

    fetch(`${BASE_URL}wishlist/remove`, {
        method: 'POST',
        body: dati
    }).then(r => console.log("Risposta eliminazione:", r));
}

// --- Utility fetch ---
function dispatchResponse(response) {
    return response.json();
}

// --- Fetch iniziale lista ---
fetch("list").then(dispatchResponse).then(onJson);

// --- Navigazione ---
document.querySelector("#btn_indietro").addEventListener('click', () => {
    location.href = `${BASE_URL}description`;
});

document.querySelector("#btn_home").addEventListener('click', () => {
    location.href = `${BASE_URL}home`;
});
