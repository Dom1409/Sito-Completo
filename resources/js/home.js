// Element references
const container = document.querySelector(".container-2");
const searchInput = document.querySelector("#search");
const searchIcon = document.querySelector("#icon");
const shop = document.querySelector("#shop");
const btnCarica = document.querySelector('#btn_carica');
const searchForm = document.querySelector("#searchForm");
const toggleButton = document.querySelector("#toggleButton");
const content = document.querySelector("#contenuto");
const btnLogout = document.querySelector("#btn_logout");

let valoreLettera = 97;

// Event listeners
searchIcon.addEventListener("click", event => {
    event.stopPropagation();
    container.classList.add("expanded");
    searchInput.focus();
});

document.addEventListener("click", event => {
    if (!container.contains(event.target)) {
        container.classList.remove("expanded");
    }

    if (!content.contains(event.target) && !toggleButton.contains(event.target)) {
        content.classList.remove("open");
    }
});

toggleButton.addEventListener("click", () => {
    content.classList.toggle("open");
});

btnLogout.addEventListener("click", () => {
    location.href = "logout";
});

btnCarica.addEventListener('click', fetchNextPage);
searchForm.addEventListener("submit", cercaGioco);

// API Fetch
const fetchApi = async (lettera) => {
    try {
        const response = await fetch(`${BASE_URL}collection/list/${lettera}`);
        if (!response.ok) throw new Error(`Errore: ${response.status}`);
        return await response.json();
    } catch (error) {
        console.error("Fetch error:", error);
        return [];
    }
};

async function avvia() {
    const data = await fetchApi(String.fromCharCode(valoreLettera));
    renderShop(data);
}

function fetchNextPage() {
    valoreLettera++;
    const lettera = String.fromCharCode(valoreLettera);
    fetchApi(lettera).then(renderShop);
}

function cercaGioco(event) {
    event.preventDefault();
    const giocoValue = encodeURIComponent(searchInput.value.trim());

    if (!giocoValue) {
        valoreLettera = 97;
        avvia();
        return;
    }

    fetchApi(giocoValue).then(renderShopClear);
    console.log("Hai cercato:", giocoValue);
}

// Utility to create game card
function createCard({ steamAppID, external, cheapest }) {
    if (!steamAppID) return;

    const card = document.createElement("div");
    card.classList.add("sez_giochi", steamAppID);

    const title = document.createElement("span");
    title.classList.add("title");
    title.textContent = external;

    const price = document.createElement("span");
    price.classList.add("prezzo");
    price.textContent = cheapest;

    const image = document.createElement("img");
    image.classList.add("immagine_shop");
    image.src = `https://cdn.cloudflare.steamstatic.com/steam/apps/${steamAppID}/capsule_sm_120.jpg`;

    card.append(title, image, price);
    card.addEventListener("click", () => {
        sessionStorage.setItem("valore", steamAppID);
        location.href = "description";
    });

    shop.appendChild(card);
}

function renderShop(data) {
    btnCarica.classList.remove("hidden");
    document.querySelector(".loader").style.visibility = "hidden";
    data.forEach(createCard);
}

function renderShopClear(data) {
    shop.innerHTML = "";
    btnCarica.classList.add("hidden");
    renderShop(data);
}

// Init
avvia();
