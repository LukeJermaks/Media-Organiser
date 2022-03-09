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
    arr.forEach(button => button.classList.remove("active"));

}

function activate(e,arr) {
    let form = e;
    if (form.classList.contains("active") === true) {
        form.classList.remove("active")
    } else {
        deactivate(arr);
        form.classList.toggle("active")
    }

}

function registerEvents(){
    let editBtns = document.querySelectorAll(".edit")
    editBtns.forEach(button => button.addEventListener('click', () => activate(button, editBtns)))
    editBtns.forEach(button => button.addEventListener('mouseleave', () => button.classList.remove("active")))

}

function filter() {
    let filter = document.querySelector(".filter");
    filter.addEventListener("click", () => filter.classList.toggle("active"))
    filter.addEventListener("mouseleave", () => filter.classList.remove("active"))
}

function addNewButton() {
    let addNewButton = document.querySelector(".addNewBtn");
    addNewButton.addEventListener("click", () => addNewButton.classList.toggle("active"))
    addNewButton.addEventListener("mouseleave", () => addNewButton.classList.remove("active"))
}


function onLoad(){
    burgerMenu();
    registerEvents();
    filter();
    addNewButton();
}


window.addEventListener("load", onLoad);
