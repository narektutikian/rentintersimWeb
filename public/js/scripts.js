$( document ).ready(function() {
    console.log("ready!");

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

    /***************** Responsive tabs *****************/

    $.fn.responsiveTabs = function() {
        console.log('responsiveTabs');
        this.addClass('responsive-tabs');
        this.append($('<i class="arrow-icon icon-dropdown"></i>'));
        this.append($('<i class="arrow-icon icon-up"></i>'));

        this.on('click', 'li.active > a, i.arrow-icon', function() {
            this.toggleClass('open');
        }.bind(this));

        this.on('click', 'li:not(.active) > a', function() {
            this.removeClass('open');
        }.bind(this));
    };

    $('.nav.nav-tabs').responsiveTabs();

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
        var $list = $('<ul />', {
            'class': 'options'
        }).insertAfter($styledSelect);

        // Insert a list item into the unordered list for each select option
        for (var i = 0; i < numberOfOptions; i++) {
            $('<li />', {
                text: $this.children('option').eq(i).text(),
                rel: $this.children('option').eq(i).val()
            }).appendTo($list);
        }

        // Cache the list items
        var $listItems = $list.children('li');

        // Show the unordered list when the styled div is clicked (also hides it if the div is clicked again)
        $styledSelect.click(function (e) {
            e.stopPropagation();
            $('div.styled_select.active').each(function () {
                $(this).removeClass('active').next('ul.options').hide();
            });
            $(this).toggleClass('active').next('ul.options').toggle();
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
            $styled_select.removeClass('active');
            $list.hide();
        });

    });

    /************ end of styling select tag *************/


});