(function(d) {
    "use strict";
  
    /*--Use Way--*/
    var s = d.createElement("script");
    /* uncomment the following line to override default position*/
    s.setAttribute("data-position", 2);
    /* uncomment the following line to override default size (values: small, large)*/
    s.setAttribute("data-size", "large");
    /* uncomment the following line to override default language (e.g., fr, de, es, he, nl, etc.)*/
    /* s.setAttribute("data-language", "language");*/
    /* uncomment the following line to override color set via widget (e.g., #053f67)*/
    /* s.setAttribute("data-color", "#053e67");*/
    /* uncomment the following line to override type set via widget (1=person, 2=chair, 3=eye, 4=text)*/
    /* s.setAttribute("data-type", "1");*/
    /* s.setAttribute("data-statement_text:", "Our Accessibility Statement");*/
    /* s.setAttribute("data-statement_url", "http://www.example.com/accessibility")";*/
    /* uncomment the following line to override support on mobile devices*/
    /* s.setAttribute("data-mobile", true);*/
    /* uncomment the following line to set custom trigger action for accessibility menu*/
    /* s.setAttribute("data-trigger", "triggerId")*/
    s.setAttribute("data-account", "7xbv06W7X5");
    s.setAttribute("src", "https://cdn.userway.org/widget.js");
    (d.body || d.head).appendChild(s);
    /*--End Use Way--*/

})(document)

document.addEventListener("DOMContentLoaded", function(){
    const pathname = window.location.pathname
    //responsiveVoice.setDefaultVoice("Indonesian Female");
    if(pathname == '/'){
        responsiveVoice.speak("selamat datang di website Gerakan Pramuka Kwartir Cabang Kota Tanjungpinang", "Indonesian Female");
        
        //responsiveVoice.speak(document.getElementById("navbar_top").textContent);
        responsiveVoice.setTextReplacements([
            {
                searchvalue: "SOP",
                newvalue: "S O P"
            },
            {
                searchvalue: "MoU",
                newvalue: "M O U"
            }
        ]);
    }
    
    var mainNav = document.getElementById('mainNav');
    //console.log(mainNav)
    mainNav.querySelectorAll('.nav-item a').forEach(function(element){
        //console.log(element)
        element.addEventListener('mouseover', function (e) {
                                    //console.log(e.target.textContent)  
            responsiveVoice.cancel();
            responsiveVoice.speak(e.target.textContent, "Indonesian Female");
        });
    })

    if(pathname == '/'){
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.getElementById('navbar_top').classList.add('bg-accent-rgb');
            } else {
                document.getElementById('navbar_top').classList.remove('bg-accent-rgb');
            } 
        });    
    }else{
        document.getElementById('navbar_top').classList.add('bg-accent-rgb');
        document.getElementById('navbar_top').classList.remove('fixed-top');
    }
}); 

window.gtranslateSettings = {
    "default_language":"id",
    "languages":[
        "id","en"
    ],
    "wrapper_selector":".gtranslate_wrapper",
    "float_switcher_open_direction":"right",
    "flag_style":"3d"
}