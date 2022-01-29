const modal = document.querySelector(".modalOverlay");
const moviename = document.querySelector("[data-mid]");
const trigger = document.querySelector(".triggerModal");
const closeButton = document.querySelector(".close-button");

function toggleModal() {
  modal.classList.toggle("show-modalOverlay");
  document.querySelectorAll('[id=test]').forEach(element=> {
    element.classList.toggle("noHover");
  });
}

function createModal(name) {

  ws.send(JSON.stringify({
    id: "movie-card",
    msg: "Please give me the movie info",
    movie: name
  }));
}

function openModal(title, img, desc, movieid) {
  var tit = document.getElementById("modal-title");
  var ur = document.getElementById("modal-url");
  var foto = document.getElementById("modal-img");
  var dis = document.getElementById("modal-disc");
  
  document.querySelectorAll('[id=test]').forEach(element=> {
    element.classList.toggle("noHover");
  });
  tit.innerHTML = title;
  dis.innerHTML = desc;
  ur.setAttribute("onclick", "window.location.href='/player.html?iv=" + movieid + "';");
  foto.setAttribute("style", "background-image: linear-gradient(180deg, transparent, rgb(0 0 0 / 70%), rgb(0 0 0)), url(" + img + ")")
    modal.classList.toggle("show-modalOverlay");
    console.log(title);
}

function windowOnClick(event) {
    if (event.target === modal) {
        toggleModal();
    }
}

closeButton.addEventListener("click", toggleModal);
window.addEventListener("click", windowOnClick);

document.addEventListener('keydown', (event) => {
		if (event.keyCode == '27'){
      if(modal.classList.contains("show-modalOverlay")){
        modal.classList.remove("show-modalOverlay");
      }
		}
  });