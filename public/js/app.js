(function() {

const btnDelete =
  document.querySelectorAll('.btn-danger');

const modal = document.querySelector('#modal');
const modalBtns = modal.querySelectorAll('button');

let url = '';

btnDelete.forEach(function(btn) {
  btn.addEventListener('click', function(e) {
    e.preventDefault(); // bloque la requête http

    //***
    url = e.target.href;
    // let t = modal.offsetTop + 100;
    let t = e.clientY;
    modal.style.top = t + 'px';

  })
})

modalBtns[0].addEventListener('click', function(e) {
  window.location.href = url;
})

modalBtns[1].addEventListener('click', function(e) {
  modal.style.top = '-100px';
})

})()
