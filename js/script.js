var modal = document.getElementById("myModal");
// Get the button that opens the modal


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal


// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}


/* -------------------   The seat functioality-----------------*/

const container = document.querySelector(".container");
const seats = document.querySelectorAll(".row .seat:not(.occupied)");


const movieSelect = document.getElementById("movie");

//Save selected movie and price
function setMovieData(movieIndex, moviePrice) {
  localStorage = setItem("slectedMovieIndex", movieIndex);
  localStorage = setItem("slectedMoviePrice", moviePrice);
}
//update total and count

//get data from local storage and populite UI
function populateUI() {
  const selectedSeats = JSON.parse(localStorage.getItem("selectedSeats"));
  if (selectedSeats !== null && selectedSeats.length > 0) {
    seats.forEach((seat, index) => {
      if (selectedSeats.indexOf(index) > -1) {
        seat.classList.add("selected");
      }
    });
  }
  const selectedmovieIndex = localStorage.getItem("selectedMovieIndex");
  if (selectedmovieIndex !== null) {
    movieSelect.selectedIndex = selectedMovieIndex;
  }
}

//movie Select Event


//Seat Click event
container.addEventListener("click", (e) => {
  if (
    !e.target.classList.contains("occupied") && !e.target.classList.contains("selected")
  ) {
      modal.style.display = "block";
      document.getElementById("seat_id").value = e.target.id;
    /*e.target.classList.toggle("selected");*/
  }
  
});
//initial count and total set
