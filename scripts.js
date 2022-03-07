(function () {
    const bMenu = document.querySelector(".b-menu"); // saves burger menu as a variable
    const menu = document.querySelector(".menu"); // saves menu as a variable
    bMenu.addEventListener('click', function(){ // listens for "click" events for "menu"
        menu.classList.toggle("active");// toggles class on click
        bMenu.classList.toggle("active");

    });
})();
