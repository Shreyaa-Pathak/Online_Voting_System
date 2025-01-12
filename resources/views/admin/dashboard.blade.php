<x-app-layout>
  
<!--    
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('admin Dashboard') }}
        </h2>
    -->

<x-slot name="header">
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



 <!------------------  Space Section ------------------> 
  
<section class="space">
  <div class="container">
    <div class="col-md-12">
      <div class="row">
    
      </div>
    </div>
</section>
</div>


<!-- ----------------  Contact Form Section ---------------- -->
  <section>
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
</section>

</x-slot>
</x-app-layout>
<!------------------  Footer Section ------------------>

<section>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <hr>
      <div class="Footer">
        <ul style="display: flex;">
          <li style="list-style: none; padding: 10px; "><a href="index.html" style="text-decoration: none; color: #a517ba;">Home</a></li>
          <li style="list-style: none; padding: 10px; "><a href="about.php" style="text-decoration: none; color: #a517ba;">About</a></li>
          <li style="list-style: none; padding: 10px; "><a href="suggestion.html" style="text-decoration: none; color: #a517ba;">Suggestion</a></li>
          <li style="list-style: none; padding: 10px; "><a href="contact_form.php" style="text-decoration: none; color: #a517ba;">Contact</a></li>
        </ul>
      </div>
    </div>
    <div class="col-md-6">
      <hr>
      <div class="social-icon">
        <ul >
                        <li>
                            <a href="">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa fa-pinterest"></i>
                            </a>
                        </li>
                    </ul>
      </div>
    </div>
  </div>
</div>
</section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  
    <script src="http://localhost/online_voting_system/resources/js/jquery-3.2.1.slim.min.js"></script>
    <script src="http://localhost/online_voting_system/resources/js/popper.min.js"></script>    
    <script src="http://localhost/online_voting_system/resources/js/bootstrap.min.js"></script>  
 
  </body>
</html>
