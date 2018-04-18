var modal = document.getElementById('modalIn');
var modal2 = document.getElementById('modalUp');
var btn = document.getElementById("signIn");
var btn2 = document.getElementById("signUp");
var span = document.getElementsByClassName("close")[0];
var span2 = document.getElementsByClassName("close")[1];

btn.onclick = function() {
    modal.style.display = "block";
}
btn2.onclick = function() {
    modal2.style.display = "block";
}
span.onclick = function() {
    modal.style.display = "none";
}
span2.onclick = function() {
    modal2.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    } else if (event.target == modal2) {
        modal2.style.display = "none";
    }
}