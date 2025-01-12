<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Fonts CDN-->

    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="http://localhost/online_voting_system/resources/css/bootstrap.min.css">
    
    <!--- Custom Css --->
    <link rel="stylesheet" href="http://localhost/online_voting_system/resources/css/style.css">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

<!------------------  Navbar Section ------------------>

<div class="container-fluid" id="cont-3">
<header id="nav-bar">
  <nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <a class="navbar-brand" href="{{route('welcome')}}"  style="color: black; font-size: 30px;font-weight: 1000; margin-top: 10px;">VOTIFY</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon" style="color: white;"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto animate__animated animate__bounceInDown" style="padding-right: 50px;">
        <li class="nav-item" >
          <a class="nav-link" href="#banner" style="font-weight: 600; text-align: center; font-size: 18px; margin-top: 20px;  text-transform: capitalize; padding: 15px;">Home</a>
        </li>
      
        <li class="nav-item" >
          <a class="nav-link" href="#about"  style="font-weight: 600; text-align: center; font-size: 18px; margin-top: 20px;  text-transform: capitalize; padding: 15px;">About</a>
        </li>

        <li class="nav-item" >
          <a class="nav-link" href="{{ route('login') }}"  style=" font-weight: 600; text-align: center; font-size: 18px; margin-top: 20px;  text-transform: capitalize; padding: 15px;">Login</a>
        </li>

        <li class="nav-item" >
          <a class="nav-link" href="{{ route('register') }}"  style=" font-weight: 600; text-align: center; font-size: 18px; margin-top: 20px;  text-transform: capitalize; padding: 15px;">Register</a>
        </li>
      </ul>
    </div>
    <!-- @if (Route::has('login'))
        <nav class="-mx-3 flex flex-1 justify-end">
        @auth
            <a href="{{ url('/dashboard') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                        Dashboard
                                    </a>
        @else
            <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                        Log in
                                    </a>

         @if (Route::has('register'))
        <a href="{{ route('register') }}"class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
            Register
        </a>
        @endif
        @endauth
        </nav>
    @endif -->
  </nav>
</header>

<!------------------  HomePage Section ------------------>

<section id="banner">
  <div class="container">
    <div class="row">
      <div class="col-md-6 animate__animated animate__bounceInLeft" style="text-align: center;">
        <h1>Welcome to votify!</h1><br>
        <p style="color:black">Your all-in-one online voting platform designed to revolutionize the way elections are conducted. With Votify, securely cast your votes from anywhere, eliminating the need for physical ballots or in-person gatherings.</p>
      <a href="{{ route('register') }}"><button class="magnifyBtn" style="font: weight 200px;">VOTE NOW</button></a>
      </div>
      
      <div class="col-md-6"> 
             <img src="http://localhost/online_voting_system/resources/img/home.png" alt="" srcset="" height="400vh " width="90%" class="animate__animated animate__bounceInRight " style="margin-left: 10px; margin-top: 20px;" >
                </div> 
            </div>  
         </div>
        </div>
      </div>
    </div>
</section>
 <!------------------  Space Section ------------------> 
  
<section class="space">
  <div class="container">
    <div class="col-md-12">
      <div class="row">
    
      </div>
    </div>
</section>
</div>

<!------------------  Candidate Section ------------------>
<section id="middle">
<div class="container">
  <div class="row">
    <div class="col-md-12">     
      <h1>Vote smarter. Vote easier.</h1>
    </div>
    <div class="col-md-12" style=" width: 100%; ">
      <img src="http://localhost/online_voting_system/resources/img/10.svg" alt="" srcset="">
      <a href="{{route('register')}}" ><span ><button style="margin-top: 20px;" class="slideUpBtn">Vote Now</button></span></a>
    </div>
 
    </div>
  </div>
  </div>
</div>

<!------------------  About Section ------------------>
<section id="about">
    <div class="container-fluid" style="margin-top: 50px">
      <div class="row" style="background: white;" width="100%">
        <div class="col-md-12" style="background-image:  white;">
          <h1 style="text-align: center; background-image:  black;"> About Votify</h1>
        </div>
        <div class="col-md-6" >
          <img src="http://localhost/online_voting_system/resources/img/home2.png" alt="" srcset="" >
        </div>
        <div class="col-md-6" data-aos="fade-left">
          <h1 style="color: black; margin-top: 40px;" class=" ">  </h1>
          <p style="color: black;" class=" "><br><br>Votify is a modern online voting system built to transform how elections and decision-making processes are conducted. With a focus on security, accessibility, and efficiency, Votify enables individuals and organizations to conduct elections without the hassle of traditional methods. Our platform is designed to ensure fairness, transparency, and reliability, empowering users to make their voices heard from anywhere in the world. At Votify, we are committed to leveraging technology to build trust and make voting more inclusive for all.</p>
        </div>
        
      </div>
    </div>
</section>
<!-- ----------------  Contact Form Section ---------------- -->
  <!-- <section>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1> Contact Form </h1>
          <p style="padding-bottom:50px;">Any Queries , Drop Contact Form  </p>  
        </div>
        <div class="col-md-4" style="border-radius: 6px; border: 3px  #a517ba solid;">
          <h2 style="padding-top: 30px;">Contact Form</h2>
          <form action="contact.php" method="post">
            <table>
              <tr>
                <label style="float: left; position: absolute; margin-top: 25px; margin-left: -160px; outline:none;"> Name :</label>
				      	<td style="padding-top: 50px;"><input placeholder="Enter Your Name" type="text" name="txtName" ></td>
              </tr>
              <tr >
                <label style="float: left; position: absolute; margin-top: 100px;  px; margin-left: -160px;"> Email :</label>
					      <td style="padding-top: 50px;"><input required placeholder="Enter Your Email id " type="email" name="txtEmail"></td>
              </tr>
              <tr>
                <label style="float: left; position: absolute; margin-top: 175px; margin-left: -160px;"> Message :</label>
                <td style="padding-top: 50px;"><textarea placeholder="Enter Your Message" name="txtMessage" rows="3" cols="22"></textarea></td>
              
              </tr>
              <tr>
              <td style="padding-top: 50px; padding-bottom: 30px;"><button class="magnifyBtn">Submit</button></a></td>
              </tr>
            </table>
          </form>
        </div>
        <div class="col-md-8" style="padding-left: 50px; width: 100%; padding-top: 30px;">
          <img src="http://localhost/online_voting_system/resources/img/6.svg" alt="" srcset="">
        </div>
      </div>
    </div>
</section> -->


<!------------------  Footer Section ------------------>


<div class="container-fluid">
  <div class="row">
  
    <div class="col-md-6" style="display: flex; justify-content: center; align-items: center; height: 60px; ">
     <p style="color:black;">Copyright @ 2025 Votify</p>
    </div>
  </div>
</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  
    <script src="http://localhost/online_voting_system/resources/js/jquery-3.2.1.slim.min.js"></script>
    <script src="http://localhost/online_voting_system/resources/js/popper.min.js"></script>    
    <script src="http://localhost/online_voting_system/resources/js/bootstrap.min.js"></script>  
 
  </body>
</html>