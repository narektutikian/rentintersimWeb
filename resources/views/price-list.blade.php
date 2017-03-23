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

            <div class="col-sm-12 col-md-3">
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

            <div class="col-sm-12 col-md-5">
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
                                <td><span class="price_list_item_text">SIM Card</span></td>
                                <td><span class="price_list_item_text">1 </span><span class="pull-right align_icon"><i class="icon-edit"></i></span></td>
                                <td><span class="price_list_item_text">4 </span><span class="pull-right align_icon"><i class="icon-edit"></i></span></td>
                            </tr>
                            <tr>
                                <td><span class="price_list_item_text">SIM Card</span></td>
                                <td><span class="price_list_item_text">2 </span><span class="pull-right align_icon"><i class="icon-edit"></i></span></td>
                                <td><span class="price_list_item_text">8 </span><span class="pull-right align_icon"><i class="icon-edit"></i></span></td>
                            </tr>
                            <tr>
                                <td><span class="price_list_item_text">SIM Card</span></td>
                                <td><span class="price_list_item_text">4 </span><span class="pull-right align_icon"><i class="icon-edit"></i></span></td>
                                <td><span class="price_list_item_text">3 </span><span class="pull-right align_icon"><i class="icon-edit"></i></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-sm-12 col-md-4">
                <div class="price_list_table_caption right">
                    <span class="price_list_caption_text">Pricelist: Default / Pricelist </span>
                    <div class="pull-right">
                        <span class="wrap_icon" title="Users" data-toggle="modal" data-target="#modal_price_list_user">
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
       <div class="modal-dialog vdf_modal">

           <!-- Modal content-->
           <div class="modal-content vdf_modal_content">
               <form class="vd_form" id="pl_new_form">
                   <div class="modal-header vdf_modal_header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       <div class="vdf_modal_sub_header">
                           <div class="col-md-12">
                               <h3>Add new pricelist</h3>
                           </div>
                       </div>
                   </div>
                   <div class="modal-body vdf_modal_body">

                       <div class="form-group col-md-12">
                           <label class="table_label">Please give name to new pricelist</label>
                           <div class="relative">
                               <input type="text" name="pricelist" class="block_btn_30 modal_input vd_email vd_required" value=""/>
                               <i class="input_icon icon-name"></i>
                           </div>
                           {{csrf_field()}}
                       </div>
                       <div class="form-group col-md-12">
                           <label class="table_label">Choose provider</label>
                           <div class="select_wrapper">
                               <select name="prk_sim_num" class="block_btn_30 modal_input vd_select">
                                   <option value="vodafone">Vodafone</option>
                                   @foreach($providers as $provider)
                                       <option value="{{$provider->id}}">{{$provider->name}}</option>
                                   @endforeach
                               </select>
                               <i class="input_icon_small icon-provider"></i>
                           </div>
                       </div>
                   </div>
                   <div class="modal-footer vdf_modal_footer">
                       <a href="#" class="inline_block_btn light_gray_btn vd_form_reset close_print" data-dismiss="modal" aria-label="Close">Cancel</a>
                       <a href="#" class="inline_block_btn light_green_btn vd_form_submit">Add</a>

                       <span class="success_response"></span>
                       <span class="error_response"></span>
                   </div>

               </form>
           </div>

       </div>
   </div>
       </div>
   <!--end of Price List Modal-->



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
                                            <input type="text" name="pricelist" class="block_btn_30 modal_input vd_email vd_required" value=""/>
                                            <i class="input_icon icon-name"></i>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer vdf_modal_footer">
                        <a href="#" class="inline_block_btn light_gray_btn vd_form_reset close_print" data-dismiss="modal" aria-label="Close">Cancel</a>
                        <a href="#" class="inline_block_btn light_green_btn vd_form_submit">Save</a>

                        <span class="success_response"></span>
                        <span class="error_response"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end of Copy Modal-->

    <!--Copy Modal-->
    <div class="modal fade" id="modal_price_list_user" tabindex="-1" role="dialog" aria-labelledby="modal_price_list_user">
        <div class="modal-dialog vdf_modal" role="document">
            <div class="modal-content vdf_modal_content">
                <div class="modal-header vdf_modal_header">
                    <button type="button" class="close close_print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="vdf_modal_sub_header">
                        <div class="col-md-12">
                            <h3>Add/ Remove users using “Default” pricelist</h3>
                        </div>
                    </div>
                </div>
                <form action="/" class="form-horizontal vd_form">
                    <div class="modal-body vdf_modal_body">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="lists_users_table">
                                    <table id="pl_users_table" class="table">
                                        <thead>
                                            <tr>
                                                <th class="table_id_cell"></th>
                                                <th>User</th>
                                                <th>Level</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label class="checkbox_wrapper">
                                                        <input type="checkbox" class="checkbox_hide">
                                                        <span class="checkbox_replace"></span>
                                                    </label>
                                                </td>
                                                <td>Maxi</td>
                                                <td>Dealer</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="checkbox_wrapper">
                                                        <input type="checkbox" class="checkbox_hide">
                                                        <span class="checkbox_replace"></span>
                                                    </label>
                                                </td><td>David</td><td>Dealer</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="checkbox_wrapper">
                                                        <input type="checkbox" class="checkbox_hide">
                                                        <span class="checkbox_replace"></span>
                                                    </label>
                                                </td><td>G2T</td><td>Dealer</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="checkbox_wrapper">
                                                        <input type="checkbox" class="checkbox_hide">
                                                        <span class="checkbox_replace"></span>
                                                    </label>
                                                </td>
                                                <td>Ann</td><td>Subdealer</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="checkbox_wrapper">
                                                        <input type="checkbox" class="checkbox_hide">
                                                        <span class="checkbox_replace"></span>
                                                    </label>
                                                </td>
                                                <td>Karen</td><td>Dealer</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="checkbox_wrapper">
                                                        <input type="checkbox" class="checkbox_hide">
                                                        <span class="checkbox_replace"></span>
                                                    </label>
                                                </td>
                                                <td>Leon</td><td>Subdealer</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="checkbox_wrapper">
                                                        <input type="checkbox" class="checkbox_hide">
                                                        <span class="checkbox_replace"></span>
                                                    </label>
                                                </td>
                                                <td>John</td><td>Dealer</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="checkbox_wrapper">
                                                        <input type="checkbox" class="checkbox_hide">
                                                        <span class="checkbox_replace"></span>
                                                    </label>
                                                </td>
                                                <td>Sara</td><td>Subdealer</td>
                                            </tr>
                                        </tbody>
                                    </table>
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