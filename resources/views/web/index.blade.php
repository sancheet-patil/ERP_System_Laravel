
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
    <meta property="og:image" content="staticFiles/dist/img/apple-icon.png" />
    <meta property="og:description" content="Lokseva Vidya Mandir & Junior College comprises of pre-primary section,Primary section,Higher secondary and Jr.College. The school follows Maharashtra State Board Curriculum and the medium of instruction is Marathi for School and junior college have three main stream i.e. Science,Commerce & Arts. ">
    <meta property="og:title" content="Lokseva Vidya Mandir & Junior College,Mandrup,Solapur">
    <meta name="twitter:title" content="Lokseva Vidya Mandir & Junior College,Mandrup,Solapur">

    <title>Lokseva Vidya Mandir & Junior College - Home</title>

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
            <a href="{{route('/')}}" class="nav-link active">Home</a>
          </li>
          <li class="nav-item">
            <a href="{{route('teacher')}}" class="nav-link">Teachers</a>
          </li>

          <li class="nav-item">
            <a href="{{route('gallery')}}" class="nav-link">Gallery</a>
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
      <div class="col-md-3 col-sm-6">
          <div class="serviceBox">
              <div class="service-icon">
                  <span><i class="fa fa-globe"></i></span>
              </div>
              <h3 class="title">Certified Teachers</h3>
              <p class="description">At Lokseva vidya mandir school teachers ability to deal with children, their thought process and their understanding of child psychology. Furthermore, This ensures that each student gets the benefit of personalized attention from highly qualified and trained tutors, who have been chosen for their dedication, competence and compassion that has made the school a role model for other institutions.we maintains the standard we prescribe for our teachers.</p>
          </div>
      </div>
      <div class="col-md-3 col-sm-6">
          <div class="serviceBox purple">
              <div class="service-icon">
                  <span><i class="fa fa-rocket"></i></span>
              </div>
              <h3 class="title">Education</h3>
              <p class="description">The management, staff and students are committed to this aim and work tirelessly to obtain the excellence in the academics, co-curricular, extra-curricular areas and be happily productive in their lives. The aim of the school is to provide depth based knowledge adapting new technology. We have rated ourselves as the toppers in the district to reach the heights in the field of education. We providing the advanced knowledge based education, We maintain healthy teaching learning relationship. </p>
          </div>
      </div>


      <div class="col-md-3 col-sm-6">
        <div class="serviceBox">
            <div class="service-icon">
                <span><i class="fa fa-globe"></i></span>
            </div>
            <h3 class="title">Book & Library</h3>
            <p class="description">Since the very first exposure to a child is through the visual medium and the written word, the school has created a friendly world of knowledge. The library where a wide range of books, comics, textbooks, encyclopedia, novels, expose children of all ages to a fascinating world. The reading habit is encouraged in the libraries cheerful, neat and spacious environs, where children learn to relax and enjoy reading. </p>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="serviceBox purple">
            <div class="service-icon">
                <span><i class="fa fa-rocket"></i></span>
            </div>
            <h3 class="title">Infrastructure</h3>
            <p class="description">The school building has been specially designed to give it a contemporary, stylish look. The classrooms are well ventilated with black boards to provide an ideal sanctum for academic progress to take place. Each class has a maximum of 60 pupils. The school has excellent infrastructure viz, air cooled school building, vast playground and spacious classroom. </p>
        </div>
    </div>

  </div>
</div>
</section>
<br>

