@extends('layouts.admin')

@section('dashboard')
    <div id="price_list">

    <div class="row">
        <div class="col-md-12">
            <div class="filter_buttons">
                <div class="price_list_wrapper">
                    <div class="search_management_option">
                        <div class="search_form_option">
                            <div class="pull-right search">
                                <input type="text" class="block_btn_30 search_input" name="query" placeholder="Search" value="{{ (isset($_GET['query'])) ? $_GET['query'] : '' }}">
                            </div>
                            <button type="button" class="search_button low"><i class="icon-search"></i></button>
                        </div>
                        <a href="#" class="add_new_btn" data-toggle="modal" data-target="#pl_new_modal"><i class="icon-new_order"></i>New Pricelist</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
   <div class="row">

    <div class="col-sm-3">
        <ul class="main_nested_list">
            <li class="nested_list_title">Price Lists</li>
            <ul class="nested_list">
                @foreach ($list['priceLists'] as $key => $li)
                    <li class="nested_list_brand" data-provider-id="{{$li['providerId']}}"><i class="icon-dropdown"></i><span class="nested_list_brand_title"></span>{{$li['providerName']}}</li>
                        <ul class="nested_list expandable">
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

    <div class="col-sm-5">
        <p id="pl_provider_name"></p>
        <p id="pl_name"></p>
        <p>
            <span>Copy Icon,</span>
            <span data-toggle="modal" data-target="#pl_new_modal">New Icon,</span>
            <span>Delete Icon</span>
        </p>
        <div class="lists_price_lists_table">
            <table id="pl_item_table" class="table">
                <thead>
                    <th>Item</th>
                    <th>Cost</th>
                    <th>Place</th>
                </thead>
                <tbody>
                    <tr>
                        <td>SIM Card</td>
                        <td><span>1 </span><span><i class="icon-edit"></i></span></td>
                        <td><span>4 </span><span><i class="icon-edit"></i></span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-sm-4">
        <p>Price List Users</p>
        <span>User Icon</span>
        <div class="lists_users_table">
            <table id="pl_users_table" class="table">
                <thead>
                    <th>
                        <td>User</td>
                        <td>Level</td>
                    </th>
                </thead>
                <tbody>
                    <tr>
                        <td>Maxi</td><td>Dealer</td>
                    </tr>
                    <tr>
                        <td>David</td><td>Dealer</td>
                    </tr>
                    <tr>
                        <td>G2T</td><td>Dealer</td>
                    </tr>
                    <tr>
                        <td>Ann</td><td>Subdealer</td>
                    </tr>
                    <tr>
                        <td>Karen</td><td>Dealer</td>
                    </tr>
                    <tr>
                        <td>Leon</td><td>Subdealer</td>
                    </tr>
                    <tr>
                        <td>John</td><td>Dealer</td>
                    </tr>
                    <tr>
                        <td>Sara</td><td>Subdealer</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
   </div>


    </div><!-- Price_list-->

   <!-- New Price List Modal-->
   <!-- Modal -->
   <div class="modal fade" id="pl_new_modal" role="dialog">
       <div class="modal-dialog">

           <!-- Modal content-->
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <h4 class="modal-title">Modal Header</h4>
               </div>
               <div class="modal-body">
                   <form class="vd_form" id="pl_new_form">
                       <div class="form-group">
                           <div class="col-md-12">
                               <label for="pl_new_name">New Price List Name</label>
                               <input type="text" name="name" class="form-control" id="pl_new_name">
                               {{csrf_field()}}
                           </div>
                           <div class="form-group">
                               <label for="pl_new_provider">Select Provider</label>
                               <select class="form-control" name="provider" id="pl_new_provider">
                                   <option>Select Provider</option>
                                   @foreach($providers as $provider)
                                   <option value="{{$provider->id}}">{{$provider->name}}</option>
                                   @endforeach
                               </select>
                           </div>
                       </div>
               <div class="modal-footer">
                       <a href="#" id="cancel_order" class="inline_block_btn light_gray_btn close vd_form_reset">Cancel</a>
                       {{--<button type="submit" href="#" class="inline_block_btn light_green_btn vd_form_submit" id="create-order">Create order</button>--}}
                       <a href="#" class="inline_block_btn light_green_btn vd_form_submit" id="pl_new_submit_button">Create Order</a>

                       <span class="required_mark_description">* Required field</span>
                       <span class="success_response"></span>
                       <span class="error_response"></span>
               </div>
                   </form>

               </div>
           </div>

       </div>
   </div>
       </div>
   <!--end Print Modal-->

@endsection