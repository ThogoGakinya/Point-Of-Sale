<div class="tabbable" style="background-color: #ffffff;">
    <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
        <li class="active">
            <a data-toggle="tab" href="#home4">New Orders</a>
        </li>

        <li>
            <a data-toggle="tab" href="#profile4">Un-Collected Orders</a>
        </li>

        <li>
            <a data-toggle="tab" href="#dropdown14">Received Quotations&nbsp;<span class="badge badge-warning"></span></a>
        </li>
    </ul>
        @php
          $cnt = 1;
        @endphp
    <div class="tab-content">
        <div id="home4" class="tab-pane in active">
            <table class="customers-actions">
                <thead>
                    <tr>
                    <th>No.</th>
                    <th>Product</th>
                    <th>Toppings</th>
                    <th>Qty</th>
                    <th>Mode</th>
                    <th>Orderd Time</th>
                    <th>Wait Time</th>
                    <th>#Receipt</th>
                    <th>Owner</th>
                    <th>-</th>

                    </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                @php
                    
                    $username = $order->user->name;
                    $array = explode(' ', $username);
                    $created = $order->created_at;
                    $array2 = explode(' ', $created);
                    $today = date("Y-m-d H:i:s");
                    $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $created);
                    $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $today);
                    $diff_in_minutes = $to->diffInMinutes($from);
                @endphp
                    <tr>
                        <td>{{$cnt}}</td>
                        <td>{{$order->product->name}}</td>
                        <td>{{$order->toppings}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->mode}}</td>
                        <td>{{$array2[1]}}</td>
                        <td>{{$diff_in_minutes}} min</td>
                        <td>{{$order->receipt_no}}</td>
                        <td>{{$array[0]}}</td>
                        <td align="center">
                            <a href=""><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    @php
                    $cnt++;
                    @endphp
                @endforeach
                </tbody>
            </table>
        </div>
        {{$orders->links()}}
        <div id="profile4" class="tab-pane">
            <div class="profile-user-info profile-user-info-striped">
                
            </div>
        </div>
        <div id="dropdown14" class="tab-pane">
                
        </div>
    </div>
</div>