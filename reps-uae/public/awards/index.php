
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'mail/vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
if($_POST){
  $firstname = $_POST['firstname'];
  $phonenum = $_POST['phonenum'];
  $email = $_POST['email'];
  $fnmsg = '';
  $pnmsg = '';
  $emailmsg = '';
  if(empty($firstname)){
    $fnmsg = 'First name is required';
  }
  if(empty($phonenum)){
    $pnmsg = 'Phone Number is required';
  }
  if(empty($email)){
    $emailmsg = 'Email is required';
  }
   
   /////////////////////////////////////////////////////// Mail ///////////////////////////////////////////////////////////
  try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'smtp.dxb@gmail.com';                     //SMTP username
    $mail->Password   = 'euwchtuaegozjjha';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('smtp.dxb@gmail.com', 'Reps UAE Awards Enquiries');
    //$mail->addAddress('events@repsuae.com', 'Joe User');     //Add a recipient
    $mail->addAddress('events@repsuae.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reps UAE Awards Enquiries';
    //$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
  $mail->Body    = '<div><b>First name</b>: '.$firstname.'</div>';
  $mail->Body    .= '<div><b>Phone number</b>: '.$phonenum.'</div>';
  $mail->Body    .= '<div><b>Email</b>: '.$email.'</div>';
  $mail->Body    .= '<div>----------------------------------------------------------------</div>';
  $mail->Body    .= '<div>This user has submitted the form on landing page.</div>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    $msg = 'Form submitted successfully.';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
   /////////////////////////////////////////////////////// Ena ////////////////////////////////////////////////////////////
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Reps UAE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css?v=2">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<link rel="stylesheet" href="https://unpkg.com/aos@2.3.0/dist/aos.css">
<script src="https://unpkg.com/aos@2.3.0/dist/aos.js"></script>
</head>
<body>

<!---- header Start---->
<header class="main-header">
<div class="container">
  <div class="row">
 <div class="col-lg-3 col-md-12 col-sm-12">
 <div class="logo">
  <a href="/awards"><img src="images/logo-award.svg"/></a>
  </div>
   </div>
    <div class="col-lg-9 col-md-12 col-sm-12">
<div class="topnav" id="myTopnav">

  <a href="/awards/#about">About</a>
    <a href="/awards/#awards">Awards</a>
  <!-- <a href="/awards/#AwardTimeline">Award Timeline</a> -->
  <a href="/awards/#categories">Categories</a>
  <a href="/awards/award.php">Winners</a>
  <a href="/awards/awards-judges.php">Judges</a>
  <a href="/awards/gallery.php">Gallery</a>
    <!-- <a href="/awards/#galadinner ">Gala Dinner </a> -->
    <!--a href="/awards/#sponsors">Sponsors</a-->
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i> Menu
  </a>
</div>

   </div>
   </div>
   </div>
</header>

<!---- header end----->

<!---- Banner start---->
<section class="top-banner for-full-screen" style="height: auto">  
<img src="images/reps-banner.png"/>
</section>

<!---- Banner end----->


<!---- About start---->
<section class="about-section for-full-screen">  
<div class="container-fluid">
  <div class="row order-change item-center" id="about">
 <div class="col-lg-6 col-md-6 col-sm-12 p-0 order2">
 <div class="text-about space-lr">
 <h2 data-aos="fade-up">About the Awards</h2>
 <p data-aos="fade-up">The awards provide an opportunity for individuals and businesses to be recognised for their contribution and dedication to their work, and the health, fitness and wellness of the UAE population.</p>
 <!-- <p data-aos="fade-up">To celebrate this milestone, REPs UAE is excited to announce the launch of
</p>

<h3 data-aos="fade-up">'REPs Industry Awards'</h3>
<p data-aos="fade-up">The awards provide an opportunity for individuals and businesses to be recognised for their contribution and dedication to their work, and the health, fitness and wellness of the UAE population.</p> -->
 </div>
 </div>
  <div class="col-lg-6 col-md-6 col-sm-12 p-0 order1">
 <div class="image-about">
 <img src="images/about.jpg"/>
 </div>
 </div>
 </div>
 
  <div class="row item-center" id="awards">
    <div class="col-lg-6 col-md-6 col-sm-12 p-0">
 <div class="image-about">
 <img src="images/obj.jpg"/>
 </div>
 </div>
 <div class="col-lg-6 col-md-6 col-sm-12 p-0">
 <div class="text-about space-rl">
 <h2 data-aos="fade-up">Awards Objective</h2>
 <ul class="list-style">
 <li data-aos="fade-up">To provide a benchmark for standards and performance within the industry</li>
 <li data-aos="fade-up">Celebrate outstanding individuals making a difference in the  sector</li>
 <li data-aos="fade-up">Showcase and reward businesses exemplifying best practice and an exceptional customer experience</li>
 <li data-aos="fade-up">Promote physical activity to the nation.</li>
 </ul>
 </div>
 </div>

 </div>
 </div>
</section>

<!---- About end----->

<!---- video start----->
<section class="vdo-section for-full-screen">  
<div class="container">
  <div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12">
 <div class="vdo-frame btm-spaces">
 <iframe class="responsive-iframe" src="https://www.youtube.com/embed/GYHMXU1B9qM?si=GF_8Inap-8Lkwnv5&amp;controls=0&autoplay=1&rel=0&showinfo=0&color=white&control=0&mute=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

 </div>
 </div>
 
 <div class="col-lg-12 col-md-12 col-sm-12 pt-5" id="awardtimeline" style="display:none; ">
 <div class="text-about text-center heading-space">
 <h2 data-aos="fade-down">Awards Timeline</h2>
 <p data-aos="fade-down">Awards timeline will be as follows:</p>
 </div>
 <div class="line-award text-center">
 <div class="inline-text">
 <div data-aos="fade-up" class="circle left-spc">16, Dec 2024</div>
 <p data-aos="fade-up" class="para-1">Applications Close</p>
 <div data-aos="fade-up" class="circle left-spc1">20, Mar 2025</div>
 <p data-aos="fade-up" class="Judge para-2">Judging Day</p>
 <div data-aos="fade-up" class="circle left-spc2">17, Apr 2025</div>
 </div>
 <img src="images/line.svg"/>
  <div class="inline-text2">
   <p data-aos="fade-up" class="para-3">Submissions Open</p>
 <div data-aos="fade-up" class="circle2 left-spc3">17, Mar 2025</div>
 <p data-aos="fade-up" class="para-4">Finalists Announced</p>
 <div data-aos="fade-up" class="circle2 left-spc4">27, Mar 2025</div>
<p data-aos="fade-up" class="para-5">Gala Awards Event</p>
 </div>
 
 </div>
 </div>
<!--  <div class="col-lg-12 col-md-12 col-sm-12" id="awardtimeline">
 <div class="text-about text-center heading-space">
 <h2 data-aos="fade-down">Awards Timeline</h2>
 <p data-aos="fade-down">Awards timeline will be as follows:</p>
 </div>
 <div class="line-award text-center">
 <div class="inline-text">
 <div data-aos="fade-up" class="circle left-spc">01, Dec 2022</div>
 <p data-aos="fade-up">Applications Close</p>
 <div data-aos="fade-up" class="circle left-spc1">21, Jan 2023</div>
 <p data-aos="fade-up">Judging Day</p>
 <div data-aos="fade-up" class="circle left-spc2">09, Feb 2023</div>
 </div>
 <img src="images/line.svg"/>
  <div class="inline-text2">
   <p data-aos="fade-up">Submissions Open</p>
 <div data-aos="fade-up" class="circle2 left-spc3">20, Jan 2023</div>
 <p data-aos="fade-up">Finalists Announced</p>
 <div data-aos="fade-up" class="circle2 left-spc4">27, Jan 2023</div>
<p data-aos="fade-up">Gala Awards Event</p>
 </div>
 
 </div>
 </div> -->
 </div>
 </section>
<!---- video end----->


<!----category start---->
<section class="about-section for-full-screen">  
<div class="container-fluid">
  <div class="row order-change item-center" id="categories">
 <div class="col-lg-6 col-md-6 col-sm-12 p-0 order2">
 <div class="text-about space-lr">
 <h2 data-aos="fade-left">Awards Categories</h2>
<h4 data-aos="fade-left">Entry Process: </h4>
<p data-aos="fade-left">Gain recognition for your excellence by entering the awards through one of two routes: either directly submit your application  or embrace the honor of being nominated by a peer. If nominated, simply accept the nomination and proceed to complete the straightforward application process. Your journey towards the prestigious awards begins here.
</p>

<div class="btn-award" data-aos="fade-left">
<a class="ct-btn" href="/awards/category.php">Categories</a>
</div>
 </div>
 </div>
  <div class="col-lg-6 col-md-6 col-sm-12 p-0 order1">
 <div class="image-about" data-aos="fade-right">
 <img src="images/cat.jpg"/>
 </div>
 </div>
 </div>
 <div class="row item-center" id="galadinner">
    <div class="col-lg-6 col-md-6 col-sm-12 p-0">
 <div class="image-about" data-aos="fade-left">
 <img src="images/dinner.jpg"/>
 </div>
 </div>
 <div class="col-lg-6 col-md-6 col-sm-12 p-0">
 <div class="text-about space-rl space-btm-head">
 <div class="logo-dinner" data-aos="fade-left">
 <img src="images/logo-dinner.svg"/>
 </div>
 <h2 data-aos="fade-left">Awards Gala Dinner</h2>
<p data-aos="fade-up">The evening will commence with a cocktail reception and entertainment followed by a three-course dinner and further entertainment.</p>
<p data-aos="fade-up">Following the announcement of the winners, the after-party will continue long into the night.</p>

<div data-aos="fade-up" class="btn-award">
<!-- <a class="book-btn" href="https://docs.google.com/forms/d/e/1FAIpQLSfljZetuUW-5NN2o59qPuin1oZTpqT4ETY1XShTBGw1wK57OQ/viewform?usp=sf_link" target="_blank">Book Your Ticket</a> -->
<!-- <a class="book-btn" href="https://docs.google.com/forms/d/e/1FAIpQLSfljZetuUW-5NN2o59qPuin1oZTpqT4ETY1XShTBGw1wK57OQ/viewform?usp=sf_link" target="_blank">Book Your Ticket</a> -->
</div>
 </div>
 </div>

 </div>
<!--   <div class="row item-center" id="galadinner">
    <div class="col-lg-6 col-md-6 col-sm-12 p-0">
 <div class="image-about" data-aos="fade-left">
 <img src="images/dinner.jpg"/>
 </div>
 </div>
 <div class="col-lg-6 col-md-6 col-sm-12 p-0">
 <div class="text-about space-rl space-btm-head">
 <div class="logo-dinner" data-aos="fade-left">
 <img src="images/logo-dinner.svg"/>
 </div>
 <h2 data-aos="fade-left">Awards Gala Dinner</h2>
<p data-aos="fade-up">The evening will commence with a cocktail reception and entertainment followed by a three-course dinner and further entertainment.</p>
<p data-aos="fade-up">Following the announcement of the winners, the after-party will continue long into the night.</p>

<div data-aos="fade-up" class="btn-award">
<a class="book-btn" href="https://docs.google.com/forms/d/e/1FAIpQLSfljZetuUW-5NN2o59qPuin1oZTpqT4ETY1XShTBGw1wK57OQ/viewform?usp=sf_link" target="_blank">Book Your Ticket</a>
<a class="book-btn" href="https://forms.gle/Kk5m2D4UZxbCfM9B8" target="_blank">Book Your Ticket</a>
</div>
 </div>
 </div>

 </div> -->
 </div>
</section>

<!---- category end----->

<!---- Sign Up start----->
<section class="signup-section">
<div class="container">
  <div class="row">
 <div class="col-lg-12 col-md-12 col-sm-12">
 <div class="sign-heading">
 <h3>Sign up for the REPs Industry Awards 2024</h3>

 </div>
 
<div class="columns large-3 medium-6 small-12 contact-mobile">
      <div class="contact-forms">
        <form method="post" action="/awards/#contactForm" accept-charset="UTF-8" id="contactForm" class="msgrepss">             
                    <div class="form-design">
                      <input placeholder="First Name" name="firstname" type="text" required>
                      <span><?php print $fnmsg; ?></span>           
            <input placeholder="Phone Number" name="phonenum" type="tel" maxlength="15" required>
            <span><?php print $pnmsg; ?></span>           
            <input placeholder="Email" name="email" type="email" required>
            <span><?php print $emailmsg; ?></span>            
                      <input class="submitBtn float-right sndmsg" type="submit" value="Sign Up">            
          </div>
                                       
          </form>     
      </div>
<div class="msg"><?php print $msg; ?></div> 
    </div>
   </div>
   </div>
   </div>
</section>
<!---- Signup end----->



<!-- <section class="new-sec">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="new-sec-text">
          <p>Under the Patronage of H.E. Sheikh Abdullah Bin Hamad Al Sharqi</p>
        </div>
      </div>
    </div>
  </div>
</section> -->



<!---- client Start----->
<section class="client-section for-full-screen" id="sponsors">
   <div class="container">
      <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="headings text-center">
          <h2 data-aos="fade-up">Supported by:</h2>
        </div>
      </div>   
     </div>
         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
               <div id="clients" class="owl-carousel owl-theme">
                  <div class="item">
               <div class="client-logo"><img src="images/Sponser-01.jpg"/></div>
             <!-- <div class="client-logo"><img src="images/2.jpg"/></div> -->
                  </div>
           <div class="item">
               <div class="client-logo"><img src="images/aviv-logo.png"/></div>
             <!-- <div class="client-logo"><img src="images/4.jpg"/></div> -->
                  </div>
           <!-- <div class="item">
               <div class="client-logo"><img src="images/tmd-logo.jpg"/></div>
                  </div> -->
           <!-- <div class="item">
               <div class="client-logo"><img src="images/Sponser-04.jpg"/></div>
         
                  </div> -->
             <!-- <div class="item">
               <div class="client-logo"><img src="images/Sponser-05.jpg"/></div>
            
                  </div> -->
                  <!-- <div class="item">
               <div class="client-logo"><img src="images/MEFITPRO_Logo.png"/></div>
            
                  </div> -->
        
               </div>
            </div>
         </div>
   </div>
</section>

<!---- client end----->


<!---- Footer Start----->
<footer class="main-ft for-full-screen">
<div class="container">
<div class="space-tb">
  <div class="row">
 <div class="col-lg-2 col-md-12 col-sm-12">
 <div class="ft-logo">
<a href="https://www.repsuae.com/" target="_blank"><img src="images/rep.svg"></a>
</div>
<div class="ftsocial-media">
<ul>
<li><a href="https://www.facebook.com/REPSUAE/" target="_blank"><img src="images/fb.svg"> </a></li>
<li><a href="https://www.instagram.com/repsuae/" target="_blank"><img src="images/insta.svg"> </a></li>
<!-- <li><a href="#" target="_blank"><img src="images/twiter.svg"/> </a></li> -->
<li><a href="#" target="_blank"><img src="images/youtube.svg"> </a></li>
</ul>
</div>
</div>

 <div class="col-lg-2 col-md-12 col-sm-12">
 <div class="ft-text">
<h3>EVENT Inquiries</h3>
<p><a href="mailto:awards@repsuae.com"><img src="images/email.svg"> awards@repsuae.com</a></p>
<p><a href="tel:97143213388"><img src="images/phone.svg"> +971 4321 3388</a></p>
<p><a href="tel:971504297919"><img src="images/call.svg"> +971 50 429 7919</a></p>
</div>
</div>

 <div class="col-lg-2 col-md-12 col-sm-12">
 <div class="ft-text">
<h3>SPONSORSHIP INQUIRIES</h3>
<p><a href="mailto:catherine@repsuae.com"><img src="images/email.svg"> catherine@repsuae.com</a></p>
<p><a href="tel:043213388"><img src="images/call.svg"> 04 321 3388</a></p>
</div>
</div>

<div class="col-lg-2 col-md-12 col-sm-12">
 <div class="ft-text">
<h3>VIDEO HUB</h3>
<p><a href="https://www.youtube.com/watch?v=6aB_-6cuwEw" target=”_blank” ><img src="/awards/images/Galley-2025/web-logo.png"> Industry Awards 2023</a></p>
<p><a href="https://www.youtube.com/watch?v=GYHMXU1B9qM" target=”_blank” ><img src="/awards/images/Galley-2025/web-logo.png"> Industry Awards 2024</a></p>
</div>
</div>

<div class="col-lg-2 col-md-12 col-sm-12">
<div class="ftsocial-media">
<h3>OFFICIAL PARTNER:</h3>  
<div class="opt-logo">
  <img src="images/dc-logo.png">
</div>
</div>
</div>

</div>
</div>
</div>
<div class="copyright">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12">
<p>REPs UAE © 2024. All rights reserved. </p>
</div>
</div>
</div>
</div>
</footer>
<!---- Footer end----->


<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}



//slider js start


$(document).ready(function() {
  var el = $('#clients');
  
  var carousel;
  var carouselOptions = {
    margin: 20,
    nav: false,
  dots: true,
  loop: false,

rewind: true,
  slidesToScroll: 1,
  autoplay:true,
    infinite: true,
    autoplaySpeed: 3000,
    slideBy: 'page',
    responsive: {
      0: {
        items: 1,
        rows: 2 //custom option not used by Owl Carousel, but used by the algorithm below
      },
      768: {
        items: 3,
        rows: 3 //custom option not used by Owl Carousel, but used by the algorithm below
      },
      991: {
        items: 5,
        rows: 2 //custom option not used by Owl Carousel, but used by the algorithm below
      }
    }
  };

  //Taken from Owl Carousel so we calculate width the same way
  var viewport = function() {
    var width;
    if (carouselOptions.responsiveBaseElement && carouselOptions.responsiveBaseElement !== window) {
      width = $(carouselOptions.responsiveBaseElement).width();
    } else if (window.innerWidth) {
      width = window.innerWidth;
    } else if (document.documentElement && document.documentElement.clientWidth) {
      width = document.documentElement.clientWidth;
    } else {
      console.warn('Can not detect viewport width.');
    }
    return width;
  };

  var severalRows = false;
  var orderedBreakpoints = [];
  for (var breakpoint in carouselOptions.responsive) {
    if (carouselOptions.responsive[breakpoint].rows > 1) {
      severalRows = true;
    }
    orderedBreakpoints.push(parseInt(breakpoint));
  }
  
  //Custom logic is active if carousel is set up to have more than one row for some given window width
  if (severalRows) {
    orderedBreakpoints.sort(function (a, b) {
      return b - a;
    });
    var slides = el.find('[data-slide-index]');
    var slidesNb = slides.length;
    if (slidesNb > 0) {
      var rowsNb;
      var previousRowsNb = undefined;
      var colsNb;
      var previousColsNb = undefined;

      //Calculates number of rows and cols based on current window width
      var updateRowsColsNb = function () {
        var width =  viewport();
        for (var i = 0; i < orderedBreakpoints.length; i++) {
          var breakpoint = orderedBreakpoints[i];
          if (width >= breakpoint || i == (orderedBreakpoints.length - 1)) {
            var breakpointSettings = carouselOptions.responsive['' + breakpoint];
            rowsNb = breakpointSettings.rows;
            colsNb = breakpointSettings.items;
            break;
          }
        }
      };

      var updateCarousel = function () {
        updateRowsColsNb();

        //Carousel is recalculated if and only if a change in number of columns/rows is requested
        if (rowsNb != previousRowsNb || colsNb != previousColsNb) {
          var reInit = false;
          if (carousel) {
            //Destroy existing carousel if any, and set html markup back to its initial state
            carousel.trigger('destroy.owl.carousel');
            carousel = undefined;
            slides = el.find('[data-slide-index]').detach().appendTo(el);
            el.find('.fake-col-wrapper').remove();
            reInit = true;
          }


          //This is the only real 'smart' part of the algorithm

          //First calculate the number of needed columns for the whole carousel
          var perPage = rowsNb * colsNb;
          var pageIndex = Math.floor(slidesNb / perPage);
          var fakeColsNb = pageIndex * colsNb + (slidesNb >= (pageIndex * perPage + colsNb) ? colsNb : (slidesNb % colsNb));

          //Then populate with needed html markup
          var count = 0;
          for (var i = 0; i < fakeColsNb; i++) {
            //For each column, create a new wrapper div
            var fakeCol = $('<div class="fake-col-wrapper"></div>').appendTo(el);
            for (var j = 0; j < rowsNb; j++) {
              //For each row in said column, calculate which slide should be present
              var index = Math.floor(count / perPage) * perPage + (i % colsNb) + j * colsNb;
              if (index < slidesNb) {
                //If said slide exists, move it under wrapper div
                slides.filter('[data-slide-index=' + index + ']').detach().appendTo(fakeCol);
              }
              count++;
            }
          }
          //end of 'smart' part

          previousRowsNb = rowsNb;
          previousColsNb = colsNb;

          if (reInit) {
            //re-init carousel with new markup
            carousel = el.owlCarousel(carouselOptions);
          }
        }
      };

      //Trigger possible update when window size changes
      $(window).on('resize', updateCarousel);

      //We need to execute the algorithm once before first init in any case
      updateCarousel();
    }
  }

  //init
  carousel = el.owlCarousel(carouselOptions);
});

//slider js end

// stickcy header

jQuery(window).scroll(function() {
if (jQuery(this).scrollTop() > 1){  
    jQuery('.main-header').addClass("navbar-sticky");
  }
  else{
    jQuery('.main-header').removeClass("navbar-sticky");
  }
});


AOS.init({
  duration: 1200,
  once: true
});
AOS.init({
  disable: function() {
    var maxWidth = 800;
    return window.innerWidth < maxWidth;
  }
});

</script>


</body>
</html>
