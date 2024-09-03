function validateForm() {

    let x = document.forms["log"]["user"].value;
    let y = document.forms["log"]["pass"].value;
    var a = 0 ;
    const radio = document.querySelectorAll('input[name="type"]');
  

    if ( x== "" &&  y == "") {
      alert("Bisogna riempire le caselle");
      return false;
    } else if ( x == ""){
        alert("Bisogna riempire email ");
        return false;
    } else if ( y == ""){
        alert("Bisogna riempire la password ");
        return false;
    } else if ( y.length < 7){
        alert("Password troppo corta.");
        return false;
    } 

    
    for(var i = 0 ; i < radio.length; i++) {
      if (radio[i].checked){
        a=1;
        break;
      }
    }
    if (a == 0) {
      alert("Campo vuoto");
      return false;
    }
  
}


function getAge(DOB) {
  var today = new Date();
  var birthDate = new Date(DOB);
  var age = today.getFullYear() - birthDate.getFullYear();
  var m = today.getMonth() - birthDate.getMonth();
  if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
      age--;
  }    
  return age;
}

function isNumber(value) {
  if (typeof value === "string") {
      return !isNaN(value);
  }
}

function validateRegistrazione() {
  let nome = document.forms["registrazioneF"]["nome"].value;
  let cognome = document.forms["registrazioneF"]["cognome"].value;
  let data = document.forms["registrazioneF"]["data"].value;
  let email = document.forms["registrazioneF"]["email"].value;
  let pw = document.forms["registrazioneF"]["password"].value;
  let iban = document.forms["registrazioneF"]["iban"].value;
  let cap = document.forms["registrazioneF"]["cap"].value;

  let pwL = pw.length;
  let ibanL = iban.length;
  let capL = cap.length;

  if ( nome == ""){
    alert("Bisogna riempire il nome ");
    return false;
  } 
  
  if ( cognome  == ""){
    alert("Bisogna riempire il cognome ");
    return false;
  }

  if ( data == ""){
  alert("Bisogna riempire la data ");
  return false;
  } else if (getAge(data) < 18){
    alert("Devi essere maggiorenne per registrarti.");
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

  if ( cap == ""){
  alert("Bisogna riempire la cap ");
  return false;
  } else if (!isNumber(cap) || capL != 5 ) {
      alert("Valore cap non valido");
      return false;
  }
}




function validateUtente() {
  let nome = document.forms["clientejs"]["nome"].value;
  let cognome = document.forms["clientejs"]["cognome"].value;
  let data = document.forms["clientejs"]["data"].value;
  let email = document.forms["clientejs"]["email"].value;
  let pw = document.forms["clientejs"]["password"].value;
  let via = document.forms["clientejs"]["via"].value;
  let civico = document.forms["clientejs"]["civico"].value;
  let citta = document.forms["clientejs"]["citta"].value;
  let cap = document.forms["clientejs"]["cap"].value;



  let pwL = pw.length;
  let capL = cap.length;

  if ( nome == ""){
    alert("Bisogna riempire il nome")
    return false;
  } 
  
  if ( cognome  == ""){
    alert("Bisogna riempire la cognome ");
    return false;
  }

  if ( data == ""){
    alert("Bisogna riempire la data ");
    return false;
    } else if (getAge(data) < 18){
      alert("Devi essere maggiorenne per registrarti.");
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
}

function validateRistorante(){
  let nome = document.forms["registrazioneR"]["nome"].value;
  let ragione = document.forms["registrazioneR"]["ragione"].value;
  let iva = document.forms["registrazioneR"]["iva"].value;
  let email = document.forms["registrazioneR"]["email"].value;
  let pw = document.forms["registrazioneR"]["password"].value;
  let via = document.forms["registrazioneR"]["via"].value;
  let civico = document.forms["registrazioneR"]["civico"].value;
  let citta = document.forms["registrazioneR"]["citta"].value;
  let cap = document.forms["registrazioneR"]["cap"].value;
  let viasede = document.forms["registrazioneR"]["via_sede"].value;
  let civicosede = document.forms["registrazioneR"]["civico_sede"].value;
  let cittasede = document.forms["registrazioneR"]["citta_sede"].value;
  let citofonosede = document.forms["registrazioneR"]["citofono_sede"].value;
  let capsede= document.forms["registrazioneR"]["cap_sede"].value;

  

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
  
    if ( capsede == ""){
    alert("Bisogna riempire la cap della sede");
    return false;
    } else if (!isNumber(capsede) || capsL != 5 ) {
        alert("Valore cap della sede non valido ");
        return false;
    }
}


function ValidatePagamento() { 
  var a = 0 ;
  const radio = document.querySelectorAll('input[name="pagamento"]');

   
  for(var i = 0 ; i < radio.length; i++) {
    if (radio[i].checked){
      a=1;
      break;
    }
  }
  if (a == 0) {
    alert("Selezionare metodo di pagamento ");
    return false;
  }

}

function mostraPassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
