const hamburger = document.querySelector(".hamburger");
    const navMenu = document.querySelector(".nav-content");

    hamburger.addEventListener("click", () => {
      hamburger.classList.toggle("active");
      navMenu.classList.toggle("active");
    })

    document.querySelectorAll(".nav-item").forEach(n => n.addEventListener("click", () => {
      hamburger.classList.remove("active");
      navMenu.classList.remove("active");
    }))

document.getElementById("artist-input").addEventListener("keypress", function(event) {
  if (event.keyCode === 13) {
    var userInput = document.getElementById("artist-input").value;

    window.location.href = "fav-artist.html?input=" + userInput;
  }
});

//for left arrow in favorite artist page
const leftArrow = document.querySelector('#leftArrow');
  leftArrow.addEventListener("click", function() {
  this.style.transform = "translateX(-100px)";
});
