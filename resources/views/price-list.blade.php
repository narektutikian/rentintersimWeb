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
                            @if(array_key_exists('myPriceListId', $li))
                            <li class="pl_li" data-pl-id="{{$li['myPriceListId']}}">My Price List</li>
                            @endif
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
        <p>
            <span>Copy Icon,</span>
            <span>Edit Icon,</span>
            <span>Delete Icon</span>
        </p>
        <div>

            <table id="pl_item_table">
            </table>

        </div>

    </div>

    <div class="col-sm-4">
        <p>Price List Users</p>
        <span>User Icon</span>
        <table id="pl_users_table" class="table">
            <tbody>
                <th>User</th>
                <th>Level</th>
            </tbody>
        </table>
    </div>
   </div>



@endsection