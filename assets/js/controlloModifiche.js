function isNumber(value) {
    if (typeof value === "string") {
        return !isNaN(value);
    }
  }
  
  function validateRistorante(){
    let nome = document.forms["risto"]["nome"].value;
    let ragione = document.forms["risto"]["ragione_sociale"].value;
    let iva = document.forms["risto"]["partita_iva"].value;
    let email = document.forms["risto"]["email"].value;
    let pw = document.forms["risto"]["password"].value;
    let via = document.forms["risto"]["via"].value;
    let civico = document.forms["risto"]["civico"].value;
    let citta = document.forms["risto"]["citta"].value;
    let citofono = document.forms["risto"]["citofono"].value;
    let cap = document.forms["risto"]["cap"].value;
    let viasede = document.forms["risto"]["via_sede"].value;
    let civicosede = document.forms["risto"]["civico_sede"].value;
    let cittasede = document.forms["risto"]["citta_sede"].value;
    let citofonosede = document.forms["risto"]["citofono_sede"].value;
    let capsede= document.forms["risto"]["cap_sede"].value;
  
    
  
    let pwL = pw.length;
    let ivaL = iva.length;
    let capL = cap.length;
    let capsL =capsede.length;

    if ( nome == ""){
      alert("Bisogna riempire il nome ");
      return false;
    } 
    
    if ( ragione  == ""){
      alert("Bisogna riempire la ragione sociale ");
      return false;
    }
  
    if ( iva == ""){
    alert("Bisogna riempire l'iva ");
    return false;
    } else if (!isNumber(iva) || ivaL < 11 ) {
      alert("Valore iva non valido");
      return false;
    }
  
  
    if ( email == ""){
    alert("Bisogna riempire la email ");
    return false;
    } else if ( email.includes(".") === false || email.includes("@") === false ){
      alert("email non valida");
      return false;
    }
  
    if ( pw == ""){
    alert("Bisogna riempire la password ");
    return false;
    } else {
      if (pwL < 7){
       alert("La password deve essere lunga almeno 7 caratteri");
       return false;
      }
    }
    
    if ( via == ""){
    alert("Bisogna riempire la via");
    return false;
    } 
    if ( civico == ""){
      alert("Bisogna riempire il civico");
      return false;
    } 
    if ( citta == ""){
      alert("Bisogna riempire la citta");
      return false;
    } 
  
    if ( cap == ""){
    alert("Bisogna riempire la cap ");
    return false;
    } else if (!isNumber(cap) || capL != 5 ) {
        alert("Valore cap non valido");
        return false;
    }
    if ( viasede == ""){
      alert("Bisogna riempire la via della sede");
      return false;
      } 
      if ( civicosede == ""){
        alert("Bisogna riempire il civico della sede");
        return false;
      }
      if ( cittasede == ""){
        alert("Bisogna riempire la citta della sede");
        return false;
      } 
      if ( citofonosede == ""){
        alert("Bisogna riempire il citofono della sede");
        return false;
      } 
      if ( citofono == ""){
        alert("Bisogna riempire il citofono.");
        return false;
      } 
    
      if ( capsede == ""){
      alert("Bisogna riempire la cap della sede");
      return false;
      } else if (!isNumber(capsede) || capsL != 5 ) {
          alert("Valore cap della sede non valido ");
          return false;
      }
  }
  

  function validateModificaF(){
    let credito = document.forms["fattorinoMod"]["credito"].value;;
    let email = document.forms["fattorinoMod"]["email"].value;
    let pw = document.forms["fattorinoMod"]["password"].value;
    let iban = document.forms["fattorinoMod"]["iban"].value;
    let cap = document.forms["fattorinoMod"]["zona"].value;
  
    let pwL = pw.length;
    let ibanL = iban.length;
    let capL = cap.length;
  
    if ( credito == ""){
      alert("Bisogna riempire il credito ");
      return false;
    } 

  
    if ( email == ""){
    alert("Bisogna riempire la email ");
    return false;
    } else if ( email.includes(".") === false || email.includes("@") === false ){
      alert("email non valida");
      return false;
    }
  
    if ( pw == ""){
    alert("Bisogna riempire la password ");
    return false;
    } else {
      if (pwL < 7){
       alert("La password deve essere lunga almeno 7 caratteri");
       return false;
      }
    }
    
    if ( iban == ""){
    alert("Bisogna riempire l'iban ");
    return false;
    } else  if ( ibanL != 27){
      alert("iban non valido");
      return false;
    }
    if (cap != ''){
      if (!isNumber(cap) || capL != 5 ) {
        alert("Valore cap non valido");
        return false;
      }
   }
  }

  function validateModificheC() {
    
    let email = document.forms["modificaC"]["email"].value;
    let pw = document.forms["modificaC"]["password"].value;
    let via = document.forms["modificaC"]["via"].value;
    let civico = document.forms["modificaC"]["civico"].value;
    let citofono = document.forms["modificaC"]["citofono"].value;
    let citta = document.forms["modificaC"]["citta"].value;
    let cap = document.forms["modificaC"]["cap"].value;
  
  
  
    let pwL = pw.length;
    let capL = cap.length;
  
 
    if ( email == ""){
    alert("Bisogna riempire la email ");
    return false;
    } else if ( email.includes(".") === false || email.includes("@") === false ){
      alert("email non valida");
      return false;
    }
  
    if ( pw == ""){
    alert("Bisogna riempire la password ");
    return false;
    } else {
      if (pwL < 7){
       alert("La password deve essere lunga almeno 7 caratteri");
       return false;
      }
    }
    
    if ( via == ""){
      alert("Bisogna riempire la via");
      return false;
    } 
    if ( civico == ""){
      alert("Bisogna riempire il civico");
      return false;
    } 
    if ( citofono == ""){
      alert("Bisogna riempire il citofono");
      return false;
    } 
    if ( citta == ""){
      alert("Bisogna riempire la citta");
      return false;
    } 
  
    if ( cap == ""){
    alert("Bisogna riempire la cap ");
    return false;
    } else if (!isNumber(cap) || capL != 5 ) {
        alert("Valore cap non valido");
        return false;
    }
  }