<!-- About us start-->
<section id="about">

  <div class="demo">
  <div class="form-bg">
    <div class="container">
        <div class="row">

            <div class="col-md-offset-3 col-md-12">
                <div class="form-container">
                    <div class="form-icon">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <div class="form-horizontal">
                      <h1 class="text-center pt-5 pb-5"> <u>About Us</u> </h1>
                      <p style="text-align:center;">Lokseva Vidya Mandir & Junior College comprises of pre-primary section,Primary section,Higher secondary and Jr.College.
                        The school follows Maharashtra State Board Curriculum and the medium of instruction is Marathi for School and junior college have three main stream i.e. Science,Commerce & Arts. </p>
                      <ul type="square">
                        <li>Maharashtra State Board Pattern based curriculum.</li>
                        <li>Value based education by qualified experienced and dedicated staff.</li>
                        <li>Aims at maximum participation for the maximum number of students in a wide range of co-curricular activities.</li>
                        <li>Special emphasis on all-round development on students personality.</li>
                        <li>Self secure and soothing learning environment for the children.</li>
                        <li>Excellent infrastructure viz, air cooled school building, vast playgrounds, spacious classroom.</li>
                        <li>Well stocked library, well equipped science and computer labs, remedial classes for weak students. </li>
                      </ul>

                    </div>
                </div>
            </div>


            <!-- <div class="col-md-offset-3 col-md-6">
              <div class="form-container">
                  <div class="form-icon">
                      <i class="fa fa-envelope-open"></i>
                  </div>


              </div>
          </div> -->




        </div>
    </div>
  </div>
  <br>
  </div>









