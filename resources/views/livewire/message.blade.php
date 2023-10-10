
<div>
    <section style="table-components">
      <div class="container py-5">

        <div class="row">

          <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">


            <div class="card">
              <div class="card-body">
                <h5 class="font-weight-bold mb-3 text-center text-lg-start">Hodimlar</h5>

                <ul class="list-unstyled mb-0" style="height: 540px; overflow-y:auto">
                  {{-- <li class="p-2 border-bottom" style="background-color: #eee;">
                    <a href="#!" class="d-flex justify-content-between">
                      <div class="d-flex flex-row">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-8.webp" alt="avatar"
                          class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                        <div class="pt-1">
                          <p class="fw-bold mb-0">John Doe</p>
                          <p class="small text-muted">Hello, Are you there?</p>
                        </div>
                      </div>
                      <div class="pt-1">
                        <p class="small text-muted mb-1">Just now</p>
                        <span class="badge bg-danger float-end">1</span>
                      </div>
                    </a>
                  </li> --}}

                  @if(empty($chats->all()))
                    <li class="p-2 border-bottom" style="background-color: #eee;">
                      <a href="#!" class="d-flex justify-content-between">
                        <div class="d-flex flex-row">
                          <div class="pt-1">
                            <p class="fw-bold mb-0">Yozishmalar mavjud emas</p>
                            <p class="small text-muted">Hello, Are you there?</p>
                          </div>
                        </div>
                      </a>
                    </li>
                  @endif

                  @foreach ($chats as $chat)
                      <li class="p-2 border-bottom">
                        <a href="#"   wire:click="getMessage({{ $chat->id }})" class="d-flex justify-content-between">
                          <div class="d-flex flex-row">
                            <img style="height:60px; width:60px"  src="{{ !empty($chat->worker->image)?'/images/'. $chat->worker->image : '/assets/images/profile/man.png' }}" alt="avatar"
                              class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                            <div class="pt-1">
                              <div style="display: flex">

                                <p style="margin-right: 15px" class="fw-bold mb-0">{{ $chat->worker->name }}</p>
                                <p style="font-size: 10px; color: rgb(150, 150, 135)">{{ $chat->messages->last()->created_at->format('d M') }}</p>
                              </div>
                              <p class="small text-muted">{{ substr($chat->messages->last()->text, 0,30 ) }}</p>
                            </div>
                          </div>
                          <div class="pt-1">
                            <p class="small text-muted mb-1">{{ $chat->messages->last()->created_at->format('H:i') }}</p>
                            <span class="badge bg-danger float-end">{{ $chat->message}}</span>
                          </div>
                        </a>
                      </li>
                  @endforeach

                </ul>

              </div>
            </div>

          </div>

          @if (!empty($messages))
            <div class="col-md-6 col-lg-7 col-xl-8">

              <ul class="list-unstyled " style="height: 500px; overflow-y:auto">




                  @foreach ($messages as $message)


                  @if ($message->user_id)


                      <li  id="{{ $message->id }}" class="d-flex justify-content-between mb-4">
                        <div class="card w-100">
                          <div class="card-header d-flex justify-content-between p-3">
                            <p class="text-muted small mb-0"><i class="far fa-clock"></i> {{ $message->created_at->format('H:i') }}</p>
                            <p class="fw-bold mb-0">{{ $message->user->name }}</p>
                          </div>
                          <div class="card-body">
                            <p class="mb-0 d-flex justify-content-end">
                              {{ $message->text }}
                            </p>
                          </div>
                        </div>
                        <img style="height:60px; width:60px" src="{{ $message->user->image?'/images/'.$message->user->image : '/assets/images/profile/man.png' }}" alt="avatar"
                          class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
                      </li>

                  @else

                      <li  id="{{ $message->id }}" class="d-flex justify-content-start mb-4">


                        <img style="height:60px; width:60px" src="{{  !empty($message->chat->worker->image)?'/images/'.$message->chat->worker->image : '/assets/images/profile/man.png' }}" alt="avatar"
                          class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" height="60px" width="60">
                        <div class="card w-100">
                          <div class="card-header d-flex justify-content-between p-3">
                            <p class="fw-bold mb-0">{{ $message->chat->worker->name }}</p>
                            <p class="text-muted small mb-0"><i class="far fa-clock"></i> {{ $message->created_at->format('H:i') }}</p>
                          </div>
                          <div class="card-body">
                            <p class="mb-0">
                              {{ $message->text }}
                            </p>
                          </div>
                        </div>
                      </li>

                  @endif
                  @endforeach
              </ul>
                <form wire:submit.prevent="addMessage">
                  @csrf
                  <div class="form-outline">
                    <textarea class="form-control" required style="resize: none" id="textAreaExample2" rows="4" wire:model="text"  placeholder="Message" ></textarea>
                  </div>
                  @error('text')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror

                  <button id="form" class="btn btn-info btn-rounded float-end m-2 ">

                    Send
                  </button>
                </form>
                <a href="#{{ $messages->last()->id}}" id="ok"></a>
            </div>
          @else
            <div class="col-md-6 col-lg-7 col-xl-8 " style="display: flex; justify-content: center; align-items: center; flex-direction: column; border:2px solid rgb(199, 191, 191); border-radius: 10px">
              <img src="/assets/images/logo/chat.svg" alt="">
              <h1> Hozircha Xabarlar mavjud emas,  Iltimos chatni Tanlang</h1>
            </div>
          @endif

        </div>
    </section>


    <script>

      document.addEventListener('livewire:load', function () {
          Livewire.on('eventChat', function () {
            let o = document.getElementById('ok');
            o.click()
          });
      });

      // function up(){
      //   let o = document.getElementById('ok');
      //     o.click()
      // }
    </script>
</div>
