<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Penjualan Rajungan</title>
    <link rel="stylesheet" href="./asset/css/styles.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/phosphor-icons@1.4.2/src/css/icons.css">
  </head>
  <body>
    <?php include 'include/navbar.php'; ?>


    <!-- Content of the page -->

    <script>
        function checkLogin() {
            const isLoggedIn = <?php echo json_encode($is_logged_in); ?>;
            if (isLoggedIn) {
                window.location.href = 'keranjang.php';
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Silahkan Login Terlebih Dahulu!!',
                    showConfirmButton: false,
                    timer: 1500,
                    width: '500px',
                    padding: '1rem',
                    customClass: {
                        popup: 'small-swal-popup'
                    }
                }).then(() => {
                    window.location.href = 'login.php';
                });
            }
        }
    </script>

    <section id="hero">
        <div class="container text-center">
            <h1>Rajungan Seafood</h1>
            <h2>Spesialis Seafood</h2>
            <h4>Kualitas dan Manfaat Tetap Terjaga</h4>
            <p>Rasakan Kelezatan Laut dengan Rajungan Kami! Dapatkan Sensasi Kenikmatan Tiada Tanding dari Daging Rajungan Berkualitas Tinggi. Dicari oleh Penikmat Kuliner Sejati, Produk Kami Menawarkan Kesegaran, Kelezatan, dan Kesehatan dalam Setiap Gigitannya. Segera Hadirkan Hidangan Spesial Ini di Meja Makan Anda dan Rasakan Perbedaannya!</p>
            <a href="#product1" onclick="scrollToProduct()" class="shop-now btn btn-primary">Pesan Sekarang</a>
        </div>
    </section>
    
    <?php
include './connection/connection.php';

// Memeriksa koneksi
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Array id_produk yang ingin ditampilkan
$id_produk_list = [1, 2, 3]; // Sesuaikan dengan id_produk Anda

// Mengambil data stok produk berdasarkan id_produk
$produk_stok = array();
foreach ($id_produk_list as $id_produk) {
    $sql = "SELECT id_produk, stok_produk FROM produk WHERE id_produk = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id_produk);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $produk_stok[$id_produk] = $result->fetch_assoc();
    } else {
        $produk_stok[$id_produk] = array("id_produk" => $id_produk, "stok_produk" => "Stok produk tidak tersedia");
    }

    $stmt->close();
}

