const signIn = document.querySelector("#signin-form");
const signUp = document.querySelector("#signup-form");
const signOut = document.querySelector("#signout-form");
const welcome = document.querySelector("#welcome-message");
const userActions = document.querySelector("#userActions");
const userLogout = document.querySelector("#userLogout");
const signedInAs = document.querySelector("#signedin-as");

signIn.addEventListener("submit", e => {
  e.preventDefault();
  signInUser();
});

function signInUser() {
  let XHR = new XMLHttpRequest();
  let FD = new FormData(signIn);
  XHR.addEventListener("load", () => {
    let responseData = JSON.parse(event.target.responseText);
    if (responseData.loggedin === true) {
      alert("Login success!");
      welcome.innerHTML = responseData.message;
      userActions.setAttribute("style", "display: none");
      signedInAs.innerHTML += " " + responseData.username;
      userLogout.setAttribute("style", "display: block");
    } else {
      alert(responseData.message);
    }
  });
  XHR.addEventListener("error", () => {
    console.error("Something went wrong");
  });
  XHR.open("POST", "./includes/login.inc.php");
  XHR.send(FD);
}

signOut.addEventListener("submit", e => {
  e.preventDefault();
  signOutUser();
});

function signOutUser() {
  let XHR = new XMLHttpRequest();
  let FD = new FormData();
  XHR.addEventListener("load", () => {
    let responseData = JSON.parse(event.target.responseText);
    if (responseData.loggedout === true) {
      alert("Logout success!");
      welcome.innerHTML = "";
      userActions.setAttribute("style", "display: block");
      userLogout.setAttribute("style", "display: none");
      signedInAs.innerHTML = "You are currently logged in as ";
    } else {
      alert("Something went wrong");
    }
  });
  XHR.addEventListener("error", () => {
    console.error("Something went wrong");
  });
  XHR.open("POST", "./includes/logout.inc.php");
  XHR.send(FD);
}

signUp.addEventListener("submit", e => {
  e.preventDefault();
  registerUser();
});

function registerUser() {
  let XHR = new XMLHttpRequest();
  let FD = new FormData(signUp);
  XHR.addEventListener("load", () => {
    let responseData = JSON.parse(event.target.responseText);
    if (responseData.userCreated === true) {
      alert("Sign up success, you can log in now!");
    } else {
      alert(responseData.message);
    }
  });
  XHR.addEventListener("error", () => {
    console.error("Something went wrong");
  });
  XHR.open("POST", "./includes/signup.inc.php");
  XHR.send(FD);
}

//calendar
const displayMonth = document.querySelector("#month");
const displayYear = document.querySelector("#year");
const currentDate = new Date();
let currentMonth = currentDate.getMonth();
let currentYear = currentDate.getFullYear();
const Months = [
  "January",
  "Feburary",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December"
];

window.onload = function() {
  updateDate();
};

const prevMonth = document.querySelector("#prevMonth");
const nextMonth = document.querySelector("#nextMonth");

prevMonth.addEventListener("click", () => {
  currentMonth -= 1;
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear -= 1;
  }
  updateDate();
});
nextMonth.addEventListener("click", () => {
  currentMonth += 1;
  if (currentMonth > 11) {
    currentMonth = 0;
    currentYear += 1;
  }
  updateDate();
});
// This part is pretty straight forward, increase/decrease month and year

const calendar = document.querySelector("#calendar");
const eachWeekday = calendar.querySelectorAll(".calendar-column");
function updateDate() {
  displayMonth.innerHTML = Months[currentMonth];
  displayYear.innerHTML = currentYear;
  // update the display month of the calendar

  let thisMonth = new Month(currentYear, currentMonth);
  //Use the given js lib provided by the class

  let weeks = thisMonth.getWeeks();

  for (let w in weeks) {
    let days = weeks[w].getDates();

    for (let d in days) {
      eachWeekday[d].children[w].classList.remove("current-month");
      eachWeekday[d].children[w].innerHTML = days[d].getDate();
      if (days[d].getMonth() === currentMonth) {
        eachWeekday[d].children[w].classList.add("current-month");
      }
      if (eachWeekday[d].children[w].innerHTML === "1") {
        let monthName = document.createTextNode(
          Months[days[d].getMonth()].substring(0, 3) + " "
        );
        eachWeekday[d].children[w].prepend(monthName);
      }
      calendar
        .querySelectorAll(".calendar-row")
        .forEach(day => day.removeEventListener("click", chooseDate));
      calendar
        .querySelectorAll(".calendar-row.current-month")
        .forEach(day => day.addEventListener("click", chooseDate));

      /*
      use a nested loop to update each element in the calendar div
      if the date happens to be 1, update the innerHTML to have the first 3 chars of the month

      Give the divs with the current month a class of ".current-month"
      This allow us to style them differently as well as add event listener on them

      The event listener must be removed after month is updated
      similarly, .current-month have to be removed too

      This feels hacky, there is room to refactor.
      */
    }
  }
}

const newEvent = document.querySelector(".newEvent");
const newEventForm = newEvent.querySelector("form");
const newEventClose = newEvent.querySelector("#closeNewEvent");
const newEventDate = newEvent.querySelector("#event-date");

function chooseDate() {
  newEvent.style.display = "flex";
  currentRealMonth = currentMonth + 1;
  if (this.childNodes.length > 1) {
    chosenDate =
      currentYear + "-" + currentRealMonth + "-0" + this.childNodes[1].data;
  } else {
    if (this.innerHTML.length === 1) {
      chosenDate = currentYear + "-" + currentRealMonth + "-0" + this.innerHTML;
    } else {
      chosenDate = currentYear + "-" + currentRealMonth + "-" + this.innerHTML;
    }
  }
  newEventDate.value = chosenDate;
}
newEventClose.addEventListener("click", closeForm);

function closeForm() {
  newEvent.style.display = "none";
}

/*
  Handles the behavior of the new event form
  chooseDate is called when a calendar date is clicked.
  This function displays the event form with prepopulated date
  Had to do a lot of string manipulation to make it work, maybe a refactor is needed
*/

/*
TODO:
1. Hook up add event form with db
2. display events conditionally for signed in users
3. ability to remove event
4. Being able to close the event form field when clicked out of the popup
*/
