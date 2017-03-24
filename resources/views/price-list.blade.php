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
                                    <!--<div class="pull-right search">
                                            <input type="text" class="block_btn_30 search_input" name="query" placeholder="Search" value="{{ (isset($_GET['query'])) ? $_GET['query'] : '' }}">
                                        </div>
                                        <button type="button" class="search_button low"><i class="icon-search"></i></button>-->
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
                <div class="price_list_table_caption">
                    <span class="price_list_caption_text" id="pl_provider_name"></span><span id="pl_name" class="price_list_caption_text"></span>
                    <div class="pull-right">
                        <span id="pl_copy_button" class="wrap_icon" title="Copy" data-toggle="modal" data-target="#modal_copy_price_list"><i class="icon-copy"></i></span></span>
                        <span id="pl_delete_button" class="wrap_icon" title="Delete" data-toggle="modal" data-target="#confirm_delete" data-row-id="36"><i class="icon-delete"></i></span></span>
                    </div>
                </div>
                <div class="lists_price_lists_table">
                    <table id="pl_item_table" class="table">
                        <thead>
                            <th>Item</th>
                            <th>Cost</th>
                            <th>Place</th>
                        </thead>

                    </table>
                </div>
            </div>

            <div class="col-sm-12 col-md-4">
                <div class="price_list_table_caption right">
                    <span class="price_list_caption_text">Price List Users </span>
                    <div class="pull-right">
                        <span id="pl_user_button" class="wrap_icon" title="Users" data-toggle="modal" data-target="#modal_price_list_user">
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
                               <input type="text" name="name" class="block_btn_30 modal_input vd_required" value=""/>
                               <i class="input_icon icon-name"></i>
                           </div>
                           {{csrf_field()}}
                       </div>
                       <div class="form-group col-md-12">
                           <label class="table_label">Choose provider</label>
                           <div class="select_wrapper">
                               <select name="provider" class="block_btn_30 modal_input vd_select">
                                   <option value=""></option>
                                   @foreach($providers as $provider)
                                       <option value="{{$provider->id}}">{{$provider->name}}</option>
                                   @endforeach
                               </select>
                               <i class="input_icon_small icon-provider"></i>
                           </div>
                       </div>
                       <div class="text-center small_modal_response">
                           <span class="success_response"></span>
                           <span class="error_response"></span>
                       </div>

                   </div>
                   <div class="modal-footer vdf_modal_footer">
                       <a href="#" class="inline_block_btn light_gray_btn vd_form_reset close_print" data-dismiss="modal" aria-label="Close">Cancel</a>
                       <a href="#" class="inline_block_btn light_green_btn vd_form_submit" id="pl_new_submit_button">Add</a>

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
                            <h3 >Copying “<span class="pl_name">Default</span>” Pricelist</h3>
                        </div>
                    </div>
                </div>
                <form action="/price-list/copy" class="form-horizontal vd_form" id="pl_copy_form" method="post">
                    <div class="modal-body vdf_modal_body">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="price_list_sm_modal">

                                        <label class="table_label">Please give name to new price list <span class="required_mark">*</span></label>
                                        <div class="relative">
                                            <input type="text" name="name" class="block_btn_30 modal_input vd_required" value=""/>
                                            <input type="hidden" name="plId" class="pl_id ">
                                            {{csrf_field()}}
                                            <i class="input_icon icon-name"></i>
                                        </div>

                                </div>
                            </div>
                        </div>

                        <div class="text-center small_modal_response">
                            <span class="success_response"></span>
                            <span class="error_response"></span>
                        </div>

                    </div>
                    <div class="modal-footer vdf_modal_footer">
                        <a href="#" class="inline_block_btn light_gray_btn vd_form_reset close_print" data-dismiss="modal" aria-label="Close">Cancel</a>
                        <a href="#" class="inline_block_btn light_green_btn vd_form_submit" id="pl_copy_submit_button">Save</a>


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
                <form action="/price-list/attache_user" class="form-horizontal vd_form" method="post">
                    <input type="hidden" name="plId" class="pl_id ">
                    {{csrf_field()}}
                    <div class="modal-body vdf_modal_body">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="lists_users_table">
                                    <table id="pl_assigned_users" class="table">
                                        <thead>
                                            <tr>
                                                <th class="table_id_cell"></th>
                                                <th>User</th>
                                                <th>Level</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="text-center small_modal_response">
                            <span class="success_response"></span>
                            <span class="error_response"></span>
                        </div>
                    </div>
                    <div class="modal-footer vdf_modal_footer">
                        <a href="#" class="inline_block_btn light_gray_btn vd_form_reset close_print" data-dismiss="modal" aria-label="Close">Cancel</a>
                        <a href="#" class="inline_block_btn light_green_btn vd_form_submit" id="save-price-list-user">Save</a>

                        {{--<span class="success_response"></span>--}}
                        {{--<span class="error_response"></span>--}}
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end of Copy Modal-->

@endsection