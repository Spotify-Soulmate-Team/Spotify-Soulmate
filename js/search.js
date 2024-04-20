const searchInput = document.getElementById('artist-input');
const suggestionsList = document.getElementById('suggestions');
const searchContainer = document.getElementById('search-container');
var lists = suggestionsList.getElementsByTagName("li");

document.getElementById("artist-input").addEventListener("keypress", function(event) {
  if (event.keyCode === 13) {
    var userInput = document.getElementById("artist-input").value;

    window.location.href = "fav-artist.html?input=" + userInput;
  }
});

const suggestions = [
  'Drake',
  'Taylor swift',
  'The weekend'
];

function filterSuggestions(input) {
  return suggestions.filter(suggestion =>
    suggestion.toLowerCase().includes(input.toLowerCase())
  );
}


function showSuggestions(filteredSuggestions) {
  suggestionsList.innerHTML = '';

  filteredSuggestions.forEach(suggestion => {
    const li = document.createElement('li');
    li.textContent = suggestion;
    suggestionsList.appendChild(li);
  });
}

searchInput.addEventListener('input', function() {
  const input = this.value;
  const filteredSuggestions = filterSuggestions(input);
  showSuggestions(filteredSuggestions);
});


suggestionsList.addEventListener('click', function(event) {
  if (event.target.tagName === 'LI') {
    searchInput.value = event.target.textContent;
    suggestionsList.innerHTML = '';
  }
});
