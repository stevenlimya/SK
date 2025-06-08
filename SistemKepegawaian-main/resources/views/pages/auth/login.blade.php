<!DOCTYPE html>
<html lang="en" style="box-shadow: inset 0 0 2000px rgba(120, 250, 250, .5)">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT Sumberban Makmur - Login</title>
    <style>
    </style>

    <!-- Custom fonts for this template-->
    <link href="{{ url('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary" >

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-9 col-md-9 mt-5 ml-5">
                <div class="card o-hidden border-0 shadow-lg my-5 ml-3" style=" width : 450px; height: 500px; border-radius: 20px;">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col p-5">
                                <h1 class="text-center sidebar-brand-text mx-3 mt-3">Login</h1><hr><br><br>
                                @if(session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                                @endif
                                <form class="user" action="{{ url('/auth/login') }}" id="login-form">
                                    @csrf
                                    <div class="form-group">
                                        <input type="username" name="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Masukkan Username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Masukan Password">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block" style="box-shadow: inset 0 0 2000px rgba(120, 250, 250, .5)">
                                        Login
                                    </button>
                                    <!-- <hr> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ url('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ url('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ url('assets/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ url('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ url('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ url('assets/js/sb-admin-2.min.js') }}"></script>
    <script>
        // Script JavaScript untuk pengiriman data login menggunakan AJAX
        $("#login-form").submit(function(e) {
            e.preventDefault();

            // Kirim data ke server menggunakan AJAX
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(response) {
                    var result = response.response;
                    if (response.code > 0) {
                        // Jika login sukses, redirect ke halaman utama
                        window.location = '/';
                    } else {
                        // Jika login gagal, tampilkan notifikasi kesalahan
                        var error = result.error;
                        $('.alert').remove(); // Hapus notifikasi sebelumnya (jika ada)
                        var errorHtml = '<div class="alert alert-danger" role="alert">' +
                            "Gagal! Password atau Usename salah " +
                            '</div>';
                        $(errorHtml).insertBefore('#login-form');
                    }
                },
                error: function(request, error) {
                    swal.fire({
                        title: "Gagal!",
                        text: "Terjadi kesalahan dalam memproses, harap menghubungi Administrator",
                        icon: "error"
                    });
                }
            });
        });    
        // $("#login-form").submit(function(e) {
        //     e.preventDefault();

        //     // Kirim data ke server
        //     $.ajax({
        //         type: "POST",
        //         url: $(this).attr('action'),
        //         data: $(this).serialize(),
        //         success: function(response) {
        //             var result = response.response;
        //             if (response.code > 0) {
        //                 // swal.fire({
        //                 //     title: result.title,
        //                 //     text: result.message,
        //                 //     icon: result.type,
        //                 //     buttons: false,
        //                 // });
        //                 window.location = '/';
        //             } else {
        //                 // swal.fire({
        //                 //     title: result.title,
        //                 //     text: result.message,
        //                 //     icon: result.type
        //                 // });
        //             }
        //         },
        //         error: function(request, error) {
        //             swal.fire({
        //                 title: "Gagal!",
        //                 text: "Terjadi kesalahan dalam memproses, harap menghubungi Administrator",
        //                 icon: "error"
        //             });
        //         }
        //     });
        // });
    </script>

</body>

</html>