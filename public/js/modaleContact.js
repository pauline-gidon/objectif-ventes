// je cible mes 3 element pour la fonction
const contact = document.querySelector("#contact");
const formulaire = document.querySelector("#formContact");
const close = document.querySelector("#close");
console.log()

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

close.addEventListener('click', function() {
    // formulaire.style.left = '-'+100+'vw';
    formulaire.classList.remove('formOpen');
    // setTimeout(modaleClose, 3000);
});

// feedback
const feedback = document.querySelector(".mailOK");

function closefeedback() {
    feedback.style.display = 'none';
}

setTimeout(closefeedback, 3000);
