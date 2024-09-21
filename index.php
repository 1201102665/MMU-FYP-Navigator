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
   <style>
    body {
      background-color: #e3f2fd;
      font-family: 'Arial', sans-serif;
    }

    .navbar {
      background-color: #0d6efd;
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
      font-size: 1.5rem;
    }

    .nav-link {
      color: white !important;
      font-size: 1.1rem;
      padding: 10px 20px;
      transition: all 0.3s ease;
    }

    .nav-link:hover {
      color: #ffc107 !important;
      transform: scale(1.1);
    }

    .btn-signup {
      background-color: #f08c00;
      color: white;
      padding: 10px 20px;
      border-radius: 25px;
      font-weight: bold;
      text-transform: uppercase;
      margin-left: 10px;
    }

    .btn-signup:hover {
      background-color: #ff9f1a;
    }

    .picture-section {
      position: relative;
      height: 100vh;
      background-image: url('design/web-banner-campus-melaka-mobile.jpg');
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
      text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
    }

    .picture-section p {
      font-size: 1.5rem;
      max-width: 800px;
      margin: 20px auto 0;
      text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
    }

    /* Form container styling */
    .form-container {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      background: rgba(0, 0, 0, 0.7);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 1050;
      opacity: 0;
      transition: opacity 0.5s ease;
    }

    .form-container.active {
      display: flex;
      opacity: 1;
    }

    .form-card {
      background-color: white;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      width: 400px;
      position: relative;
      transform: translateY(-50%);
      transition: transform 0.5s ease;
    }

    .form-container.active .form-card {
      transform: translateY(0);
    }

    .form-close-btn {
      position: absolute;
      top: 10px;
      right: 15px;
      background: none;
      border: none;
      font-size: 1.5rem;
      color: #333;
      cursor: pointer;
    }

    .form-card h2 {
      margin-bottom: 30px;
      color: #0d6efd;
      font-weight: bold;
      text-align: center;
    }

    .form-card .form-control {
      border-radius: 50px;
      padding: 10px 20px;
    }

    .form-card .btn-primary {
      border-radius: 50px;
      padding: 10px 20px;
      font-weight: bold;
      background-color: #0d6efd;
    }

    .form-card .btn-primary:hover {
      background-color: #0048cc;
    }

    footer {
      background-color: #0d6efd;
      color: white;
      text-align: center;
      padding: 10px;
      position: fixed;
      bottom: 0;
      width: 100%;
    }

    .main-content {
      padding: 40px;
    }

    /* Lecturers Section */
    .lecturer-card {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      text-align: center;
      margin-bottom: 30px;
      transition: all 0.3s ease;
    }

    .lecturer-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .lecturer-card img {
      border-radius: 50%;
      max-width: 120px;
      margin-bottom: 15px;
    }

    .lecturer-card h5 {
      margin-bottom: 10px;
      font-size: 1.2rem;
      color: #0d6efd;
    }

    .lecturer-card p {
      font-size: 0.95rem;
      color: #555;
    }

    .lecturer-card a {
      color: #0d6efd;
      text-decoration: none;
    }

    .lecturer-card a:hover {
      text-decoration: underline;
    }

    .lecturer-section {
      padding: 50px 0;
    }

    .lecturer-section h2 {
      margin-bottom: 50px;
      text-align: center;
      font-size: 2.5rem;
      font-weight: bold;
      color: #0d6efd;
    }

    /* Contact Section */
    .contact-section {
      padding: 50px 0;
      background-color: #f7f9fc;
    }

    .contact-section h2 {
      text-align: center;
      margin-bottom: 40px;
      font-size: 2.5rem;
      font-weight: bold;
      color: #0d6efd;
    }

    .contact-section img {
      max-width: 100%;
      border-radius: 10px;
    }

    .contact-form {
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .contact-form .form-control {
      border-radius: 50px;
      padding: 10px 20px;
      margin-bottom: 20px;
    }

    .contact-form .btn-primary {
      border-radius: 50px;
      padding: 10px 20px;
      font-weight: bold;
      width: 100%;
    }

    .contact-form .btn-primary:hover {
      background-color: #0048cc;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">MMU FYP Navigator</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link me-5 active" aria-current="page" href="#" onclick="showMainContent()">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-5" href="#events-content" onclick="scrollToevents()">Events</a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-5" href="#lecturers-section" onclick="scrollToLecturers()">Our Professors</a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-5" href="#contact-section" onclick="scrollToContact()">Contact</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="showForm('signin')"><i class="bi bi-box-arrow-in-right"></i> Login</a>
          </li>
          <li class="nav-item">
            <button class="btn btn-signup" onclick="showForm('signup')">Sign Up</button>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Big Picture Section -->
  <div class="picture-section" id="home-section">
    <div>
      <h1>Welcome to MMU FYP Navigator</h1>
      <p>Empowering MMU University students by providing easy access to academic resources and fostering collaboration for academic excellence.</p>
    </div>
  </div>

  <!-- Main Content -->
  <div class="form-container" id="form-container" onclick="hideForm(event)">
    <div class="form-card" onclick="event.stopPropagation()">
      <button class="form-close-btn" onclick="hideForm()">&times;</button>
      <!-- Sign In Form -->
      <form method="post" action="signin.php" id="signin-form" class="signin-form">
        <h2>Sign In</h2>
        <div class="mb-3">
          <label for="signin-email" class="form-label">Email</label>
          <input type="email" class="form-control" id="signin-email" name="email" required>
        </div>
        <div class="mb-3">
          <label for="signin-password" class="form-label">Password</label>
          <input type="password" class="form-control" id="signin-password" name="password" required>
        </div>
        <button type="submit" name="signin" class="btn btn-primary w-100">Sign In</button>
      </form>


      <!-- Sign Up Form -->
      <form method="post" action="signin.php" enctype="multipart/form-data" id="signup-form" class="signup-form" style="display:none;">
        <h2>Sign Up</h2>
        <div class="mb-3">
          <label for="signup-username" class="form-label">Username</label>
          <input type="text" class="form-control" id="signup-username" name="username" required>
        </div>
        <div class="mb-3">
          <label for="signup-email" class="form-label">Email</label>
          <input type="email" class="form-control" id="signup-email" name="email" required>
        </div>
        <div class="mb-3">
          <label for="signup-password" class="form-label">Password</label>
          <input type="password" class="form-control" id="signup-password" name="password" required>
        </div>
        <div class="mb-3">
          <label for="signup-confirm-password" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" id="signup-confirm-password" name="confirm_password" required>
        </div>
        <div class="mb-3">
          <label for="signup-profile-picture" class="form-label">Profile Picture</label>
          <input type="file" class="form-control" id="signup-profile-picture" name="profile_picture" accept=".jpg,.jpeg,.png,.gif">
        </div>
        <button type="submit" name="signup" class="btn btn-primary w-100">Sign Up</button>
      </form>
    </div>
  </div>



  <div class="main-content" id="events-content">
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
            <img src="design/IMG_5870.PNG" class="d-block w-100" alt="Event 1">
          </div>
          <div class="carousel-item">
            <img src="design/IMG_5871.PNG" class="d-block w-100" alt="Event 2">
          </div>
          <div class="carousel-item">
            <img src="design/IMG_5872.PNG" class="d-block w-100" alt="Event 3">
          </div>
          <div class="carousel-item">
            <img src="design/IMG_5874.PNG" class="d-block w-100" alt="Event 4">
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

    <!-- Lecturers Section -->
    <div class="lecturer-section container" id="lecturers-section">
      <h2>Our Professors</h2>
      <div class="row">
        <!-- Lecturer 1 -->
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="lecturer-card">
            <img src="design/1991015769.png" alt="Lecturer 1">
            <h5>Prof. John Doe</h5>
            <p>Expert in AI and Machine Learning. Research focus on AI-driven systems.</p>
            <p><strong>Email:</strong> johndoe@example.com<br><strong>Phone:</strong> +123456789</p>
          </div>
        </div>
        <!-- Lecturer 2 -->
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="lecturer-card">
            <img src="design/1991015769.png" alt="Lecturer 2">
            <h5>Prof. Jane Smith</h5>
            <p>Specialist in Cybersecurity and Blockchain technologies.</p>
            <p><strong>Email:</strong> janesmith@example.com<br><strong>Phone:</strong> +987654321</p>
          </div>
        </div>
        <!-- Lecturer 3 -->
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="lecturer-card">
            <img src="design/1991015769.png" alt="Lecturer 3">
            <h5>Prof. Alan Watts</h5>
            <p>Data Science and Analytics expert, passionate about big data.</p>
            <p><strong>Email:</strong> alanwatts@example.com<br><strong>Phone:</strong> +1122334455</p>
          </div>
        </div>
        <!-- Lecturer 4 -->
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="lecturer-card">
            <img src="design/1991015769.png" alt="Lecturer 4">
            <h5>Prof. Clara Li</h5>
            <p>Software Engineering expert focusing on agile methodologies.</p>
            <p><strong>Email:</strong> clarali@example.com<br><strong>Phone:</strong> +9988776655</p>
          </div>
        </div>
        <!-- Lecturer 5 -->
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="lecturer-card">
            <img src="design/1991015769.png" alt="Lecturer 5">
            <h5>Prof. Michael Zhang</h5>
            <p>Cloud Computing and DevOps researcher.</p>
            <p><strong>Email:</strong> michaelzhang@example.com<br><strong>Phone:</strong> +6677889900</p>
          </div>
        </div>
        <!-- Lecturer 6 -->
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="lecturer-card">
            <img src="design/1991015769.png" alt="Lecturer 6">
            <h5>Prof. Sarah Brown</h5>
            <p>Specialist in Information Security and Privacy.</p>
            <p><strong>Email:</strong> sarahbrown@example.com<br><strong>Phone:</strong> +4455667788</p>
          </div>
        </div>
        <!-- Lecturer 7 -->
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="lecturer-card">
            <img src="design/1991015769.png" alt="Lecturer 7">
            <h5>Prof. William Green</h5>
            <p>Expert in Software Development and Agile Practices.</p>
            <p><strong>Email:</strong> williamgreen@example.com<br><strong>Phone:</strong> +1122558899</p>
          </div>
        </div>
        <!-- Lecturer 8 -->
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="lecturer-card">
            <img src="design/1991015769.png" alt="Lecturer 8">
            <h5>Prof. Emma White</h5>
            <p>Specialist in Database Systems and Data Modeling.</p>
            <p><strong>Email:</strong> emmawhite@example.com<br><strong>Phone:</strong> +6677884455</p>
          </div>
        </div>
        <!-- Lecturer 9 -->
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="lecturer-card">
            <img src="design/1991015769.png" alt="Lecturer 9">
            <h5>Prof. David Black</h5>
            <p>Network Security and Ethical Hacking expert.</p>
            <p><strong>Email:</strong> davidblack@example.com<br><strong>Phone:</strong> +3344556677</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Contact Section -->
    <div class="contact-section container" id="contact-section">
      <h2>Contact Us</h2>
      <div class="row">
        <!-- Image on the left -->
        <div class="col-lg-6 col-md-12">
          <img src="design/Logo.png" alt="Contact Image">
        </div>
        <!-- Form on the right -->
        <div class="col-lg-6 col-md-12">
          <form class="contact-form" action="contact.php" method="POST">
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">Phone +60-xxxxxxxx</label>
              <input type="number" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
              <label for="inquiry" class="form-label">Inquiry Type</label>
              <select class="form-control" id="inquiry" name="inquiry">
                <option>General Inquiry</option>
                <option>Technical Support</option>
                <option>Collaboration</option>
                <option>Other</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Message</label>
              <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <p>&copy; 2024 MMU FYP Navigator. All Rights Reserved.</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Custom JS for form switching and smooth scrolling -->
  <script>
    function showMainContent() {
      document.getElementById('home-section').style.display = 'flex';
      document.getElementById('main-content').classList.remove('slide-out');
      document.getElementById('main-content').classList.remove('hidden');
      document.getElementById('form-container').classList.remove('active');
      document.getElementById('form-container').classList.add('hidden');
    }

    function showForm(type) {
      document.getElementById('form-container').classList.add('active');

      if (type === 'signin') {
        document.getElementById('signin-form').style.display = 'block';
        document.getElementById('signup-form').style.display = 'none';
      } else if (type === 'signup') {
        document.getElementById('signin-form').style.display = 'none';
        document.getElementById('signup-form').style.display = 'block';
      }
    }

    function scrollToLecturers() {
      document.getElementById('lecturers-section').scrollIntoView({ behavior: 'smooth' });
    }

    function scrollToContact() {
      document.getElementById('contact-section').scrollIntoView({ behavior: 'smooth' });
    }
    function scrollToevents() {
      document.getElementById('events-content').scrollIntoView({ behavior: 'smooth' });
    }
    function hideForm(event) {
      document.getElementById('form-container').classList.remove('active');
    }

  </script>
</body>
</html>
