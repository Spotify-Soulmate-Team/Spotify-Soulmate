//declaring variables using DOM element selection
const searchInput = document.getElementById('artist-input');
const suggestionsList = document.getElementById('suggestions');
const searchContainer = document.getElementById('search-container');
var lists = suggestionsList.getElementsByTagName("li");



// //adding an event listner to the element then excuting a function when pressing enter
// document.getElementById("artist-input").addEventListener("keypress", function(event) {
//   if (event.keyCode === 13) {
//     var userInput = document.getElementById("artist-input").value;

//     window.location.href = "fav-artist.html?input=" + userInput;
//   }
// });
//Array of suggestions
// const suggestions = [
//   'Drake',
//   'Taylor swift',
//   'The weekend'
// ];

//adding an event listener to the element then executing a function when pressing enter
document.getElementById("artist-input").addEventListener("keypress", function(event) {
  if (event.keyCode === 13) {
    var userInput = document.getElementById("artist-input").value.toLowerCase().trim();
    
    const suggestion = suggestions.find(s => s.name.toLowerCase() === userInput);
    if (suggestion) {
      window.location.href = suggestion.file;
    } else {
      // Handle case where input does not match any suggestion
      // For now, redirect to a default page
      window.location.href = 'index.html';
    }
  }
});


const suggestions = [
  { name: 'Drake', file: 'drake.html' },
  { name: 'Taylor Swift', file: 'taylor_swift.html' },
  { name: 'The Weekend', file: 'the_weeknd.html' }
];


//function to filter the suggestions based on the user input
function filterSuggestions(input) {
  return suggestions.filter(suggestion =>
    suggestion.name.toLowerCase().includes(input.toLowerCase())
  );
}

//display function 
function showSuggestions(filteredSuggestions) {
  suggestionsList.innerHTML = '';

  filteredSuggestions.forEach(suggestion => {
    const li = document.createElement('li');
    li.textContent = suggestion.name;
    suggestionsList.appendChild(li);
  });
}
//event listner for any input changes  
searchInput.addEventListener('keyup', function() {
  const input = this.value;
  const filteredSuggestions = filterSuggestions(input);
  showSuggestions(filteredSuggestions);
});


//event listner for when a suggestion is clicked to clear the list after
suggestionsList.addEventListener('click', function(event) {
  if (event.target.tagName === 'LI') {
    const clickedSuggestion = event.target.textContent;
    searchInput.value = clickedSuggestion;
    suggestionsList.innerHTML = ''; 
  }
});
