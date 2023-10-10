
      <!-- ========== table components start ========== -->
      <section class="table-components">
        <div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title mb-30">
                  <h2>Topshiriqlar</h2>
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
                        Topshiriqlar
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
                        <h6 class="mb-10">Topshiriqlar Jadvali</h6>
                        <a href="{{ route('task.create') }}" style="padding: 5px" class="main-btn primary-btn btn-hover">Topshiriq Qo'shish</a>
                    </div>

                    <form class="col-6"  action="{{ route('filterTask') }}" method="GET" style="display: flex; justify-content: flex-end; flex-direction: column;">

                      @csrf


                      <div class="row col-lg-12">

                          <div class="col-xxl-3">
                            <div class="select-style-1">
                              <label> Guruhlar  </label>
                              <div class="select-position">
                                <select name="group_id">
                                  <option value="">Barchasi</option>
                                  @foreach ($groups as $group)
                                  <option {{ !empty($_GET['group_id'])&&$_GET['group_id']==$group->id? 'selected':'' }} value="{{ $group->id }}">{{ $group->title }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="col-xxl-3">
                            <div class="select-style-1">
                              <label>Compony</label>
                              <div class="select-position">
                                <select name="company_id">
                                  <option value="">Barchasi</option>
                                  @foreach ($companies as $compony)
                                  <option {{ !empty($_GET['company_id'])&&$_GET['company_id']==$compony->id? 'selected':'' }} value="{{ $compony->id }}">{{ $compony->title }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="col-xxl-3">
                            <div class="select-style-1">
                              <label>Status</label>
                              <div class="select-position">
                                <select name="status_id">
                                  <option value="">Barchasi</option>
                                  <option {{ !empty($_GET['status_id'])&&$_GET['status_id']==1? 'selected':'' }} value="{{ 1 }}">Tugatilgan</option>
                                  <option {{ isset($_GET['status_id'])&&$_GET['status_id']==0? 'selected':'' }} value="{{ 0 }}">Tugatilamagan</option>
                                </select>
                              </div>
                            </div>
                          </div>


                          <div class="col-xxl-3" style="display: flex; align-items: center" >
                            <a href="/task" class="btn btn-secondary"  style="background-color: #4a6cf7; padding: 15px 15px; margin: 5px ">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"></path>
                                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"></path>
                              </svg>
                            </a>
                            <button style="padding: 10px 30px" class="main-btn primary-btn btn-hover">Saralash</button>
                          </div>


                        </div>

                    </form>


                  </div>
                @if (!empty($tasks->all()))
                         <div class="table-wrapper table-responsive">
                    <table class="table striped-table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th><h6> Guruhlar</h6></th>
                          <th><h6> Tashkilotlar</h6></th>
                          <th><h6> Sana</h6></th>
                          <th><h6> Status</h6></th>

                          <th><h6>Batafsil </h6></th>

                          <th><h6> O'chirish</h6></th>
                        </tr>
                        <!-- end table row-->
                      </thead>
                      <tbody>

                        @foreach ($tasks as $task)
                        @php
                           static $i=0;
                            $i++;
                        @endphp
                          <tr>
                            <td>
                              <h6 class="text-sm">#{{ $i }}</h6>
                            </td>
                            <td>
                              <p>{{ $task->group->title }}</p>
                            </td>
                            <td>
                              <p>{{ $task->company->title }}</p>
                            </td>
                            <td>
                              <p>{{ $task->date }}</p>
                            </td>
                            <td>
                              @if ($task->status)
                                <span class="badge bg-success">Tugatilgan</span>
                              @else
                                <span class="badge bg-warning text-dark">Tugatilmagan</span>
                              @endif
                            </td>
                            <td>
                              <div class="action">
                                <a href="{{ route('task.edit', $task->id) }}" class="text-warning fs-5  ">
                                  <span class="badge rounded-pill primary-btn" style="font-size: 14px">Batafsil</span>
                                </a>
                              </div>
                            </td>
                            <td>
                              <div class="action">
                                    <button onclick = "ochirish(`{{ route('task.destroy', $task->id) }}`)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-danger fs-5">
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
