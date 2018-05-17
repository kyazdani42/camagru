const icon = document.querySelector("#menuIcon");
const nav = document.querySelector(".navImg");
const list = document.getElementsByClassName("navList");

icon.addEventListener('mouseover', (e) => {

    nav.style.display = "flex";
    for (let i = 0; i < list.length; i++) {
        list[i].style.display = "block";
    }

});

nav.addEventListener('mouseout', (e) => {

    nav.style.display = `none`;
    for (i = 0; i < list.length; i++) {
        list[i].style.display = 'none';
    }

});

icon.addEventListener('mouseout', (e) => {

    nav.style.display = `none`;
    for (i = 0; i < list.length; i++) {
        list[i].style.display = 'none';
    }

});
