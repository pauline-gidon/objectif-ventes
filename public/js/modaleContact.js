// je cible mes 3 element pour la fonction
const contact = document.querySelector("#contact");
const formulaire = document.querySelector("#formContact");
const cross = document.querySelector("#close");

function animateModale() {
    formulaire.style.left = 0;
}
function modaleClose() {
    formulaire.style.left = '-'+100+'vw';
}

contact.addEventListener('click', function(event) {
    event.preventDefault();
    // formulaire.style.left = 0;
    formulaire.classList.add('formOpen');
    
});

cross.addEventListener('click', function() {
    // formulaire.style.left = '-'+100+'vw';
    formulaire.classList.remove('formOpen');
    // setTimeout(modaleClose, 3000);
});

// laisser apparaitre le formulaire en cas d'erreur d'envoie
const errors = document.querySelectorAll(".error");
if (errors.length > 0) {
    animateModale();
    
    console.log(cross);
    cross.addEventListener('click', function() {

        setTimeout(modaleClose, 3000);
    });

  }