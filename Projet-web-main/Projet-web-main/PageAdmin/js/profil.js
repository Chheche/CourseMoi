/* Quand on clique sur le bouton profil */

let recVisible = false;

document.getElementById('button-profilId').addEventListener('click', function() {
    if (recVisible) {
        closeProfile();
    } else {
        openProfile();
    }
});

function openProfile() {
    document.getElementById('profileId').style.display = 'block';
    recVisible = true;

    setTimeout(function() {
        document.addEventListener('click', clickOutside);
    }, 50);
}

function closeProfile() {
    document.getElementById('profileId').style.display = 'none';
    recVisible = false;
    document.removeEventListener('click', clickOutside);
}

function clickOutside(event) {
    var rec = document.getElementById('profileId');

    if (event.target !== rec && !rec.contains(event.target)) {
        closeProfile();
    }
}


/* Quand on clique sur la checkbox pour modifier ses infos*/

document.getElementById('modifInfos').addEventListener('click', openModal);

function openModal() {
    if(document.getElementById('modifierInfos').checked){
        document.getElementById('montrerForm').style.display = 'block';
    }
    else{
        document.getElementById('montrerForm').style.display = 'none';
    }
}


/* Quand on clicke sur la photo de profil */
let boolean = false;

document.getElementById('photoProfil').addEventListener('click', function() {
    if(!boolean){
        document.getElementById('formUpload').style.display = 'block';
    }
    else{
        document.getElementById('formUpload').style.display = 'none';
    }
     
    boolean = !boolean;   
});