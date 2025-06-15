@extends('layouts.app')
@section('content')

<div class="card-body">
    <div class="container-fluid">
        <h1>PT ELICD</h1>
        <hr><br><br>

        <h2>Profil Perusahaan</h2>
        <hr class="left-corner-line" style="width: 600px; position: absolute;"><br><br>

        <div class="bodypage">
            <!-- About Section -->
            <section>
                <div class="row">
                    <div class="col-lg-6">
                        <p>Sejak berdiri pada 12 Januari 2012, PT ELICD telah memantapkan diri sebagai perusahaan terpercaya dalam bidang distribusi dan penjualan ban berkualitas tinggi. Berlokasi strategis di kawasan industri Tanjung Raya, tepatnya di Jl. Letjen H. S. Wiratama, perusahaan ini menjadi mitra utama bagi pelanggan yang mencari produk ban unggulan dari merek-merek ternama seperti Hankook.

Dengan komitmen terhadap kualitas dan pelayanan profesional, PT ELICD terus tumbuh dan berkembang, memperluas jangkauan distribusi di berbagai wilayah Indonesia. Didukung oleh tim yang berpengalaman dan sistem logistik yang efisien, PT ELICD bertekad menjadi pilihan utama bagi pelanggan ritel maupun korporat dalam memenuhi kebutuhan ban berstandar internasional.</p>

                        <h2>Visi dan Misi</h2>
                        <hr style="width: 600px;">
                        
                        <h4>Visi</h4>
                        <p>Menjadi perusahaan berskala nasional yang mampu bersaing di tingkat internasional.</p>

                        <h4>Misi</h4>
                        <p>
                            1. Terus berinovasi dan melakukan perbaikan secara berkelanjutan.<br>
                            2. Mengambil keputusan berdasarkan analisa data yang akurat.<br>
                            3. Membangun kemitraan jangka panjang yang saling menguntungkan.
                        </p>
                    </div>

                    <div class="col-lg-6">
                        <!-- Company Image -->
                        <img src="{{ url('assets/img/banelicd.png') }}" class="img-fluid" alt="Company Image">
                    </div>
                </div>
            </section>
        </div>
    </div><br><br><br><br><br><br><br><br>

@endsection

@section('css_before')
@endsection


