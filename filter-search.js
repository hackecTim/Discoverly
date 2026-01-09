//javascript code that filters, sorts and searches elements from the places.html and activities.html pages

//Sort functions:
function sortPlaces(){

  let grid = document.getElementsByClassName("places-grid")[0];
  let cards = grid.getElementsByClassName("place-card");
  let sortType = document.getElementById("sortSelectHidden").value;

  // bubble sort
  for(let i = 0; i < cards.length - 1; i++){
    for(let j = i + 1; j < cards.length; j++){

      var nameA = cards[i].getElementsByTagName("h3")[0].innerHTML.toUpperCase();
      var nameB = cards[j].getElementsByTagName("h3")[0].innerHTML.toUpperCase();

      if((sortType == "az" && nameA > nameB) || (sortType == "za" && nameA < nameB)){
        let temp = cards[i];
        grid.insertBefore(cards[j], cards[i]);
        grid.insertBefore(temp, cards[j].nextSibling);
      }
    }
  }
}

// toggle sort dropdown menu
function toggleSortMenu(){
  let menu = document.getElementById("sortMenu");
  if(menu.className.indexOf("show") > -1){
    w3RemoveClass(menu, "show");
  }
  else{
    w3AddClass(menu, "show");
  }
}

// set sort type
function setSort(type){
  var sortSelect = document.getElementById("sortSelectHidden");
  sortSelect.value = type;
  sortPlaces();
  w3RemoveClass(document.getElementById("sortMenu"), "show");
}


//Filter functions:

function filterSelection(c) {
    
  var x, i;
  x = document.getElementsByClassName("filterDiv");
  
  if (c == "all") c = "";
  
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) {
      w3AddClass(x[i], "show");
    }
  }
  sortPlaces();
}

// Show filtered elements
function w3AddClass(element, name) {
var i, arr1, arr2;
arr1 = element.className.split(" ");
arr2 = name.split(" ");
for (i = 0; i < arr2.length; i++) {
  if (arr1.indexOf(arr2[i]) == -1) {
    element.className += " " + arr2[i];
  }
}
}

// Hide elements that are not selected
function w3RemoveClass(element, name) {
var i, arr1, arr2;
arr1 = element.className.split(" ");
arr2 = name.split(" ");
for (i = 0; i < arr2.length; i++) {
  while (arr1.indexOf(arr2[i]) > -1) {
    arr1.splice(arr1.indexOf(arr2[i]), 1);
  }
}
element.className = arr1.join(" ");
}


// Add active class to the current control button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
if(btnContainer){
  var btns = btnContainer.getElementsByClassName("category-btn");
  for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function() {
      var current = document.getElementsByClassName("active");
      current[0].className = current[0].className.replace(" active", "");
      this.className += " active";
    });
  }
}
//Search function, looks only for words that start with the letter, no letter in the middle bs search
function search(){ 
  var input = document.getElementById('search-bar');
  var filter = input.value.toUpperCase();
  var cards = document.querySelectorAll('.activity-card, .place-card');

  for (var i=0; i<cards.length; i++){
    console.log("Card", i, cards[i]);  
    w3RemoveClass(cards[i], "show");
    var textValue = cards[i].querySelector('h3').textContent;
    var words = textValue.split(' ');

    for (var j=0; j<words.length; j++){
        if (words[j].toUpperCase().startsWith(filter)){
          w3AddClass(cards[i], "show");
        }
    }
  }
}

//show filtered page after pressing on a category from page1.html

//getting the URL query param
const url = new URL(window.location.href)
const currentFilter = url.searchParams.get('filter')

// console.log("Full URL:", window.location.href);
// console.log("Current filter value:", currentFilter);

//we only filter stuff if a filter is provided
if (currentFilter != null){

  //make the correct button light up accordingly..
  var btnContainer = document.getElementById("myBtnContainer");
  var btns = btnContainer.getElementsByClassName("category-btn");
  for (var i = 0; i < btns.length; i++) {
    var buttonCategory = btns[i].getAttribute('data-category');
    if (buttonCategory == currentFilter){
      var current = document.getElementsByClassName("active");
      current[0].className = current[0].className.replace(" active", "");
      btns[i].className += " active";
    }
  }

  filterSelection(currentFilter)

}