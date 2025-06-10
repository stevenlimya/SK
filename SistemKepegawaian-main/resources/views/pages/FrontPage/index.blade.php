<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PT ELICD</title>
  <style>
    .hero {
  background-color: rgb(0,168,250);
  padding: 100px 0;
}

.about {
  padding: 80px 0;
}

.products {
  padding: 100px 0;
}


.contact {
  padding: 80px 0;
}

.footer {
  background-color: blue;
  color: #fff;
  box-shadow: inset 0 0 2000px rgba(120, 250, 250, .5);
  padding: 20px 0;
}
.card {
  flex: 0 0 auto; /* Tidak memperluas card, namun tetap mempertahankan ukuran asli */
  width: 300px; /* Lebar card */
  border: 1px solid #ccc;
  border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
.card-container {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap; /* Tidak memungkinkan wrapping ke baris baru */
  overflow-x: auto; /* Tampilkan scrollbar horizontal jika melebihi lebar */
  gap: 20px; /* Jarak antar card */
  padding: 20px;
}
.card p {
  font-size: 14px;
  margin-bottom: 8px;
}
.card h4 {
    font-size: 18px;
    margin-bottom: 10px;
}
.judul {
  text-align: center;
}
.swiper-container {
      width: 100%;
      height: 100%;
    }

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      /* other styles */
    }

  </style>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="styles.css" rel="stylesheet">

