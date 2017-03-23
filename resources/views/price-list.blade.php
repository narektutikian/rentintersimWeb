@extends('layouts.admin')

@section('dashboard')
    <div id="price_list">

    <div class="row">
        <div class="col-md-12">
            <section class="filter_status">
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
            </section>

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
        <div class="price_list_table_caption">
            <span class="price_list_caption_text" data-toggle="modal" data-target="#pl_new_modal">Provider: Vodafone / Pricelist: Default </span>
            <div class="pull-right">
                <span class="wrap_icon" title="Copy" data-toggle="modal" data-target="#modal_copy_price_list"><i class="icon-copy"></i></span></span>
                <span class="wrap_icon" title="Delete" data-toggle="modal" data-target="#modal_delete_price_list"><i class="icon-delete"></i></span></span>
            </div>
        </div>
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
        <div class="price_list_table_caption right">
            <span class="price_list_caption_text">Pricelist: Default / Pricelist </span>
            <div class="pull-right">
                <span class="wrap_icon" title="Users">
                    <i class="icon-add_user"></i>
                </span>
            </div>

        </div>

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



    <!--Copy Modal-->
    <div class="modal fade" id="modal_copy_price_list" tabindex="-1" role="dialog" aria-labelledby="modal_copy_price_list">
        <div class="modal-dialog vdf_modal" role="document">
            <div class="modal-content vdf_modal_content">
                <div class="modal-header vdf_modal_header">
                    <button type="button" class="close close_print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="vdf_modal_sub_header">
                        <div class="col-md-12">
                            <h3>Copying “Default” Pricelist</h3>
                        </div>
                    </div>
                </div>
                <form action="/" class="form-horizontal vd_form">
                    <div class="modal-body vdf_modal_body">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="price_list_sm_modal">
                                    <form action="/" class="vd_form">
                                        <label class="table_label">Please give name to new pricelist</label>
                                        <div class="relative">
                                            <input type="text" name="email" id="email" class="block_btn_30 modal_input vd_email vd_required" value=""/>
                                            <i class="input_icon icon-name"></i>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer vdf_modal_footer">
                        <a href="#" class="inline_block_btn light_gray_btn vd_form_reset close_print" data-dismiss="modal" aria-label="Close">Cancel</a>
                        <a href="#" class="inline_block_btn light_green_btn vd_form_submit" id="send-order">Save</a>

                        <span class="success_response"></span>
                        <span class="error_response"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end of Copy Modal-->

@endsection