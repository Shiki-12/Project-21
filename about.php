<?php
// --- SETUP DATABASE & AMBIL DATA ---
include 'database/koneksi.php';
$sql = "SELECT * FROM biodata";
$result = mysqli_query($koneksi, $sql);
// Ambil satu baris data, karena kita asumsi biodata cuma ada satu
$data = mysqli_fetch_assoc($result);
// Jika tidak ada data sama sekali, hentikan script
if (!$data) {
    die("Data biodata tidak ditemukan di database.");
}

// --- HITUNG UMUR OTOMATIS ---
// Buat objek tanggal dari data di database
$tanggal_lahir = new DateTime($data['tgl_lahir']);
// Buat objek tanggal untuk hari ini
$hari_ini = new DateTime('today');
// Hitung selisihnya untuk dapat umur dalam tahun
$umur = $hari_ini->diff($tanggal_lahir)->y;


// --- OLAH DATA SKILL (CARA BARU - PAKAI SPASI) ---
$skills_string_from_db = $data['skill']; // Contoh: "php 100% HTML 70% ..."

// Gunakan regex untuk menemukan semua pasangan 'nama skill' dan 'nilai%'
// Regex ini lebih canggih dan bisa menangani nama skill seperti "WordPress/CMS"
preg_match_all('/([a-zA-Z\/.-]+)\s+(\d+)%?/', $skills_string_from_db, $matches, PREG_SET_ORDER);

$skills_array = []; // Siapkan array kosong
foreach ($matches as $match) {
    // $match[1] akan berisi nama skill (e.g., "WordPress/CMS")
    // $match[2] akan berisi nilainya (e.g., "70")
    $skill_name = trim($match[1]);
    $skill_value = trim($match[2]);
    
    if (!empty($skill_name)) {
        $skills_array[$skill_name] = $skill_value;
    }
}
// $skills_array sekarang berisi: ['php' => 100, 'HTML' => 70, ...]
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Asat</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Kelly
  * Template URL: https://bootstrapmade.com/kelly-free-bootstrap-cv-resume-html-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="about-page">

  <header id="header" class="header d-flex align-items-center light-background sticky-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <?php echo "<h1 class=\"sitename\">" . $data['nama_depan'] ."</h1>"; ?>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php" class="active">About</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <div class="header-social-links">
        <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div>

    </div>
  </header>

  <main class="main">

    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>About</h2>
        <?php echo "<p>" . $data['tentang'] . "</p>"; ?>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 justify-content-center">
          <div class="col-lg-4">
            <img src='<?php echo $data['url_foto']?>' class="img-fluid" alt="">
          </div>
          <div class="col-lg-8 content">
            <?php echo "<h2>" . $data['profesi'] . "</h2>"; ?>
            <?php echo "<p class=\"fst-italic py-3\">" . $data['deskripsi_profesi'] . "</p>"; ?>
            <div class="row">
              <div class="col-lg-6">
                <ul>
                  <?php echo "<li><i class=\"bi bi-chevron-right\"></i> <strong>Birthday:</strong> <span>" . $data['tgl_lahir'] ."</span></li>"; ?>
                  <?php echo "<li><i class=\"bi bi-chevron-right\"></i> <strong>Website:</strong> <span>" . $data['website'] ."</span></li>"; ?></span></li>
                  <?php echo "<li><i class=\"bi bi-chevron-right\"></i> <strong>Phone:</strong> <span>" . $data['hp'] ."</span></li>"; ?>
                  <?php echo "<li><i class=\"bi bi-chevron-right\"></i> <strong>City:</strong> <span>" . $data['kota'] ."</span></li>"; ?></span></li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul>
                  <?php echo "<li><i class=\"bi bi-chevron-right\"></i> <strong>Age:</strong> <span>" . $umur . "</span></li>"; ?>
                  <?php echo "<li><i class=\"bi bi-chevron-right\"></i> <strong>Degree:</strong> <span>" . $data['gelar'] ."</span></li>"; ?></span></li>
                  <?php echo "<li><i class=\"bi bi-chevron-right\"></i> <strong>Email:</strong> <span>" . $data['email'] ."</span></li>"; ?></span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Freelance</strong> <span>
                    <?php
                    if ($data['freelance'] === '1') {
                      echo 'Available';
                    } else {
                      echo 'Unavailable';
                    }
                    ?>
                  </span>
                </ul>
              </div>
            </div>
            <p class="py-3">
              <?php echo $data['keterangan_about']; ?>
            </p>
          </div>
        </div>

      </div>

    </section><!-- /About Section -->

    <section id="skills" class="skills section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Skills</h2>
        <p><?php echo htmlspecialchars($data['keterangan_skill']); ?></p>
      </div>
      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <!-- KODE BARU UNTUK MENAMPILKAN SKILL SECARA DINAMIS -->
        <div class="row skills-content skills-animation">
        <?php
            // Logika untuk membagi skill menjadi 2 kolom
            if (!empty($skills_array)) {
                $total_skills = count($skills_array);
                $midpoint = ceil($total_skills / 2);
                $counter = 0;

                echo '<div class="col-lg-6">'; // Buka kolom pertama

                foreach ($skills_array as $skill_name => $skill_value) {
                    // Tampilkan setiap skill sebagai progress bar
                    echo '<div class="progress">';
                    echo '  <span class="skill"><span>' . htmlspecialchars($skill_name) . '</span> <i class="val">' . htmlspecialchars($skill_value) . '%</i></span>';
                    echo '  <div class="progress-bar-wrap">';
                    echo '    <div class="progress-bar" role="progressbar" aria-valuenow="' . htmlspecialchars($skill_value) . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . htmlspecialchars($skill_value) . '%"></div>';
                    echo '  </div>';
                    echo '</div>'; // End Skills Item

                    $counter++;
                    // Jika sudah mencapai titik tengah, tutup kolom pertama dan buka kolom kedua
                    if ($counter == $midpoint) {
                        echo '</div>'; // Tutup kolom pertama
                        echo '<div class="col-lg-6">'; // Buka kolom kedua
                    }
                }

                echo '</div>'; // Tutup kolom kedua
            } else {
                echo '<p class="text-center">Data skill belum diisi.</p>';
            }
        ?>
        </div>

    <!-- Stats Section -->
    <section id="stats" class="stats section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Facts</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
              <p>Clients</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
              <p>Projects</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1" class="purecounter"></span>
              <p>Hours Of Support</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1" class="purecounter"></span>
              <p>Workers</p>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section><!-- /Stats Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Testimonials</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Titles -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              }
            }
          </script>
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                <h3>Saul Goodman</h3>
                <h4>Ceo &amp; Founder</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                <h3>Sara Wilsson</h3>
                <h4>Designer</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                <h3>Jena Karlis</h3>
                <h4>Store Owner</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                <h3>Matt Brandon</h3>
                <h4>Freelancer</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                <h3>John Larson</h3>
                <h4>Entrepreneur</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Testimonials Section -->

  </main>

  <footer id="footer" class="footer light-background">

    <div class="container">
      <div class="copyright text-center ">
        <p>© <span>Copyright</span> <?php echo "<strong class=\"px-1 sitename\">" . $data['nama_depan'] ."</strong>"?> <span>All Rights Reserved<br></span></p>
      </div>
      <div class="social-links d-flex justify-content-center">
        <a href=""><i class="bi bi-twitter-x"></i></a>
        <a href=""><i class="bi bi-facebook"></i></a>
        <a href=""><i class="bi bi-instagram"></i></a>
        <a href=""><i class="bi bi-linkedin"></i></a>
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">Shiki</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>