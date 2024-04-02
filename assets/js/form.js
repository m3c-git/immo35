function formManage(form) {
    console.log(`data msg :  ${form} `);

    let formData = new FormData(form);
    //formData.append('contactManage', contactManage);
    //const urlEncodeData = new URLSearchParams(formData);
    console.log(formData.entries());
    const options = {
        method: 'POST',
        body: formData,
       
    };

    fetch('index.php?route=check-contact-manage', options)
        .then(response => response.json())
        .then(data => {
            console.log(data);
        });
}

document.addEventListener("DOMContentLoaded", function(e) {
    console.log("Le DOM est chargé.");
    e.preventDefault();
    function getRoute()
    {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);

        return urlParams.get('route');
    }

    const route = getRoute();

    /*console.log(route);*/

    if(route === 'contact-manage') {
        let form = document.querySelector('form');

        form.addEventListener('submit', (event) => {
                /* let element = event.target;
                let formManage = element.getAttribute("data-manage"); */
                
                //let element = document.querySelector('#contact-manage');
                formManage(form);
                event.preventDefault();
            });
       
    }
});


