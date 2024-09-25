<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - MMU Resources</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/about_us.css">
    <!-- Google Font for modern typography -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for modern icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container about-container">
        <h2 style="color: black;"><i class="fas fa-info-circle"></i> About Us</h2>
        <div class="about-member">
            <img src="design/salma.png" alt="salma" class="profile-pic">
            <div class="details hidden">
                <h3>SALMA IBRAHIM MOHMED ABDELKADER</h3>
                <p><strong>Student ID:</strong> 1221302021</p>
                <p><strong>Email:</strong> <a href="mailto:1221302021@student.mmu.edu.my">1221302021@student.mmu.edu.my</a></p>
                <p><strong>Lecture:</strong> TC1L</p>
                <p><strong>Tutorial:</strong> TT1L</p>
            </div>
        </div>
        <div class="about-member">
            <img src="design/ABDULKAFI.jpeg" alt="kafi" class="profile-pic">
            <div class="details hidden">
                <h3>ABDULKAFI WALEED ABDULKAFI ALMALAMI</h3>
                <p><strong>Student ID:</strong>1201102665</p>
                <p><strong>Email:</strong> <a href="mailto:1201102665@student.mmu.edu.my">1201102665@student.mmu.edu.my</a></p>
                <p><strong>Lecture:</strong> TC1L</p>
                <p><strong>Tutorial:</strong> TT1L</p>
            </div>
        </div>
        <div class="about-member">
            <img src="design/alshaibi.JPG" alt="shaibi" class="profile-pic">
            <div class="details hidden">
                <h3>AL-SHAIBI, MUA'AD ALI SALEH</h3>
                <p><strong>Student ID:</strong> 1201302915</p>
                <p><strong>Email:</strong> <a href="mailto:1201302915@student.mmu.edu.my">1201302915@student.mmu.edu.my</a></p>
                <p><strong>Lecture:</strong> TC1L</p>
                <p><strong>Tutorial:</strong> TT1L</p>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>

    <!-- JavaScript to handle hover effects -->
    <script>
        const members = document.querySelectorAll('.about-member');
        members.forEach(member => {
            member.addEventListener('mouseenter', () => {
                member.querySelector('.details').classList.remove('hidden');
                member.querySelector('.details').classList.add('fade-in');
            });
            member.addEventListener('mouseleave', () => {
                member.querySelector('.details').classList.remove('fade-in');
                member.querySelector('.details').classList.add('hidden');
            });
        });
    </script>
</body>
</html>
