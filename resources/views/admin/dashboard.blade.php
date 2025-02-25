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
    <style>
    .container {
    min-height: 80vh; /* Ensures the container takes at least the full height of the viewport */
    display: flex;
    flex-direction: column;
  
}
</style>
</head>
  
<section id="banner">
  <div class="container">
    <div class="row">
      <div class="col-md-6 animate__animated animate__bounceInLeft" style="text-align: center;">
        <h1 style="font-size:20px">Welcome to votify!</h1><br>
      </div>
      <div class="col-md-6"> 
             <img src="http://localhost/online_voting_system/resources/img/adminhome.png" alt="" srcset="" height="100vh " width="30%" style="margin-left: 425px;" >
      </div> 
    </div>  
  </div>
        
</section>
 
  </body>
  </x-slot>
</x-app-layout>
</html>


