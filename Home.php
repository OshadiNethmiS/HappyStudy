<?php 
session_start(); 
include_once 'heder.php';
?>

<header>
    <img src="images/img_01.WEBP" alt="Site Logo" width=150> 
    HappYstudY
    <h2> ..Your Easy Path to Learning.. </h2>
</header>

<div class="nav">
    <h1>Welcome to Ours HappYstudY ...</h1>

    <?php if(!isset($_SESSION['user_id'])): ?>
        <!-- User NOT logged in -->
        <a href="login.php" class="button" 
           style="background:#11004d; padding:10px 20px; text-decoration:none; color:white; border-radius:5px;">
           Login / Register
        </a>
    <?php else: ?>
        <a href="login.php" class="button"
       style="background:#11004d; padding:10px 20px; text-decoration:none; color:white; border-radius:5px;">
       Login / Register
    </a>
    <?php endif; ?>
</div>


<div class="main">
    <br><br>
    <div class="a">
        <div class="a:hover">
            <div class="card_h ">
                <div class="cards">

                    <a href="Course.php">
                        <div class="card" style="background: #4d2bc9ff;">
                            <h3> View Courses</h3>
                            <p>Explore all available courses</p>
                        </div>
                    </a>

                    <a href="Course.php"> 
                        <div class="card" style="background: #4d2bc9ff;">
                            <h3>My Courses</h3>
                            <p>Check your registered courses</p>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>

<br><br><br><br>

<div class="about-box">
    <h1> About as </h1>
    <table>
        <tr> <td>
                <img src="images/img_02.WEBP" alt="About Us" width=500> 
            </td>
            <td>
                <div class="about-section">
                    Welcome to HappYstudY – your companion in smart and simple learning!  
                    We are a student-focused web platform designed to make course registration, academic tracking, and learning management more convenient than ever before. Whether you're a student looking for the right courses or a teacher managing your classes, HappYstudY provides an efficient, user-friendly space to handle it all.

                    At HappYstudY, our goal is to simplify education through technology. With just a few clicks, students can create accounts, browse available courses, register for classes, and view their course schedules or academic updates – all in one place. Our platform also supports instructors and admins in managing course details, student enrollments, and sharing important information.

                    We believe education should be accessible, flexible, and stress-free. That’s why we designed HappYstudY with simplicity, speed, and clarity in mind. It’s not just a tool – it’s a smart solution to help students stay organized, informed, and in control of their academic journey.
                    We are continuously improving HappYstudY to provide even better features and experiences. Join us as we move towards smarter education, together!
                </div>
            </td>
        </tr> </table>
</div>

<footer>© 2025 HappyStudY - Admin Panel</footer>

<?php
include_once 'footer.php';
?>