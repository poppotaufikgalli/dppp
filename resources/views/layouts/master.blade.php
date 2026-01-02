@include('layouts.header')
<body>
    @include('sweetalert::alert')
    <a
        href="#"
        class="btn btn-accent btn-lg rounded-circle back-to-top"
        role="button"
        id="btn-back-to-top"
    >
        <i class="bi bi-arrow-up"></i>
    </a>
    @include('partials.nav')
    
    @yield('content')
    @include('layouts.footer')
    
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(){
            AOS.init()

            // Get the button element
            let myButton = document.getElementById("btn-back-to-top");

            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function () {
            scrollFunction();
            };

            function scrollFunction() {
            if (
                document.body.scrollTop > 20 ||
                document.documentElement.scrollTop > 20
            ) {
                myButton.classList.remove("d-none");
                myButton.classList.add("d-block");
            } else {
                myButton.classList.remove("d-block");
                myButton.classList.add("d-none");
            }
            }

            // When the user clicks on the button, smoothly scroll to the top of the document
            myButton.addEventListener("click", function (e) {
            e.preventDefault(); // Prevent default anchor behavior
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
            });


            /*if(pathname == '/'){
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
            }*/
        }); 
    </script>
    @stack('scripts')
</body>
</html>