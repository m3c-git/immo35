

    const burgerToggler = document.querySelector(".burger");

    const navLinksContainer = document.querySelector(".navlinks-container");

    const btn = document.querySelector('div#backToTop');

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

    function backToTop()
    {
        
        window.scroll({
            top: 0,
            left: 0,
            behavior: "smooth",
          }); // reset the scroll position to the top left of the document.
    
    
    }

    function scrollTop()
    {
        const y = window.scrollY;
        //console.log(y);

        if(window.scrollY > 20)
        {
            btn.classList.add("visible");            
            //window.scroll(0, 0); // reset the scroll position to the top left of the document.
            console.log(window.scrollY);
        }
        else
        {
            btn.classList.remove("visible");
            //console.log(window.scrollY)
        }
          
    
    }

document.addEventListener("DOMContentLoaded", function(e) {
    
    burgerToggler.addEventListener("click", toggleNav);
    btn.addEventListener("click", backToTop);
    //btn.addEventListener("scroll", scrollTop);
    window.onscroll = function() {scrollTop()};

});

