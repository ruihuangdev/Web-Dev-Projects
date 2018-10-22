const signIn = document.querySelector("#signin-form");
const signUp = document.querySelector("#signup-form");
const welcome = document.querySelector("#welcome-message");
const userActions = document.querySelector("#userActions");
const userLogout = document.querySelector("#userLogout");

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
    }
    userActions.setAttribute("style", "display: none");
    userLogout.setAttribute("style", "display: block");
  });
  XHR.addEventListener("error", () => {
    console.error("Something went wrong");
  });
  XHR.open("POST", "./includes/login.inc.php");
  XHR.send(FD);
}
