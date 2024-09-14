<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MMU FYP Navigator</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Icons (for login/signup icons) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
  <style>
    body {
      background-color: #e3f2fd; /* Light blue background */
      font-family: 'Arial', sans-serif;
    }

    /* Modern Sticky Navbar */
    .navbar {
      background-color: #0000ff
; /* Darker background for a modern look */
      padding: 15px 30px;
      position: sticky;
      top: 0;
      width: 100%;
      z-index: 1030;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .navbar-brand {
      color: white !important;
      font-weight: bold;
      font-size: 1.5rem; /* Larger and bolder font */
    }
    .nav-link {
      color: white !important;
      font-size: 1.1rem;
      padding: 10px 20px;
      transition: all 0.3s ease;
    }
    .nav-link:hover {
      color: #ffc107 !important; /* Modern hover effect: gold text */
      transform: scale(1.1); /* Smooth scale effect */
    }
    .navbar-toggler {
      border-color: white;
    }
    .navbar-toggler-icon {
      color: white;
    }

    /* Right-aligned Login/Signup */
    .navbar .btn-signup {
      background-color: #f08c00;
      color: white;
      padding: 10px 20px;
      border-radius: 25px;
      font-weight: bold;
      text-transform: uppercase;
      margin-left: 10px;
    }
    .navbar .btn-signup:hover {
      background-color: #ff9f1a;
    }

    /* Big Picture Section */
    .picture-section {
      position: relative;
      height: 100vh;
      background-image: url('design/web-banner-campus-melaka-mobile.jpg'); /* Replace with your image */
      background-size: cover;
      background-position: center;
      display: flex;
      justify-content: center;
      align-items: center;
      color: white;
      text-align: center;
      padding: 0 20px;
    }

    .picture-section h1 {
      font-size: 3.5rem;
      font-weight: bold;
      text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6); /* Text shadow for better visibility */
    }

    .picture-section p {
      font-size: 1.5rem;
      max-width: 800px;
      margin: 20px auto 0;
      text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
    }

    /* Footer */
    footer {
      background-color: #0d6efd;
      color: white;
      text-align: center;
      padding: 0px;
      position: fixed;
      bottom: 0;
      width: 100%;
    }
  </style>
</head>
<body>

  <!-- Modern Sticky Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">MMU FYP Navigator</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link me-5 active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-5" href="#">Events</a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-5" href="#">Our Profs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-5" href="#">Contact</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-box-arrow-in-right"></i> Login</a>
          </li>
          <li class="nav-item">
            <button class="btn btn-signup">Sign Up</button>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Big Picture Section with Heading and Description -->
  <div class="picture-section">
    <div>
      <h1>Welcome to MMU FYP Navigator</h1>
      <p>Empowering MMU University students by providing easy access to academic resources and fostering collaboration for academic excellence.</p>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-content">
 
  </div>

  <!-- Carousel Section -->
  <div class="container my-5">
    <h2 class="text-center mb-4">Last Events</h2>
    <div id="eventsCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#eventsCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#eventsCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#eventsCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#eventsCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
        <button type="button" data-bs-target="#eventsCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="design/web-banner-campus-melaka-mobile.jpg" class="d-block w-100" alt="Event 1">
        </div>
        <div class="carousel-item">
          <img src="https://via.placeholder.com/800x300?text=Event+2" class="d-block w-100" alt="Event 2">
        </div>
        <div class="carousel-item">
          <img src="https://via.placeholder.com/800x300?text=Event+3" class="d-block w-100" alt="Event 3">
        </div>
        <div class="carousel-item">
          <img src="https://via.placeholder.com/800x300?text=Event+4" class="d-block w-100" alt="Event 4">
        </div>
        <div class="carousel-item">
          <img src="https://via.placeholder.com/800x300?text=Event+5" class="d-block w-100" alt="Event 5">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#eventsCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#eventsCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>

  <!-- Announcements Section -->
  <div class="container announcements-section">
    <h2 class="text-center mb-4">Announcements</h2>
    <div class="alert alert-primary d-flex align-items-center" role="alert">
      <i class="bi bi-megaphone-fill me-2"></i>
      <div>
        Important Update: Exam schedules have been revised for the upcoming term.
      </div>
    </div>
    <div class="alert alert-warning d-flex align-items-center" role="alert">
      <i class="bi bi-bell-fill me-2"></i>
      <div>
        New Announcement: The library will now open at 8:00 AM daily.
      </div>
    </div>
    <div class="alert alert-success d-flex align-items-center" role="alert">
      <i class="bi bi-check-circle-fill me-2"></i>
      <div>
        New Update: Additional study resources have been uploaded to the platform.
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <p>&copy; 2024 MMU FYP Navigator. All Rights Reserved.</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
