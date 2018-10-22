const signIn = document.querySelector("#signin-form");
const signUp = document.querySelector("#signup-form");

signIn.addEventListener("submit", e => {
  e.preventDefault();
  sendData();
});

function sendData() {
  var XHR = new XMLHttpRequest();
  var FD = new FormData(signIn);
  XHR.addEventListener("load", function(event) {
    alert(event.target.responseText);
  });
  XHR.addEventListener("error", function(event) {
    alert("Oops! Something went wrong.");
  });
  XHR.open("POST", "./includes/login.inc.php");
  XHR.send(FD);
}
