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
                        <p>PT ELICD adalah perusahaan yang fokus pada distribusi dan penjualan ban berkualitas dengan merek-merek ternama seperti Hankook. Berdiri sejak 12 Januari 2021, perusahaan ini berlokasi strategis di Jl. Letjen Harun Sohar, kawasan Tanjung Api Api. Sejak awal pendiriannya, PT ELICD telah dikenal sebagai tempat terpercaya bagi pelanggan yang menginginkan produk ban unggulan dari brand ternama.</p>

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


