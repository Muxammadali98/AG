<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon"
      href="/assets/images/favicon.svg"
      type="image/x-icon"
    />



    <title>@yield('title')</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/assets/css/lineicons.css" />
    <link rel="stylesheet" href="/assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="/assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="/assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="/assets/css/main.css" />
    <link rel="stylesheet" href="/build/assets/app-9273b9a5.css">
    <link rel="stylesheet" type="application/json" href="/build/manifest.json">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Add Bootstrap CSS and JavaScript to the head of your HTML file -->
    {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"> --}}


    @livewireStyles()
  </head>
  <body>
    <!-- ======== sidebar-nav start =========== -->
    <aside class="sidebar-nav-wrapper">
      <div class="navbar-logo">
        <a href="/">
          <img src="/assets/images/logo/logo.svg" alt="logo" />
        </a>
      </div>
      <nav class="sidebar-nav">
        <ul>
          <li class="nav-item {{ request()->is('/') || request()->is('2')? 'active' : '' }}">
            <a href="/">
                <span style="{{ request()->is('/') || request()->is('2')? 'color: #4a6cf7;' : '' }}" class="text">Statistika</span>
            </a>
          </li>
          <li class="nav-item {{ request()->is('group')? 'active' : '' }}">
            <a href="{{ route('group.index') }}" >
              <span style="{{ request()->is('group')? 'color: #4a6cf7;' : '' }}" class="text">Guruhlar</span>
            </a>
          </li>
          <li class="nav-item {{ request()->is('moderation')? 'active' : '' }}" >
            <a href="/moderation" >
              <span style="{{ request()->is('moderation')? 'color: #4a6cf7;' : '' }}" class="text">Moderatsiya</span>
            </a>
          </li>
          <li class="nav-item {{ request()->is('city')? 'active' : '' }}">
            <a href="{{ route('city.index') }}">
              <span style="{{ request()->is('city')? 'color: #4a6cf7;' : '' }}" class="text">Shaharlar</span>
            </a>
          </li>
          <li class="nav-item {{ request()->is('worker')? 'active' : '' }}">
            <a href="{{ route('worker.index') }}">
              <span style="{{ request()->is('worker')? 'color: #4a6cf7;' : '' }}" class="text">Hodimlar</span>
            </a>
          </li>
          <li class="nav-item {{ request()->is('task')? 'active' : '' }}">
            <a href="{{ route('task.index') }}">
              <span style="{{ request()->is('task')? 'color: #4a6cf7;' : '' }}" class="text">Topshiriqlar</span>
            </a>
          </li>
          <li class="nav-item {{ request()->is('client')? 'active' : '' }}">
            <a href="{{ route('client.index') }}">
              <span style="{{ request()->is('client')? 'color: #4a6cf7;' : '' }}" class="text">Mijozlar</span>
            </a>
          </li>
          <li class="nav-item {{ request()->is('status')? 'active' : '' }}">
            <a href="{{ route('status.index') }}">
              <span style="{{ request()->is('status')? 'color: #4a6cf7;' : '' }}" class="text">Holatlar(Status)</span>
            </a>
          </li>
          <li class="nav-item {{ request()->is('company')? 'active' : '' }}">
            <a href="{{ route('company.index') }}">
              <span style="{{ request()->is('company')? 'color: #4a6cf7;' : '' }}" class="text">Tashkilotlar</span>
            </a>
          </li>
          <li class="nav-item {{ request()->is('chat')? 'active' : '' }}">
            <a href="{{ route('chat') }}">
              <span style="{{ request()->is('chat')? 'color: #4a6cf7;' : '' }}" class="text">Yozishmalar</span>
            </a>
          </li>
          <li class="nav-item {{ request()->is('notification')? 'active' : '' }}">
            <a href="{{ route('notification.index') }}">
              <span style="{{ request()->is('notification')? 'color: #4a6cf7;' : '' }}" class="text">Bildirishnoma</span>
            </a>
          </li>
        </ul>
      </nav>

    </aside>
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
      <!-- ========== header start ========== -->
      <header class="header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-5 col-md-5 col-6">
              <div class="header-left d-flex align-items-center">
                <div class="menu-toggle-btn mr-20">
                  <button
                    id="menu-toggle"
                    class="main-btn primary-btn btn-hover"
                  >
                    <i class="lni lni-chevron-left me-2"></i> Menu
                  </button>
                </div>
                {{-- <div class="header-search d-none d-md-flex">
                  <form action="#">
                    <input type="text" placeholder="Search..." />
                    <button><i class="lni lni-search-alt"></i></button>
                  </form>
                </div> --}}
              </div>
            </div>
            <div class="col-lg-7 col-md-7 col-6">
              <div class="header-right">
                {{-- <!-- notification start -->
                <div class="notification-box ml-15 d-none d-md-flex">
                  <button
                    class="dropdown-toggle"
                    type="button"
                    id="notification"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    <i class="lni lni-alarm"></i>
                    <span>2</span>
                  </button>
                  <ul
                    class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="notification"
                  >
                    <li>
                      <a href="#0">
                        <div class="image">
                          <img src="/assets/images/lead/lead-6.png" alt="" />
                        </div>
                        <div class="content">
                          <h6>
                            John Doe
                            <span class="text-regular">
                              comment on a product.
                            </span>
                          </h6>
                          <p>
                            Lorem ipsum dolor sit amet, consect etur adipiscing
                            elit Vivamus tortor.
                          </p>
                          <span>10 mins ago</span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#0">
                        <div class="image">
                          <img src="/assets/images/lead/lead-1.png" alt="" />
                        </div>
                        <div class="content">
                          <h6>
                            Jonathon
                            <span class="text-regular">
                              like on a product.
                            </span>
                          </h6>
                          <p>
                            Lorem ipsum dolor sit amet, consect etur adipiscing
                            elit Vivamus tortor.
                          </p>
                          <span>10 mins ago</span>
                        </div>
                      </a>
                    </li>
                  </ul>
                </div>
                <!-- notification end --> --}}


                @livewire('notifikation')


                {{-- <!-- filter start -->
                <div class="filter-box ml-15 d-none d-md-flex">
                  <button class="" type="button" id="filter">
                    <i class="lni lni-funnel"></i>
                  </button>
                </div>
                <!-- filter end --> --}}
                <!-- profile start -->
                <div class="profile-box ml-15">
                  <button
                    class="dropdown-toggle bg-transparent border-0"
                    type="button"
                    id="profile"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    <div class="profile-info">
                      <div class="info">
                        <h6>{{ auth()->user()->name }}</h6>
                        <div class="image">
                          <img
                              style="width: 42px; height: 42px"
                            src="{{ auth()->user()->image?'/images/'. auth()->user()->image : '/images/profile-icon.png' }}"
                            alt=""
                          />
                          <span class="status"></span>
                        </div>
                      </div>
                    </div>
                    <i class="lni lni-chevron-down"></i>
                  </button>
                  <ul
                    class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="profile"
                  >
                    <li>
                      <a href="/profile">
                        <i class="lni lni-user"></i> Shaxsiy ma'lumotlar
                      </a>
                    </li>

                    <li>

                        <button style="display: block; width: 100%; background: none; border: none "  data-bs-toggle="modal" data-bs-target="#logoutModal">
                          <a> <i class="lni lni-exit"></i> Chiqish </a>
                        </button>
                    </li>
                  </ul>
                </div>
                <!-- profile end -->
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- ========== header end ========== -->

        @yield('content')

      <!-- ========== footer start =========== -->
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 order-last order-md-first">
              <div class="copyright text-center text-md-start">
                <p class="text-sm">
                  Designed and Developed by
                  <a
                    href="https://plainadmin.com"
                    rel="nofollow"
                    target="_blank"
                  >

                  </a>
                </p>
              </div>
            </div>
            <!-- end col-->
            <div class="col-md-6">
              <div
                class="
                  terms
                  d-flex
                  justify-content-center justify-content-md-end
                "
              >
                <a href="#0" class="text-sm"> Company Find Work</a>
              </div>
            </div>
          </div>
          <!-- end row -->
        </div>
        <!-- end container -->

          <!-- Modal -->
          <div class="modal fade " id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- modal-dialog-centered - ekran o'rtasiga joylash -->
                  <div class="modal-content" style="width: 300px; margin: 0 auto">
                      <div class="modal-header">
                          <h5 class="modal-title " id="exampleModalLabel">{{ "Ma'lumotni o'chirilsinmi?" }}</h5>
{{--                          <button type="button"  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
                      </div>
                      <div  class="action d-flex justify-content-end ">
                          <button data-bs-dismiss="modal" class="text-danger fs-5 m-2 ">
                              <span class="badge rounded-pill bg-gray-500" style="font-size: 15px">Yopish</span>
                          </button>
                          <form action="" id="deleteItem" method="POST" class=" m-2">
                              @csrf
                              @method('DELETE')
                              <button class="text-danger fs-5">
                                  <span class="badge rounded-pill bg-danger " style="font-size: 15px">O'chirish</span>
                              </button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>


          <div class="modal fade " id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- modal-dialog-centered - ekran o'rtasiga joylash -->
                  <div class="modal-content" style="width: 300px; margin: 0 auto">
                      <div class="modal-header">
                          <h5 class="modal-title " id="exampleModalLabel">{{ "Xisobdan chiqmoqchimisiz?" }}</h5>
{{--                          <button type="button"  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
                      </div>
                      <div  class="action d-flex justify-content-end ">
                          <button data-bs-dismiss="modal" class="text-danger fs-5 m-2 ">
                              <span class="badge rounded-pill bg-gray-500" style="font-size: 15px">Yopish</span>
                          </button>
                          <form action="{{route('logout')}}" id="deleteItem" method="POST" class=" m-2">
                              @csrf
                              <button class="text-danger fs-5">
                                  <span class="badge rounded-pill bg-danger " style="font-size: 15px">Chiqish</span>
                              </button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </footer>
      <!-- ========== footer end =========== -->
    </main>
    <!-- ======== main-wrapper end =========== -->

    <!-- ========= All Javascript files linkup ======== -->
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/Chart.min.js"></script>
    <script src="/assets/js/dynamic-pie-chart.js"></script>
    <script src="/assets/js/moment.min.js"></script>
    <script src="/assets/js/fullcalendar.js"></script>
    <script src="/assets/js/jvectormap.min.js"></script>
    <script src="/assets/js/world-merc.js"></script>
    <script src="/assets/js/polyfill.js"></script>
    <script src="/assets/js/main.js"></script>
    <script src="/livewire/livewire.js"></script>

    <script src="/build/assets/app-a1256489.js"></script>



   


    <script>

      function test(url){

        let modalImage = document.getElementById('imageModal');
        modalImage.src = url;
      }
      function ochirish(data){

        let deleteItem = document.getElementById('deleteItem');
          deleteItem.action = data;
      }

      

    </script>
     @livewireScripts
  </body>
</html>
