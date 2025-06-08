<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Anda Tidak Memiliki Akses</title>
  <style>
    body, html {
  margin: 0;
  padding: 0;
}

/* Style for the error page */
.error-page {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  font-family: Arial, sans-serif;
  text-align: center;
}

.error-page h1 {
  font-size: 2em;
  margin-bottom: 10px;
}

.error-page p {
  margin-bottom: 20px;
}

/* Style for the button */
.btn {
  display: inline-block;
  padding: 10px 20px;
  background-color: #3498db;
  color: #fff;
  text-decoration: none;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

.btn:hover {
  background-color: #2980b9;
}
  </style>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="error-page">
    <h1>Anda Tidak Memiliki Akses!</h1>
    <p>Mohon maaf, Anda tidak memiliki izin untuk mengakses halaman ini.</p>
    <a href="/" class="btn">Kembali ke Halaman Utama</a>
  </div>
</body>
</html>