      <!-- ========== tab components start ========== -->
      <section class="tab-components">
        <div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title mb-30">
                  <a  href="{{ route('task.index') }}" class="btn btn-primary" style=" border-color: #fd621e ; background-color: #fd621e ;  display: flex; width: 100px;justify-content: space-between;align-items: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"></path>
                      <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"></path>
                    </svg>
                    Ortga
                  </a>
                </div>
              </div>
              <!-- end col -->
              <div class="col-md-6">
                <div class="breadcrumb-wrapper mb-30">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="{{ route('group.index') }}">Bosh sahifa</a>
                      </li>
                      <li class="breadcrumb-item"><a href="{{ route('task.index') }}">Topshiriqlar</a></li>
                      <li class="breadcrumb-item active" aria-current="page">
                        O'zgartirish
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

          <!-- ========== form-elements-wrapper start ========== -->
          <div class="form-elements-wrapper">
            <div class="row">
              <div class="col-lg-12">
                <!-- input style start -->
                <form action="{{ route('task.update',$task->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="card-style mb-30">
                    <div class="input-style-3" style="display: flex;   justify-content: space-between">
                      <h2>Topshiriqni O'zgartirish</h2>
                      <button style="padding: 10px 30px" class="main-btn primary-btn btn-hover">O'zgartirish</button>
                    </div>
                    <div class="row">
                      <div class="col-xxl-4">
                        <div class="select-style-1">
                          <label>Guruh</label>
                          <div class="select-position">
                            <select name="group_id">
                              @foreach ($groups as $group)
                              <option {{ $task->group_id == $group->id?'selected':'' }} value="{{ $group->id }}">{{ $group->title }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-xxl-4">
                        <div class="select-style-1">
                          <label>Tashkilot</label>
                          <div class="select-position">
                            <select name="company_id">
                              @foreach ($companies as $compony)
                              <option {{ $task->company_id == $compony->id?'selected':'' }} value="{{ $compony->id }}">{{ $compony->title }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-xxl-4">
                        <div class="input-style-1">
                          <label>Sana</label>
                          <input type="date" value="{{ $task->date }}" name="date"  />
                          @error('date')
                              <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>

                    </div>
                    <div class="row">
                      <div class="col-xxl-4" >

                        <label for="">Tugatilgan </label>
                        <input {{ $task->status == 1?'checked':'' }} value="1" type="checkbox" name="status">
                      </div>
                      <div class="col-xxl-4">
                                <b> Tashkilot manzili</b>
                            <label for="">{{ $task->company->address}}</label>

                      </div>
                    </div>


                  </div>
                  <!-- end col -->




                </form>
                <!-- end card -->

                <h6>Bajarganlar</h6>
                <div class="card-style mb-30">
                  <div class="table-wrapper table-responsive">
                    @if(!empty($task->locations->all()))
                    <table class="table striped-table">
                      <thead>
                        <tr>
                          <th></th>
                          <th><h6>Hodim</h6></th>
                          <th><h6>Kelgan Manzil</h6></th>
                          <th><h6>Suratlar</h6></th>


                        </tr>
                        <!-- end table row-->
                      </thead>
                      <tbody>
                        @foreach ($task->locations as $client)

                          <tr>
                            <td>
                              {{-- <div class="check-input-primary">
                                <input name="clients[]"
                                value="{{ $client->id }}"
                                  class="form-check-input"
                                  type="checkbox"
                                  checked
                                  id="checkbox-1"
                                />
                              </div> --}}
                            </td>
                            <td>
                              <p>{{ $client->worker->name }}</p>
                            </td>
                            <td>
                              <p>{{ $client->address }}</p>
                            </td>

                            <td>
                              <div class="product">
                                <div class="image m-1" style="display: flex; flex-wrap: wrap ; width: 70%; justify-content: center">
                                  @foreach ($client->worker->images as $image)
                                    <img style="height:50px; margin:5px" onclick = "test(`{{ '/images/'.$image->image }}`)"  data-bs-toggle="modal" data-bs-target="#exampleModal" src="{{ '/images/'.$image->image }}" height="50px" alt="">
                                  @endforeach
                                </div>
                              </div>
                            </td>


                            {{-- <td>
                              <div class="action">
                                <button class="text-danger">
                                  <i class="lni lni-trash-can"></i>
                                </button>
                              </div>
                            </td> --}}
                          </tr>

                        @endforeach

                      </tbody>
                    </table>
                    @else

                    <div class="input-style-3" style="display: flex; justify-content: center">
                      <h2>
                        Bajarganlar Mavjud emas
                      </h2>
                    </div>
                    @endif
                    <!-- end table -->
                  </div>
                </div>



                <h6>Mijozlar</h6>
                <div class="card-style mb-30">
                  <div class="table-wrapper table-responsive">
                    @if(!empty($task->clients->all()))
                    <table class="table striped-table">
                      <thead>
                        <tr>
                          <th></th>
                          <th><h6>Nomi</h6></th>
                          <th><h6>Holat</h6></th>
                          <th><h6>Tel Raqami</h6></th>
                          <th><h6>Izoh</h6></th>
                        </tr>
                        <!-- end table row-->
                      </thead>
                      <tbody>
                        @foreach ($task->clients as $client)

                          <tr>
                            <td>
                              {{-- <div class="check-input-primary">
                                <input name="clients[]"
                                value="{{ $client->id }}"
                                  class="form-check-input"
                                  type="checkbox"
                                  checked
                                  id="checkbox-1"
                                />
                              </div> --}}
                            </td>
                            <td>
                              <p>{{ $client->title }}</p>
                            </td>
                            <td>
                              <p>{{ $client->status->title }}</p>
                            </td>
                            <td>
                              <p>{{ $client->phone }}</p>
                            </td>
                            <td>
                              <p>{{ $client->comment }}</p>
                            </td>
                            {{-- <td>
                              <div class="action">
                                <button class="text-danger">
                                  <i class="lni lni-trash-can"></i>
                                </button>
                              </div>
                            </td> --}}
                          </tr>

                        @endforeach

                      </tbody>
                    </table>
                    @else

                    <div class="input-style-3" style="display: flex; justify-content: center">
                      <h2>
                        Mijozlar Mavjud emas
                      </h2>
                    </div>
                    @endif
                    <!-- end table -->
                  </div>
                </div>

            </div>
            <!-- end row -->
          </div>
          <!-- ========== form-elements-wrapper end ========== -->
        </div>
        <!-- end container -->

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- modal-dialog-centered - ekran o'rtasiga joylash -->
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">{{ isset($group->title)? $group->title : ''; }}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="display: flex; justify-content: center; align-items: center">
                  <img id="imageModal" style=" object-fit: cover margin:5px" src="" alt="">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
      </section>
      <!-- ========== tab components end ========== -->
