      <!-- ========== tab components start ========== -->
      <section class="tab-components">
        <script src="https://api-maps.yandex.ru/2.1/?apikey=4ee30b78-bb09-45b8-a270-fb4efb6d8880&lang=uz_UZ" type="text/javascript"></script>
        <div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title mb-30">
                  <a  href="{{ route('company.index') }}" class="btn btn-primary" style=" border-color: #fd621e ; background-color: #fd621e ;  display: flex; width: 100px;justify-content: space-between;align-items: center;">
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
                      <li class="breadcrumb-item"><a href="{{ route('company.index') }}">Tashkilotlar</a></li>
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
                <div class="card-style mb-30">
                <form action="{{ route('company.update',$company->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')

                    <div class="input-style-3" style="display: flex; justify-content: space-between">
                      <h2>Tashkilotni O'zgartirish</h2>
                    </div>
                    <div class="input-style-1">
                      <label>Nomi  </label>
                      <input type="text" value="{{ $company->title }}" name="title" placeholder="Name company" />
                      @error('title')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="input-style-1">
                      <label>Manzil  </label>
                      <input type="text" id="addressInput" value="{{ $company->address }}" readonly name="address" placeholder="Xaritadan belgilang " />
                      @error('address')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="input-style-1">
                      <label>Uzunlik</label>
                      <input type="text" id="longitudeInput" name="longitude"  readonly placeholder="Xaritadan belgilang " />
                      @error('longitude')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="input-style-1">
                      <label>Kenglik </label>
                      <input type="text" id="latitudeInput" name="latitude"  readonly placeholder="Xaritadan belgilang " />
                      @error('latitude')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="input-style-1">
                      <label>Rasmlar </label>
                      <input type="file" name="images[]" multiple  />
                    </div>
                    <div class="image m-1 d-flex align-items-end"  style="display:  flex; justify-content: space-between ">
                    <div class="input-style-3" style="display: flex; justify-content: space-between">
                      <button style="padding: 10px 30px" class="main-btn primary-btn btn-hover">O'zgartirish</button>
                    </div>
                  <!-- end col -->
                </form>
                <!-- end card -->
                  <div style=" display: flex ; flex-wrap: wrap ; width: 70%; justify-content: right;">


                    @foreach ($company->images as $image)
                        <img style="height:70px; margin:5px" onclick = "test(`{{ '/images/'.$image->image }}`)" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal" src="{{ '/images/'.$image->image }}" height="100px" alt="">
                        <form action="{{ route('company.show', $image->id) }}" style="justify-content: end" method="GET">
                          @csrf
                          <button class="text-danger fs-5  " style="border: 0 ; background-color: #fff ">
                            <i class="lni lni-trash-can"></i>
                          </button>
                        </form>


                    @endforeach
                  </div>
                  </div>
                </div>
                <div style="height: 600px;" id="mapp"></div>
            </div>
            <!-- end row -->
          </div>
          <!-- ========== form-elements-wrapper end ========== -->
        </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- modal-dialog-centered - ekran o'rtasiga joylash -->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ isset($company->title)? $company->title :'' }}</h5>
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
        <!-- end container -->
        <script>

          ymaps.ready(function () {
              var map = new ymaps.Map('mapp', {
                  center: [41.2995, 69.2401], // Ishlatilayotgan boshlang'ich markaziy koordinatalar
                  zoom: 10 // Ishlatilayotgan boshlang'ich zoom darajasi
              });

          // Foydalanuvchi turish joyini aniqlash
          ymaps.geolocation.get().then(function (res) {
              var userLocation = res.geoObjects.get(0).geometry.getCoordinates();
              map.setCenter(userLocation);

              // Foydalanuvchi turish joyiga marker qo'shish
              var userPlacemark = new ymaps.Placemark(userLocation, {}, { preset: 'islands#blueCircleDotIcon' });
              map.geoObjects.add(userPlacemark);
          });


          var placemark;
          map.events.add('click', function (e) {
              var coords = e.get('coords');

              // Kursor yordamida belgilangan joyga qizil belgi qo'yish
              if (placemark) {
                  map.geoObjects.remove(placemark);
              }
              placemark = new ymaps.Placemark(coords, {}, { preset: 'islands#redIcon' });
              map.geoObjects.add(placemark);

              // Kordinatalarni input elementlarga joylash
              var latitudeInput = document.getElementById('latitudeInput');
              var longitudeInput = document.getElementById('longitudeInput');
              latitudeInput.value = coords[0].toPrecision(6);
              longitudeInput.value = coords[1].toPrecision(6);

              // Manzilni input elementga joylash
              ymaps.geocode(coords).then(function (res) {
                  var address = res.geoObjects.get(0) ? res.geoObjects.get(0).getAddressLine() :''
                  var addressInput = document.getElementById('addressInput');
                  addressInput.value = address;
              });
          });
            });

        </script>
      </section>
      <!-- ========== tab components end ========== -->
