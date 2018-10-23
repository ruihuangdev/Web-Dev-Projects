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