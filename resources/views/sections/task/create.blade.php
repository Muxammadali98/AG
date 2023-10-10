<!-- ========== tab components start ========== -->
<section class="tab-components">
  <div class="container-fluid">
      <!-- ========== title-wrapper start ========== -->
      <div class="title-wrapper pt-30">
          <div class="row align-items-center">
              <div class="col-md-6">
                  <div class="title mb-30">
                      <a href="{{ route('task.index') }}" class="btn btn-primary"
                         style=" border-color: #fd621e ; background-color: #fd621e ;  display: flex; width: 100px;justify-content: space-between;align-items: center;">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                               class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                              <path fill-rule="evenodd"
                                    d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"></path>
                              <path fill-rule="evenodd"
                                    d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"></path>
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
                              <li class="breadcrumb-item"><a href="{{ route('group.index') }}">Topshiriq</a></li>
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
                  <form action="{{ route('task.store') }}" method="POST">
                      @csrf
                      <div class="card-style mb-30">
                          <div class="input-style-3" style="display: flex; justify-content: space-between">
                              <h2>Topshiriq Yaratish</h2>
                              <button style="padding: 10px 30px" class="main-btn primary-btn btn-hover">Saqlash
                              </button>
                          </div>
                          <div class="row">
                              <div class="col-xxl-4">
                                  <div class="select-style-1">
                                      <label>Guruh</label>

                                      <div class="select-position">
                                          <select name="group_id">
                                              @forelse ($groups as $group)
                                                  <option
                                                      value="{{ $group->id }}">{{ $group->title. " - tugatilmagan topshirig'lari " . count($group->tasks). ' ta'  }}</option>
                                              @empty
                                                  <option>{{ "Iltimos Guruh Qo'shing" }}</option>
                                              @endforelse
                                          </select>
                                      </div>
                                      @empty($groups->all())
                                          <a href="{{ route('group.create') }}" style="padding: 5px"
                                             class="main-btn primary-btn btn-hover m-3">Guruh Qo'shish</a>
                                      @endempty
                                  </div>
                              </div>

                              <div class="col-xxl-4">
                                  <div class="input-style-1">
                                      <label>Sana</label>
                                      <input type="date" name="date" min="{{date('Y-m-d')}}" value="{{old('date')}}"/>
                                      @error('date')
                                      <div class="alert alert-danger">{{ $message }}</div>
                                      @enderror
                                  </div>
                              </div>
                          </div>
                          <div class="card-style mb-30">
                              @if (!empty($companies->all()))
                                  <h6 class="mb-10">Tashkilotni tanlang</h6>
                              @else
                                  <a href="{{ route('company.create') }}" style="padding: 5px"
                                     class="main-btn primary-btn btn-hover m-3">Tashkilot Qo'shish</a>
                              @endif

                              <div class="table-wrapper table-responsive">
                                  @if(!empty($companies->all()))
                                      <table class="table striped-table" style="padding: 5px">
                                          <thead>
                                          <tr>
                                              <th></th>
                                              <th><h6>Tashkilot Nomi</h6></th>
                                              <th><h6>Oxiri marta borilgan sana</h6></th>
                                              <th><h6>Manzil</h6></th>
                                              <th><h6>Rasmlar</h6></th>
                                          </tr>
                                          <!-- end table row-->
                                          </thead>
                                          <tbody>
                                          @foreach ($companies as $company)

                                              @php
                                                  $startTime = \Carbon\Carbon::parse($company->cmae);
                                                 $endTime = \Carbon\Carbon::parse(date('Y-m-d'));

                                                 $time = $endTime->diff($startTime)->h;

                                              @endphp
                                              <tr>
                                                  <td>
                                                      <div class="check-input-primary">
                                                          <input name="company_id[]"
                                                                 value="{{ $company->id }}"
                                                                 class="form-check-input"
                                                                 type="checkbox"
                                                                 id="checkbox-1"
                                                                 style="margin: 10px"
                                                          />
                                                      </div>
                                                  </td>
                                                  <td>
                                                      <p>{{ $company->title }}</p>
                                                  </td>
                                                      <td >
                                                          @if($time <= 30)
                                                              <p style="background-color: yellow; display: inline-block; border-radius: 3px; padding: 5px; color: black   " >{{ $company->come?? "Borilmagan"}}</p>
                                                          @else
                                                              <p style="background-color: green; display: inline-block; border-radius: 3px; padding: 5px; color: white">{{ $company->come?? "Borilmagan"}}</p>
                                                          @endif
                                                      </td>
                                                  <td>
                                                      <p>{{ $company->address }}</p>
                                                  </td>
                                                  <td>
                                                      <div class="product">
                                                          <div class="image m-1"
                                                               style="display: flex; flex-wrap: wrap ; width: 70%; justify-content: center">
                                                              @foreach ($company->images as $image)
                                                                  <button
                                                                      onclick="test(`{{ '/images/'.$image->image }}`)"
                                                                      type="button" data-bs-toggle="modal"
                                                                      data-bs-target="#exampleModal">
                                                                      <img style="height: 70px; margin:5px"
                                                                           src="{{ '/images/'.$image->image }}"
                                                                           alt="">
                                                                  </button>
                                                              @endforeach
                                                          </div>
                                                      </div>
                                                  </td>
                                              </tr>
                                          @endforeach
                                          </tbody>
                                      </table>
                                  @else

                                      <div class="input-style-3" style="display: flex; justify-content: center">
                                          <h2>
                                              Tashkilot Topilmadi
                                          </h2>
                                      </div>
                                  @endif
                                  <!-- end table -->
                              </div>
                          </div>
                          <!-- end card -->
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
  </div>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- modal-dialog-centered - ekran o'rtasiga joylash -->
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">{{ isset($company->title)? $company->title : ''     }}</h5>
                  <button type="button" class="btn-close" style="color: black" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" style="display: flex; justify-content: center; align-items: center">
                  <img id="imageModal" style=" object-fit: cover; margin:5px" src="" alt="">
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" style="color: black" data-bs-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
</section>
<!-- ========== tab components end ========== -->

