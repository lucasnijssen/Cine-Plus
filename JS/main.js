const modal = document.querySelector(".modalOverlay");
const moviename = document.querySelector("[data-mid]");
const trigger = document.querySelector(".triggerModal");
const closeButton = document.querySelector(".close-button");

function toggleModal() {

  ws.send(JSON.stringify({
    id: "movie-info",
    msg: "Please give me the movie info",
    movie: moviename.getAttribute("data-mid")
  }));
}

function openModal(title) {
  var tit = document.getElementById("modal-title");
  var ur = document.getElementById("modal-url");
  tit.innerHTML = title;
  ur.setAttribute("onclick", "window.location.href='/player.html?iv=" + moviename.getAttribute("data-mid") + "';");
    modal.classList.toggle("show-modalOverlay");
    console.log(title);
}

function windowOnClick(event) {
    if (event.target === modal) {
        toggleModal();
    }
}

trigger.addEventListener("click", toggleModal);
closeButton.addEventListener("click", toggleModal);
window.addEventListener("click", windowOnClick);