function burgerMenu() {
    const bMenu = document.querySelector(".b-menu"); // saves burger menu as a variable
    const menu = document.querySelector(".menu-container"); // saves menu as a variable
    const overlay = document.querySelector(".overlay"); // saves overlay as variable
    bMenu.addEventListener('click', function () { // listens for "click" events for "menu"
        menu.classList.toggle("active");// toggles class on click
        bMenu.classList.toggle("active");
        document.querySelector("body").classList.toggle("menu-active")
    });
    overlay.addEventListener('click', function () { // listens for "click" events for "menu"
        menu.classList.remove("active");// toggles class on click
        bMenu.classList.remove("active");
        document.querySelector("body").classList.remove("menu-active")
    });
}

function deactivate(arr) {
    arr.forEach(button => button.querySelector("form").classList.remove("active"));

}

function activate(e,arr) {
    let form = e.querySelector("form");
    if (form.classList.contains("active") === true) {
        form.classList.remove("active")
    } else {
        deactivate(arr);
        form.classList.toggle("active")
    }

}

function registerEvents(){
    let editBtns = document.querySelectorAll(".edit")
    editBtns.forEach(button => button.querySelector("span.btn").addEventListener('click', () => activate(button, editBtns)))
    editBtns.forEach(button => button.addEventListener('mouseleave', () => button.querySelector("form").classList.remove("active")))

}

function dropdown() {
    let dropdowns = document.querySelectorAll(".dropdown");
    for (let i = 0; i < dropdowns.count; i++) {
        dropdowns[i].addEventListener("click", () => dropdowns[i].classList.toggle("active"))
        dropdowns[i].addEventListener("mouseleave", () => dropdowns[i].classList.remove("active"))
    }
}


function onLoad(){
    burgerMenu();
    registerEvents();
    dropdown();

}


window.addEventListener("load", onLoad);
