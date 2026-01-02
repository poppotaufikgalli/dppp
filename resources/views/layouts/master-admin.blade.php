@include('layouts.header')
    <body>
        @include('sweetalert::alert')
        <div id="wrapper">
            @include('partials.sidebar')

            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">
                    @include('partials.topbar')
                    
                    @yield('content')
                </div>

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <small>&copy; 2025 | {{env('APP_NAME')}} | V.1</small>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Logout/Keluar?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">Apakah anda ingin Logout? Pilih "Logout" untuk mengakhiri sesi anda.</div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                            <a class="btn btn-sm btn-primary" href="{{route('logout')}}">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="gantiPasswordModal" aria-labelledby="gantiPasswordModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="gantiPasswordModalTitle">Ganti Password</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="{{route('user.reset.password')}}">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="admin" id="admin">
                                <div class="row mb-3" id="passwordLama">
                                    <label for="password0" class="col-sm-12 col-form-label">Password Lama</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-sm" id="password0" name="password_old">
                                            <button type="button" id="btnPassword0" class="btn btn-sm btn-primary"><i class="bi bi-eye"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="password1" class="col-sm-12 col-form-label">Password Baru</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-sm" id="password1" name="password">
                                            <button type="button" id="btnPassword1" class="btn btn-sm btn-primary"><i class="bi bi-eye"></i></button>
                                        </div>
                                    </div>
                                    <label for="password2" class="col-sm-12 col-form-label">Konfirmasi Password Baru</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-sm" id="password2" name="password_confirmation">
                                            <button type="button" id="btnPassword2" class="btn btn-sm btn-primary"><i class="bi bi-eye"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function(){
                const gantiPasswordModal = document.getElementById('gantiPasswordModal')

                if (gantiPasswordModal) {
                    gantiPasswordModal.addEventListener('show.bs.modal', event => {
                        const button = event.relatedTarget
                        const id = button.getAttribute('data-bs-id')
                        const admin = button.getAttribute('data-bs-admin')
                        
                        const inputId = gantiPasswordModal.querySelector('.modal-body input#id')
                        const inputAdmin = gantiPasswordModal.querySelector('.modal-body input#admin')
                        const passwordLama = gantiPasswordModal.querySelector('.modal-body #passwordLama')

                        inputId.value = id
                        inputAdmin.value = admin

                        if(admin == "1"){
                            passwordLama.classList.add('d-none')
                        }else{
                            passwordLama.classList.remove('d-none')
                        }
                    })
                }

                document.getElementById('btnPassword0').addEventListener('click', function(e){
                    var password0 = document.getElementById('password0')
                    if(password0.type == 'password'){
                        password0.type = 'text'
                        this.innerHTML = '<i class="bi bi-eye-slash"></i>'
                    }else{
                        password0.type = 'password'
                        this.innerHTML = '<i class="bi bi-eye"></i>'
                    }
                })

                document.getElementById('btnPassword1').addEventListener('click', function(e){
                    var password1 = document.getElementById('password1')
                    if(password1.type == 'password'){
                        password1.type = 'text'
                        this.innerHTML = '<i class="bi bi-eye-slash"></i>'
                    }else{
                        password1.type = 'password'
                        this.innerHTML = '<i class="bi bi-eye"></i>'
                    }
                })

                document.getElementById('btnPassword2').addEventListener('click', function(e){
                    var password2 = document.getElementById('password2')
                    if(password2.type == 'password'){
                        password2.type = 'text'
                        this.innerHTML = '<i class="bi bi-eye-slash"></i>'
                    }else{
                        password2.type = 'password'
                        this.innerHTML = '<i class="bi bi-eye"></i>'
                    }
                })
            }); 
        </script>
        @stack('scripts')
    </body>
</html>