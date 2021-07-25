$(function(){

    $('#suplier_iddata').on('change', function(){
        var supplierid = $(this).val();
        $('#suplierid').val(supplierid);

        $.ajax({
            type: 'GET',
            url:'/purchesh_suplier_data/'+supplierid,
            success: function (data) {
                //console.log(data);
                if (data.accounts > 0){
                    var status_new = 1;
                }else if(data.accounts < 0){
                    var status_new = 0;
                }else{
                    var status_new = 0;
                }

                $('#suplier_status').val(status_new);


                var subtotalcash = $("#subtotal_cash").val();
                var dataaccounts = data.accounts;
                var accounts = dataaccounts.replace('-', '');
                $('#suplier_ledger').val(accounts);

                if (subtotalcash !=""){
                    if(data.status == 0){
                        $('#suplier_account').val(data.accounts);
                        $('#calculate').val(subtotalcash - accounts);
                    }else{
                        $('#calculate').val(parseFloat(subtotalcash) + parseFloat(accounts));
                        $('#suplier_account').val(data.accounts);
                    }
                }else{
                    if(data.status == 1){
                        $('#suplier_account').val(data.accounts);
                    }else{
                        $('#suplier_account').val(data.accounts);
                    }
                }

            }

        });
    });

    $( function() {
        $.ajax({
            type: 'GET',
            url:'/productselect_ajax',
            success: function (data) {
                //console.log(data);
                var availableTags = [];
                for(var k in data){
                    availableTags.push(data[k].product_name + ' = '+data[k].id);
                }
                $( "#name_tags" ).autocomplete({
                    source: availableTags
                });
            }
        });

    }); // function


    $('.newtag').on('change', function () {
        $('#tagsname').html('You selected: ' + this.value);
    }).change();
    $('.newtag').on('autocompleteselect', function (e, ui) {
        $('#tagsname').html('You selected: ' + ui.item.value);
        var string =(ui.item.value);
        var arr = string.split("=");
        var productname = arr[0];
        var product_id = arr[1];

        $.ajax({
            type: 'GET',
            url:'/productdata_select/'+product_id,
            success: function (data) {
                //console.log(data);
                $('#selltype').val(data.sell_type);

                $('#product_namevalu').val(data.product_name);
                $('#productidval').val(data.id);
                $('#addbtn').val(data.id);

                if(data.sell_type =="Color"){
                    $('.purchesh').empty().append('<div class="col-md-12 purchesh">\n' +
                        '                                                <div class="ui-widget">\n' +
                        '                                                    <label for="ProductDetails">Symbol :<span class="tx-danger" > *</span></label>\n' +
                        '                                                    <select class="form-control"  name="" id="symbol_id" required style="width: 165px"> </select>\n' +
                        '                                                </div>\n' +
                        '                                            </div>');


                }else if(data.sell_type =="Size"){
                    $('.purchesh').empty().append('<div class="col-md-12 purchesh">\n' +
                        '                                                <div class="ui-widget">\n' +
                        '                                                    <label for="ProductDetails">Symbol :<span class="tx-danger" > *</span></label>\n' +
                        '                                                    <select class="form-control"  name="" id="symbol_id" required style="width: 165px"> </select>\n' +
                        '                                                </div>\n' +
                        '                                            </div>');

                }else if(data.sell_type =="Gram"){
                    $('.purchesh').empty().append('<div class="col-md-12 purchesh">\n' +
                        '                                                <div class="ui-widget">\n' +
                        '                                                    <label for="ProductDetails">Symbol :<span class="tx-danger" > *</span></label>\n' +
                        '                                                    <select class="form-control"  name="" id="symbol_id" required style="width: 165px"> </select>\n' +
                        '                                                </div>\n' +
                        '                                            </div>');

                }else if(data.sell_type =="ML"){
                    $('.purchesh').empty().append('<div class="col-md-12 purchesh">\n' +
                        '                                                <div class="ui-widget">\n' +
                        '                                                    <label for="ProductDetails">Symbol :<span class="tx-danger" > *</span></label>\n' +
                        '                                                    <select class="form-control"  name="" id="symbol_id" required style="width: 165px"> </select>\n' +
                        '                                                </div>\n' +
                        '                                            </div>');

                }else if(data.sell_type =="Dozen"){
                    $('.purchesh').empty().append('<div class="row purchesh">\n' +
                        '                                                <div class="col-md-6 purchesh">\n' +
                        '                                                    <div class="ui-widget">\n' +
                        '                                                        <label for="ProductDetails">Dozen Quantity<span class="tx-danger" > *</span></label>\n' +
                        '                                                        <input class="form-control" type="number" name=""  placeholder="5 Dozen" id="dozen_val">\n' +
                        '                                                    </div>\n' +
                        '                                                </div>\n' +
                        '                                                <div class="col-md-6 purchesh">\n' +
                        '                                                    <div class="ui-widget">\n' +
                        '                                                        <label for="ProductDetails">Pic Quantity :<span class="tx-danger" > *</span></label>\n' +
                        '                                                        <input class="form-control" type="text" name=""  placeholder="Single Pic" id="dozen_Pic_Value">\n' +
                        '                                                    </div>\n' +
                        '                                                </div>\n' +
                        '                                            </div>');

                    $('#dozen_val').on('change', function(){
                        var dozen_val = $("#dozen_val").val();
                        var dozenPicValue = $("#dozen_Pic_Value").val();
                        var dazonbig = data.attrebute;
                        var dazon_pic = dozen_val * dazonbig;

                        if (dozenPicValue==""){
                            var totalpic_valu = dazon_pic;
                        }else{
                            var totalpic_valu = parseFloat(dozenPicValue) + parseFloat(dazon_pic);
                        }
                        $('#pic_value').val(totalpic_valu);
                        $('#quantity_last').val(totalpic_valu);
                        $('#buypriceval').val('');
                        $('#sellpriceval').val('');
                    });

                    $('#dozen_Pic_Value').on('change', function(){
                        var dozen_val = $("#dozen_val").val();
                        var dazonbig = data.attrebute;
                        var dazon_pic = dozen_val * dazonbig;
                        var dozen_PicValue = $("#dozen_Pic_Value").val();
                        if (dozen_val==""){
                            var totalpic_valu = dozen_PicValue;
                        }else{
                            var totalpic_valu = parseFloat(dozen_PicValue) + parseFloat(dazon_pic);
                        }
                        $('#pic_value').val(totalpic_valu);
                        $('#quantity_last').val(totalpic_valu);
                        $('#buypriceval').val('');
                        $('#sellpriceval').val('');
                    });

                }else if(data.sell_type =="Pic"){
                    if (data.attrebute !=null){
                        $('.purchesh').empty().append('<div class="col-md-12 purchesh">\n' +
                            '                                                <div class="ui-widget">\n' +
                            '                                                    <label for="ProductDetails">Symbol :<span class="tx-danger" > *</span></label>\n' +
                            '                                                    <select class="form-control"  name="" id="symbol_id" required style="width: 165px"> </select>\n' +
                            '                                                </div>\n' +
                            '                                            </div>');
                    }else{
                        $('.purchesh').empty().append('');
                    }

                }else{
                    $('.purchesh').empty().append('');
                }


                $('#pic_value').on('change', function(){
                    var pic_value = $("#pic_value").val();
                    $('#quantity_last').val(pic_value);
                    $('#buypriceval').val('');
                    $('#sellpriceval').val('');
                });

                $('#buypriceval').on('change', function(){
                    var buypriceval = $("#buypriceval").val();
                    var pic_value = $("#pic_value").val();
                    var totalbuyamount = buypriceval * pic_value;

                    $('#totalbuyval').val(totalbuyamount);
                    $('#subtotal_cash').val(totalbuyamount);
                    $('#suplier_buy').val(totalbuyamount);
                    $('#paableamount').val(totalbuyamount);

                    var status = $("#suplier_status").val();
                    var accounts = $("#suplier_ledger").val();

                    if (status !=""){
                        if(status==1){
                            var lastbalanceoo =  parseFloat(totalbuyamount) + parseFloat(accounts);
                            $('#calculate').val(lastbalanceoo);

                        }else if(status==0){
                            var lastbalance = totalbuyamount - accounts ;
                            $('#calculate').val(lastbalance);
                        }else{
                            $('#calculate').val(totalbuyamount);
                        }
                    }else{
                        $('#calculate').val(totalbuyamount);
                    }

                });


                if (data.attrebute !=null){
                    var symbol = data.attrebute.split(",");
                    var select = '';
                    select += '<option value="">Select Symbol</option>';
                    $.each(symbol, function (index, obj) {
                        select += ('<option value="'+ obj+'">' + obj+ '</option>');

                    });
                    $('#symbol_id').html(select);
                    //console.log(symbol);
                }
            }

        }); // end ajax
    }); // auto select form end


    $('#sellpriceval').on('change', function() {
        var sell_priceval = $("#sellpriceval").val();
    });


// barcode push data


    $('.tagBox').on('keypress', function() {
        var content = document.getElementsByClassName('tagBox')[0];
        var contentItems =content.getElementsByClassName('tag');
        var codecount = contentItems.length +1;
        $('#pic_value').val(codecount);
        $('#quantity_last').val(codecount);
    });

// barcode push data

    function add(accumulator, a) {
        return accumulator + a;
    }

    var product_info = []; // form submit
    var calculative_data = {};
    var x = 1;
    var sellValues = [];
    var item_sell_value = [];

    var i="1";
    var sl= 1;

    $("#addbtn").click(function(event){
        var productid = $(this).val();
        var suplierid = $("#suplierid").val();

        if (productid && suplierid){

            var content = document.getElementsByClassName('tagBox')[0];
            var contentItems =content.getElementsByClassName('tag');
            if (contentItems.length==0){
                var productBarcode = " ";
            }else{
                var productBarcode = [];
            }

            for(var v = 0; v < contentItems.length; v++ ){
                var contentItemInput = contentItems[v].getElementsByTagName('input')[0].value;
                productBarcode.push(contentItemInput);
            }

            var buypriceval = $("#buypriceval").val();
            var sell_priceval = $("#sellpriceval").val();
            var totalbuyval = $("#totalbuyval").val();
            var quantity_last = $("#quantity_last").val();
            var product_name = $("#product_namevalu").val();
            var selltype 	= $("#selltype").val();
            var symbol 	= $("#symbol_id").val();

            if (symbol){
                var symboldata = symbol;
            }else{
                var symboldata = " ";
            }

            var tr = '<tr id="item_row">';
            tr += (
                '<td>'+  sl +  '</td>'+
                '<td>' + product_name + '</td>' +
                '<td>' + buypriceval + '</td>' +
                '<td>' + quantity_last + '</td>' +
                '<td>' + totalbuyval + '</td>'+
                '<td>' + sell_priceval + '</td>' +
                '<td>' + '<div class="btn btn-sm btn-danger remove_field"> X </div>' +'</td>'
            );

            tr += ('</td>');
            tr += '</tr>';

            $( "#item_list tbody" ).append(tr);

            i++;
            sl++;

            var serialval = i-1;
            var newsl = serialval.toString();
            var float_subby = buypriceval * quantity_last ;
            sellValues.push(float_subby);
            const sub_total = sellValues.reduce(add);

            obj = {product_name:product_name,serialid:newsl,product_id:productid, allsub_total:sub_total, singlebuyprice:buypriceval, quntity_valu:quantity_last, singleprice:sell_priceval,singlesubtotal:totalbuyval,selltype:selltype,symboldata:symboldata,productBarcode:productBarcode};

            product_info.push(obj);
            // console.log(product_info);

            var status = $("#suplier_status").val();
            var accounts = $("#suplier_ledger").val();
            if (status !=""){
                if(status==0){
                    var lastbalance = sub_total - accounts ;
                    $('#calculate').val(lastbalance);

                }else if(status==1){
                    var lastbalanceoo =  parseFloat(sub_total) + parseFloat(accounts);
                    $('#calculate').val(lastbalanceoo);
                }else{
                    $('#calculate').val(sub_total);
                }
            }else{
                $('#calculate').val(sub_total);
            }

            $('#suplier_buy').val(sub_total);
            $('#paableamount').val(sub_total);
            $('#subtotal_cash').val(sub_total);

            // flash data in input form

            $('#pic_value').val('');
            $('#symbol_id').val('');
            $('#dozen_val').val('');
            $('#dozen_Pic_Value').val('');
            $('#selltype').val('');
            $('#productidval').val('');
            $('#quantity_last').val('');
            $('#product_namevalu').val('');
            $('#buypriceval').val('');
            $('#totalbuyval').val('');
            $('#sellpriceval').val('');
            $('#laber_cost').val('');
            $('#discount_flat').val('');
            $('#suplier_payment').val('');
            $('#button1').val('');
            $('#select2-product_iddata-container').html("");
            $('#select2-input_product_code-container').html("");
            $('.tag').remove();
            $('.bootstrap-tagsinput').find('span').remove();
            $('.purchesh').empty().append('');
            $('#name_tags').val("");


        }else{
            alert("Select Supplier ID");
            $('#name_tags').focus();
            $('#suplier_iddata').focus();
        }

    }); // plus button

    function getInsideCodes(){

    }

    $('#laber_cost').on('change', function(){
        var laber_cost = $("#laber_cost").val();
        var suplier_buy = $("#suplier_buy").val();
        if (laber_cost==""){
            var lcost = 0;
        }else{
            var lcost = laber_cost;
        }
        var total_payable =  parseFloat(suplier_buy) + parseFloat(lcost);

        var status = $("#suplier_status").val();
        var accounts = $("#suplier_ledger").val();
        if (status !=""){
            if(status==0){
                var lastbalance = total_payable - accounts ;
                $('#calculate').val(lastbalance);

            }else if(status==1){
                var lastbalanceoo =  parseFloat(total_payable) + parseFloat(accounts);
                $('#calculate').val(lastbalanceoo);
            }else{
                $('#calculate').val(total_payable);
            }
        }else{
            $('#calculate').val(total_payable);
        }

        $('#paableamount').val(total_payable);
        $('#subtotal_cash').val(total_payable);
    });


    $('#discount_flat').on('change', function(){
        var disccount = $("#discount_flat").val();
        var suplier_buy = $("#suplier_buy").val();
        var laber_cost = $("#laber_cost").val();

        if (laber_cost==""){
            var lcost = 0;
        }else{
            var lcost = laber_cost;
        }
        var buyamount =  parseFloat(suplier_buy) + parseFloat(lcost);
        var buyamountlast =  buyamount - disccount;
        $('#subtotal_cash').val(buyamountlast);

        var status = $("#suplier_status").val();
        var accounts = $("#suplier_ledger").val();
        if (status !=""){
            if(status==0){
                var lastbalance = buyamountlast - accounts ;
                $('#calculate').val(lastbalance);

            }else if(status==1){
                var lastbalanceoo =  parseFloat(buyamountlast) + parseFloat(accounts);
                $('#calculate').val(lastbalanceoo);
            }else{
                $('#calculate').val(buyamountlast);
            }
        }else{
            $('#calculate').val(buyamountlast);
        }
    });

    $('#suplier_payment').on('change', function(){
        var suplierpayment = $("#suplier_payment").val();
        var suplier_buy = $("#suplier_buy").val();
        var disccount = $("#discount_flat").val();
        var laber_cost = $("#laber_cost").val();

        if (laber_cost==""){
            var lcost = 0;
        }else{
            var lcost = laber_cost;
        }
        if (disccount==""){
            var discost = 0;
        }else{
            var discost = disccount;
        }

        var totalbuyamountlast =  parseFloat(suplier_buy) + parseFloat(lcost);
        var lastbuyamount = totalbuyamountlast - discost ;
        var buyamountlast =  lastbuyamount - suplierpayment;

        var status = $("#suplier_status").val();
        var accounts = $("#suplier_ledger").val();

        if (status !=""){
            if(status==0){
                var lastbalance = buyamountlast - accounts ;
                $('#calculate').val(lastbalance);

            }else if(status==1){
                var lastbalanceoo =  parseFloat(buyamountlast) + parseFloat(accounts);
                $('#calculate').val(lastbalanceoo);
            }else{
                $('#calculate').val(buyamountlast);
            }
        }else{
            $('#calculate').val(buyamountlast);
        }

    });

    $("#checkval").click(function(){
        var check = $(this).prop('checked');
        if(check == true) {
            var stat = "1";
            $('#checkvalchange').val(stat);
        } else {
            var stat = "0";
            $('#checkvalchange').val(stat);
        }
    });

    $(document).on('click', '.remove_field', function() {
        var serial_r = $(this).closest('tr').find('td:eq(0)').text();
        var productname = $(this).closest('tr').find('td:eq(1)').text();
        var singBuyprice = $(this).closest('tr').find('td:eq(2)').text();
        var quantiry = $(this).closest('tr').find('td:eq(3)').text();
        var subtotal_r = $(this).closest('tr').find('td:eq(4)').text();
        var sellpricesn = $(this).closest('tr').find('td:eq(5)').text();
        $(this).parents('tr').remove();

        const index = product_info.findIndex(function (todo, index){
            return todo.serialid === serial_r
        })

        product_info.splice(index, 1);

        var suplier_buy = $("#suplier_buy").val();
        var nitsellamount = suplier_buy - subtotal_r;

        $('#suplier_buy').val(nitsellamount);
        $('#paableamount').val(nitsellamount);
        $('#subtotal_cash').val(nitsellamount);
        var status = $("#suplier_status").val();
        var accounts = $("#suplier_ledger").val();

        if (status !=""){
            if(status==0){
                var lastbalance = nitsellamount - accounts ;
                $('#calculate').val(lastbalance);
            }else if(status==1){
                var lastbalanceoo =  parseFloat(nitsellamount) + parseFloat(accounts);
                $('#calculate').val(lastbalanceoo);
            }else{
                $('#calculate').val(nitsellamount);
            }
        }else{
            $('#calculate').val(nitsellamount);
        }

        if (nitsellamount === 0) {
            location.reload();
        }
        $('#laber_cost').val("");
        $('#discount_flat').val("");
        $('#suplier_payment').val("");

    });


    $("#order_submit_btn").on('click',function(e){

        var suplierid 		= $("#suplierid").val();
        var laber_cost 		= $("#laber_cost").val();
        var discountflat 	= $("#discount_flat").val();
        var suplier_payment = $("#suplier_payment").val();
        var checkval 		= $("#checkvalchange").val();
        var suplier_buy 	= $("#suplier_buy").val();
        var balanch_cash = $("#calculate").val();
        var sellingdate = $("#sellingdate").val();

        if (suplierid !="" && suplier_buy !="") {
            $.ajax({
                url: '/Purchase',
                type: 'post',
                data: {
                    "requested_data": product_info,
                    "suplierid": suplierid,
                    "laber_cost": laber_cost,
                    "suplier_payment": suplier_payment,
                    "checkval": checkval,
                    "suplier_buy": suplier_buy,
                    "discountflat": discountflat,
                    balanch_cash: balanch_cash,
                    sellingdate: sellingdate
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',

                success: function (data) {
                    $('#order_submit_btn').attr('disabled','disabled');
                    //console.log(data);
                    if (data.status == "success") {
                        toastr["success"]("Product Purchase Added Success")
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }

                    }

                    location.reload();
                    $('#name_tags').focus();
                    $('#suplierid').val('');
                    $('#suplier_buy').val('');
                    $('#order_submit_btn').attr('disabled','disabled');

                },
                error: function(data){
                    alert("Check Data !");
                }

            });
        }else{
            alert("Check Data !");
            $('#suplierid').focus();
        }

        $(this).prop("disabled",true);
        $(this).attr("disabled","disabled");

        //location.reload();

    });



//=======================================
});// end function


