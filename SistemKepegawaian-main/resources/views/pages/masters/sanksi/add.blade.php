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
            <span class="breadcrumb-text">Tambah {{ $information['title'] }} </span>
        </a>
    </div>
    <div class="row starter-main">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0 card-no-border">
                    <h3>Tambah {{ $information['title'] }} </h3>
                </div>

                <form class="form theme-form" id="input-form" action="{{ url($information['route']) }}/store" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-4">
                                <label class="form-label" for="select-input-karyawan_id">Nama</label>
                                    <select name="karyawan_id" id="karyawan_id" class="form-control input-air-primary">
                                        <option value="">Pilih Nama Karyawan</option>
                                        @foreach($karyawan as $karyawan)
                                            <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>      
                        </div>
                        <input class="form-control input-air-primary" id="nama" name="nama" type="hidden" placeholder="Nama" />
                        <div class="row">
                            <div class="col">
                                    <div class="mb-4">
                                        <label class="form-label" for="select-input-divisi">Divisi</label>
                                        <select name="divisi" id="divisi" class="form-control input-air-primary">
                                            <option value="" selected hidden>Pilih Divisi</option>
                                            <option value="HRD">HRD</option>
                                            <option value="Information And Technology">Information And Technology</option>
                                            <option value="Penjualan">Penjualan</option>
                                            <option value="Finance">Finance</option>
                                            <option value="Pembelian">Pembelian</option>
                                        </select>
                                    </div>
                            </div>      
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="txt-input-sanksi">Sanksi</label>
                                    <input class="form-control input-air-primary" id="txt-input-sanksi" name="sanksi" type="text" placeholder="Sanksi Yang Diterima" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="txt-input-keterangan">Keterangan</label>
                                    <input class="form-control input-air-primary" id="txt-input-keterangan" name="keterangan" type="text" placeholder="Keterangan Pelanggaran" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="txt-input-tanggal">Tanggal</label>
                                    <input class="form-control input-air-primary" id="txt-input-tanggal" name="tanggal" type="date" placeholder="" />
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
            $('#karyawan_id').change(function() {
                var id = $(this).val();
                if (id) {
                    // Kirim permintaan Ajax ke endpoint yang tepat
                    $.ajax({
                        url: "{{ url($information['route']) }}/getdata/" + id + "/",
                        type: 'GET',
                        dataType: 'json',
                        success: function(karyawan) {
                            $('#nama').val(karyawan.nama);
                            if (karyawan.divisi) {
                                var divisiDropdown = '<option value="' + karyawan.divisi + '">' + karyawan.divisi + '</option>';
                                $('#divisi').html(divisiDropdown);
                            } else {
                        $('#divisi').empty(); // Mengosongkan dropdown divisi jika tidak ada data divisi
                    }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    $('#nama').val(''); 
                    $('#divisi').val(''); 
                }
            });
        });
        
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