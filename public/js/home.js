
let container = document.querySelector(".container-2");
let searchInput = document.querySelector("#search");
let searchIcon = document.querySelector("#icon");

searchIcon.addEventListener("click", function(event) {
  event.stopPropagation();
  container.classList.add("expanded");
 
  searchInput.focus();
});

document.addEventListener("click", function(event) {
  if (!container.contains(event.target)) {
    container.classList.remove("expanded");
  }
});





function onjson(json){
  const shop=document.querySelector("#shop");
    
  btn_carica.classList.remove('hidden');
    let num_results=json;
    console.log(num_results);

    let i=0;

    const loader=document.querySelector('.loader');
    loader.style.visibility="hidden";

    while(i<(num_results.length)){
        const doc=json[i];

        const titolo=doc.external;
        const title=document.createElement('span');
        title.textContent=titolo;
        const prezzo=doc.cheapest;
        const price=document.createElement('span');
        price.textContent=prezzo;
        price.classList.add('prezzo');
        let steam_id=doc.steamAppID;
        title.setAttribute("class","title");
        url_image="https://cdn.cloudflare.steamstatic.com/steam/apps/"+steam_id+"/capsule_sm_120.jpg";
    
        const image=document.createElement('img');
        image.src=url_image;
        image.setAttribute("class","immagine_shop");
        if(steam_id!==null){
            const sez_giochi= document.createElement('div');
            sez_giochi.classList.add('sez_giochi');
              sez_giochi.classList.add(steam_id);
            sez_giochi.appendChild(title);
            sez_giochi.appendChild(image);
            sez_giochi.appendChild(price);  
      
            
            shop.appendChild(sez_giochi);
            
            
        }
        i++;
    }
    
    const element_cliccable=document.querySelectorAll("#shop .sez_giochi");
    
    for(const box of element_cliccable){
        box.addEventListener('click',()=>{
          
          let valore=box.classList.value.split(" ")[1];
          sessionStorage.setItem('valore', valore);

          location.href='description';
        });
        
      }
    }
    
    function onResponce(response){
      console.log('Json ricevuto correttamente');
      return response.json();
    }
    
    let valore_lettera = 97;
    let lettera = String.fromCharCode(valore_lettera);
    

  
    console.log(lettera);
    
  const fetchApi = async () => {
  const response = await fetch(BASE_URL + 'collection/list/' + lettera);
  if (!response.ok) {
    console.error('Errore:', response.status, response.statusText);
    return 'Errore';
  }
  return await response.json();
}


    avvia();
    
    
   async function avvia() {
      const data = await fetchApi();
      onjson(data);
    }
   
  
    
    const btn_carica=document.querySelector('#btn_carica');

btn_carica.addEventListener('click',Api);

function Api(){
     
 if(valore_lettera===97){
   
     valore_lettera++;
}
    if(valore_lettera!==97){
        let lettera=String.fromCharCode(valore_lettera);
        let data =new FormData();
    data.append('lettera',lettera);
        console.log(lettera);
        console.log(valore_lettera);
        fetch('https://www.cheapshark.com/api/1.0/games?title=' + lettera)
        .then(onResponce).then(onjson);
        valore_lettera++;
        
    }
   
}






function onjson2(json){
  const shop=document.querySelector("#shop");
    
  while (shop.firstChild) {
    shop.removeChild(shop.firstChild);
    btn_carica.classList.add('hidden');
  }

    let num_results=json;
    console.log(num_results);

    let i=0;


    while(i<(num_results.length)){
   
        const doc=json[i];

        const titolo=doc.external;
        const title=document.createElement('span');
        title.textContent=titolo;
        const prezzo=doc.cheapest;
        const price=document.createElement('span');
        price.textContent=prezzo;
        let steam_id=doc.steamAppID;
        title.setAttribute("class","title");
        url_image="https://cdn.cloudflare.steamstatic.com/steam/apps/"+steam_id+"/capsule_sm_120.jpg";
    
        const image=document.createElement('img');
        image.src=url_image;
        image.setAttribute("class","immagine_shop");
        if(steam_id!==null){
            const sez_giochi= document.createElement('div');
            sez_giochi.classList.add('sez_giochi');
              sez_giochi.classList.add(steam_id);
            sez_giochi.appendChild(title);
            sez_giochi.appendChild(image);
            sez_giochi.appendChild(price);  
      
            
            shop.appendChild(sez_giochi);
            
            
        }
        i++;
    }
    const element_cliccable=document.querySelectorAll("#shop .sez_giochi");
    
    for(const box of element_cliccable){
      box.addEventListener('click',()=>{
        
        let valore=box.classList.value.split(" ")[1];
        sessionStorage.setItem('valore', valore);

        location.href='description';
      });
      
    }
  }



  let search_form=document.querySelector("#searchForm");
  search_form.addEventListener("submit",cerca_gioco);
 

function cerca_gioco(event){
 event.preventDefault();
const gioco_input=document.querySelector('#search');
const gioco_value=encodeURIComponent(gioco_input.value);

let data =new FormData();
    data.append('lettera',gioco_value);
 fetch('https://www.cheapshark.com/api/1.0/games?title=' +gioco_value)
 .then(onResponce).then(onjson2);



  console.log("Hai cercato:", gioco_value);
  if(gioco_value === ""){
   
  
valore_lettera=97;
lettera=String.fromCharCode(valore_lettera);
let data =new FormData();
    data.append('lettera',lettera);
    fetch(BASE_URL+'collection/list/'+lettera)
    .then(onResponce).then(onjson2);
    valore_lettera++;

  }
}

let toggleButton = document.querySelector("#toggleButton");
let Content = document.querySelector("#contenuto");

toggleButton.addEventListener("click", function() {
  Content.classList.toggle("open");
});

document.addEventListener("click", function(event) {
  let targetElement = event.target;

  if (!Content.contains(targetElement) && !toggleButton.contains(targetElement)) {
    Content.classList.remove("open");
  }
});




function esci(){

  location.href="logout";
}


const btn_home=document.querySelector("#btn_logout");
btn_home.addEventListener('click',esci);