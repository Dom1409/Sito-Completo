// Variabili globali utili
let gameTitle, gameImage;
const BASE_URL = window.location.origin;
const gameContainer = document.querySelector('#contenuto');

// Fetch iniziale
const gameId = sessionStorage.getItem('valore');
fetch(`${BASE_URL}/description/info/${gameId}`)
    .then(dispatchResponse)
    .then(json => renderGame(json[gameId].data));

// Funzioni di utilità
function dispatchResponse(response) {
    return response.json();
}

function createElement(tag, className = '', content = '') {
    const el = document.createElement(tag);
    if (className) el.classList.add(className);
    if (content) el.textContent = content;
    return el;
}

// Render principale
function renderGame(data) {
    const gameBox = createElement('div', 'gioco');
    gameTitle = data.name;
    gameImage = data.header_image;

    // Titolo
    const title = createElement('span', 'title', gameTitle);
    gameBox.appendChild(title);

    // Immagine header
    const imageHeader = createElement('img', 'immagine_header');
    imageHeader.src = gameImage;
    const imageContainer = createElement('div', 'contenitore_immagine');
    imageContainer.appendChild(imageHeader);
    gameBox.appendChild(imageContainer);

    // Descrizione
    gameBox.appendChild(createElement('div', 'descr', 'Descrizione'));
    const descriptionWrapper = createElement('div', 'contenitore_descrizione');
    const descriptionContent = createElement('div', 'descrizione_generale');
    descriptionContent.innerHTML = data.about_the_game;
    descriptionWrapper.appendChild(descriptionContent);
    gameBox.appendChild(descriptionWrapper);

    // Requisiti minimi
    gameBox.appendChild(createElement('div', 'descr', 'Requisiti Minimi'));
    const requirements = createElement('div', 'requisiti');
    requirements.innerHTML = data.pc_requirements.minimum;
    gameBox.appendChild(requirements);

    // Screenshot
    if (data.screenshots?.length) {
        gameBox.appendChild(createElement('div', 'descr', 'Foto Gioco'));
        const screenshotsContainer = createElement('div', 'contenitore_screen');
        const modal = createModal();

        data.screenshots.forEach(screenshot => {
            const thumb = createElement('img', 'screen_thumbnail');
            thumb.src = screenshot.path_thumbnail;
            thumb.addEventListener('click', () => {
                modal.image.src = thumb.src;
                modal.container.classList.add('immagine_grande');
                modal.closeBtn.style.visibility = 'visible';
                gameContainer.appendChild(modal.container);
            });
            screenshotsContainer.appendChild(thumb);
        });

        gameBox.appendChild(screenshotsContainer);
    }

    gameContainer.appendChild(gameBox);
}

// Modale per screenshot
function createModal() {
    const modal = createElement('div');
    const modalImage = createElement('img');
    const closeBtn = createElement('div', 'btn_x');

    const x1 = createElement('span', 'icon_x1');
    const x2 = createElement('span', 'icon_x2');
    closeBtn.appendChild(x1);
    closeBtn.appendChild(x2);

    closeBtn.addEventListener('click', () => {
        modal.remove();
        closeBtn.style.visibility = 'hidden';
    });

    modal.appendChild(modalImage);
    modal.appendChild(closeBtn);

    return { container: modal, image: modalImage, closeBtn };
}

// Aggiungi alla wishlist
function aggiungiAllaWishlist() {
    const formData = new FormData();
    formData.append('nome', gameTitle);
    formData.append('image', gameImage);
    formData.append('_token', csrf_token);

    fetch(`${BASE_URL}/wishlist/add`, {
        method: 'POST',
        body: formData,
    })
        .then(res => res.json())
        .then(data => {
            alert(data.success
                ? "Aggiunto alla tua Wishlist con Successo!!"
                : "Il Gioco è già presente nella tua Wishlist.");
        });
}

// Navigazione
document.querySelector('#btn_home').addEventListener('click', () => {
    location.href = "home";
});

document.querySelector('#btn_desideri').addEventListener('click', aggiungiAllaWishlist);

document.querySelector('#btn_visualizza_desideri').addEventListener('click', () => {
    location.href = "wishlist/view";
});
