@extends('layouts.app')

@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="breadcrumb">
        <a class="breadcrumb-item" href="#">
            <span class="breadcrumb-icon">
                <i data-feather="home"></i>
            </span>
            <span class="breadcrumb-text">Home</span>
        </a>
        <a class="breadcrumb-item" href="#">
            <span class="breadcrumb-icon">
                <i data-feather="database"></i>
            </span>
            <span class="breadcrumb-text">{{ $information['title'] }}</span>
        </a>
    </div>
    <div class="row starter-main">
        <div class="col-md-12">
            <div class="card">
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="notification">
                    {{ session('error') }}
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="notification">
                    {{ session('success') }}
                </div>
            @endif
                <div class="card-header pb-0 card-no-border">
                    <h3>Unduh Laporan</h3>
                </div>
                <form class="form theme-form" id="input-form" action="{{ url($information['route']) }}/export" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-4">
                                    <label class="form-label" for="select-input-laporan">LAPORAN</label>
                                    <select name="report_type" id="select-input-laporan" class="form-control input-air-primary">
                                        <option value="" selected hidden>Pilih Laporan</option>
                                        <option value="izin">Laporan Izin</option>
                                        <option value="cuti">Laporan Cuti</option>
                                        <option value="absen">Laporan Absen</option>
                                        <option value="resain">Laporan Resain</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="start_date">Tanggal Awal</label>
                                    <input class="form-control input-air-primary" id="start_date" name="start_date" type="date" placeholder="Tanggal Awal" />
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="end_date">Tanggal Akhir</label>
                                    <input class="form-control input-air-primary" id="end_date" name="end_date" type="date" placeholder="Tanggal Akhir" />
                                </div>
                            </div>      
                        </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Eksport</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<!-- Container-fluid Ends-->
@endsection

@section('js_after')
<script src="{{ url('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script>

     // Fungsi untuk menghilangkan notifikasi dari session setelah beberapa detik
     function hideNotification() {
        var notification = document.getElementById('notification');
        if (notification) {
            setTimeout(function() {
                notification.style.display = 'none';
            }, 3000); // Pemberitahuan akan hilang setelah 3 detik
        }
    }

    // Panggil fungsi hideNotification
    hideNotification();

</script>
@endsection