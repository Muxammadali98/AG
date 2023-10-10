      <!-- ========== tab components start ========== -->
      <section class="tab-components">
        <div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title mb-30">
                  <a  href="{{ route('notification.index') }}" class="btn btn-primary" style=" border-color: #fd621e ; background-color: #fd621e ;  display: flex; width: 100px;justify-content: space-between;align-items: center;">
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
                      <li class="breadcrumb-item"><a href="{{ route('notification.index') }}">Bildirishnoma</a></li>
                      <li class="breadcrumb-item active" aria-current="page">
                        Yaratish
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
                <form action="{{ route('storeGroup') }}" method="POST">
                  @csrf

                  <div class="card-style mb-30">
                    <div style="display: flex; align-items: center; justify-content: space-between">
                    <div class="col-xxl-4">
                      <div class="select-style-1">
                        <label>Guruh</label>
                        <div class="select-position">
                          <select name="group_id">
                            @foreach ($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->title }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="input-style-3" style="display: flex; justify-content: right">
                      <button style="padding: 10px 30px" class="main-btn primary-btn btn-hover">Jo'natish</button>
                    </div>
                    <input type="hidden" name="type" value="g">
                    </div>
                    <div class="input-style-1">
                      <label>Bildirishnoma </label>
                      <input type="text" name="text" value="{{old('text')}}" placeholder="Matin" />
                      @error('text')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>


                  </div>
                  <!-- end col -->




                </form>
                <!-- end card -->

            </div>
            <!-- end row -->
          </div>
          <!-- ========== form-elements-wrapper end ========== -->
        </div>
        <!-- end container -->
      </section>
      <!-- ========== tab components end ========== -->