</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-primary navbar-dark" style="box-shadow: inset 0 0 2000px rgba(120, 250, 250, .5)">
    <a class="navbar-brand px-5" href="#">PT Sumber Ban Makmur</a>
    <div class="container" id="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#products">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#loker">Loker</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="#contact">Contact</a>
          </li> -->
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Login Admin
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ url('/login') }}">Login</a></li>
          </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  
  <!-- Hero Section -->
  <section id="home" class="hero">
    <div class="container text-center" >
      <img src="{{ url('assets/img/banelicd.png') }}" alt="" class="icon">
      <h2>Selamat Datang Di Website</h2>
      <h1>PT ELICD</h1>
    </div>
  </section>
  <div class="bodypage" style="box-shadow: inset 0 0 2000px rgba(150, 250, 250, .3)">
  <!-- About Section -->
  <section id="about" class="about">
    <div class="container">
      <div class="row">
        <div class="judul"><h2>Tentang Kami</h2><br></div>
        <div class="col-lg-6">
          <p>PT ELICD adalah perusahaan yang bergerak di bidang distribusi dan penjualan ban kendaraan bermotor, mulai dari mobil penumpang hingga kendaraan niaga dan alat berat. Berdiri sejak tahun 2012, PT ELICD berkomitmen untuk menyediakan produk ban berkualitas tinggi yang mendukung keselamatan, kenyamanan, dan performa kendaraan pelanggan kami di seluruh Indonesia.</p>
          <p>Kami bekerja sama dengan berbagai merek ternama seperti Michelin, Bridgestone, GT Radial, Dunlop, dan lainnya, untuk memastikan pelanggan mendapatkan pilihan terbaik sesuai kebutuhan mereka. Dengan jaringan distribusi yang luas, layanan pelanggan yang responsif, dan tim teknis yang profesional, PT ELICD telah dipercaya oleh ribuan pelanggan individu maupun perusahaan fleet.</p>
        </div>
        <div class="col-lg-6">
          <!-- Insert an image related to your company -->
          <img src="{{ url('assets/img/banelicd.png') }}" class="img-fluid" alt="Company Image">
        </div>
      </div>
    </div>
  </section>

  <!-- Products Section -->
  <section id="products" class="products">
    <div class="container">
      <div class="judul"><h2>Produk Kami</h2><br></div>
      <!-- Display your products here -->
      <div class="card-container mx-5">
        
          <div class="swiper-container">
            <div class="swiper-wrapper">
              <div class="col-lg-4">
                <div class="card">
                  <div class="card-body">
                    <img src="{{ url('assets/img/ban1.png') }}" class="img-fluid" alt="Product 1"><hr>
                    <h5 class="card-title">Ventus S1 Noble</h5>
                    <p class="card-text">Keseimbangan yang ideal</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
        <div class="swiper-container">
            <div class="swiper-wrapper">
              <div class="col-lg-4">
                <div class="card">
                  <div class="card-body">
                    <img src="{{ url('assets/img/ban2.png') }}" class="card-img-top" alt="Product 2"><hr>
                    <h5 class="card-title">Ventus V2 Concept</h5>
                    <p class="card-text">Konsep pengemudian baru</p>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="swiper-container">
            <div class="swiper-wrapper">
              <div class="col-lg-4">
                <div class="card">
                  <div class="card-body">
                    <img src="{{ url('assets/img/ban3.png') }}" class="card-img-top" alt="Product 3"><hr>
                    <h5 class="card-title">Kinergy Eco</h5>
                    <p class="card-text">Pengemudian yang lebih aman</p>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="swiper-container">
            <div class="swiper-wrapper">
              <div class="col-lg-4">
                <div class="card">
                  <div class="card-body">
                    <img src="{{ url('assets/img/ban4.png') }}" class="card-img-top" alt="Product 4"><hr>
                    <h5 class="card-title">Ventus Prime</h5>
                    <p class="card-text">Keseimbangan yang sempurna</p>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="swiper-container">
            <div class="swiper-wrapper">
              <div class="col-lg-4">
                <div class="card">
                  <div class="card-body">
                    <img src="{{ url('assets/img/ban5.png') }}" class="card-img-top" alt="Product 5"><hr>
                    <h5 class="card-title">Ventus S1 Evo</h5>
                    <p class="card-text">Keseimbangan yang terbaik</p>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="swiper-container">
            <div class="swiper-wrapper">
              <div class="col-lg-4">
                <div class="card">
                  <div class="card-body">
                    <img src="{{ url('assets/img/ban6.png') }}" class="card-img-top" alt="Product 6"><hr>
                    <h5 class="card-title">Ventus S1 Evo Z</h5>
                    <p class="card-text">Performa yang maksimal</p>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Loker Section -->
  <section id="loker" class="loker">
    <div class="judul"><h2>Lowongan Pekerjaan</h2></div>
     <br>
    <div class="card-container mx-5">
        @foreach($loker as $loker)
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{ $loker->judul }}</h4><hr>
                  <h5 class="card-title">Deskripsi Pekerjaan</h5>
                  <p class="card-text">{{ $loker->deskripsi1 }} <br>{{ $loker->deskripsi2 }} <br> {{ $loker->deskripsi3 }} <br> {{ $loker->deskripsi4 }}</p>
                  <h5 class="card-title">Persyaratan Pekerjaan</h5>
                  <p class="card-text">{{ $loker->persyaratan1 }} <br> {{ $loker->persyaratan2 }} <br> {{ $loker->persyaratan3 }} <br> {{ $loker->persyaratan4 }}</p>
                </div>
              </div>
        @endforeach
    </div>
  </section>
  <br>
</div>

  <!-- Footer -->
  <footer class="footer">
    <div class="container ml-3 text-center">
      <img src="{{ url('assets/img/wa.png') }}" alt="whatsapp" width="20px"> +628 561246123
      <img src="{{ url('assets/img/hp.png') }}" alt="phone" width="30px"> 00551358
      <p>&copy; 2025 PT ELICD. All Rights Reserved.</p>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
  const swiper = new Swiper('.swiper-container', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,

    // If you want pagination
    pagination: {
      el: '.swiper-pagination',
    },

    // Navigation arrows (optional)
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

    // And if you want scrollbar
    scrollbar: {
      el: '.swiper-scrollbar',
    },
  });
</script>
</body>
</html>