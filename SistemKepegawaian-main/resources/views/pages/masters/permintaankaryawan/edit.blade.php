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

                <form class="form theme-form" id="edit-form" action="{{ url($information['route']) }}/update/{{ Crypt::encrypt($permintaan_karyawan->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">                  
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="txt-input-pemohon">Nama Pemohon</label>
                                     <input class="form-control input-air-primary" id="pemohon" name="pemohon" type="text" placeholder="Nama" value="{{ $permintaan_karyawan->pemohon }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="txt-input-divisi_pemohon">Divisi Pemohon</label>
                                     <input class="form-control input-air-primary" id="divisi_pemohon" name="divisi_pemohon" type="text" placeholder="Divisi" value="{{ $permintaan_karyawan->divisi_pemohon }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="txt-input-keterangan">Keterangan</label>
                                    <input class="form-control input-air-primary" id="txt-input-keterangan" name="keterangan" type="text" placeholder="Alasan Permintaan" value="{{ $permintaan_karyawan->keterangan }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">                   
                            <div class="col">
                                <div class="mb-4">
                                    <label class="form-label" for="select-input-divisi">Divisi</label>
                                    <select name="divisi" id="select-input-divisi" class="form-control input-air-primary" required>
                                        <option value="{{ $permintaan_karyawan->divisi }}" selected hidden>Pilih Divisi</option>
                                        <option value="HRD" {{ $permintaan_karyawan->divisi === 'HRD' ? 'selected' : '' }}>HRD</option>
                                        <option value="Information And Technology" {{ $permintaan_karyawan->divisi === 'Information And Technology' ? 'selected' : '' }}>Information And Technology</option>
                                        <option value="Penjualan" {{ $permintaan_karyawan->divisi === 'Penjualan' ? 'selected' : '' }}>Penjualan</option>
                                        <option value="Finance" {{ $permintaan_karyawan->divisi === 'Finance' ? 'selected' : '' }}>Finance</option>
                                        <option value="Pembelian" {{ $permintaan_karyawan->divisi === 'Pembelian' ? 'selected' : '' }}>Pembelian</option>                                    
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="txt-input-tanggal">Tanggal Permintaan</label>
                                    <input class="form-control input-air-primary" id="txt-input-tanggal" name="tanggal" type="date" placeholder="Tanggal Permintaan" value="{{ $permintaan_karyawan->tanggal }}"/>
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
                url: "{{ url($information['route']) }}/update/{{ Crypt::encrypt($permintaan_karyawan->id) }}",
                data: form_data,
                processData: false,
                contentType: false,

                success: function(data) {
                    var response = data;

                    swal({
                        title: response.title,
                        icon: response.type,
                        buttons: {
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