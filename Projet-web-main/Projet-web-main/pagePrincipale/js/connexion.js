function validerMotDePasse() {
    var mDP = document.getElementById('newPassword').value;
    var messageErreur = document.getElementById('messageErreur');
    var creation = document.getElementById('bouton');

    if (mDP.length >= 8) {
        
        var contientLettres = /[a-zA-Z]/.test(mDP);
        var contientChiffres = /\d/.test(mDP);

        
        if (contientLettres && contientChiffres) {
            
            messageErreur.style.color = 'green';
            messageErreur.innerHTML = "Mot de passe valide.";
            creation.disabled = false;
            return true; 
        } 
        else {
            messageErreur.style.color = 'red';
            messageErreur.innerHTML = "Le mot de passe doit contenir à la fois des lettres et des chiffres.";
            creation.disabled = true;
            return false; 
        }
    }
    else if(mDP==""){
        messageErreur.innerHTML = " ";
        creation.disabled = true;
        return false;
    }
    else{
        messageErreur.style.color = 'red';
        messageErreur.innerHTML = "Le mot de passe doit avoir une longueur minimale de 8 caractères.";
        creation.disabled = true;
        return false; 
    } 
}

/*
function onInputMotDePasse() {
    document.getElementById('messageErreur').innerHTML = "";
}
*/

function connexion(){
    var mail = document.getElementById("email").value;
    var mdp = document.getElementById("password").value;
    var info = document.getElementById('info');

    if(mail==="compte.admin@coursemoi.fr" && mdp==="123456789"){
        info.innerHTML = "Connexion en tant que admin";
        return true;
    }
    else{
        return false;
    }
}