// Menutup koneksi
$connection->close();
?>

    <!-- Produk -->
    <section method="GET" id="product1" class="section-p1" action="index.php">
      <h1>Produk</h1>
      <h4>Berbagai jenis daging yang kami tawarkan</h4>
      <div class="pro-container">
          <div class="pro" data-name="Daging Jumbo" data-price="100000" data-image="./asset/img/jumbo.jpg">
              <img src="./asset/img/jumbo.jpg" alt="" />
              <div class="des">
                  <span>Rajungan</span>
                  <h5>Daging Jumbo</h5>
                  <div class="star">
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                  </div>
                  <span>Stok Produk: <?php echo htmlspecialchars($produk_stok[1]['stok_produk']); ?></span>
                  <h4>Rp. 100.000,-</h4>
              </div>
              <button class="add-to-cart" style="text-decoration:none;">
                  <i class="bi bi-cart cart"></i>
              </button>
          </div>
  
          <div class="pro" data-name="Daging Merah" data-price="60000" data-image="./asset/img/capit rajungan.png">
              <img src="./asset/img/capit rajungan.png" alt="" />
              <div class="des">
                  <span>Rajungan</span>
                  <h5>Daging Merah</h5>
                  <div class="star">
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                  </div>
                  <span>Stok Produk: <?php echo htmlspecialchars($produk_stok[2]['stok_produk']); ?></span>
                  <h4>Rp. 60.000,-</h4>
              </div>
              <button class="add-to-cart">
                  <i class="bi bi-cart cart"></i>
              </button>
          </div>
  
          <div class="pro" data-name="Capit Kepiting" data-price="50000" data-image="./asset/img/capit kepiting.webp">
              <img src="./asset/img/capit kepiting.webp" alt="" />
              <div class="des">
                  <span>Kepiting</span>
                  <h5>Capit Kepiting</h5>
                  <div class="star">
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                  </div>
                  <span>Stok Produk: <?php echo htmlspecialchars($produk_stok[3]['stok_produk']); ?></span>
                  <h4>Rp. 50.000,-</h4>
              </div>
              <button class="add-to-cart">
                  <i class="bi bi-cart cart"></i>
              </button>
          </div>
      </div>
  </section>

    <!-- carousel -->
    <div class="pembungkus">
    <section>
        <h6 style="text-align: center; margin-bottom: 4%; font-size: 2rem ;" id="carousel">Perbedaan Rajungan & Kepiting</h6>
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./asset/img/rajungan.webp" class="d-block w-50" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Rajungan</h5>
              </div>
            </div>
            <div class="carousel-item">
              <img src="./asset/img/kepiting.png" class="d-block w-50" alt="...">
              <div class="carousel-caption d-none d-md-block ">
                <h5>Kepiting</h5>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
          </button>
        </div>
    
    </section>

    <section id="about-head" class="section-p1">
      <img src="img/about/a6.jpg" alt="" />
      <div>
        <h2>Rajungan</h2>
        <p>
        Rajungan memiliki warna biru dengan corak bentol-bentol yang khas. Rajungan betina berwarna kehijauan dengan bercak putih, sementara jantannya berwarna kebiruan dengan bercak putih terang. Capit rajungan panjang dan bentuknya pipih, dengan cangkang yang lebih tipis dibandingkan kepiting. Rajungan hidup di laut dan akan mati jika diangkat dari air. Meski dagingnya lebih sedikit, rasa daging rajungan lebih manis, gurih, dan empuk. Rajungan memiliki kandungan gizi yang tinggi, dengan kadar protein yang tinggi namun rendah lemak dan kolesterol, menjadikannya pilihan yang lebih sehat.
        </p>
      </div>
    </section>
    
    
    <section id="about-head" class="section-p1">
      <img src="img/about/a6.jpg" alt="" />
      <div>
        <h2>Kepiting</h2>
        <p>
        Kepiting umumnya berwarna coklat kehitaman atau hijau kehitaman dan memiliki capit yang berukuran besar. Bentuk tubuhnya terlihat lebih kokoh dengan cangkang yang keras dan tebal. Habitatnya biasanya berada di tambak atau rawa, sehingga ketahanannya lebih baik ketika diangkat dari air. Kepiting juga memiliki jumlah daging yang lebih banyak dibandingkan dengan rajungan. Dari segi kandungan gizi, kepiting kaya akan vitamin B, vitamin E, mangan, fosfor, yodium, dan zinc, namun kandungan lemaknya lebih tinggi.
        </p>


        <marquee bgcolor="#ccc" loop="-1" scrollamount="5" width="100%"
          >"Rasakan kesegaran dan kelezatan rajungan terbaik! Pesan sekarang dan nikmati sajian istimewa yang siap memanjakan lidah Anda. Dapatkan penawaran spesial hari ini!"</marquee
        >
      </div>
    </section>
  </div>



    <section  id="feature" class="section-p1">
        <div class="fe-box">
          <img src="./asset/img/f2.png" alt="" />
          <h6>Online Order</h6>
        </div>
        <div class="fe-box">
          <img src="./asset/img/f3.png" alt="" />
          <h6>Save Money</h6>
        </div>
        <div class="fe-box">
          <img src="./asset/img/f4.png" alt="" />
          <h6>Promotions</h6>
        </div>
        <div class="fe-box">
          <img src="./asset/img/f5.png" alt="" />
          <h6>Happy Sell</h6>
        </div>
    </section>
  
   </section>
    <section>
      <h1 style="text-align: center;" id="kontak">Hubungi Kami</h1>
      <div class="container">
          <div class="row">
              <div class="col-md-6">
              <form id="request" class="main_form" action="submit_contact.php" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <input class="contactus" placeholder="Nama" type="text" name="Name" required> 
                        </div>
                        <div class="col-md-12">
                            <input class="contactus" placeholder="Email" type="email" name="Email" required> 
                        </div>
                        <div class="col-md-12">
                            <input class="contactus" placeholder="No Handphone" type="text" name="phone_number" required>                          
                        </div>
                        <div class="col-md-12">
                            <textarea class="textarea" placeholder="Pesan" name="Message" required></textarea>
                        </div>
                        <div class="col-md-12">
                            <button class="send_btn">Kirim</button>
                        </div>
                    </div>
                </form>
              </div>
              <div class="col-md-6">
                  <div class="map_main">
                      <div class="map-responsive">
                      <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d247.97980117953537!2d106.5907414708508!3d-6.039008654784649!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sid!2sid!4v1724261982066!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                      </div>
                  </div>
              </div>
          </div>
       </div>
  </section>

  <!-- digunakan untuk mengupload data kontak -->
<!-- digunakan untuk mengupload data kontak -->



  <!-- Footer -->
  <?php include 'include/footer.php'; ?>


    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <script src="asset/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
  </body>
</html>