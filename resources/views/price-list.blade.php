@extends('layouts.admin')

@section('dashboard')

    <div>
        <ul>
            <li>Price Lists</li>
            <ul>
                <li>Vodafone</li>
                <li>Default</li>
                <li>My Price List</li>
            </ul>
        </ul>
    </div>

    <div>
        <p>Provider: </p>
        <p>Price List: </p>
        <Ul>
            <li>Copy Icon</li>
            <li>Edit Icon</li>
            <li>Delete Icon</li>
        </Ul>
        <div>

            <table class="rwd-table responsive_table table">
                <tbody>
                <tr>
                    <th>Item</th>
                    <th>Cost</th>
                    <th>Sell Price</th>
                </tr>
                <tr>
                    <td>SIM card</td>
                    <td>{{$defaultCost['cost']}}</td>
                    <td>{{$default['cost']}}</td>
                </tr>
                    @foreach($default['price_lists'] as $key => $item)
                <tr>
                    <td>{{$item['package']['name']}}</td>
                    <td>{{$defaultCost['price_lists'][$key]['cost']}}</td>
                    <td>{{$item['cost']}}</td>
                </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>

    <div>
        <p>Price List Users</p>
        <span>User Icon</span>
        <table class="table">
            <tbody>
                <th>User</th>
                <th>Level</th>
            </tbody>
        </table>
    </div>



@endsection