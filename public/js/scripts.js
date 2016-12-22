$( document ).ready(function() {

    $('header .mobile_nav_button').on('click', function(){
        $('header .mobile_nav').slideToggle();
    });

    $('header .profile_name').on('click', function(){
        $(this).siblings('.header_dropdown').slideToggle();
    });

    $('header .current_language').on('click', function(){
        $(this).siblings('.header_dropdown').slideToggle();
    });

    /************* Pie Charts ***********/
    $('#chart_active').pieChart({
        barColor: '#2cc763',
        trackColor: '#ecf0f1',
        lineCap: 'round',
        lineWidth: 6,
        size: 115,
        onStep: function (from, to, percent) {
            $(this.element).find('.pie-value').text(Math.round(percent) + '%');
        }
    });

    $('#chart_pending').pieChart({
        barColor: '#ffca14',
        trackColor: '#ecf0f1',
        lineCap: 'round',
        lineWidth: 6,
        size: 115,
        onStep: function (from, to, percent) {
            $(this.element).find('.pie-value').text(Math.round(percent) + '%');
        }
    });

    $('#chart_not_used').pieChart({
        barColor: '#8d97a6',
        trackColor: '#ecf0f1',
        lineCap: 'round',
        lineWidth: 6,
        size: 115,
        onStep: function (from, to, percent) {
            $(this.element).find('.pie-value').text(Math.round(percent) + '%');
        }
    });

    $('#chart_average').pieChart({
        barColor: '#2cc763',
        trackColor: '#8d97a6',
        lineCap: 'round',
        lineWidth: 6,
        size: 115,
        onStep: function (from, to, percent) {
            $(this.element).find('.pie-value').text(Math.round(percent) + '%');
            $(this.element).closest('.average_numbers').find('.average_value > .value').text(Math.round(percent) + '%');
            var remainder = 100 - percent;
            $(this.element).closest('.average_numbers').find('.remainder_value > .value').text(Math.round(remainder) + '%');

        }
    });

    /***************** end of Pie Charts *****************/

     /**************** Style select tag ******************/

    // Iterate over each select element
    $('.styled_select').each(function () {

        // Cache the number of options
        var $this = $(this),
            numberOfOptions = $(this).children('option').length;

        // Hides the select element
        $this.addClass('s-hidden');

        // Wrap the select element in a div
        $this.wrap('<div class="select"></div>');

        $this.closest('.select').addClass('block_btn login_input');
        // Insert a styled div to sit over the top of the hidden select element
        $this.after('<div class="styled_select"></div>');

        // Cache the styled div
        var $styledSelect = $this.next('div.styled_select');

        $('.select').append('<i class="icon-dropdown"></i>');

        // Show the first select option in the styled div
        $styledSelect.text($this.children('option').eq(0).text());

        // Insert an unordered list after the styled div and also cache the list
        var $list = $('<div class="options"></div>').insertAfter($styledSelect);

        // Insert a list item into the unordered list for each select option
        for (var i = 0; i < numberOfOptions; i++) {
            $('<div />', {
                class: 'imitation_item',
                text: $this.children('option').eq(i).text(),
                rel: $this.children('option').eq(i).val()
            }).appendTo($list);
        }

        // Cache the list items
        var $listItems = $list.children('.imitation_item');

        // Show the unordered list when the styled div is clicked (also hides it if the div is clicked again)
        $styledSelect.click(function (e) {
            e.stopPropagation();
            $(this).toggleClass('active').next('.options').toggle();
            $(".options").perfectScrollbar('update');
        });

        // Hides the unordered list when a list item is clicked and updates the styled div to show the selected list item
        // Updates the select element to have the value of the equivalent option
        $listItems.click(function (e) {
            e.stopPropagation();
            $styledSelect.text($(this).text()).removeClass('active');
            $this.val($(this).attr('rel'));
            $list.hide();
            /* alert($this.val()); Uncomment this for demonstration! */
        });

        // Hides the unordered list when clicking outside of it
        $(document).click(function () {
            $styledSelect.removeClass('active');
            $list.hide();
        });

    });

    $('.options').perfectScrollbar();
    /************ end of styling select tag *************/


    /************ Styling Radio buttons *************/

    //$(document).on('click', 'label.label_unchecked', function(e){
    //    // prevent label from being called twice
    //    e.stopPropagation();
    //    e.preventDefault();
    //    e.stopImmediatePropagation();

    //    if($(this).closest('.toggle_container').hasClass('disabled')){

    //        $(this).closest('.toggle_container').removeClass('disabled');
    //        /* Enable rows in table */
    //        $(this).closest('.table_status_cell').prevAll('td').removeClass('disable');
    //        $(this).closest('.vdf_radio').siblings('.table_status_text').removeClass('disable');

    //    }else if(!$(this).closest('.toggle_container').hasClass('disabled')){

    //        $(this).closest('.toggle_container').addClass('disabled');
    //        /* Disable rows in table */
    //        $(this).closest('.table_status_cell').prevAll('td').addClass('disable');
    //        $(this).closest('.vdf_radio').siblings('.table_status_text').addClass('disable');
    //    }
    //    if($(this).hasClass('label_unchecked')){

    //        $(this).removeClass('label_unchecked').addClass('label_checked');
    //        $(this).siblings('label').addClass('label_unchecked').removeClass('label_checked');
    //    }
    //});

    /********** end of Styling Radio buttons ***********/


    // rotate arrow for nested rows
    $(document).on('click', '.open_nested', function (e) {

        e.preventDefault();
        $(this).find('.icon-dropdown').toggleClass('expanded');
    });


    /********** Uploaded Image Name ***********/
    $('.modal .file_container').on('click', function(e){

        $(this).find('.modal_image_name').click(function(e){
            e.stopImmediatePropagation();
        });
    });

    $('.modal_image_name').change(function (e) {

        if (this.files && this.files[0]) {

            var file_ext = this.files[0].type.split('/')[1].toLowerCase();

            if($.inArray(file_ext, ['xls','xlsx', 'vnd.openxmlformats-officedocument.spreadsheetml.sheet']) == -1) {

                $(this).parent('.file_container').siblings('.uploaded_file_links').find('.download_file').addClass('disabled');
                alert('invalid extension!!!!');

            }else{
                var file_name = this.files[0].name;
                var tmp_path = URL.createObjectURL(e.target.files[0]);

                $(this).parent().siblings('.keep_file_name').html(file_name);
            }
        }

    });
    /********** end of Uploaded Image Name ***********/

    /* Owl Slider in Orders List Modal*/

    $('#modal_new_order').on('show.bs.modal', function () {
        // do something…
        setTimeout(function(){

            $('.wrap_package_list').show(); // show package list after modal was open
            $('.wrap_package_list').owlCarousel({
                nav : true,
                navText : ['<i class="prev icon-dropdown"></i>', '<i class="next icon-dropdown"></i>'],
                margin : 22,
                responsive:{
                    0:{
                        items:1
                    },
                    480:{
                        items:2,
                        margin : 48
                    },
                    640:{
                        items:3,
                        margin : 28
                    },
                    1000:{
                        items:2
                    },
                    1200:{
                        items:3
                    }
                }
            });
        }, 600);

    });

    $('#modal_edit_order').on('show.bs.modal', function () {

        console.log('modal_edit_order');
        // do something…
        setTimeout(function(){

            $('.wrap_package_list_edit').show(); // show package list after modal was open
            $('.wrap_package_list_edit').owlCarousel({
                nav : true,
                navText : ['<i class="prev icon-dropdown"></i>', '<i class="next icon-dropdown"></i>'],
                margin : 22,
                responsive:{
                    0:{
                        items:1
                    },
                    480:{
                        items:2,
                        margin : 48
                    },
                    640:{
                        items:3,
                        margin : 28
                    },
                    1000:{
                        items:2
                    },
                    1200:{
                        items:3
                    }
                }
            });
        }, 600);

    });


    /* Bootstrap Datepicker */
    $('.date').datetimepicker();


    /* Put Editable values inside modal window */
    $(document).on('click', '.table .table_action_cell .edit', function () {

        var target_form_id;
        target_form_id = $(this).attr('data-form');

        $(this).closest('tr').find('.editable_cell').each(function () {
            
            var attribute_title = $(this).attr('data-th');
            var cell_value = $(this)[0].innerHTML.trim();

            // Capture Modal Open Event
            $(target_form_id).one('shown.bs.modal', function () {

                if(attribute_title == "Id"){ // set form action id

                    var form_action = $(this).find('form').attr('action');
                    $(this).find('form').attr('action', form_action + '/' + cell_value);
                }
                var prop_name = $(this).find('[data-th="' + attribute_title + '"]').prop("tagName");

                if(prop_name){

                    if(prop_name.toUpperCase()  == "INPUT"){

                        $(this).find('input[data-th="' + attribute_title + '"]').each(function(){

                            $(this).val(cell_value);
                        });
                    }else if(prop_name.toUpperCase()  == "SELECT"){

                        $(this).find('select[data-th="' + attribute_title + '"] option').each(function () {
                            if ($(this).text().toLowerCase() == cell_value.toLowerCase()) {
                                $(this).prop('selected','selected');
                                return;
                            }
                        });

                    }else if(prop_name.toUpperCase()  == "TEXTAREA"){

                        $(this).find('textarea[data-th="' + attribute_title + '"]').each(function(){

                            $(this).val(cell_value);
                        });
                    }
                }else {
                    console.log('Property data-th="' + attribute_title + '" not found');
                }
            });

        });


        // Capture Modal Close Event
        $(target_form_id).one("hidden.bs.modal", function () {

            // put your default event here
            var form_action = $(this).find('form').attr('action');
            var reset_form_action = form_action.split('/')[0];

            $(this).find('form').attr('action', reset_form_action + '/');
            $(this).find('form')[0].reset();
        });

    });

    /* Bootstrap Modal Close Event */
    $('.modal').one("hidden.bs.modal", function () {

        $(this).find('form')[0].reset();
        location.reload();

    });


    /* highlight selected package */
    $(document).on('click', '.package_item a', function () {

        $(this).addClass('selected_package');
        $(this).parents('.owl-item').siblings('.owl-item').find('a').removeClass('selected_package');
        return false;
    });

    /* Print Message in browser */
    $(document).on('click', '.email_send_print', function () {

        window.print();
    });

    /* Numeric inputs for time picker */
    $('.numeric_input').keydown(function(event) {
        console.log('keydown ');
        if (event.keyCode == 8 || (event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105)) {
            // 0-9 only
            console.log('0-9 only ');

        }else{
            $(this).val($(this).val().replace(/[^\d].+/, ""));

            if (event.keyCode != 8 || (event.which < 48 || event.which > 57)) {
                console.log('letters are not allowed ');
                event.preventDefault();
            }
        }

    });

        /* Change hours/minutes by click */
        $('.arrow-down').on('click', function(){

            if($(this).siblings().hasClass('vdf_hour')){

                var el = $(this).siblings('.vdf_hour').text();

                if(parseInt($(this).siblings('.vdf_hour').text()) == 23) {

                    $(this).siblings('.vdf_hour').text(parseInt(0));
                }else{
                    $(this).siblings('.vdf_hour').text(parseInt(el) + 1);
                }

            }
            if($(this).siblings().hasClass('vdf_min')){

                var el = $(this).siblings('.vdf_min').text();

                if(parseInt($(this).siblings('.vdf_min').text()) == 45){

                    $(this).siblings('.vdf_min').text(parseInt(0));
                }else{

                    $(this).siblings('.vdf_min').text(parseInt(el) + 15);
                }

            }

        });
        $('.arrow-up').on('click', function(){
            
            if($(this).siblings().hasClass('vdf_hour')){

                console.log('vdf_hour');
                var el = $(this).siblings('.vdf_hour').text();

                if(parseInt($(this).siblings('.vdf_hour').text()) == 0){

                    $(this).siblings('.vdf_hour').text(23);
                }else{
                    $(this).siblings('.vdf_hour').text(parseInt(el) - 1);
                }

            }
            if($(this).siblings().hasClass('vdf_min')){

                var el = $(this).siblings('.vdf_min').text();

                if(parseInt($(this).siblings('.vdf_min').text()) == 0){

                    $(this).siblings('.vdf_min').text(parseInt(45));
                }else{

                    $(this).siblings('.vdf_min').text(parseInt(el) - 15);
                }

            }

        });

        /* end of Change hours/minutes by click */
    /* end of Numeric inputs for time picker */

    $('.ref_number').on('click', function () {
        var data_content = $(this).attr('data-content');

        if($(this).closest('tr').siblings('tr').find('.show_data_content').length > 0){
            console.log('remove');
            $(this).closest('tr').siblings('tr').find('.show_data_content').remove();
        }

        if($(this).find('.show_data_content').length > 0){

            $(this).find('.show_data_content').remove();
        }else{
            $(this).append('<span class="show_data_content">' + data_content + '</span>');
        }

    });



});