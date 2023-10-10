
      <!-- ========== table components start ========== -->
      <section class="table-components">
        <div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title mb-30">
                  <h2>Tashkilot</h2>
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
                        Tashkilot
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
                  <h6 class="mb-10">Tashkilotlar Jadvali</h6>
                  <a href="{{ route('company.create') }}" style="padding: 5px" class="main-btn primary-btn btn-hover">Tashkilot Qo'shish</a>
                @if (!empty($companies->all()))
                         <div class="table-wrapper table-responsive">
                    <table class="table striped-table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th><h6>Tashkilot Nomi</h6></th>
                          <th><h6>Manzil</h6></th>
                          <th><h6>Rasmlar</h6></th>


                          <th><h6>O'zgartirish</h6></th>

                          <th><h6>O'chirish</h6></th>
                        </tr>
                        <!-- end table row-->
                      </thead>
                      <tbody>

                        @foreach ($companies as $company)
                        @php
                           static $i=0;
                            $i++;
                        @endphp
                          <tr>
                            <td>
                              <h6 class="text-sm">#{{ $i }}</h6>
                            </td>
                            <td>
                              <p>{{ $company->title }}</p>
                            </td>
                            <td>
                              <p>{{ $company->address }}</p>
                            </td>
                            <td>
                              <div class="product">
                                <div class="image m-1" style="display: flex; flex-wrap: wrap ; width: 70%; justify-content: center">
                                  @foreach ($company->images as $image)
                                  <button onclick = "test(`{{ '/images/'.$image->image }}`)" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal">


                                    <img style="height: 70px; margin:5px"    src="{{ '/images/'.$image->image }}" alt="">
                                  </button>
                                  @endforeach
                                </div>
                              </div>
                            </td>

                            <td>
                              <div class="action">

                                <a href="{{ route('company.edit', $company->id) }}" class="text-warning fs-5  ">
                                  <span class="badge rounded-pill bg-success"style="font-size: 14px">O'zgartirish</span>
                                </a>
                              </div>
                              </td>
                              <td>
                                <div class="action">
{{--                                <form action="{{ route('company.destroy', $company->id) }}" method="POST">--}}
{{--                                  @csrf--}}
{{--                                  @method('DELETE')--}}
                                  <button onclick = "ochirish(`{{ route('company.destroy', $company->id) }}`)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-danger fs-5">
                                    <span class="badge rounded-pill bg-danger" style="font-size: 15px">O'chirish</span>
                                  </button>
{{--                                </form>--}}
                              </div>
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
                    Tashkilot Topilmadi
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

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- modal-dialog-centered - ekran o'rtasiga joylash -->
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ isset($company->title)? $company->title : '' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" style="display: flex; justify-content: center; align-items: center">
                <img id="imageModal" style=" object-fit: cover; margin:5px" src="" alt="">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- ========== table components end ========== -->
