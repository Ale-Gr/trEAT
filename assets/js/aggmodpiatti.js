function validatePiatti(){
    // effettuo i controlli sui valori 
    let prezzo = document.forms["Piatto"]["prezzo"].value;
    let descrizione = document.forms["Piatto"]["descrizione"].value;
    let immagine = document.forms["Piatto"]["immagine"].value;

    if( descrizione ==='' && prezzo === '') {
        alert("Inserire i dati richiesti");
        return false
    }

    if (descrizione ==='') {
        alert("Inserire descrizione");
        return false;
    } else if (descrizione.length > 400) {
        alert("descrizione troppo lunga");
        return false;
    }

    if (prezzo === '') {
        alert("Inserire il prezzo");
        return false;
    } else if (isNaN(prezzo)){
        alert("Il valore associato al prezzo non è valido");
        return false;
    }
    if (immagine === '') {
        alert("Inserire immagine");
        return false;
    }
    
}

function validatePiattiMod(){
    // effettuo i controlli sui valori 
    let prezzo = document.forms["Piatto"]["prezzo"].value;
    let descrizione = document.forms["Piatto"]["descrizione"].value;

    if( descrizione ==='' && prezzo === '') {
        alert("Inserire i dati richiesti");
        return false
    }

    if (descrizione ==='') {
        alert("Inserire descrizione");
        return false;
    } else if (descrizione.length > 400) {
        alert("descrizione troppo lunga");
        return false;
    }

    if (prezzo === '') {
        alert("Inserire il prezzo");
        return false;
    } else if (!isNumber(prezzo)){
        alert("Il valore associato al prezzo non è valido");
        return false;
    }
    
}

function validateAggiungiM(){
    let prezzo = document.forms["Menu"]["prezzo"].value;
    let immagine = document.forms["Menu"]["immagine"].value;
    var a = 0 ;
    const piatti = document.getElementById('piatti').value;
    if (prezzo === '') {
        alert("Inserire il prezzo");
        return false;
    } else if (!isNumber(prezzo)){
        alert("Il valore associato al prezzo non è valido");
        return false;
    }
    if (immagine === '') {
        alert("Inserire immagine");
        return false;
    }
}

function validateModificaOrari(){
    let inizio= document.forms["orario"]["inizio"].value;
    let fine = document.forms["orario"]["fine"].value;

    if (inizio == null) {
        alert("Selezionare orario inizio");
        return false;
    } 
    if (fine == null ) {
        alert("Selezionare orario fine");
        return false;
    }

}