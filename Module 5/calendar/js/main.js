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
  var XHR = new XMLHttpRequest();
  var FD = new FormData(signIn);
  XHR.addEventListener("load", () => {
    var responseData = JSON.parse(event.target.responseText);
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
  var XHR = new XMLHttpRequest();
  var FD = new FormData();
  XHR.addEventListener("load", () => {
    var responseData = JSON.parse(event.target.responseText);
    if (responseData.loggedout === true) {
      alert("Logout success!");
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
  var XHR = new XMLHttpRequest();
  var FD = new FormData(signUp);
  XHR.addEventListener("load", () => {
    var responseData = JSON.parse(event.target.responseText);
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
  if (currentMonth >= 12) {
    currentMonth = 0;
    currentYear += 1;
  }
  updateDate();
});

const calendar = document.querySelector("#calendar");
const eachWeekday = calendar.querySelectorAll(".calendar-column");
function updateDate() {
  displayMonth.innerHTML = Months[currentMonth];
  displayYear.innerHTML = currentYear;

  var thisMonth = new Month(currentYear, currentMonth);
  var weeks = thisMonth.getWeeks();
  for (var w in weeks) {
    var days = weeks[w].getDates();
    for (var d in days) {
      eachWeekday[d].children[w].innerHTML = days[d].getDate();
      if (eachWeekday[d].children[w].innerHTML === "1") {
        eachWeekday[d].children[w].innerHTML =
          Months[days[d].getMonth()] + " 1";
      }
    }
  }
}
