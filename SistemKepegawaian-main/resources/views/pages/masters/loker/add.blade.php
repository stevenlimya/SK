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
        <a class="breadcrumb-item" href="#">
            <span class="breadcrumb-icon">
                <i data-feather="database"></i>
            </span>
            <span class="breadcrumb-text">Tambah Lowongan Pekerjaan</span>
        </a>
    </div>
    <div class="row starter-main">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0 card-no-border">
                    <h3>Tambah Lowongan Pekerjaan</h3>
                </div>

                <form class="form theme-form" id="input-form" action="{{ url($information['route']) }}/store" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-4">
                                    <label class="form-label" for="txt-input-judul">Judul Loker<span class="text-danger">*</span></label>
                                    <input class="form-control input-air-primary" id="txt-input-judul" name="judul" type="text" placeholder="Tambahkan Divisi Untuk Lowongan Pekerjaan" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="txt-input-deskripsi1">Deskripsi 1</label>
                                    <input class="form-control input-air-primary" id="txt-input-deskripsi1" name="deskripsi1" type="text" placeholder="Deskripsi Pekerjaan Pertama" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="txt-input-deskripsi2">Deskripsi 2</label>
                                    <input class="form-control input-air-primary" id="txt-input-deskripsi2" name="deskripsi2" type="text" placeholder="Deskripsi Pekerjaan Kedua" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="txt-input-deskripsi3">Deskripsi 3</label>
                                    <input class="form-control input-air-primary" id="txt-input-deskripsi3" name="deskripsi3" type="text" placeholder="Deskripsi Pekerjaan Ketiga" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="txt-input-deskripsi4">Deskripsi 4</label>
                                    <input class="form-control input-air-primary" id="txt-input-deskripsi4" name="deskripsi4" type="text" placeholder="Deskripsi Pekerjaan Keempat" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="txt-input-persyaratan1">Persyaratan 1</label>
                                    <input class="form-control input-air-primary" id="txt-input-persyaratan1" name="persyaratan1" type="text" placeholder="Persyaratan Pekerjaan Pertama" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="txt-input-persyaratan2">Persyaratan 2</label>
                                    <input class="form-control input-air-primary" id="txt-input-persyaratan2" name="persyaratan2" type="text" placeholder="Persyaratan Pekerjaan Kedua" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="txt-input-persyaratan3">Persyaratan 3</label>
                                    <input class="form-control input-air-primary" id="txt-input-persyaratan3" name="persyaratan3" type="text" placeholder="Persyaratan Pekerjaan Ketiga" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="txt-input-persyaratan4">Persyaratan 4</label>
                                    <input class="form-control input-air-primary" id="txt-input-persyaratan4" name="persyaratan4" type="text" placeholder="Persyaratan Pekerjaan Keempat" />
                                </div>
                            </div>
                        </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-secondary" onclick="history.back()" type="button">Tutup</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection


@section('js_after')
<script>
    $(document).ready(function() {
        $("#input-form").submit(function(e) {
            e.preventDefault();

            let form_data = new FormData($(this)[0]);

            $.ajax({
                type: "post",
                url: "{{ url($information['route']) }}/store",
                data: form_data,
                processData: false,
                contentType: false,

                success: function(data) {
                    var response = data;

                    swal({
                        title: response.title,
                        icon: response.type,
                        buttons: {
                            reload: {
                                text: "Input Data Baru",
                                className: "bg-primary text-center"
                            },
                            close: {
                                text: "Tutup",
                                className: "bg-secondary text-center"
                            },
                        },
                    }).then((value) => {
                        if (value == 'reload') {
                            location.reload();
                        } else {
                            location.href = "{{ url($information['route']) }}"; 
                        }
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
                    if (xhr.status == 422) {
                        swal("Proses gagal!", response.message, "error");
                    }
                    if (xhr.status == 500) {
                        swal("Internal Servel Error 500", "Hubungi admin untuk mendapatkan bantuan terkait masalah", "error");
                    }
                },
            });
        });
    });
</script>
@endsection