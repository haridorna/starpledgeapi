function ATool() {
    var $this = this;
    var $descriptions;
    var $bankName;
    var $itemVal;
    var businessesWoGooglePlace;
    var searchedGooglePlaces;

    this.init = function () {
        $itemVal = 'restaurants';
        $('#bank-select').change(function () {
            var bankId = $(this).val();
            if (bankId) {
                $this.populateCategories(bankId);
            }

        });
        $('#mappingStatus').change(function () {
            var categoryName = $(this).val();
            if (categoryName == 'MoreThan2Locations' || categoryName == 'OutOfUSA' || categoryName == 'CashWithdraw' || categoryName == 'OnlineWebsite' || categoryName == 'NotFound' || categoryName == 'NoCityData') {
                $('#multiple-selections-wrap').show();
                $('#submit-status-multiple').show();
                $('#submit-status').hide();
            }else{
                $('#multiple-selections-wrap').hide();
                $('#submit-status-multiple').hide();
                $('#submit-status').show();
            }
        });

        $('#category-select').change(function () {
            var categoryName = $(this).val();
            if (categoryName) {
                $this.populateDescription(categoryName);
            }
        });

        $('#description-select').change(function () {
            $this.changeDescription($(this).val());
        });

        $('#search-yelp').click(function () {
            $('#div-merchant-form').html('');
            $this.searchYelp();
        });

        $('#results').on('click', 'button', function () {
            var id = $(this).data('id');

            $(this).html('Submitting...')
            $this.submitForm(id);
        });

        $('.nav-item').click(function () {
            $this.navShift($(this));
        });

        $('#global_merchant_select').change(function () {
            $this.showBusiness($(this));
        });

        $('#gb-term').change(function () {
            $this.GoogleBtnToggle();
        });

        $('#gb-location').change(function () {
            $this.GoogleBtnToggle();
        });

        $('#search-google-place').click(function () {
            $this.fetchGoogleData();
        });

        $(".nav-link").click(function () {
            $this.redirectToLink($(this));
        });

        $('#google-place-results').on('click', '.btn-gp-select', function () {
            var index = $(this).data('gp-index');
            var data = $this.searchedGooglePlaces[index];

            $this.saveGooglePlace(data);
            $('#google-place-results').html('');
            $('#global-merchant-display').html('');
            $('#global_merchant_select').val('');
        });

        $('#add-online-merchant').click(function () {
            $('#results').html('');
            $this.showAddOnlineMerchantForm();
        });

        var $merchantForm = $('#div-merchant-form');
        $merchantForm.on('click', '#cancel-merchant', function () {
            $('#div-merchant-form').html('');
        });

        $merchantForm.on('click', '#save-merchant', function () {
            $this.saveMerchant();
        });

        $('#description-display').on('click', '#ignoreBtn', function() {
            BootstrapDialog.confirm({
                title: 'WARNING',
                message: 'Warning! Ignore this Description?',
                type: BootstrapDialog.TYPE_WARNING,
                btnCancelLabel: "Don't Ignore",
                btnOKLabel: 'Ignore!',
                btnOKClass: 'btn-warning',
                callback: function(result) {
                    if(result) {
                        var description = $('#ignoreBtn').data('description');
                        $this.saveIgnoredDescription(description);
                    }
                }
            });
        });
        $('#status-change').on('click', '#submit-status', function() {
            BootstrapDialog.confirm({
                title: 'CONFIRM',
                message: 'Do you want to change the status?',
                type: BootstrapDialog.TYPE_WARNING,
                btnCancelLabel: "No",
                btnOKLabel: 'Yes!',
                btnOKClass: 'btn-warning',
                callback: function(result) {
                    if(result) {
                        var description = $('#status-change #description').val();
                        description = rhtmlspecialchars(description);
                        var status = $('#status-change #mappingStatus').val();
                        var notes = $('#status-change #mappingNotes').val();
                        $this.saveIgnoredDescription(description, status, notes);
                    }
                    $('#description-select').val('');
                    $('#status-change').hide();
                }
            });
        });
        $('#status-change').on('click', '#submit-status-multiple', function() {
            BootstrapDialog.confirm({
                title: 'CONFIRM',
                message: 'Do you want to change the status of multiple items?',
                type: BootstrapDialog.TYPE_WARNING,
                btnCancelLabel: "No",
                btnOKLabel: 'Update All!',
                btnOKClass: 'btn-warning',
                callback: function(result) {
                    if(result) {
                        var descriptions = $('#status-change #description-select-multiple').val();
                        if(!descriptions) {
                            var descriptionOne = $('#status-change #description').val();
                            descriptions = [descriptionOne];
                        }
                        var status = $('#status-change #mappingStatus').val();
                        var notes = $('#status-change #mappingNotes').val();
                        for(i = 0; i < descriptions.length; i++){
                            var description = rhtmlspecialchars(descriptions[i]);
                            $this.saveIgnoredDescription(description, status, notes);
                        }                        
                    }
                    $('#description-select').val('');
                    $('#status-change #description-select-multiple').val('');
                    $('#status-change').hide();
                    $('#multiple-selections-wrap').hide();
                }
            });
        });

        $('#btnRemoveTransaction').click(function() {
            $this.removeTransaction();
        })
    };

    this.removeTransaction = function() {
        var description = $('#description-select').val();

        if (!description) {
            return false;
        }

        BootstrapDialog.confirm('Are you sure?', function(result){
            if(result) {
                window.location.href = '/admin/index/removeDescriptions?description=' + description;
            }
        });
    };

    this.saveIgnoredDescription = function(description, status, notes) {
        description = encodeURIComponent(description);
        status = encodeURIComponent(status);
        notes = encodeURIComponent(notes);
        var url = '/admin/index/saveIgnoredDescription?description=' + description + '&status=' + status + '&notes=' + notes;
        $.get(url, function(data) {
            console.log(data);
            window.location.href = '/admin/index';
        });        
    };

    this.saveMerchant = function () {

        var error = false;
        var urlR = /^(?:([A-Za-z]+):)?(\/{0,3})([0-9.\-A-Za-z]+)(?::(\d+))?(?:\/([^?#]*))?(?:\?([^#]*))?(?:#(.*))?$/;
        $('#url').removeClass('form-error');
        $('#name').removeClass('form-error');

        if ($.trim($('#url').val()) == '' || !$('#url').val().match(urlR)) {
            $('#url').addClass('form-error');
            error = true;
        }

        if ($.trim($('#name').val()) == '') {
            $('#name').addClass('form-error');
            error = true;
        }

        if (error) {
            return false;
        }

        var frmData = $('#merchant-form').serialize();

        $.ajax('/admin/index/save-merchant', {
            type: 'POST',
            //dataType: 'JSON',
            data: frmData,
            success: function (data) {
                if (data.result == 'success') {
                    $('#div-merchant-form').html("Merchant Saved successfully");
                    $this.populateMerchants(data, true);
                }
            }
        })
    };

    this.showAddOnlineMerchantForm = function () {
        $.get('/admin/index/showAddOnlineMerchantForm', function (data) {
            $('#div-merchant-form').html(data);
        });
    };

    this.saveGooglePlace = function (data) {
        var globalMerchantId = $('#global_merchant_select').val();
        data.globalMerchantId = globalMerchantId;

        $.post('/admin/save-google-place', data);
    };

    this.redirectToLink = function ($item) {
        var link = $item.data('link');

        $('.nav-item').removeClass('active');
        $item.addClass('active');

        window.location.href = link;
    };

    this.changeDescription = function (description) {

        if (!description) {            
            $('#status-change #description').val('');
            $('#bank_name').val('');
            $('#mappingStatus').val('');
            $('#status-change').hide();
            return false;
        }

        $('#bank_id').val($('#bank-select').val());
        $('#mappingStatus').val('');
        $('#status-change #description').val(description);
        $('#multiple-selections-wrap').hide();
        $('#status-change').show();        
    };

    this.fetchGoogleData = function () {
        var location = $('#gb-location').val();
        var term = $('#gb-term').val();
        $("#search-google-place").html('Searching...');

        $.get('/admin/get-google-places?term=' + term + '&location=' + location, function (data) {
            var html = '';
            $this.searchedGooglePlaces = data;

            $.each(data, function (index, item) {
                html += '<div class="col-md-9 result-item"><table class="merchant-listing">';
                html += '<tr><th>Name</th><td>' + item.name + '</td></tr>' +
                    '<tr><th>Address</th><td>' + item.address + '</td></tr>' +
                    '<tr><th>Place Id</th><td>' + item.place_id + '</td></tr>';
                html += '</table></div>';
                html += '<div class="col-md-3"><button class="btn btn-success btn-gp-select" data-gp-index="' + index + '">Select This Place</button></div>';
            });

            $('#google-place-results').html(html);
            $("#search-google-place").html('Search Google Place');
        });
    };

    this.GoogleBtnToggle = function () {
        var location = $('#gb-location').val();
        var term = $('#gb-term').val();

        if (location.trim().length > 0 && term.trim().length > 0) {
            $('#search-google-place').removeClass('disabled')
        } else {
            $('#search-google-place').addClass('disabled')
        }
    };

    this.showBusiness = function ($select) {
        var index = $select.val();

        if (!$.isNumeric(index)) {
            $('#global-merchant-display').html('');
            return false;
        }

        var data = $this.businessesWoGooglePlace[index];

        var html = '<div class="col-md-12 result-item"><table class="merchant-listing">' +
            '<tr>' +
            '<th width="30%">Name</th>' +
            '<td>' + data.name + '</td>' +
            '</tr>' +
            '<tr>' +
            '<th>Address</th>' +
            '<td vlign="top">' + data.city + ', ' +
            data.state_code + ', ' +
            data.display_address1 + ', ' +
            data.display_address2 + ', ' +
            data.postal_code +
            '</td>' +
            '</tr>' +
            '</table></div>';

        $('#global-merchant-display').html(html);
    };

    this.navShift = function ($item) {
        $('#description-display').html('')
        $('.nav-item').removeClass('active');
        $item.addClass('active');
        var itemVal = $item.data('item');
        $itemVal = itemVal;

        if (itemVal == 'no-google-place') {
            $('#yodlee-yelp-mapper-section').hide();
            $('#google-place-section').show();
            $this.googlePlaceForm();
            return;
        } else {
            $('#yodlee-yelp-mapper-section').show();
            $('#google-place-section').hide();

            $descriptionSelect = $('#description-select');
            $bankSelect = $('#bank-select');
            $bankSelect.find('option')
                .remove()
                .end()
                .append('<option value="">Loading...</option>')
                .val('');
            $descriptionSelect.find('option')
                .remove()
                .end()
                .append('<option value="">Select Description</option>')
                .val('');

            $.get('/admin/fetch-banks?item=' + $itemVal, function (data) {
                $bankSelect.find('option')
                    .remove()
                    .end()
                    .append('<option value="">Select Bank</option>')
                    .val('');

                $.each(data, function (index, item) {
                    $bankSelect.append('<option value="' + item.bankName + '">' + item.bankName + '(' + item.count + ')' + '</option>');
                });
            });
        }
    };

    this.populateCategories = function (bankId) {
        $select = $('#category-select');
        $select.find('option')
            .remove()
            .end()
            .append('<option value="">Loading...</option>')
            .val('');
        $.get('/admin/index/fetchCategories?bankId=' + bankId, function (data) {
            $select.find('option')
                .remove()
                .end()
                .append('<option value="">Select Category</option>');
            $.each(data, function (index, item) {
                //{"purchaseCategory":"Shopping","categoryCount":"52"}
                item.purchaseCategory = (!item.purchaseCategory) ? 'No Category' : item.purchaseCategory;
                $select.append('<option value="' + item.purchaseCategory + '">' + item.purchaseCategory + ' (' + item.categoryCount + ') </option>');
            });
        });
    };

    this.populateDescription = function (categoryName) {
        $('#category_name').val(categoryName)
        $('#description-display').html('')

        $select = $('#description-select');
        $selectMultiple = $('#description-select-multiple');
        $selectMultiple.multiselect( 'unload' );
        $selectMultiple.find('option').remove().val('');
        $select.find('option')
            .remove()
            .end()
            .append('<option value="">Loading...</option>')
            .val('');
        var bankId = $('#bank-select').val();
        $.get('/admin/index/fetchDescriptions?categoryName=' +
            encodeURIComponent(categoryName) +
            '&bankId=' + bankId,
            function (data) {
                $descriptions = data;
                $select.find('option')
                    .remove()
                    .end()
                    .append('<option value="">Select Description</option>');
                $.each(data, function (index, value) {
                    $select.append("<option value='" + htmlspecialchars(value) + "'>" + value + "</option>");
                    $selectMultiple.append('<option value="' + htmlspecialchars(value) + '">' + value + '</option>');

                });
                $selectMultiple.multiselect();
            });
    };

    this.googlePlaceForm = function () {
        $('#global_merchant_select').find('option')
            .remove()
            .end()
            .append('<option value="">Loading...</option>')
            .val('');
        $.get('/admin/businesses-without-google-place', function (data) {
            var $select = $('#global_merchant_select');
            $select.find('option')
                .remove()
                .end()
                .append('<option value="">Select Merchant</option>');
            $.each(data, function (index, item) {
                $select.append('<option  value="' + item.id + '">' + item.name + '</option>');
            });

            $this.businessesWoGooglePlace = data;
        });
    };

    this.submitForm = function (id) {
        var mappingPart1 = $('#mapping_part1').val();
        var mappingPart2 = $('#mapping_part2').val();
        var mappingPart3 = $('#mapping_part3').val();
        var description = $('#description').val();
        var bankId = $('#bank_name').val();

        if (!($.trim(mappingPart1) || $.trim(mappingPart2) || $.trim(mappingPart3))) {
            $('#description-display').html("YOU MUST ADD AT LEAST ONE MAPPING STRING TO SELECT MERCHANT");
            return false;
        }

        $('.merchant-map').attr('disabled', 'disabled');
        $('#global_merchant_id').val(id);
        $('#search-form').attr('action', '/admin/map-merchant');
        $('#search-form').attr('method', 'POST');
        $('#search-form').submit();
    };

    this.searchYelp = function () {

        var location = $('#location').val();
        location = $.trim(location);
        var term = $('#term').val();
        term = $.trim(term);

        if (!term) {
            $('#search-yelp').text('Search Term Empty');
            return false;
        }

        $('#search-yelp').text('Please wait...');
        var data = '{ "business_name": "' + term + '","business_address": "' + location + '"}';

        $.ajax({
            contentType: 'application/json',
            data: data,
            dataType: 'json',
            success: function (data) {
                $this.populateMerchants(data);
                $('#search-yelp').text('Search');
            },
            error: function () {
                console.log("Device control failed");
                $('#search-yelp').text('Search');
            },
            processData: false,
            type: 'POST',
            url: '/admin/index/search-merchant'
        });

    };

    this.populateMerchants = function (data, newMerchant) {
        var html = '';

        $.each(data.businesses, function (i, item) {
            //console.log(item);
            if (!item.image_url) {
                item.image_url = '/img/merchant.jpg';
            }

            html += '<div class="row result-item">' +
                '<div class="merchant-img col-md-2">' +
                '<img src="' + item.image_url  + '" />' +
                '</div>' +
                '<div class="merchant-data col-md-8"><table class="merchant-listing">' +
                '<tr><td><b>Merchant Name</b></td><td>' + item.name + '</td></tr>';

            if (!newMerchant) {
                html += '<tr><td><b>Phone</b></td><td>' + item.display_phone + '</td></tr>' +
                        '<tr><td><b>Description</b></td><td>' + item.snippet_text + '</td></tr>';

                if (item.yelp_id) {
                    html += '<tr><td><b>Yelp Url</b></td><td> <a href="http://www.yelp.com/biz' + item.yelp_id + '">http://www.yelp.com/biz' + item.yelp_id + '</a></td></tr>';
                } else {
                    html += '<tr><td><b>Merchant Url</b></td><td> <a href="' + item.url + '">' + item.url + '</a></td></tr>';
                }

                html +='<tr><td><b>Address</b></td><td>';
                html += item.display_address1 + '<br>';
                html += item.display_address2 + '<br>';
                html += item.display_address3 + '<br>';
                html += item.postal_code + ' ';
                html += item.state_code + ' ';
                html += '</td></tr>';
            } else {
                html += '<tr><td><b>Merchant Url</b></td><td>' + item.url + '</td></tr>';
            }

            html += '<tr><td><b>Categories</td><td>';

            $.each(item.categories, function (i, category) {
                html += category + ', '
            });
            html += '</td></tr></table>';

            html += '</div>' +
                '<div class="merchant-select col-md-2">' +
                '<button class="btn btn-success merchant-map" data-id="' + item.id + '">' +
                'Select Merchant' +
                '</button>' +
                '</div>' +
                '</div>';
        });

        $('#results').html(html);


    };
}
function htmlspecialchars(str) {
 if (typeof(str) == "string") {
  str = str.replace(/&/g, "&amp;"); /* must do &amp; first */
  str = str.replace(/"/g, "&quot;");
  str = str.replace(/'/g, "&#039;");
  str = str.replace(/</g, "&lt;");
  str = str.replace(/>/g, "&gt;");
  }
 return str;
 }
 function rhtmlspecialchars(str) {
 if (typeof(str) == "string") {
  str = str.replace(/&gt;/ig, ">");
  str = str.replace(/&lt;/ig, "<");
  str = str.replace(/&#039;/g, "'");
  str = str.replace(/&quot;/ig, '"');
  str = str.replace(/&amp;/ig, '&'); /* must do &amp; last */
  }
 return str;
 }

$(function () {
    var aTool = new ATool();

    aTool.init();
});
