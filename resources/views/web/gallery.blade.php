
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="description" content="Lokseva Vidya Mandir & Junior College,Mandrup,Solapur">
  <meta name="author" content="Bodhi Technology">
  <meta name = "keywords" content = "school,best school,no.1 school,solapur,mandrup,south solapur,primary,college,Science,Arts,Commerce"/> 
  <meta property="og:image" content="staticFiles/dist/img/apple-icon.png')}}">
  <meta property="og:description" content="Lokseva Vidya Mandir & Junior College comprises of pre-primary section,Primary section,Higher secondary and Jr.College. The school follows Maharashtra State Board Curriculum and the medium of instruction is Marathi for School and junior college have three main stream i.e. Science,Commerce & Arts. ">
  <meta property="og:title" content="Lokseva Vidya Mandir & Junior College,Mandrup,Solapur">
  <meta name="twitter:title" content="Lokseva Vidya Mandir & Junior College,Mandrup,Solapur">
  <link rel="shortcut icon" href="staticFiles/dist/img/favicon.png')}}" type="image/x-icon" />
  <title>Lokseva Vidya Mandir & Junior College - Gallery</title>


    <link rel="stylesheet" href="{{'https://cdn.queensherainfotech.com/adminltev3/plugins/icheck-bootstrap/icheck-bootstrap.min.css'}}">
    <link rel="stylesheet" href="{{'https://cdn.queensherainfotech.com/adminltev3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'}}">
    <link rel="stylesheet" href="{{'https://cdn.queensherainfotech.com/adminltev3/plugins/jqvmap/jqvmap.min.css'}}">
    <link rel="stylesheet" href="{{'https://cdn.queensherainfotech.com/adminltev3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'}}">
    <link rel="stylesheet" href="{{'https://cdn.queensherainfotech.com/adminltev3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'}}">
    <link rel="stylesheet" href="{{'https://cdn.queensherainfotech.com/adminltev3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'}}">
    <link rel="stylesheet" href="{{'https://cdn.queensherainfotech.com/adminltev3/plugins/toastr/toastr.min.css'}}">
    <link rel="stylesheet" href="{{'https://cdn.queensherainfotech.com/adminltev3/plugins/pace-progress/themes/black/pace-theme-flat-top.css'}}">
    <link rel="stylesheet" href="{{'https://cdn.queensherainfotech.com/adminltev3/plugins/select2/css/select2.min.css'}}">
    <link rel="stylesheet" href="{{'https://cdn.queensherainfotech.com/adminltev3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'}}">
    <link rel="stylesheet" href="{{'https://cdn.queensherainfotech.com/adminltev3/dist/css/adminlte.min.css'}}">
    <link rel="stylesheet" href="{{'https://cdn.queensherainfotech.com/adminltev3/plugins/summernote/summernote-bs4.css'}}">
    <link rel="stylesheet" href="{{'https://pro.fontawesome.com/releases/v5.13.0/css/all.css'}}">
    <link rel="stylesheet" href="{{'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700'}}">
    <link rel="stylesheet" href="{{asset('css/mystyle.css')}}">
</head>

<body class="hold-transition layout-top-nav layout-navbar-fixed layout-fixed">
    <div class="wrapper">
    
              <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="#" class="navbar-brand">
        <img src="{{asset('img/android-icon-48x48.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Lokseva Vidya Mandir & Junior College</span>
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="{{route('/')}}" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="{{route('teacher')}}" class="nav-link">Teachers</a>
            </li>

            <li class="nav-item">
                <a href="{{route('gallery')}}" class="nav-link active">Gallery</a>
            </li>
            <li class="nav-item">
                <a href="{{route('contact')}}" class="nav-link">Contact</a>
            </li>
            <li class="nav-item">
                <a href="{{route('download')}}" class="nav-link">Download-App</a>
            </li>
            <li class="nav-item">
                <a href="{{route('login')}}"> <button type="button" class="btn btn-outline-success">Login</button>
                </a>
            </li>

         


        </ul>
      </div>   
    </div>
  </nav>
  <!-- /.navbar -->

      
    
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
       
    
      
<!-- START  CAROUSEL-->
<section id="home">    

