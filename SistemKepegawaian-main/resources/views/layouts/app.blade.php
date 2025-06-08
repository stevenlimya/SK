<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT Sumberban Makmur - Dashboard</title>
    <style>
.sidebar {
  width: 200px;
  padding: 10px;
}
.dropdown-btn {
  width: 100%;
  padding: 8px 16px;
  margin-top: 4px;
  text-align: left;
  border: none;
  outline: none;
  background-color: inherit;
  cursor: pointer;
  color: white;
}

.dropdown-btn:hover {
  background-color: #ddd;
}

.dropdown-container {
  display: none;
  padding-left: 16px;
}

.dropdown-container a {
  display: block;
  padding: 6px 8px;
  text-decoration: none;
  color: white;
}

.dropdown-container a:hover {
  background-color: #ccc;
}

.arrow {
  float: right;
  color: white;
  transition: transform 0.3s ease;
}
    </style>

    <!-- Custom fonts for this template-->
    <link href="{{ url('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ url('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    @yield('css_before')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-30">
                    <!-- <i class="fab fa-slack mt-1"></i>  -->
                    <!-- <img scr="wb-group.jpg"/> -->
                    <img src="{{ url('assets/img/logosbm.png') }}" alt="" height="40px" class="icon">
                </div>
                <div class="sidebar-brand-text ml-2">PT Sumber Ban Makmur</div>
            </a>

            
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/') }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->

            <div class="sidebar">
                <button class="dropdown-btn">Akun Login <span class="fas fa-chevron-right arrow"></span></button>
                <div class="dropdown-container">
                <a href="{{ url('/master/user') }}">Akun</a>
                </div>
                <hr>
                <button class="dropdown-btn">Kelola Karyawan <span class="fas fa-chevron-right arrow"></span></button>
                <div class="dropdown-container mt-1">
                <a href="{{ url('/master/karyawan') }}">Data Karyawan</a>
                <a href="{{ url('/master/absen') }}">Data Absensi</a>
                <a href="{{ url('/master/reward') }}">Data Reward</a>
                <a href="{{ url('/master/resain') }}">Data Resign</a>
                <a href="{{ url('/master/sanksi') }}">Data Sanksi</a>
                </div>
                <hr>
                <button class="dropdown-btn">Pengajuan <span class="fas fa-chevron-right arrow"></span></button>
                <div class="dropdown-container">
                <a href="{{ url('/master/izin') }}">Izin</a> 
                <a href="{{ url('/master/cuti') }}">Cuti</a>
                <a href="{{ url('/master/permintaankaryawan') }}">Karyawan</a>
                </div>
                <hr>
                <button class="dropdown-btn">Approval <span class="fas fa-chevron-right arrow"></span></button>
                <div class="dropdown-container">
                <a href="{{ url('/master/approvizin') }}">Izin</a> 
                <a href="{{ url('/master/approvcuti') }}">Cuti</a>
                </div>
                <hr>
                <button class="dropdown-btn">Lowongan Pekerjaan <span class="fas fa-chevron-right arrow"></span></button>
                <div class="dropdown-container">
                <a href="{{ url('/master/loker') }}">Loker</a>
                <a href="{{ url('/master/pelamar') }}">Pelamar</a>
                </div>
                <hr>
                <button class="dropdown-btn">Laporan <span class="fas fa-chevron-right arrow"></span></button>
                <div class="dropdown-container">
                <a href="{{ url('/master/laporan') }}">Laporan</a>
                </div>
            </div>
<!-- <div> -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/master/user') }}">
            <span>Akun</span> 
        </a>
    </li> -->
    
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/master/karyawan') }}">
            <span>Data Karyawan</span> 
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/master/absen') }}">
            <span>Data Absensi</span> 
        </a>
    </li> -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/master/loker') }}">
            <span>Lowongan Pekerjaan</span> 
        </a>
    </li> -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/master/pelamar') }}">
            <span>Data Pelamar</span> 
        </a>
    </li> -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/master/cuti') }}">
            <span>Pengajuan Cuti</span> 
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/master/izin') }}">
            <span>Pengajuan Izin</span> 
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/master/approvizin') }}">
            <span>Approval Izin</span> 
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/master/approvcuti') }}">
            <span>Approval Cuti</span> 
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/master/reward') }}">
            <span>Data Reward</span> 
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/master/resain') }}">
            <span>Data Resain</span> 
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/master/sanksi') }}">
            <span>Data Sanksi</span> 
        </a>
    </li>       -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/master/laporan') }}">
            <span>Laporan</span> 
        </a>
    </li>        -->
<!-- </div> -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> </span>
                                <!-- <i class="fas fa-laugh-wink"></i> -->
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                               
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ url('/FrontPage') }}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div><br><br><br><br><br><br><br><br>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white mb-3">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; PT. Sumber Ban Makmur 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script> -->

    <!-- Bootstrap core JavaScript-->
    <script src="{{ url('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ url('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ url('assets/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ url('assets/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ url('assets/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ url('assets/js/demo/chart-pie-demo.js') }}"></script>
    <script type="text/javascript" src="{{ url('/assets/vendor/sweet-alert/sweetalert.min.js') }}"></script>
    @yield('js_after')
</body>
<script>
                  document.addEventListener('DOMContentLoaded', function() {
                    const dropdownBtns = document.querySelectorAll('.dropdown-btn');

                    dropdownBtns.forEach(btn => {
                        btn.addEventListener('click', function() {
                            const dropdownContent = this.nextElementSibling;
                            dropdownContent.style.display === 'block' ?
                                dropdownContent.style.display = 'none' :
                                dropdownContent.style.display = 'block';

                            const arrowIcon = this.querySelector('.arrow');
                            arrowIcon.classList.toggle('fa-chevron-down'); // Menambah atau menghapus kelas Font Awesome untuk mengubah ikon panah
                            arrowIcon.classList.toggle('fa-chevron-right');
                        });
                    });
                });
            </script>

</html>