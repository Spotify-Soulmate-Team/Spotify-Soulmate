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

//for left arrow in favorite artist page
const leftArrow = document.querySelector('#leftArrow');
  leftArrow.addEventListener("click", function() {
  this.style.transform = "translateX(-100px)";
});
