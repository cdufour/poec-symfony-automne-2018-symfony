(function() {

const btnDelete =
  document.querySelectorAll('.btn-danger');

const modal = document.querySelector('#modal');
const modalBtns = modal.querySelectorAll('button');

let urlDelete = ''; // url de la ressource à supprimer

btnDelete.forEach(function(btn) {
  btn.addEventListener('click', function(e) {
    e.preventDefault(); // bloque la requête http

    // déplacement du modal
    let topPosition = e.clientY;
    modal.style.top = topPosition + 'px';

    // mémorisation de l'url permettant la suppression
    urlDelete = e.target.href;
  })
})

// confirmation de la suppression
modalBtns[0].addEventListener('click', function(e) {
  // redirection: requête GET sur l'url fourni
  window.location.href = urlDelete;
})

// annulation de la suppresion
modalBtns[1].addEventListener('click', function(e) {
  modal.style.top = '-100px';
})





})()
