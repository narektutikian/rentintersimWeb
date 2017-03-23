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
            <span id="pl_copy_modal" class="pl_id" data-pl-id="">Copy Icon,</span>
            <span data-toggle="modal" data-target="#pl_new_modal">New Icon,</span>
            <span data-pl-id="" class="pl_id">Delete Icon</span>
        </p>
        <div>

            <table id="pl_item_table">
            </table>

        </div>

    </div>

    <div class="col-sm-4">
        <p>Price List Users</p>
        <span class="pl_id" data-toggle="modal" data-target="#pl_add_users_modal">User Icon</span>
        <table id="pl_users_table" class="table">
            <tbody>
                <th>User</th>
                <th>Level</th>
            </tbody>
        </table>
    </div>
   </div>

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

   <!--end new Price List Modal-->

   <!-- Modal -->
   <div class="modal fade" id="pl_add_users_modal" role="dialog">
       <div class="modal-dialog">

           <!-- Modal content-->
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <h4 class="modal-title">Add Users</h4>
               </div>
               <div class="modal-body">
                   <form class="vd_form" id="pl_new_form">
                       <div class="form-group">
                           <div class="col-md-12">
                               <label for="pl_add_user">New Price List Name</label>
                               <input type="text" name="name" class="form-control" id="pl_add_user">
                               {{csrf_field()}}
                           </div>

                       </div>
                       <div class="modal-footer">
                           <a href="#" id="cancel_order" class="inline_block_btn light_gray_btn close vd_form_reset">Cancel</a>
                           <a href="#" class="inline_block_btn light_green_btn vd_form_submit" id="pl_new_submit_button">Save</a>

                           <span class="required_mark_description">* Required field</span>
                           <span class="success_response"></span>
                           <span class="error_response"></span>
                       </div>
                   </form>

               </div>
           </div>

       </div>
   </div>

   <!--end Print Modal-->

@endsection