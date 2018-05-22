const clicks = document.getElementsByClassName("openComs");
const hidden = [];
for (let i = 0; i < clicks.length; i++) {
    hidden[i] = clicks[i].parentNode.nextElementSibling;
    clicks[i].addEventListener("click", () => {
        hidden[i].style.display = "block";
    });
    window.addEventListener("click", (e) => {
        if (e.target === hidden[i]) {
            hidden[i].style.display = "none";
        }
    });
}