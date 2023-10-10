      <!-- ========== section start ========== -->
      <section class="section">
        <div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="titlemb-30">
                  <a  href="{{  url()->previous()}}" class="btn btn-primary" style=" border-color: #fd621e ; background-color: #fd621e ;  display: flex; width: 100px;justify-content: space-between;align-items: center;">
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
                        <a href="/">Bosh sahifa</a>
                      </li>
                      <li class="breadcrumb-item"><a href="{{ route('worker.index') }}">Hodimlar</a></li>
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

          <div class="row">
            <div class="col-lg-12">
              <div class="card-style settings-card-1 mb-30  ">
                <div
                  class="
                    title
                    mb-30
                    d-flex
                    justify-content-between
                    align-items-center
                  "
                >
                <h2>Hodimni O'zgartirish</h2>

                </div>
                <div class="profile-info">
                    <form action="{{ route('worker.update', $worker->id) }}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        @method('PUT')
                        <div class="d-flex align-items-center mb-30">
                            <div class="profile-image">
                            <img style="height: 75px; width: 75px" src="{{ $worker->image?'/images/'. $worker->image : '/assets/images/profile/man.png' }}" alt="" />
                            <div class="update-image">
                                <input name="image" type="file" id="image"/>
                                <label for="image"
                                ><i class="lni lni-cloud-upload"></i
                                ></label>
                            </div>
                            </div>
                            <div class="profile-meta">
                            <h5 class="text-bold text-dark mb-10">{{ $worker->name }}</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-style-1">
                                    <label>Ism*</label>
                                    <input
                                    name="name"
                                    type="text"
                                    value="{{ $worker->name }}"
                                    />
                                </div>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-style-1">
                                    <label>Familya*</label>
                                    <input
                                    name="surname"
                                    type="text"
                                    value="{{ $worker->surname }}"
                                    />
                                </div>
                                @error('surname')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-style-1">
                                    <label>Foydalanuvchi ismi*</label>
                                    <input
                                    name="username"
                                    type="text"
                                    value="{{ $worker->username }}"
                                    />
                                </div>
                                @error('username')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="select-style-1">
                                  <label>Guruhlar</label>
                                  <div class="select-position">
                                    <select name="group_id" class="light-bg">
                                      <option value=""> Bosh </option>
                                      @foreach ($groups as $group)

                                      <option {{ $group->id == $worker->group_id?'selected':'' }} value="{{ $group->id }}">{{ $group->title }}</option>

                                      @endforeach
                                    </select>
                                  </div>
                                    @error('group_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input-style-1">
                                    <label>Parol</label>
                                    <input
                                    name="password"
                                    type="password" />
                                </div>
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <div class="select-style-1">
                                  <label>Shaxar</label>
                                  <div class="select-position">
                                    <select name="city_id" class="light-bg">
                                      @foreach ($cities as $city)

                                      <option {{ $city->id == $worker->city_id?'selected':'' }} value="{{ $city->id }}">{{ $city->name }}</option>

                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                @error('city_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-style-1">
                                    <label>Manzili*</label>
                                    <input
                                    name="address"
                                    type="text"
                                    value="{{ $worker->address }}"
                                    />
                                </div>
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="select-style-1">
                                  <label>Holati*</label>
                                  <div class="select-position">
                                    <select name="status" class="light-bg">
                                      <option value=1>Tekshirilgan</option>

                                      <option {{ 0 == $worker->status?'selected':'' }} value="0">Tekshirilmagan</option>

                                    </select>
                                  </div>
                                </div>
                                @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="select-style-1">
                                  <label>Lavozimi*</label>
                                  <div class="select-position">
                                    <select name="job_title" class="light-bg">
                                      <option value=1>Sardor</option>

                                      <option {{ 0 == $worker->job_title?'selected':'' }} value=0>Hodim</option>

                                    </select>
                                  </div>
                                </div>
                                @error('job_title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-style-1" style="display: flex; justify-content: right; margin-top: 70px ">
                                    <button style="padding: 10px 30px" class="main-btn primary-btn btn-hover">O'zgarishlarni Saqlash</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
              <!-- end card -->
            </div>
            <!-- end col -->
            {{--
            <div class="col-lg-6">
              <div class="card-style settings-card-2 mb-30">
                <div class="title mb-30">
                  <h6>My Profile</h6>
                </div>
                <form action="#">
                  <div class="row">
                    <div class="col-12">
                      <div class="input-style-1">
                        <label>Full Name</label>
                        <input type="text" placeholder="Full Name" />
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="input-style-1">
                        <label>Email</label>
                        <input type="email" placeholder="Email" />
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="input-style-1">
                        <label>Company</label>
                        <input type="text" placeholder="Company" />
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="input-style-1">
                        <label>Address</label>
                        <input type="text" placeholder="Address" />
                      </div>
                    </div>
                    <div class="col-xxl-4">
                      <div class="input-style-1">
                        <label>City</label>
                        <input type="text" placeholder="City" />
                      </div>
                    </div>
                    <div class="col-xxl-4">
                      <div class="input-style-1">
                        <label>Zip Code</label>
                        <input type="text" placeholder="Zip Code" />
                      </div>
                    </div>
                    <div class="col-xxl-4">
                      <div class="select-style-1">
                        <label>Country</label>
                        <div class="select-position">
                          <select class="light-bg">
                            <option value="">Select category</option>
                            <option value="">USA</option>
                            <option value="">UK</option>
                            <option value="">Canada</option>
                            <option value="">India</option>
                            <option value="">Bangladesh</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="input-style-1">
                        <label>About Me</label>
                        <textarea placeholder="Type here" rows="6"></textarea>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="main-btn primary-btn btn-hover">
                        Update Profile
                      </button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- end card -->
            </div> --}}
            <!-- end col -->
          </div>
          <!-- end row -->
        </div>
        <!-- end container -->
      </section>
      <!-- ========== section end ========== -->
