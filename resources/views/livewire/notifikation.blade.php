<div>
                    <!-- message start -->
                    <div class="header-message-box ml-15 d-none d-md-flex">
                        <button
                          class="dropdown-toggle"
                          type="button"
                          id="message"
                          data-bs-toggle="dropdown"
                          aria-expanded="false"
                        >
                        <i class="lni lni-envelope"></i>
                        @empty(!$count)


                          <span>{{  $count }}</span>
                          @endempty
                        </button>




                        <ul
                          class="dropdown-menu dropdown-menu-end"
                          aria-labelledby="message"
                        >@if($count)
                        @foreach ($notifi as $chat)
                          <li>
                            <a wire:clik="$refresh"  href="/chat?id={{ $chat->id }}">
                              <div class="image">
                                <img src="{{!empty($chat->worker->image)?'/images/'. $chat->worker->image : '/assets/images/profile/man.png' }}" alt="" />
                              </div>
                              <div class="content">
                                <h6>{{ $chat->worker->name }}</h6>
                                <p>{{ $chat->messages->last()->text }}</p>
                                <span>{{ $chat->messages->last()->created_at->format('H:i') }}</span>
                                <span style="color: #fff" class="badge bg-danger float-end">{{ $chat->message}}</span>
                              </div>
                            </a>
                          </li>
                        @endforeach
                        @else
                            <li>
                                <p>Habar Mavjud Emas!</p>
                            </li>
                        @endif
                        </ul>
                      </div>
                      <!-- message end -->
</div>
