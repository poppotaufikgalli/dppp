(function() {
    "use strict";
  
    const select = (el, all = false) => {
        el = el.trim()
        if (all) {
            return [...document.querySelectorAll(el)]
        } else {
            return document.querySelector(el)
        }
    }
  
    /**
    * Preloader
    */
    let preloader = select('#preloader');
    //console.log("preloader", preloader)
    if (preloader) {
        window.addEventListener('load', () => {
            preloader.remove()
        });
    }

    // var gl = document.querySelector('.glightbox')
    // if(gl){
        /*var lightboxDescription = GLightbox({
            selector: '.glightbox'
        });    */
    // }
    const divKunjungan = document.getElementById('divKunjungan')
    if(divKunjungan){
        axios.get('/api/getDataKunjungan').then(res => {
            // console.log("getDataKunjungan", res)
            const {online_user, visit_day, visit_month, visit_year, visit_total} = res.data;
    
            document.getElementById('KunjunganHariIni').innerHTML = visit_day;
            document.getElementById('KunjunganBulanIni').innerHTML = visit_month;
            document.getElementById('KunjunganTahunIni').innerHTML = visit_year;
            document.getElementById('KunjunganTotal').innerHTML = visit_total;
            document.getElementById('KunjunganOnline').innerHTML = online_user;    
        
        })
    }
})()
