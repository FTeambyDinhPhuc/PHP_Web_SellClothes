<?php
include 'header.php';
?>
<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item ml-5"> <a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">About</li>
        </ol>
    </nav>


    <div class="container aboutus">
        <div class="contact__form__title">
            <h2>About us</h2>
        </div>
        <div class="row">
            <div class="col-md-7">
                <h3>FTeam</h3>
                <p><span><i class="fa-solid fa-circle-dot"></i></span>&ensp;Website bán quần áo nam nữ thời thượng, cao cấp, giá cả hợp lý<br /><span><i class="fa-solid fa-circle-dot"></i></span>&ensp;Website được thiết kế dựa trên các xu hướng thiết kế hiện nay <br /><span><i class="fa-solid fa-circle-dot"></i></span>&ensp;Phục vụ công việc học tập và nghiên cứu <br /><span><i class="fa-solid fa-circle-dot"></i></span>&ensp;Được thực hiện bởi FTeam từ Hutech University</p>
                <h5>My Team</h5>
                <ol>
                    <li>
                        <p><span><i class="fa-solid fa-graduation-cap"></i></span>&ensp;Lê Đình Phúc - FrontEnd</p>
                    </li>
                    <li>
                        <p><span><i class="fa-solid fa-graduation-cap"></i></span>&ensp;Nguyễn Thiên Minh - FrontEnd</p>
                    </li>
                    <li>
                        <p><span><i class="fa-solid fa-graduation-cap"></i></span>&ensp;Mã Lương Linh - BackEnd</p>
                    </li>
                </ol>
            </div>
            <div class="col-md-5">
                <img width="100%" src="assets/img/aboutImage.png" />
            </div>
        </div>
    </div>


    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="contact__form__title">
                <h2>Contact</h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>Phone</h4>
                        <p>+84-399-128-713</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>Address</h4>
                        <p>KCNC Quận 9 Hồ Chí Minh</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_clock_alt"></span>
                        <h4>Open time</h4>
                        <p>09:00 am to 20:00 pm</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_mail_alt"></span>
                        <h4>Email</h4>
                        <p>fteam@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
    <!-- Map Begin -->
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3918.5472917264988!2d106.81273301529349!3d10.845915160871762!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1653826967200!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <div class="map-inside">
            <i class="icon_pin"></i>
            <div class="inside-widget">
                <h4>FTeam</h4>
                <ul>
                    <li>Phone: +84-399-128-713</li>
                    <li>Add: KCNC Quận 9 Hồ Chí Minh</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Map End -->
    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>Leave Message</h2>
                    </div>
                </div>
            </div>
            <form action="#">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <input type="text" placeholder="Your name">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="email" placeholder="Your Email">
                    </div>
                    <div class="col-lg-12 text-center">
                        <textarea placeholder="Your message"></textarea>
                        <button type="submit" class="site-btn shadow-sm">SEND MESSAGE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Contact Form End -->

</div>
<?php
include 'footer.php';
?>