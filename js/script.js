document.getElementById("artist-input").addEventListener("keypress", function(event) {
  if (event.keyCode === 13) {
    var userInput = document.getElementById("artist-input").value;

    window.location.href = "fav-artist.html?input=" + userInput;
  }
});

//for left arrow in favorite artist page
document.getElementById("leftArrow").addEventListener("click", function() {
  this.style.transform = "translateX(-100px)";
});
