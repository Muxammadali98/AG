
      <!-- ========== table components start ========== -->
      <section class="table-components">
        <div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title mb-30">
                  <h2>Statistika</h2>
                </div>
              </div>
              <!-- end col -->
              <div class="col-md-6">
                <div class="breadcrumb-wrapper mb-30">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="/">Bosh sahifa</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">
                        Statistika
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->

          <!-- ========== tables-wrapper start ========== -->
          <div class="tables-wrapper">

            <div class="row">
              <!-- end col -->
              <div class="col-lg-12">
                <div class="card-style mb-30">
                  <div class="row">
                    <div class="col-6">
                        <h6 class="mb-10">Statistika Jadvali</h6>
{{--                        <a href="{{ route('task.create') }}" style="padding: 5px" class="main-btn primary-btn btn-hover">Topshiriq Qo'shish</a>--}}
                        <div class="d-flex align-content-center">

                        <a style="margin: 10px" href="/" style="padding: 10px 10px" class="main-btn primary-btn btn-hover">Guruhlar</a>
                        <a style="margin: 10px" href="/statistic/2" style="padding: 10px 10px" class="main-btn primary-btn btn-hover">Hodimlar</a>
                        <form style="display: inline-block; margin: 10px"  action="{{ request()->is('/') ? '/download-pdf' : '/download-pdf/2' }}" method="GET" style="display: flex; justify-content: flex-end; flex-direction: column;">
                              <input type="hidden" name="filter" value="{{ request()->query('filter')}}">
                              <input type="hidden" name="text" value="{{$_GET['text']?? ''}}">
                            <button  style="padding:  15px" class="main-btn primary-btn btn-hover d-flex justify-center align-content-center"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                            </svg> <span style="margin-left: 5px">PDF </span></button>
                        </form>
                        </div>

                    </div>

                    <form class="col-6"  action="{{ request()->is('/') ? '/' : '/statistic/2' }}" method="GET" style="display: flex; justify-content: flex-end; flex-direction: column;">

                      <div class="row col-lg-12">

                          <div class="col-xxl-3">
                            <div class="select-style-1">
                              <label> Muddatni Tanlang  </label>
                              <div class="select-position">
                                <select name="filter">
                                  <option {{ request()->query('filter') == '' ? 'selected' : '' }}  value="">Barchasi</option>
                                  <option {{ request()->query('filter') == 1 ? 'selected' : '' }} value="1">1-kunlik</option>
                                  <option {{ request()->query('filter') == 2 ? 'selected' : '' }} value="2">1-hafta</option>
                                  <option {{ request()->query('filter') == 3 ? 'selected' : '' }} value="3">1-oy</option>
                                  <option {{ request()->query('filter') == 4 ? 'selected' : '' }} value="4">1-yillik</option>
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="input-style-1 col-xxl-3">
                              <label>Qidiruv</label>
                              <input type="text" name="text" value="{{$_GET['text']?? ''}}"  placeholder="Qidiruv..." />
                          </div>
                          <input type="hidden" value="{{!empty($data->first()->title)?1:2}}">
                          <div class="col-xxl-3" style="display: flex; align-items: center" >
                            <a href="{{ request()->is('/') ? '/' : '/statistic/2' }}" class="btn btn-secondary"  style="background-color: #4a6cf7; padding: 15px 15px; margin: 5px ">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"></path>
                                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"></path>
                              </svg>
                            </a>
                            <button style="padding: 10px 10px" class="main-btn primary-btn btn-hover">Saralash</button>
                          </div>

                        </div>

                    </form>




                  </div>
                @if (!empty($data->first()->title))
                         <div class="table-wrapper table-responsive">
                    <table class="table striped-table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th><h6> Guruh nomi</h6></th>
                          <th><h6> Umumiy ishlar</h6></th>
                          <th><h6> Umumiy mijozlar</h6></th>
                          <th><h6> Sotilgan</h6></th>
                        </tr>
                        <!-- end table row-->
                      </thead>
                      <tbody>

                        @foreach ($data as $item)
                          <tr>
                            <td>
                              <h6 class="text-sm"># {{ $loop->iteration }}</h6>
                            </td>
                            <td>
                              <p>{{ $item->title }}</p>
                            </td>
                            <td>
                              <p>{{ $item->location_count }}</p>
                            </td>
                            <td>
                              <p>{{ $item->clients_count}}</p>
                            </td>
                            <td>
                                <p>{{ count($item->clients) }}</p>
                            </td>
                          </tr>
                        @endforeach
                        <!-- end table row -->
                      </tbody>
                    </table>
                    <!-- end table -->
                  </div>
                @elseif(!empty($data->first()->name))
                    <div class="table-wrapper table-responsive">
                            <table class="table striped-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><h6> Hodim ismi</h6></th>
                                    <th><h6> Umumiy ishlar</h6></th>
                                    <th><h6> Umumiy mijozlar</h6></th>
                                    <th><h6> Sotilgan</h6></th>
                                </tr>
                                <!-- end table row-->
                                </thead>
                                <tbody>

                                @foreach ($data as $item)
                                    <tr>
                                        <td>
                                            <h6 class="text-sm"># {{ $loop->iteration }}</h6>
                                        </td>
                                        <td>
                                            <p>{{ $item->name }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $item->location_count }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $item->clients_count }}</p>
                                        </td>
                                        <td>
                                            <p>{{ count($item->clients) }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- end table row -->
                                </tbody>
                            </table>
                            <!-- end table -->
                        </div>
                @else
                <div class="input-style-3" style="display: flex; justify-content: center">
                  <h2>
                    Topshiriq Topilmadi
                  </h2>
                </div>
                @endif

                </div>
                <!-- end card -->
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
          <!-- ========== tables-wrapper end ========== -->
        </div>
        <!-- end container -->
      </section>
      <!-- ========== table components end ========== -->
