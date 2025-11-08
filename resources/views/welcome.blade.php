<!doctype html>
<html lang="en">

<head>
  <title>Votify</title>
  <link rel="icon" type="image/png" href="{{ asset('home_assets/img/hand-index-thumb') }}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!--Fonts CDN-->
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <!--- Custom Css --->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
  <!------------------  Navbar Section ------------------>
  <nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <a href="{{ route('welcome') }}" style="display: flex; align-items: center; padding-left: 20px; text-decoration: none;">
  <img src="{{ asset('home_assets/img/hand-index-thumb.svg') }}" 
       alt="Votify" 
       style="width: 20px; height: 20px; display: inline-block;">
  <span style="color: gray; font-weight: 800; font-size: 14px; margin-left: 10px;">VOTIFY</span>
</a>



    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon" style="color: white;"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto animate__animated animate__bounceInDown" style="padding-right: 50px;">
        <li class="nav-item">
          <a class="nav-link" href="#banner"
            style="font-weight: 600; text-align: center; font-size: 18px; margin-top: 20px;  text-transform: capitalize; padding: 15px;">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#about"
            style="font-weight: 600; text-align: center; font-size: 18px; margin-top: 20px;  text-transform: capitalize; padding: 15px;">About</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}"
            style=" font-weight: 600; text-align: center; font-size: 18px; margin-top: 20px;  text-transform: capitalize; padding: 15px;">Login</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}"
            style=" font-weight: 600; text-align: center; font-size: 18px; margin-top: 20px;  text-transform: capitalize; padding: 15px;">Register</a>
        </li>
      </ul>
    </div>

  </nav>


  <!------------------  HomePage Section ------------------>

  <section id="banner">
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-6 animate__animated animate__bounceInLeft" style="text-align: center;">
          <h1>Welcome to votify!</h1><br>
          <p style="color:black">Your all-in-one online voting platform designed to revolutionize the way elections
            are conducted. With Votify, securely cast your votes from anywhere, eliminating the need for physical
            ballots or in-person gatherings.</p>
          <a href="{{ route('register') }}"><button class="magnifyBtn" style="font: weight 200px;">VOTE
              NOW</button></a>
        </div>

        <div class="col-md-6">
          <img src="./img/home.png" alt="" srcset="" height="400vh " width="90%"
            class="animate__animated animate__bounceInRight " style="margin-left: 10px; margin-top: 20px;">
        </div>
      </div>
    </div>
  </section>

  <!------------------  Candidate Section ------------------>
  <section id="middle">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1>Vote smarter. Vote easier.</h1>
        </div>
        <div class="col-md-12" style=" width: 100%; ">
          <img src="{{ asset('img/10.svg') }}" alt="" srcset="">
          <a href="{{route('register')}}"><span><button class="slideUpBtn mb-4">Vote
                Now</button></span></a>
        </div>

      </div>
    </div>
  </section>

  <!------------------  About Section ------------------>
  <section id="about">
    <div class="container-fluid" style="margin-top: 50px">
      <div class="row" style="background: white;" width="100%">
        <div class="col-md-12" style="background-image:  white;">
          <h1 style="text-align: center; background-image:  black;"> About Votify</h1>
        </div>
        <div class="col-md-6">
          <img src="{{ asset('img/home2.png') }}" alt="" srcset="">
        </div>
        <div class="col-md-6" data-aos="fade-left">
          <h1 style="color: black; margin-top: 40px;" class=" "> </h1>
          <p style="color: black;" class=" "><br><br>Votify is a modern online voting system built to transform how
            elections and decision-making processes are conducted. With a focus on security, accessibility, and
            efficiency, Votify enables individuals and organizations to conduct elections without the hassle of
            traditional methods. Our platform is designed to ensure fairness, transparency, and reliability,
            empowering users to make their voices heard from anywhere in the world. At Votify, we are committed to
            leveraging technology to build trust and make voting more inclusive for all.</p>
        </div>

      </div>
    </div>
  </section>


  <!-- Optional JavaScript -->

  <script src="{{ asset('js/jquery-3.2.1.slim.min.js') }}"></script>
  <script src="{{ asset('js/popper.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</body>

<!------------------  Footer Section ------------------>
<footer class="bg-gray-50 border-t border-gray-200">
  <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
    <div class="text-center text-sm text-gray-600">
      Copyright© 2025 <span class="font-semibold text-indigo-700">Votify</span>
    </div>
  </div>
</footer>

</html>