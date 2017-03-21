@extends('layouts.admin')

@section('dashboard')

   <div class="row">
    <div class="col-sm-3">
        <ul>
            <li>Price Lists</li>
            <ul>
                @foreach ($list['priceLists'] as $key => $li)
                    <li data-provider-id="{{$li['providerId']}}">{{$li['providerName']}}</li>
                        <ul>
                            <li class="pl_li" data-pl-id="{{$li['defaultId']}}">Default</li>
                            <li class="pl_li" data-pl-id="{{$li['myPriceListId']}}">My Price List</li>
                            @foreach($li['iCreated'] as $pl)
                            <li class="pl_li" data-pl-id="{{$pl['id']}}">{{$pl['name']}}</li>
                            @endforeach
                        </ul>
                @endforeach
            </ul>
        </ul>
    </div>

    <div class="col-sm-4">
        <p id="pl_provider_name"></p>
        <p id="pl_name"></p>
        <Ul>
            <li>Copy Icon</li>
            <li>Edit Icon</li>
            <li>Delete Icon</li>
        </Ul>
        <div>

            <table id="pl_item_table" class="rwd-table responsive_table table">
                <tbody>
                <tr>
                    <th>Item</th>
                    <th>Cost</th>
                    <th>Sell Price</th>
                </tr>
                {{--<tr>--}}
                    {{--<td>SIM card</td>--}}
                    {{--<td>{{$defaultCost['cost']}}</td>--}}
                    {{--<td>{{$default['cost']}}</td>--}}
                {{--</tr>--}}
                    {{--@foreach($default['price_lists'] as $key => $item)--}}
                {{--<tr>--}}
                    {{--<td>{{$item['package']['name']}}</td>--}}
                    {{--<td>{{$defaultCost['price_lists'][$key]['cost']}}</td>--}}
                    {{--<td>{{$item['cost']}}</td>--}}
                {{--</tr>--}}
                    {{--@endforeach--}}
                </tbody>
            </table>

        </div>

    </div>

    <div class="col-sm-4">
        <p>Price List Users</p>
        <span>User Icon</span>
        <table class="table">
            <tbody>
                <th>User</th>
                <th>Level</th>
            </tbody>
        </table>
    </div>
   </div>



@endsection