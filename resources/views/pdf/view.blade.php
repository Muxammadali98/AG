<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        table,tr,th,td{
            border: 2px solid;
            border-collapse: collapse;
        }
        table{
            width: 100%
        }   
        h6{
            font-size: 18px
        }

        th,td{
            padding: 0px 20px;
            margin: 0 auto
            
        }
    </style>

</head>
<body>

                @if (!empty($data->first()->title))
                    <table >
                      <thead>
                        <tr>
                          <th>#</th>
                          <th><h6> Guruh nomi</h6></th>
                          <th><h6> Umumiy ishlar</h6></th>
                          <th><h6> Umumiy mijozlar</h6></th>
                          <th><h6> Sotilgan</h6></th>
                        </tr>
                        <!-- end table row-->
                      </thead>
                      <tbody>

                        @foreach ($data as $item)
                          <tr>
                            <td>
                              <h6 class="text-sm">{{ $loop->iteration }}</h6>
                            </td>
                            <td>
                              <p>{{ $item->title }}</p>
                            </td>
                            <td>
                              <p>{{ $item->location_count }}</p>
                            </td>
                            <td>
                              <p>{{ $item->clients_count}}</p>
                            </td>
                            <td>
                                <p>{{ count($item->clients) }}</p>
                            </td>
                          </tr>
                        @endforeach
                        <!-- end table row -->
                      </tbody>
                    </table>
                    <!-- end table -->
                @elseif(!empty($data->first()->name))
                            <table >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><h6> Hodim ismi</h6></th>
                                    <th><h6> Umumiy ishlar</h6></th>
                                    <th><h6> Umumiy mijozlar</h6></th>
                                    <th><h6> Sotilgan</h6></th>
                                </tr>
                                <!-- end table row-->
                                </thead>
                                <tbody>

                                @foreach ($data as $item)
                                    <tr>
                                        <td>
                                            <h6 class="text-sm">{{ $loop->iteration }}</h6>
                                        </td>
                                        <td>
                                            <p>{{ $item->name }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $item->location_count }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $item->clients_count }}</p>
                                        </td>
                                        <td>
                                            <p>{{ count($item->clients) }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- end table row -->
                                </tbody>
                            </table>
                            <!-- end table -->
                @else
                  <h2>
                    Topshiriq Topilmadi
                  </h2>
                @endif

   
    </body>
    </html>