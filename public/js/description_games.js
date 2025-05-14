

//funzione che restituisce tutto quello che serve dll'api
function onjson(json){

    const gioco_tot=document.querySelector('#contenuto');

    const result = json[valore].data;
   
    //creo il mio box
     const gioco=document.createElement('div');
    gioco.classList.add('gioco');
  //titolo
    const title = document.createElement('span');
    tit=result.name;
    let titolo = result.name;
    title.textContent=titolo;
    title.classList.add('title');
    
    //image_header
    const image_header=document.createElement('img');
    image_header.src=result.header_image;
    img=result.header_image;
    const contenitore_immagine=document.createElement('div');
    contenitore_immagine.classList.add('contenitore_immagine');
    image_header.classList.add('immagine_header');
    contenitore_immagine.appendChild(image_header);


    //descrizione_gioco
    
    const descrizione=document.createElement('div');
    descrizione.textContent="Descrizione";
    descrizione.classList.add("descr");
    const descizione_generale=document.createElement('div');
    descizione_generale.classList.add('descrizione_generale');
    const contenitore=document.createElement('div');
    contenitore.classList.add('contenitore_descrizione');
    contenitore.appendChild(descizione_generale);
    let general_description=result.about_the_game;
    descizione_generale.innerHTML=general_description;

    
    //requisiti minimi per poter giocare
    const requisiti=document.createElement('div');
    requisiti.textContent="Requisiti Minimi";
    requisiti.classList.add("descr");
    const requisiti_minimi=document.createElement('div');
    requisiti_minimi.classList.add('requisiti');
    let requisiti_minimi_richiesti=result.pc_requirements.minimum;
    requisiti_minimi.innerHTML=requisiti_minimi_richiesti;


   

//appendo tutti gli elementi al nodo padre

    gioco.appendChild(title);
    gioco.appendChild(contenitore_immagine);
    gioco.appendChild(descrizione);
    gioco.appendChild(contenitore);
    gioco.appendChild(requisiti);
    gioco.appendChild(requisiti_minimi);
    
     //screenshot
     const screen=document.createElement('div');
     screen.textContent="Foto Gioco";
     screen.classList.add("descr");
     gioco.appendChild(screen);

     if (result.screenshots.length > 0) {
        const screenshotsContainer = document.createElement('div');
        screenshotsContainer.classList.add('contenitore_screen');

      //sia parte di modale che parte dei screen presi dal json
        const modale=document.createElement('div');
        const modalImage=document.createElement('img');


        for (let i = 0; i < result.screenshots.length; i++) {
            const screenshot = result.screenshots[i];
            const screen_gioco = document.createElement('img');
            screen_gioco.src = screenshot.path_thumbnail;
            screenshotsContainer.appendChild(screen_gioco);
            screen_gioco.classList.add('screen_thumbnail');


            screen_gioco.addEventListener('click',function(event){
        
              modale.classList.add('immagine_grande');
                modalImage.src=screen_gioco.src;
                gioco_tot.appendChild(modale);
                event.stopPropagation();
                btn_x.style.visibility="visible";
               
            });
           

          } 
          //button x della modale
          const btn_x=document.createElement('div');
          btn_x.classList.add('btn_x');
            modale.appendChild(btn_x);

            const x1=document.createElement('span');
            const x2=document.createElement('span');
            x1.classList.add('icon_x1');
            x2.classList.add('icon_x2');

            btn_x.appendChild(x1);
            btn_x.appendChild(x2);

            btn_x.addEventListener('click',function(){

                modale.remove();
                btn_x.style.visibility="hidden";
               
            });




          gioco.appendChild(screenshotsContainer);
          modale.appendChild(modalImage);
          gioco_tot.appendChild(modale);
  

     }
   //appendo tutti i gioco ad un nodo padre
       gioco_tot.appendChild(gioco);

  
}


// ottengo il valore(steam_id) dalla sessione del browser preso dall'elemento cliccato dalla home e faccio
//la fetch con questo valore 
let valore=sessionStorage.getItem('valore');
let formdata=new FormData();
formdata.append('valore',valore);


 fetch(BASE_URL+'description/info/'+valore)
.then(dispatchResponse)
.then(data=>onjson(data));
    

//funzione che converte la risposta della fetch da json ad oggetto
function dispatchResponse(response) {

    console.log(response);
    return response.json();
  }



  //funzione che indirizza alla home
function ritorna_home(){

    location.href="home";
}


const btn_home=document.querySelector("#btn_home");
btn_home.addEventListener('click',ritorna_home);




//funzione che dopo il click al button desideri fa la fetch al server per aggiungere l'elemento al database
function aggiungilista(){

    const data= new FormData(); 

    data.append('nome',tit);
    data.append('image',img);
    data.append('_token',csrf_token);
    console.log(BASE_URL);

    fetch(BASE_URL+"wishlist/add", {method: 'POST', body: data ,credentials: 'include' }).then(response => response.json())
    .then(data => {
      if (data.error) {
        alert("Il Gioco è già presente nella tua Wishlist.");
      } else if (data.success) {
        alert("Aggiunto alla tua Wishlist con Successo!!");
      }
    })
}

let img;
let tit;
const btn_desideri=document.querySelector("#btn_desideri");
btn_desideri.addEventListener('click',aggiungilista);
   



//funzione che indirizza alla visualizzazione della lista desideri
const btn_visualizza_desideri=document.querySelector("#btn_visualizza_desideri");

btn_visualizza_desideri.addEventListener('click',()=>{
  
    location.href="wishlist/view";
    
});