<!-- Key Members start-->


    <div class="demo">
    <div class="form-bg">

      <div class="container">
          <div class="row">

              <div class="col-md-offset-3 col-md-12">
                  <div class="form-container">

                      <div class="form-icon">
                          <i class="fa fa-map-marker"></i>
                      </div>
                      <div class="form-horizontal">
                        <h1 class="text-center pt-5 pb-5"> <u>Key Members</u> </h1>
                        <div class="container">
                          <div class="row">
                              <div class="col-md-3 col-sm-6">
                                  <div class="our-team">
                                      <div class="pic">
                                          <img src="{{asset('img/keymember1.png')}}" alt="">
                                      </div>
                                      <ul class="social">
                                          <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                          <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                          <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                          <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                      </ul>
                                      <div class="team-content">
                                          <h3 class="title">Shri.Shivsharan H. Birajdar-Patil</h3>
                                          <span class="post">President</span>

                                      </div>
                                  </div>
                              </div>

                              <div class="col-md-3 col-sm-6">
                                  <div class="our-team">
                                      <div class="pic">
                                          <img src="{{asset('img/keymember2.png')}}" alt="">
                                      </div>
                                      <ul class="social">
                                          <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                          <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                          <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                          <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                      </ul>
                                      <div class="team-content">
                                          <h3 class="title">Shri.Gurusiddh Pirappa Mhetre</h3>
                                          <span class="post">Secretary</span>
                                          <!-- <p class="description">
                                              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar feugiat fermentum. Donec efficitur posuere eros, vitae placerat.
                                          </p> -->
                                      </div>
                                  </div>
                              </div>

                              <div class="col-md-3 col-sm-6">
                                <div class="our-team">
                                    <div class="pic">
                                        <img src="{{asset('img/keymember3.png')}}" alt="">
                                    </div>
                                    <ul class="social">
                                        <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                    </ul>
                                    <div class="team-content">
                                        <h3 class="title">Shri.Pirappa Gurusiddh Mhetre</h3>
                                        <span class="post">Assistant Secretary</span>
                                        <!-- <p class="description">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar feugiat fermentum. Donec efficitur posuere eros, vitae placerat.
                                        </p> -->
                                    </div>
                                </div>
                            </div>


                             <div class="col-md-3 col-sm-6">
                                  <div class="our-team">
                                      <div class="pic">
                                          <img src="{{asset('img/keymember4.png')}}" alt="">
                                      </div>
                                      <ul class="social">
                                          <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                          <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                          <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                          <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                      </ul>
                                      <div class="team-content">
                                          <h3 class="title">Shri.S.V.Tele</h3>
                                          <span class="post">Principal</span>
                                          <!-- <p class="description">
                                              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar feugiat fermentum. Donec efficitur posuere eros, vitae placerat.
                                          </p> -->
                                      </div>
                                  </div>
                              </div>


                          </div>
                      </div>

                      </div>
                  </div>
              </div>






          </div>
      </div>
    </div>
    <br>
    </div>


  <!-- Key Members End-->




 <!-- Topper Start-->
  <div class="demo">
    <div class="form-bg">

      <div class="container">
          <div class="row">

              <div class="col-md-offset-3 col-md-12">
                  <div class="form-container">

                      <div class="form-icon">
                          <i class="fa fa-rocket"></i>
                      </div>
                      <div class="form-horizontal">
                        <h1 class="text-center pt-5 pb-5"> <u>Academic Toppers</u> </h1>
                        <div class="container">
                          <div class="row">
                              <div class="col-md-4 col-sm-6">
                                  <div class="our-team">
                                      <div class="pic">
                                          <img src="{{asset('img/sciTop.png')}}" alt="">
                                      </div>
                                      <ul class="social">
                                          <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                          <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                          <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                          <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                      </ul>
                                      <div class="team-content">
                                          <h3 class="title">Ashfiya Shaikh</h3>
                                          <span class="post">H.S.C.Topper from Science Faculty : 85.38%  Year 2020</span>

                                      </div>
                                  </div>
                              </div>

                              <div class="col-md-4 col-sm-6">
                                  <div class="our-team">
                                      <div class="pic">
                                          <img src="{{asset('img/comTop.png')}}" alt="">
                                      </div>
                                      <ul class="social">
                                          <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                          <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                          <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                          <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                      </ul>
                                      <div class="team-content">
                                          <h3 class="title">Snehal Khyade</h3>
                                          <span class="post">H.S.C.Topper from Commerce Faculty : 84.76%  Year 2020</span>
                                          <!-- <p class="description">
                                              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar feugiat fermentum. Donec efficitur posuere eros, vitae placerat.
                                          </p> -->
                                      </div>
                                  </div>
                              </div>

                              <div class="col-md-4 col-sm-6">
                                <div class="our-team">
                                    <div class="pic">
                                        <img src="{{asset('img/artTop.png')}}" alt="">
                                    </div>
                                    <ul class="social">
                                        <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                    </ul>
                                    <div class="team-content">
                                        <h3 class="title">Akash Korali</h3>
                                        <span class="post">H.S.C.Topper from Arts Faculty : 84%  Year 2020</span>
                                        <!-- <p class="description">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar feugiat fermentum. Donec efficitur posuere eros, vitae placerat.
                                        </p> -->
                                    </div>
                                </div>
                            </div>

                            <!-- First Row end -->

                              <div class="col-md-4 col-sm-6">
                                  <div class="our-team">
                                      <div class="pic">
                                          <img src="{{asset('img/sciTop2.png')}}" alt="">
                                      </div>
                                      <ul class="social">
                                          <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                          <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                          <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                          <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                      </ul>
                                      <div class="team-content">
                                          <h3 class="title">Varsha Moglai</h3>
                                          <span class="post">H.S.C. Second Topper from Science Faculty : 81.38% Year 2020</span>

                                      </div>
                                  </div>
                              </div>


                              <div class="col-md-4 col-sm-6">
                                <div class="our-team">
                                    <div class="pic">
                                        <img src="{{asset('img/comTop2.png')}}" alt="">
                                    </div>
                                    <ul class="social">
                                        <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                    </ul>
                                    <div class="team-content">
                                        <h3 class="title">Shivangi Arjun</h3>
                                        <span class="post">H.S.C. Second Topper from Commerce Faculty : 78.76%  Year 2020</span>
                                        <!-- <p class="description">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar feugiat fermentum. Donec efficitur posuere eros, vitae placerat.
                                        </p> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                              <div class="our-team">
                                  <div class="pic">
                                      <img src="{{asset('img/artTop2.png')}}" alt="">
                                  </div>
                                  <ul class="social">
                                      <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                      <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                      <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                      <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                  </ul>
                                  <div class="team-content">
                                      <h3 class="title">Bhagyashree Jakune</h3>
                                      <span class="post">H.S.C.Second Topper from Arts Faculty : 82.62%  Year 2020</span>
                                      <!-- <p class="description">
                                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar feugiat fermentum. Donec efficitur posuere eros, vitae placerat.
                                      </p> -->
                                  </div>
                              </div>
                          </div>

                             <!-- second Row end -->


                          <div class="col-md-4 col-sm-6">
                            <div class="our-team">
                                <div class="pic">
                                    <img src="{{asset('img/sciTop3.png')}}" alt="">
                                </div>
                                <ul class="social">
                                    <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                </ul>
                                <div class="team-content">
                                    <h3 class="title">Smita Dongaon</h3>
                                    <span class="post">H.S.C.Third Topper from Science Faculty : 81.25%  Year 2020</span>
                                    <!-- <p class="description">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar feugiat fermentum. Donec efficitur posuere eros, vitae placerat.
                                    </p> -->
                                </div>
                            </div>
                        </div>


                          <div class="col-md-4 col-sm-6">
                              <div class="our-team">
                                  <div class="pic">
                                      <img src="{{asset('img/comTop3.png')}}" alt="">
                                  </div>
                                  <ul class="social">
                                      <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                      <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                      <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                      <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                  </ul>
                                  <div class="team-content">
                                      <h3 class="title">Vaishnavi Deshmukh</h3>
                                      <span class="post">H.S.C. Third Topper from Commerce Faculty : 76.77%   Year 2020</span>

                                  </div>
                              </div>
                          </div>


                          <div class="col-md-4 col-sm-6">
                            <div class="our-team">
                                <div class="pic">
                                    <img src="{{asset('img/artTop3.png')}}" alt="">
                                </div>
                                <ul class="social">
                                    <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                </ul>
                                <div class="team-content">
                                    <h3 class="title">Madhuri Kumthale</h3>
                                    <span class="post">H.S.C.Third Topper from Arts Faculty : 81.54%  Year 2020</span>
                                    <!-- <p class="description">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar feugiat fermentum. Donec efficitur posuere eros, vitae placerat.
                                    </p> -->
                                </div>
                            </div>
                        </div>

                       <!-- SSC Topper Start-->

                        <div class="col-md-4 col-sm-6">
                            <div class="our-team">
                                <div class="pic">
                                    <img src="{{asset('img/sscTop.png')}}" alt="">
                                </div>
                                <ul class="social">
                                    <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                </ul>
                                <div class="team-content">
                                    <h3 class="title">Mendgudle Samruddhi Sanjay</h3>
                                    <span class="post">S.S.C.Topper : 95%  Year 2020</span>
                                    <!-- <p class="description">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar feugiat fermentum. Donec efficitur posuere eros, vitae placerat.
                                    </p> -->
                                </div>
                            </div>
                        </div>



                        <div class="col-md-4 col-sm-6">
                            <div class="our-team">
                                <div class="pic">
                                    <img src="{{asset('img/sscTop2.png')}}" alt="">
                                </div>
                                <ul class="social">
                                    <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                </ul>
                                <div class="team-content">
                                    <h3 class="title">Birajdar Vaishnavi Rajkumar</h3>
                                    <span class="post">S.S.C.Second Topper : 92.80%  Year 2020</span>
                                    <!-- <p class="description">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar feugiat fermentum. Donec efficitur posuere eros, vitae placerat.
                                    </p> -->
                                </div>
                            </div>
                        </div>



                        <div class="col-md-4 col-sm-6">
                            <div class="our-team">
                                <div class="pic">
                                    <img src="{{asset('img/sscTop3.png')}}" alt="">
                                </div>
                                <ul class="social">
                                    <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                </ul>
                                <div class="team-content">
                                    <h3 class="title">Shaikh Saniya Lalsab</h3>
                                    <span class="post">S.S.C.Second Topper : 92.80%  Year 2020</span>
                                    <!-- <p class="description">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar feugiat fermentum. Donec efficitur posuere eros, vitae placerat.
                                    </p> -->
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4 col-sm-6">
                            <div class="our-team">
                                <div class="pic">
                                    <img src="{{asset('img/sscTop4.png')}}" alt="">
                                </div>
                                <ul class="social">
                                    <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                </ul>
                                <div class="team-content">
                                    <h3 class="title">Bagvan Simran Yashin</h3>
                                    <span class="post">S.S.C.Third Topper : 92%  Year 2020</span>
                                    <!-- <p class="description">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar feugiat fermentum. Donec efficitur posuere eros, vitae placerat.
                                    </p> -->
                                </div>
                            </div>
                        </div>




                          </div>
                      </div>

                      </div>
                  </div>
              </div>






          </div>
      </div>
    </div>
    <br>
    </div>

    </section>
  <!-- toppers End-->
 <!-- About us End-->






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


<!-- REQUIRED SCRIPTS -->
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


<!-- Select2 -->
<script> $('#myCarousel').carousel({
  interval: 3000,
})</script>

</body>
</html>