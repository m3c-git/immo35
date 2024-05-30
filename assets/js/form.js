async function formManage(form) {
    try {

        let formData = new FormData(form);
        //formData.append('contactManage', contactManage);
        //const urlEncodeData = new URLSearchParams(formData);
        const options = {
            method: 'POST',
            body: formData,
           
        };
    
            let url = 'index.php?route=check-contact-manage';
            let reponse = await fetch(url, options);
            
            if(reponse.ok)
            {
                let result = await reponse.json();

                if (result.isSuccessf) {
                    console.log("Mail envoyé !");
                     
                    document.getElementById("thank-you").innerHTML = "Merci pour votre message il a bien été envoyé.<br>Je reviens vers vous rapidement.<br>Pensez à vérifier vos spams";
                    document.getElementById("thank-you").style.display="block";
                    document.getElementById("sendError").style.display="none";
                    document.getElementById("contact-maanage-form").reset();
                    document.getElementsByClassName("comments")[0].innerHTML = "";
                    document.getElementsByClassName("comments")[1].innerHTML = "";
                    document.getElementsByClassName("comments")[2].innerHTML = "";
                    document.getElementsByClassName("comments")[3].innerHTML = "";
                    document.getElementsByClassName("comments")[4].innerHTML = "";
                    document.getElementsByClassName("comments")[5].innerHTML = "";
                    document.getElementsByClassName("comments")[6].innerHTML = "";
    
                } else { 
                    document.getElementById("thank-you").style.display="none";
                    document.getElementById("sendError").innerHTML = "Un problème est survenu  survenu lors de l'envoi. <br>Merci d'essayer ultérieurement. <br>Si l'erreur persiste merci de me contacter par téléphone";
                    document.getElementById("sendError").style.display="block";
                    document.getElementsByClassName("comments")[0].innerHTML = result.civiliteError;
                    document.getElementsByClassName("comments")[1].innerHTML = result.firstnameError;
                    document.getElementsByClassName("comments")[2].innerHTML = result.emailError;
                    document.getElementsByClassName("comments")[3].innerHTML = result.phoneError;
                    document.getElementsByClassName("comments")[4].innerHTML = result.districtError;
                    document.getElementsByClassName("comments")[5].innerHTML = result.districtError;
                    document.getElementsByClassName("comments")[6].innerHTML = result.cityError;
                    
                }
            }
            
        
       
        
    } catch (error) {

        console.error("Un problème est survenu lors de l'envoi :", error);
    }


}

async function formContact(form) {
    try {

        let formData = new FormData(form);
        //formData.append('contactManage', contactManage);
        //const urlEncodeData = new URLSearchParams(formData);
        const options = {
            method: 'POST',
            body: formData,
           
        };
    
            let url = 'index.php?route=check-contact';
            let reponse = await fetch(url, options);
            
            if(reponse.ok)
            {
                let result = await reponse.json();
                console.log(result);

                if (result.isSuccessf) {
                    console.log("Mail envoyé !");
                     
                    document.getElementById("thank-you").innerHTML = "Merci pour votre message il a bien été envoyé.<br>Je reviens vers vous rapidement.<br>Pensez à vérifier vos spams";
                    document.getElementById("thank-you").style.display="block";
                    document.getElementById("sendError").style.display="none";
                    document.getElementById("contact-form").reset();
                    document.getElementsByClassName("comments")[0].innerHTML = "";
                    document.getElementsByClassName("comments")[1].innerHTML = "";
                    document.getElementsByClassName("comments")[2].innerHTML = "";
                    document.getElementsByClassName("comments")[3].innerHTML = "";
                    document.getElementsByClassName("comments")[4].innerHTML = "";
                    document.getElementsByClassName("comments")[5].innerHTML = "";
                    document.getElementsByClassName("comments")[6].innerHTML = "";
                    document.getElementsByClassName("comments")[7].innerHTML = "";
                    document.getElementsByClassName("comments")[8].innerHTML = "";
                    document.getElementsByClassName("comments")[9].innerHTML = "";
    
                } else { 
                    document.getElementById("thank-you").style.display="none";
                    document.getElementById("sendError").innerHTML = "Un problème est survenu  survenu lors de l'envoi. <br>Merci d'essayer ultérieurement. <br>Si l'erreur persiste merci de me contacter par téléphone";
                    document.getElementById("sendError").style.display="block";
                    document.getElementsByClassName("comments")[0].innerHTML = result.civiliteError;
                    document.getElementsByClassName("comments")[1].innerHTML = result.firstnameError;
                    document.getElementsByClassName("comments")[2].innerHTML = result.lastnameError;
                    document.getElementsByClassName("comments")[3].innerHTML = result.companyError;
                    document.getElementsByClassName("comments")[5].innerHTML = result.phoneError;
                    document.getElementsByClassName("comments")[6].innerHTML = result.emailError;
                    document.getElementsByClassName("comments")[7].innerHTML = result.districtError;
                    document.getElementsByClassName("comments")[8].innerHTML = result.cityError;
                    document.getElementsByClassName("comments")[9].innerHTML = result.messageError;
                    let test = getComputedStyle(document.getElementsByClassName("comments")[3]);
                    console.log(test.display );
                }
            }
            
        
       
        
    } catch (error) {

        console.error("Un problème est survenu lors de l'envoi :", error);
    }


}

function toggleContactForm(profil) {
    
    let demandeProfessionnelle = document.querySelectorAll(".demande-professionnelle");
    let demandeProfessionnelleSelect = document.querySelector("select.demande-professionnelle");
    let demandeProfessionnelleInput = document.querySelectorAll(".demande-professionnelle > input");

    let demandeParticulier = document.querySelector(".demande-particulier");
    let demandeParticulierSelect = document.querySelector("select.demande-particulier");

    

    if( profil.value === "Un particulier")
    {   console.log(profil.value);

        demandeParticulierSelect.removeAttribute("disabled", "");
        demandeParticulier.style.display="block";
        
        demandeProfessionnelleSelect.setAttribute("disabled", "");
        demandeProfessionnelle.forEach(element => {
           
            element.style.display="none";
            
        });

        demandeProfessionnelleInput.forEach(element => {
           
            element.setAttribute("disabled", "");
            
        });        
        

    }
    else if(profil.value === "Un professionnel une entreprise"){

        demandeParticulierSelect.setAttribute("disabled", "");
        demandeParticulier.style.display="none";

        demandeProfessionnelleSelect.removeAttribute("disabled", "");
        demandeProfessionnelle.forEach(element => {

            element.removeAttribute("disabled", "");
            element.style.display="block";

        });

        demandeProfessionnelleInput.forEach(element => {
           
            element.removeAttribute("disabled");
            
        }); 

    }
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

    console.log(route);

    if(route === 'contact-manage') {
        let form = document.querySelector('#contact-manage-form');

        form.addEventListener('submit', (event) => {

                formManage(form);
                event.preventDefault();
            });
       
    }
    else if(route === 'sell' || route === 'contact') {

        let form = document.querySelector('#contact-form');
        let profil = document.querySelector("select.profil");

        profil.addEventListener('click', () => {

            toggleContactForm(profil);
        
        });

        form.addEventListener('submit', (event) => {

                formContact(form);
                event.preventDefault();
            });

    }

});