function validateAggiuntaCarta(){
  let numero = document.forms["aggiungiCarta"]["numero"].value;
  let nl = numero.length;
  let nome = document.forms["aggiungiCarta"]["nome"].value;
  let mese = document.forms["aggiungiCarta"]["mese"].value;
  let anno = document.forms["aggiungiCarta"]["anno"].value;
  let codice = document.forms["aggiungiCarta"]["codice"].value;
  

  if ( numero== ""){
    alert("Bisogna inserire il numero della carta");
    return false;
    } else if (!isNumber(numero) || nl < 13 || nl > 16  ) {
        alert("Valore numero non valido");
        return false;
    }

    if ( nome== "" ){
      alert("Bisogna inserire il nome presente sulla carta");
      return false;
      } 
    if ( mese == ""){
      alert("Bisogna inserire il mese di scadenza");
      return false;
      } else if (!isNumber(mese) || mese < 1 || mese > 12  ) {
          alert("Valore mese non valido");
          return false;
      }
  
    if ( anno == ""){
      alert("Bisogna inserire l'anno di scadenza");
      return false;
      } else if (!isNumber(anno) || anno < 2023  ) {
          alert("Valore anno non valido");
          return false;
    }
    if ( codice== ""){
      alert("Bisogna inserire il codice dietro la carta");
      return false;
      } else if (!isNumber(codice) || codice.length != 3   ) {
          alert("Valore codice non valido");
          return false;
      }
}

function  validateRimozioneCarta(){
  var a = 0 ;
  const radio = document.querySelectorAll('input[name="numero"]');

   
  for(var i = 0 ; i < radio.length; i++) {
    if (radio[i].checked){
      a=1;
      break;
    }
  }
  if (a == 0) {
    alert("Selezionare carta ");
    return false;
  }
}

function validateRimuoviF(){
  let cap = document.forms["rimuoviCap"]["zona"].value;
;
  let capL = cap.length;

  if (cap != ''){
    if (!isNumber(cap) || capL != 5 ) {
      alert("Valore cap non valido");
      return false;
    }
 }
}