<div class="row ">    

    <!-- /.col -->
    <div class="col-md-12">
      <!-- <div class="card"> -->
        
        <!-- /.card-header -->
        <!-- <div class="card-body"> -->
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
             <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="{{asset('img/slide1.png')}}" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('img/slide2.png')}}" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('img/slide3.png')}}" alt="Third slide">
              </div>
            </div> 
            
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
      

    </div>
    <!-- /.col -->



   </div>
  <!-- /.row -->
  <!-- END CAROUSEL-->


  <br>

 
 

  <div class="container">
    <div class="row">


        <div class="col-md-4 col-sm-6">
            <div class="ourgallery-team">
                <img src="{{asset('img/g1.png')}}">
                <div class="team-content">
                    <h3 class="title">Welcome Gate</h3>
                   
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="ourgallery-team">
                <img src="{{asset('img/g2.png')}}">
                <div class="team-content">
                    <h3 class="title">Annual affection conference

                   </h3>
                  
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="ourgallery-team">
              <img src="{{asset('img/g3.png')}}">
              <div class="team-content">
                  <h3 class="title">Annual affection conference

                  </h3>
                 
              </div>
          </div>
      </div>

     

      <div class="col-md-4 col-sm-6">
        <div class="ourgallery-team">
            <img src="{{asset('img/g4.png')}}">
            <div class="team-content">
                <h3 class="title">Annual affection conference

                </h3>
              
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="ourgallery-team">
            <img src="{{asset('img/g5.png')}}">
            <div class="team-content">
                <h3 class="title">Athletes selected for the Divisional Taekwondo and Karate Championships</h3>
                
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
      <div class="ourgallery-team">
          <img src="{{asset('img/g6.png')}}">
          <div class="team-content">
              <h3 class="title">Science Exhibition</h3>
             
          </div>
      </div>
  </div>




  <div class="col-md-4 col-sm-6">
    <div class="ourgallery-team">
        <img src="{{asset('img/g7.png')}}">
        <div class="team-content">
            <h3 class="title">Selection of Ms. Sania Sheikh for State Level Inspire Award Science Exhibition (2019-20)</h3>
           
        </div>
    </div>
</div>
<div class="col-md-4 col-sm-6">
    <div class="ourgallery-team">
        <img src="{{asset('img/g8.png')}}">
        <div class="team-content">
            <h3 class="title">Annual Day celebration</h3>
            
        </div>
    </div>
</div>
<div class="col-md-4 col-sm-6">
  <div class="ourgallery-team">
      <img src="{{asset('img/g9.png')}}">
      <div class="team-content">
          <h3 class="title">womens day celebration</h3>
          
         
      </div>
  </div>
</div>

<div class="col-md-4 col-sm-6">
  <div class="ourgallery-team">
      <img src="{{asset('img/g10.png')}}">
      <div class="team-content">
          <h3 class="title">Annual Day celebration</h3>
          <!-- <span class="post">Web Developer</span> -->
        
      </div>
  </div>
</div>


<div class="col-md-4 col-sm-6">
  <div class="ourgallery-team">
      <img src="{{asset('img/g11.png')}}">
      <div class="team-content">
          <h3 class="title">School Play Ground</h3>
          <!-- <span class="post">dfs</span> -->
          <!-- <ul class="social">
              <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
              <li><a href="#"><i class="fab fa-twitter"></i></a></li>
              <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
          </ul> -->
      </div>
  </div>
</div>



    </div>
</div>






      </div>
      <!-- /.content-wrapper -->
    
   
    
    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        <i class="fa fa-rocket">
        <a href="#" style="color: black;"> </i>+91 9420490054/9923350050 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
        <p class="float-right" ><a href="#" style="color: black;">Back to top</a></p>
      </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; <script>document.write(new Date().getFullYear());</script> <a href="">Lokseva Vidya Mandir & Junior College</a>.</strong> All rights reserved.
      </footer>
    </div>
    <!-- ./wrapper -->


    <script src="{{'https://cdn.queensherainfotech.com/adminltev3/plugins/jquery/jquery.min.js'}}"></script>
    <script src="{{'https://cdn.queensherainfotech.com/adminltev3/plugins/bootstrap/js/bootstrap.bundle.min.js'}}"></script>
    <script src="{{'https://cdn.queensherainfotech.com/adminltev3/plugins/moment/moment.min.js'}}"></script>
    <script src="{{'https://cdn.queensherainfotech.com/adminltev3/plugins/select2/js/select2.full.min.js'}}"></script>
    <script src="{{'https://cdn.queensherainfotech.com/adminltev3/dist/js/adminlte.js'}}"></script>

<script>
  $( '.navbar-nav a' ).on( 'click', function () {
    $( '.navbar-nav' ).find( 'li.active' ).removeClass( 'active' );
    $( this ).parent( 'li' ).addClass( 'active' );
  });
     </script>


<script> $('#myCarousel').carousel({
  interval: 3000,
})</script>

</body>
</html>