/* Quand on clique sur le bouton profil */

let recVisible2 = false;

document.getElementById('button-profilId').addEventListener('click', function() {
    if (recVisible2) {
        closeProfile();
    } else {
        openProfile();
    }
});

function openProfile() {
    document.getElementById('profileId').style.display = 'block';
    recVisible2 = true;

    setTimeout(function() {
        document.addEventListener('click', clickOutside);
    }, 50);
}

function closeProfile() {
    document.getElementById('profileId').style.display = 'none';
    recVisible2 = false;
    document.removeEventListener('click', clickOutside);
}

function clickOutside(event) {
    var rec2 = document.getElementById('profileId');

    if (event.target !== rec2 && !rec2.contains(event.target)) {
        closeProfile();
    }
}