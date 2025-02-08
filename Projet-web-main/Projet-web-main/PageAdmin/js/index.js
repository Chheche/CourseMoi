/* RELOAD PAGE */

function reloadPage() {
    document.location.href="index.php";
}

/* Quand on clique sur Admin */

document.getElementById('admin').addEventListener('click', openView);
document.getElementById('supprimer2').addEventListener('click', closeView);
document.getElementById('enregistrer').addEventListener('click', closeView);

function openView() {
    document.getElementById('modal2').style.display = 'flex';
    document.querySelectorAll(".addition").forEach(function(element) {
        element.style.display = 'none';});
    document.querySelectorAll(".suppression").forEach(function(element) {
        element.style.display = 'none';});
}

function closeView() {
    document.getElementById('modal2').style.display = 'none';
    document.querySelectorAll(".addition").forEach(function(element) {
        element.style.display = 'flex';});
    supVisible = false;
}

/* Quand on clique sur Supprimer */

let supVisible = false;

document.getElementById('delete').addEventListener('click', function() {
    if (supVisible) {
        closeSup();
    } else {
        openSup();
    }
});

function openSup() {
    document.querySelectorAll(".suppression").forEach(function(element) {
        element.style.display = 'flex';});
    supVisible = true;
}

function closeSup() {
    document.querySelectorAll(".suppression").forEach(function(element) {
        element.style.display = 'none';});
    supVisible = false;
}

/* Quand on supprime */

document.querySelectorAll('.suppression').forEach(function(button) {
    button.addEventListener('click', function() {
        var annonceId = button.getAttribute('data-id');
        fetch('supprimer_annonce.php?id=' + annonceId, {
            method: 'GET'
        })
        .then(function(response) {
            if (response.ok) {
                location.reload();
            } else {
                console.error('Erreur lors de la suppression de l\'annonce');
            }
        })
        .catch(function(error) {
            console.error('Erreur réseau:', error);
        });
    });
});

/* Quand on clique sur addition */

function comment(){
    document.location.href="annonce.php";
}

/* Quand on clique sur filtre */

document.getElementById('filtreCtn').addEventListener('click', openModal);
document.getElementById('supprimer').addEventListener('click', closeModal);
document.getElementById('enregistrer1').addEventListener('click', closeModal);

function openModal() {
    document.getElementById('modal').style.display = 'flex';
    document.querySelectorAll(".addition").forEach(function(element) {
        element.style.display = 'none';});
    document.querySelectorAll(".suppression").forEach(function(element) {
        element.style.display = 'none';});
}

function closeModal() {
    document.getElementById('modal').style.display = 'none';
    document.querySelectorAll(".addition").forEach(function(element) {
        element.style.display = 'flex';});
    supVisible = false;
}

/* Inverser annonce */ 

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('enregistrer1').addEventListener('click', function() {
        if (document.getElementById('checkboxInversion').checked) {
            inverserOrdreAnnonces();
        }else{
            remettreOrdreAnnonces();
        }
    });
});

function inverserOrdreAnnonces() {
    var rectangles = document.querySelectorAll('.annonce');
    var container = document.querySelector('.annonce-ctn1');
  
    var reversedRectangles = Array.from(rectangles).reverse();
  
    reversedRectangles.forEach(function(rectangle) {
      container.appendChild(rectangle);
    });
}

function remettreOrdreAnnonces(){
    var rectangles = document.querySelectorAll('.annonce');
    var container = document.querySelector('.annonce-ctn1');
  
    var reversedRectangles = Array.from(rectangles).reverse();
  
    reversedRectangles.forEach(function(rectangle) {
      container.appendChild(rectangle);
    });
}

/* Quand on clique sur mettre mon annonce */

document.getElementById('button-add').addEventListener('click', openAdd);
document.getElementById('closeAdd').addEventListener('click', closeAdd);

function openAdd() {
    document.getElementById('add').style.display = 'flex';
    document.querySelectorAll(".addition").forEach(function(element) {
        element.style.display = 'none';});
    document.querySelectorAll(".suppression").forEach(function(element) {
        element.style.display = 'none';});
}

function closeAdd() {
    document.getElementById('add').style.display = 'none';
    document.querySelectorAll(".addition").forEach(function(element) {
        element.style.display = 'flex';});
    supVisible = false;
}

/* Checkbox annonce */

let checkbox = document.getElementById('check1');
let inputContainer = document.getElementById('contact-ligne1');
let content = document.getElementById('add-content');

checkbox.addEventListener('change', function() {
    inputContainer.style.display = checkbox.checked ? 'block' : 'none';
    content.style.height = checkbox.checked ? '39rem' : '35rem';
});

/* Valide uniquement les caractères numériques */

function validInput(input) {
    input.value = input.value.replace(/\D/g, '');
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
