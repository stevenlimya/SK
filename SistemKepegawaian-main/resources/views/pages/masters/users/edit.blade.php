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
            <span class="breadcrumb-text">Edit {{ $information['title'] }}</span>
        </a>
    </div>
    <div class="row starter-main">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0 card-no-border">
                    <h3>Edit {{ $information['title'] }}</h3>
                </div>

                <form class="form theme-form" id="edit-form" action="{{ url($information['route']) }}/update/{{ Crypt::encrypt($users->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-4">
                                    <label class="form-label" for="txt-input-nama">Nama<span class="text-danger">*</span></label>
                                    <input class="form-control input-air-primary" id="txt-input-nama" name="nama" type="nama" placeholder="Nama" value="{{ $users->nama }}" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-4">
                                    <label class="form-label" for="txt-input-name">Email<span class="text-danger">*</span></label>
                                    <input class="form-control input-air-primary" id="txt-input-name" name="email" type="email" placeholder="Email" value="{{ $users->email }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="txt-input-username">Username</label>
                                    <input class="form-control input-air-primary" id="txt-input-username" name="username" type="text" placeholder="Username" value="{{ $users->username }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="txt-input-password">Password</label>
                                    <input class="form-control input-air-primary" id="txt-input-password" name="password" type="password" placeholder="Password"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">                   
                            <div class="col">
                                <div class="mb-4">
                                    <label class="form-label" for="select-input-hakakses">Hak Akses</label>
                                    <select name="hakakses" id="select-input-hakakses" class="form-control input-air-primary" required>
                                        <option value="{{ $users->hakakses }}" selected hidden>Pilih Hak Akses</option>
                                        <option value="HRD" {{ $users->hakakses === 'HRD' ? 'selected' : '' }}>HRD</option>
                                        <option value="Karyawan" {{ $users->hakakses === 'Karyawan' ? 'selected' : '' }}>Karyawan</option>
                                        <option value="Direktur" {{ $users->hakakses === 'Direktur' ? 'selected' : '' }}>Direktur</option>
                                    </select>
                                </div>
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
        $("#edit-form").submit(function(e) {
            e.preventDefault();

            let form_data = new FormData($(this)[0]);

            $.ajax({
                type: "post",
                url: "{{ url($information['route']) }}/update/{{ Crypt::encrypt($users->id) }}",
                data: form_data,
                processData: false,
                contentType: false,

                success: function(data) {
                    var response = data;

                    swal({
                        title: response.title,
                        icon: response.type,
                        buttons: {
                            // reload: {
                            //     text: "Input Data Baru",
                            //     className: "bg-primary .d-flex"
                            // },
                            close: {
                                text: "Tutup",
                                className: "bg-secondary .d-flex"
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