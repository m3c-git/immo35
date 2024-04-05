

    const burgerToggler = document.querySelector(".burger");

    const navLinksContainer = document.querySelector(".navlinks-container");

    const toggleNav = e => {
        burgerToggler.classList.toggle("open");

        const araToggle = burgerToggler.getAttribute("aria-expanded")
        if(araToggle === "true")
        {
            burgerToggler.setAttribute("aria-expanded", "true")
        }
        else
        {
            burgerToggler.setAttribute("aria-expanded", "false")
        }
        
        navLinksContainer.classList.toggle('open')
    }

document.addEventListener("DOMContentLoaded", function(e) {
    
    burgerToggler.addEventListener("click", toggleNav);
    

});