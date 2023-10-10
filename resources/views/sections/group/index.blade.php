
      <!-- ========== table components start ========== -->
      <section class="table-components">
        <div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Groups</h2>
                </div>
              </div>
              <!-- end col -->
              <div class="col-md-6">
                <div class="breadcrumb-wrapper mb-30">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="#0">Bosh sahifa</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">
                        Guruhlar
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
                  <h6 class="mb-10">Guruhlar Jadvali</h6>
                  <a href="{{ route('group.create') }}" style="padding: 5px" class="main-btn primary-btn btn-hover"
                  >Guruh Qo'shish</a>

                @if (!empty($groups->all()))
                         <div class="table-wrapper table-responsive">
                    <table class="table striped-table">
                      <thead>
                        <tr>
                          <th></th>
                          <th><h6>Nomi</h6></th>
                          <th><h6>Hodimlar soni</h6></th>
                          <th><h6>Topshiriqlar soni</h6></th>
                          <th><h6>O'zgartirish </h6></th>
                          <th><h6>O'chirish</h6></th>
                        </tr>
                        <!-- end table row-->
                      </thead>
                      <tbody>

                        @foreach ($groups as $group)
                        @php
                           static $i=0;
                            $i++;
                        @endphp
                          <tr>
                            <td>
                              <h6 class="text-sm">#{{ $i }}</h6>
                            </td>
                            <td>
                              <p>{{ $group->title }}</p>
                            </td>
                            <td>
                              <p>{{ count($group->workers) }}</p>
                            </td>
                            <td>
                              <p>{{ count($group->tasks) }}</p>
                            </td>
                            <td>
                              <div class="action">

                                <a href="{{ route('group.edit', $group->id) }}" class="text-warning fs-5  ">
                                  <span class="badge rounded-pill bg-success"style="font-size: 14px">O'zgartirish</span>
                                </a>
                              </div>
                              </td>
                              <td>
                                <div class="action">
                                    <button onclick = "ochirish(`{{ route('group.destroy', $group->id) }}`)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-danger fs-5">
                                        <span class="badge rounded-pill bg-danger" style="font-size: 15px">O'chirish</span>
                                    </button>
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
                    Guruh Topilmadi
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
