
/* RELOAD PAGE */

function reloadPage() {
    document.location.href="indexUti.php";
}

/* Quand on clique sur le bouton profil */

let rectangleVisible = false;

document.getElementById('button-profil').addEventListener('click', function() {
    if (rectangleVisible) {
        closeProfile();
    } else {
        openProfile();
    }
});

function openProfile() {
    console.log("test");
    document.getElementById('profileModal').style.display = 'block';
    rectangleVisible = true;

    setTimeout(function() {
        document.addEventListener('click', clickOutside);
    }, 50);
}

function closeProfile() {
    document.getElementById('profileModal').style.display = 'none';
    rectangleVisible = false;
    document.removeEventListener('click', clickOutside);
}

function clickOutside(event) {
    var rectangle = document.getElementById('profileModal');

    if (event.target !== rectangle && !rectangle.contains(event.target)) {
        closeProfile();
    }
}
