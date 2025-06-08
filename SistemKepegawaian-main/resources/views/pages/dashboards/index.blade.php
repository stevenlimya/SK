@extends('layouts.app')
@section('content')

<div class="card-body">
    <div class="container-fluid">
            <h1>PT SUMBER BAN MAKMUR</h1>
            <HR>
        </HR><br><br>
       <h2>Profil Perusahaan</h2><hr class="left-corner-line" style="width: 600px;  position: absolute;"><br><br>
        <div class="bodypage">
        <!-- About Section -->
        <section>
            <div class="row">
                <div class="col-lg-6">
                    <p>PT Sumber Ban Makmur adalah sebuah perusahaan yang bergerak dalam penjualan ban dengan merek terkemuka seperti Hankook. Perusahaan ini berdiri sejak tanggal 12 Januari 2021 dan memiliki lokasi yang strategis di Jl. Letjen Harun Sohar Tanjung Api Api. Sejak awal berdirinya, PT Sumber Ban Makmur telah menjadi salah satu destinasi utama bagi konsumen yang mencari ban berkualitas tinggi dari merek terpercaya seperti Hankook.</p>
                    <h2>Visi Dan Misi Perusahaan</h2><hr style="width: 600px;">
                    <h4>Visi</h4>
                    <p>Menjadi Perusahaan Nasional yang memiliki standar Internasional.</p>
                    <h4>Misi</h4>
                    <p>1. Inovasi dan improve merupakan KEHARUSAN. <br> 2. KEPUTUSAN harus berdasarkan data. <br> 3. Membangun jaringan dan kerja sama untuk jangka panjang.</p>
                </div>
                <div class="col-lg-6">
                <!-- Insert an image related to your company -->
                <img src="{{ url('assets/img/sbm.png') }}" class="img-fluid" alt="Company Image">
                </div>
            </div>
        </section>
    </div>
</div><br><br><br><br><br><br><br><br>

@endsection

@section('css_before')
@endsection

