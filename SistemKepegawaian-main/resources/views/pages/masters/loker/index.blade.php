@extends('layouts.app')

@section('content')
<!-- Container-fluid starts 12-->
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
    <div class="row">
        <div class="col-md-12">
            <div>
                <div class="row">

                    <div class="col text-left">
                        <h4>{{ $information['title'] }}</h4>
                    </div>
                    <div class="col text-right">
                        <a href="{{ url($information['route'] . '/create') }}" href="{{ url($information['route'] . '/create') }}">
                            <button type="button" class="btn btn-primary">Tambah Data</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header pb-0 card-no-border">
                    <div class="row">
                        <div class="col-md-11">
                            <h3>Data {{ $information['title'] }}</h3>
                        </div>

                    </div>

                </div>
                <div class="card-body">
                    <!-- <input type="text" class="form-control input-air-primary mb-3" id="input-table-search" placeholder="Cari" style="width: 100%;"> -->
                    <div class="table-responsive">
                        <table class="table table-bordered" id="index-table">
                            <thead>
                                <tr class="table-primary">
                                    <th>No</th>
                                    <th>Judul Loker</th>
                                    <th>Deskripsi Utama</th>
                                    <th>Persyaratan Utama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

@endsection

@section('css_before')
<link rel="stylesheet" type="text/css" href="{{ url('assets/vendor/datatables/datatables.bootstrap4.css') }}">
<style>
    /* Hide pencarian di datatable */
    .dataTables_filter {
        display: none;
    }
</style>
@endsection

@section('js_after')
<script src="{{ url('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script>
    var data_table_search_delay = null;
    var data_table = null;

    $(function() {

        data_table = $("#index-table").DataTable({
            processing: true,
            serverSide: true,
            lengthChange: false,
            pageLength: 5,
            searchDelay: 2000,
            ajax: {
                url: "{{ url($information['route']) }}"
            },
            order: [
                [3, 'desc']
            ],
            columns: [{
                    data: 'DT_RowIndex',
                    sortable: false,
                    searchable: false
                },
                {
                    name: "loker.judul",
                    data: "judul"
                },
                {
                    name: "loker.deskripsi1",
                    data: "deskripsi1"
                },
                {
                    name: "loker.persyaratan1",
                    data: "persyaratan1",
                },
                {
                    data: "action",
                    searchable: false,
                    sortable: false
                },
            ],
        });

        $('#input-table-search').keyup(function() {
            clearTimeout(data_table_search_delay);
            data_table_search_delay = setTimeout(() => {
                data_table.search($(this).val()).draw();
            }, 350);
        })
    });


    function delete_confirm(url) {
        swal({
            title: 'Konfirmasi Hapus Data',
            text: 'Apakah anda yakin ingin menghapus data berikut?',
            icon: 'warning',
            buttons: [
                "Batal Hapus",
                "Ya, Hapus"
            ],
            dangerMode: true,
        }).then((isConfirm) => {
            if (isConfirm) {
                
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        
                        var response = data;
                        swal(response.title, response.message, response.type).then((isConfirm) => {
                            data_table.ajax.reload(null, false);
                        });
                    },
                    error: function(xhr, status, error) {
                        
                        var response = xhr.responseJSON;
                        if (xhr.status == 406) {
                            swal(response.title, response.message, response.type);
                        }
                        if (xhr.status == 404) {
                            swal("Proses Gagal!", "Halaman tidak ditemukan", "error");
                        }
                        if (xhr.status == 500) {
                            swal("Internal Servel Error 500", "Hubungi admin untuk mendapatkan bantuan terkait masalah", "error");
                        }
                    }
                });
            }
        });
    }
</script>
@endsection 