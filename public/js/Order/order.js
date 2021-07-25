
    $(function(){

        var productCartIds = [];
        var leftQty ;
        var newaccounts ;

        $('#customer_id').on('change', function(){
            var customer_id = $(this).val();
            $('#customerid_store').val(customer_id);

            $.ajax({
                type: 'GET',
                url:'/customer_accounts_data/'+customer_id,
                success: function (data) {
                    //console.log(data);
                    $('#customer_status').val(data.status);
                    $('#custome_ledger').val(data.accounts);
                    $('#Customername').val(data.customer_name);

                    var grandtotal = $("#grandtotal").val();
                    var actual_blanch = $("#actual_blanch").val();
                    var accounts = data.accounts;
                     newaccounts = accounts.replace(/\-/g, "");

                    if (actual_blanch==""){
                        var subtotalcash = grandtotal;
                    }else{
                        var subtotalcash = actual_blanch;
                    }

                    if (subtotalcash !=""){
                        if(data.status == 1){
                            $('#customer_account').val(data.accounts);
                            $('#last_balanch').val( subtotalcash - newaccounts);
                        }else{
                            $('#last_balanch').val(parseFloat(subtotalcash) + parseFloat(newaccounts));
                            $('#customer_account').val(data.accounts);
                        }
                    }else{
                        $('#customer_account').val(data.accounts);
                        $('#last_balanch').val(data.accounts);
                    }

                }

            });
        });

        $( function() {
            $.ajax({
                type: 'GET',
                url:'/productselect_ajax_order',
                success: function (data) {
                    var availableTags = [];
                    for(var k in data){
                        availableTags.push(data[k].product_id +" : "+data[k].product_name + ' : '+data[k].barcode + " : " +data[k].attribute);
                    }
                    $( "#tags" ).autocomplete({
                        source: availableTags
                    });

                }
            });

        }); // end function
        $('.newtag').on('change', function () {
            $('#tagsname').html('You selected: ' + this.value);
        }).change();
        $('.newtag').on('autocompleteselect', function (e, ui) {
            $('#tagsname').html('You selected: ' + ui.item.value);
            var string = (ui.item.value);
            var arr = string.split(" : ");
            var productidset = arr[0];
            var name_product = arr[1];
            var product_code = arr[2];
            var product_attr = arr[3];

            $.ajax({
                type: 'GET',
                url:'/productdata_orderselect/'+productidset+"/"+product_code+"/"+product_attr,
                success: function (data) {
                    var mydata = $.parseJSON(data);
                    var Productdata = (mydata.Product);
                    var qtydata = (mydata.Rest_qty);
                    var productrate = (mydata.Rate);
                    var barcodedata = (mydata.Barcode);
                    var customerid = document.getElementById("customer_id")[0]['value'];

                    if(qtydata != null){
                        $('#sellprice_data').val(productrate.sell_price);
                        $('#bercode_input_data').val(barcodedata.barcode);
                        $('#selltype').val(Productdata.sell_type);
                        $('#product_namevalu').val(Productdata.product_name);
                        $('#productdetails').val(Productdata.product_deatils+" - "+qtydata.attribute);
                        $('#product_details').val(Productdata.product_deatils);
                        $('#productidval').val(productidset);
                        $('#addbtn').val(productidset);
                        $('#sell_quantity').val("1");
                        $('#customerid_store').val(customerid);
                        $('#symboledatanew').val(qtydata.attribute);

                        var qty = qtydata.rest_qty;

                        if(productCartIds.length == 0){
                            leftQty = qty;
                        }else{
                            for(var q = 0; q < productCartIds.length; q++){
                                var cqty = qty;
                                if(productCartIds[q]['id'] == Productdata.id){
                                    leftQty = cqty - productCartIds[q]['qty'];
                                }else{
                                    leftQty = qty;
                                }
                            }
                        }

                        $('#singlesubtotal').val(productrate.sell_price);

                        $('#stoke_qty').val(leftQty);

                        $('#sell_quantity').on('change', function(){
                            var sellquantity = $("#sell_quantity").val();
                            var sellprice = $("#sellprice_data").val();

                            if (sellprice !=""){
                                var subtotal_val = sellquantity * sellprice;
                            }else{
                                var subtotal_val = 0;
                            }

                            $('#singlesubtotal').val(subtotal_val);
                        });

                        $('#sellprice_data').on('change', function(){
                            var sellprice = $("#sellprice_data").val();
                            var sellquantity = $("#sell_quantity").val();
                            var subtotal_val = sellquantity * sellprice;
                            $('#singlesubtotal').val(subtotal_val);
                        });

                    }else{
                        alert("Product Not Found");
                        $('#select2-product_iddata-container').html("");
                        $('#select2-input_product_code-container').html("");
                        $('.bootstrap-tagsinput').find('span').remove();
                        $('.purchesh').empty().append('');
                        $('#tags').val("");
                        $('#productdetails').val('');
                        $('#bercode_input_data').val('');
                        $('#stoke_qty').val('');
                        $('#bercode_input_data').focus();
                    }

                }, // success data end
                error: function(data){
                    alert("Wrong !");
                }

            }); // ajax end

        }); // main search data end


        $('#bercode_input_data').on("change",function() {
            var length = $(this).val().length;
            if ($(this).val().length > 5 || length < 15) {
                var product_code = $(bercode_input_data).val();

                $.ajax({
                    type: 'GET',
                    url:'/productdata_orderselect_code/'+product_code,
                    success: function (data) {
                        var mydata = $.parseJSON(data);
                        var Productdata = (mydata.Product);
                        var qtydata = (mydata.Rest_qty);
                        var productrate = (mydata.Rate);
                        var barcodedata = (mydata.Barcode);


                        var customerid = document.getElementById("customer_id")[0]['value'];

                        if(qtydata != null){
                            $('#sellprice_data').val(productrate.sell_price);
                            $('#tags').val(Productdata.product_name);
                            $('#selltype').val(Productdata.sell_type);
                            $('#product_namevalu').val(Productdata.product_name);
                            $('#productdetails').val(Productdata.product_deatils+" - "+qtydata.attribute);
                            $('#product_details').val(Productdata.product_deatils);
                            $('#productidval').val(Productdata.id);
                            $('#addbtn').val(Productdata.id);
                            $('#sell_quantity').val("1");
                            $('#customerid_store').val(customerid);
                            $('#symboledatanew').val(qtydata.attribute);

                            var qty = qtydata.rest_qty;

                            if(productCartIds.length == 0){
                                leftQty = qty;
                            }else{
                                for(var q = 0; q < productCartIds.length; q++){
                                    var cqty = qty;
                                    if(productCartIds[q]['id'] == Productdata.id){
                                        leftQty = cqty - productCartIds[q]['qty'];
                                    }else{
                                        leftQty = qty;
                                    }
                                }
                            }

                            $('#singlesubtotal').val(productrate.sell_price);

                            $('#stoke_qty').val(leftQty);

                            $('#sell_quantity').on('change', function(){
                                var sellquantity = $("#sell_quantity").val();
                                var sellprice = $("#sellprice_data").val();

                                if (sellprice !=""){
                                    var subtotal_val = sellquantity * sellprice;
                                }else{
                                    var subtotal_val = 0;
                                }

                                $('#singlesubtotal').val(subtotal_val);
                            });

                            $('#sellprice_data').on('change', function(){
                                var sellprice = $("#sellprice_data").val();
                                var sellquantity = $("#sell_quantity").val();
                                var subtotal_val = sellquantity * sellprice;
                                $('#singlesubtotal').val(subtotal_val);
                            });

                        }else{
                            alert("Product Not Found");
                            $('#select2-product_iddata-container').html("");
                            $('#select2-input_product_code-container').html("");
                            $('.bootstrap-tagsinput').find('span').remove();
                            $('.purchesh').empty().append('');
                            $('#tags').val("");
                            $('#productdetails').val('');
                            $('#bercode_input_data').val('');
                            $('#stoke_qty').val('');
                            $('#bercode_input_data').focus();
                        }

                    }, // success data end
                    error: function(data){
                        alert("Wrong !");
                        $('#select2-product_iddata-container').html("");
                        $('#select2-input_product_code-container').html("");
                        $('.bootstrap-tagsinput').find('span').remove();
                        $('.purchesh').empty().append('');
                        $('#tags').val("");
                        $('#productdetails').val('');
                        $('#bercode_input_data').val('');
                        $('#stoke_qty').val('');
                        $('#bercode_input_data').focus();
                    }

                }); // ajax end

            }
        });


        function add(accumulator, a) {
            return accumulator + a;
        }
        var product_info = []; // form submit
        var calculative_data = {};
        var x = 1;
        var sellValues = [];
        var item_sell_value = [];

        var i="1";

        $("#addbtn").click(function(event){
            var productid = $(this).val();
            var customerid 		= $("#customerid_store").val();
            var stoke_qty = $("#stoke_qty").val();
            var sellquantityd = $("#sell_quantity").val();
            var newqt =  Number(sellquantityd);
            var sellpricesingle = $("#sellprice_data").val();
            var symboledata = $("#symboledatanew").val();


            if (productid && sellpricesingle){
                if (!(newqt > leftQty)){
                    var sellquantityc = $("#sell_quantity").val();
                    var product_name = $("#product_namevalu").val();
                    var sellpricesinglea = $("#sellprice_data").val();
                    var singlesubtotal = $("#singlesubtotal").val();
                    var product_details = $("#product_details").val();
                    var bercode = $("#bercode_input_data").val();

                    var tr = '<tr id="item_row">';
                    tr += (
                        '<td>'+  i +  '</td>'+
                        '<td>' + product_name + '</td>' +
                        '<td>' + bercode + '</td>' +
                        '<td class="pd_id">' + productid + '</td>' +
                        '<td class="qtysell">' + sellquantityc + '</td>' +
                        '<td>' + sellpricesinglea + '</td>' +
                        '<td>' + singlesubtotal + '</td>'+
                        '<td>' + '<div class="btn btn-sm btn-danger remove_field" style="width: 32px;\n' +
                        '        height: 20px;\n' +
                        '        text-align: center;\n' +
                        '        padding: 0px;"> X </div>' +'</td>'
                    );

                    tr += ('</td>');
                    tr += '</tr>';

                    $( "#item_list tbody" ).append(tr);

                    i++;

                    var serialval = i-1;
                    var newsl = serialval.toString();
                    var newsellprice = sellpricesinglea * sellquantityc;
                    sellValues.push(newsellprice);
                    const sub_total = sellValues.reduce(add);

                    obj = {product_name:product_name,serialid:newsl,product_id:productid, singlesub_total:sub_total, sellprice:sellpricesinglea, quntity_valu:sellquantityc,product_details:product_details,bercode:bercode,symboledata:symboledata};

                    product_info.push(obj);

                    console.log(product_info);
                    var cartIds = document.getElementsByClassName('pd_id');

                    for(var p = 0; p < cartIds.length; p++){
                        productCartIds.push({
                            'id': document.getElementsByClassName('pd_id')[p].innerText,
                            'qty': document.getElementsByClassName('qtysell')[p].innerText
                        });
                    }
                    $('#subtotal_data').val(sub_total);
                    $('#cash_payment').val(sub_total);
                    $('#grandtotal').val(sub_total);

                    var status = $("#customer_status").val();
                    var accounts = $("#custome_ledger").val();
                    var actual_blanch = $("#actual_blanch").val();

                    if (actual_blanch==""){
                        var subtotalcash = 0;
                    }else{
                        var subtotalcash = actual_blanch;
                    }

                    if (status !=""){
                        if(status==1){
                            var lastbalance = subtotalcash - newaccounts ;
                            $('#last_balanch').val(lastbalance);
                        }else if(status==0){
                            var lastbalanceoo =  parseFloat(subtotalcash) + parseFloat(newaccounts);
                            $('#last_balanch').val(lastbalanceoo);
                        }else{
                            $('#last_balanch').val(subtotalcash);
                        }
                    }else{
                        $('#last_balanch').val(subtotalcash);
                    }


                    $('#bercode_input_data').val("");
                    $('#tonvalue').val("");
                    $('#kgvaluedata').val("");
                    $('#cartonvalu').val("");
                    $('#picvalu').val("");
                    $('#sell_quantity').val("");
                    $('#sellprice_data').val("");
                    $('#addbtn').val("");
                    $('#stoke_qty').val("");
                    $('#productdetails').val("");
                    $('#symboledata').val("");
                    $('#singlesubtotal').val("");
                    $('#select2-product_iddata-container').html("");
                    $('#select2-input_product_code-container').html("");
                    $('.bootstrap-tagsinput').find('span').remove();
                    $('.order_group').empty().append('');
                    $('#tags').val("");
                    $('#bercode_input_data').focus();


                }else{
                    alert("Check Product");
                    $('input[name="sale_qty"]').focus();
                }

            }else{
                alert("Select Customer And Product");
                $('#bercode_input_data').focus();
            }

        }); //add + buttom end

        $('#sell_cost').on('change', function(){
            var sell_cost = $("#sell_cost").val();
            var subtotal_data = $("#subtotal_data").val();
            var return_amount = $("#return_amount").val();
            var costlase_value = parseFloat(subtotal_data) + parseFloat(sell_cost);
            var sellvalureturnlase = costlase_value - return_amount;
            $('#grandtotal').val(sellvalureturnlase);
            $('#cash_payment').val(sellvalureturnlase);
            $('#discount_sell').val('');

            // var status = $("#customer_status").val();
            // var accounts = $("#custome_ledger").val();
            //
            // if (status !=""){
            //     if(status==1){
            //         var lastbalance = costlase_value - accounts ;
            //         $('#last_balanch').val(lastbalance);
            //     }else if(status==0){
            //         var lastbalanceoo =  parseFloat(costlase_value) + parseFloat(accounts);
            //         $('#last_balanch').val(lastbalanceoo);
            //     }else{
            //         $('#last_balanch').val(costlase_value);
            //     }
            // }else{
            //     $('#last_balanch').val(costlase_value);
            // }
            document.getElementById("order_submit_btn").disabled = false;
        });

        $('#discount_sell').on('change', function(){
            var discount_sell = $("#discount_sell").val();
            var subtotal_data = $("#subtotal_data").val();
            var sell_cost = $("#sell_cost").val();
            var return_amount = $("#return_amount").val();
            if (sell_cost !=""){
                var costlase_value = parseFloat(subtotal_data) + parseFloat(sell_cost);
            }else{
                var costlase_value = subtotal_data;
            }
            var discountlase_value =  costlase_value - discount_sell;
            var lastsellvalu = discountlase_value - return_amount;

            $('#grandtotal').val(lastsellvalu);
            $('#cash_payment').val(lastsellvalu);

            // var status = $("#customer_status").val();
            // var accounts = $("#custome_ledger").val();
            //
            // if (status !=""){
            //     if(status==1){
            //         var lastbalance = discountlase_value - accounts ;
            //         $('#last_balanch').val(lastbalance);
            //     }else if(status==0){
            //         var lastbalanceoo =  parseFloat(discountlase_value) + parseFloat(accounts);
            //         $('#last_balanch').val(lastbalanceoo);
            //     }else{
            //         $('#last_balanch').val(discountlase_value);
            //     }
            // }else{
            //     $('#last_balanch').val(discountlase_value);
            // }
            document.getElementById("order_submit_btn").disabled = false;
        });

        $('#cash_payment').on('change', function(){
            var cash_payment = $("#cash_payment").val();
            var discount_sell = $("#discount_sell").val();
            var subtotal_data = $("#subtotal_data").val();
            var sell_cost = $("#sell_cost").val();

            if (sell_cost !=""){
                var costlase_value = parseFloat(subtotal_data) + parseFloat(sell_cost);
            }else{
                var costlase_value = subtotal_data;
            }
            if (discount_sell !=""){
                var discountlase_value =  costlase_value - discount_sell;
            }else{
                var discountlase_value =  costlase_value;
            }

            var payment_blanch = discountlase_value - cash_payment;
            $('#actual_blanch').val(payment_blanch);

            var status = $("#customer_status").val();
            var accounts = $("#custome_ledger").val();

            if (status !=""){
                if(status==1){
                    var lastbalance = payment_blanch - newaccounts ;
                    $('#last_balanch').val(lastbalance);
                }else if(status==0){
                    var lastbalanceoo =  parseFloat(payment_blanch) + parseFloat(newaccounts);
                    $('#last_balanch').val(lastbalanceoo);
                }else{
                    $('#last_balanch').val(payment_blanch);
                }
            }else{
                $('#last_balanch').val(payment_blanch);
            }
            document.getElementById("order_submit_btn").disabled = false;
        });  // customer payment end

        $('#note_input').on('change',function (){
            var noteval = $(this).val();
            var cashpay = $("#cash_payment").val();
            var noteval = noteval - cashpay;
            $("#return_show").val(noteval);
        });

        $(document).on('click', '.remove_field', function() {
            var showroom_id = $("#showroom_id").val();
            var serial_r = $(this).closest('tr').find('td:eq(0)').text();
            var productname = $(this).closest('tr').find('td:eq(1)').text();
            var code = $(this).closest('tr').find('td:eq(2)').text();
            var productid = $(this).closest('tr').find('td:eq(3)').text();
            var quantiry = $(this).closest('tr').find('td:eq(4)').text();
            var sellprice = $(this).closest('tr').find('td:eq(5)').text();
            var subtotalval = $(this).closest('tr').find('td:eq(6)').text();
            $(this).parents('tr').remove();

            const index = product_info.findIndex(function (todo, index){
                return todo.serialid == serial_r
            })

            product_info.splice(index, 1);

            var subtotal_data = $("#subtotal_data").val();
            var nitsellamount = subtotal_data - subtotalval;

            var status = $("#customer_status").val();
            var accounts = $("#custome_ledger").val();

            if (status !=""){
                if(status==1){
                    var lastbalance = nitsellamount - newaccounts ;
                    $('#last_balanch').val(lastbalance);
                }else if(status==0){
                    var lastbalanceoo =  parseFloat(nitsellamount) + parseFloat(newaccounts);
                    $('#last_balanch').val(lastbalanceoo);
                }else{
                    $('#last_balanch').val(nitsellamount);
                }
            }else{
                $('#last_balanch').val(nitsellamount);
            }

            $('#subtotal_data').val(nitsellamount);
            $('#grandtotal').val(nitsellamount);
            $('#cash_payment').val(nitsellamount);

            $('#sell_cost').val("");
            $('#discount_sell').val("");
            $('#Invoice').val("");
            $('#return_amount_taka').val("");

            if (nitsellamount == 0) {
                location.reload();
                $('#sell_cost').val("");
                $('#discount_sell').val("");
                $('#Invoice').val("");
                $('#return_amount_taka').val("");
            }

        }); //remove btn end



        $('#Invoice').on('change',function (){
            var id = $(this).val();
            $.ajax({
                type: 'GET',
                url: '/returninvoiceid/' + id,
                success: function (data) {
                   // console.log(data);
                    if (data !=0 ){
                        var subtotal_data = $("#subtotal_data").val();
                        $('#return_amount').val(data.return_cash);
                        $('#return_amount_taka').val(data.return_cash);
                        $('#return_id').val(data.return_invoice);
                        var payableblanch = subtotal_data - data.return_cash;

                        var status = $("#customer_status").val();

                        if (status !=""){
                            if(status==1){
                                var lastbalance = payableblanch - newaccounts ;
                                $('#last_balanch').val(lastbalance);

                            }else if(status==0){
                                var lastbalanceoo =  parseFloat(payableblanch) + parseFloat(newaccounts);
                                $('#last_balanch').val(lastbalanceoo);
                            }else{
                                $('#last_balanch').val(payableblanch);
                            }
                        }
                        $('#grandtotal').val(payableblanch);
                        $('#cash_payment').val(payableblanch);

                    }else{
                        alert("Invoice no match")
                        $('#return_amount').val('');
                        $('#Invoice').val('');
                        $('#Invoice').focus();
                    }
                }
            });
        });


        $("#order_submit_btn").on('click',function(e) {

            var customer_id = $("#customer_id").val();
            var sell_cost = $("#sell_cost").val();
            var discount_sell = $("#discount_sell").val();
            var cash_payment = $("#cash_payment").val();
            var subtotal_data = $("#subtotal_data").val();
            var sellingdate = $("#sellingdate").val();
            var lastbalanch = $("#last_balanch").val();
            var note_input = $("#note_input").val();
            var return_show = $("#return_show").val();
            // var cardname = $("#cardname").val();
            // var cardno = $("#cardno").val();
            // var mobleno = $("#mobleno").val();
            // var bankname = $("#bankname").val();
            // var chequeno = $("#chequeno").val();

            var return_amount = $("#return_amount").val();
            var return_id = $("#return_id").val();
            if (customer_id !="" && cash_payment !==""){
                $.ajax({
                    type: 'POST',
                    url: '/Order',
                    data: {
                        "requested_data": product_info,
                        "customerid": customer_id,
                        "sell_cost": sell_cost,
                        "discount_amount": discount_sell,
                        "cash_payment": cash_payment,
                        "totalsubtotal_data": subtotal_data,
                        "sellingdate": sellingdate,
                        "pay_lase_lastbalanch": lastbalanch,
                        "note_input": note_input,
                        "return_show": return_show,
                        // "cardname": cardname,
                        // "cardno": cardno,
                        // "bkash": mobleno,
                        // "bankname": bankname,
                        // "chequeno": chequeno,
                        "return_amount": return_amount,
                        "return_id": return_id,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('#order_submit_btn').attr('disabled','disabled');
                        //console.log(data);
                        if (data.status == "success") {
                            // var invoiceid = data.invoice;
                            // newurl="/order/invoice/print";
                            // myWindow = window.open(newurl+"/"+invoiceid, "myWindow", "width=400, height=650");
                            // myWindow.focus();
                            // myWindow.print();
                            toastr["success"]("Order Added Success")
                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": false,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "400",
                                "hideDuration": "1000",
                                "timeOut": "6000",
                                "extendedTimeOut": "3000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                        }
                        location.reload();
                        $('#customer_id').val('');
                        $('#cash_payment').val('');
                        $('#order_submit_btn').attr('disabled','disabled');
                    },

                });
            }else{
                alert("Select Customer");
                $('#customer_id').focus();
            }
            $(this).prop("disabled",true);
            $(this).attr("disabled","disabled");
            //location.reload();
        });  // order submit done



    }); // function end



    function focusNext(e) {
        var idArray =["tags","bercode_input_data","sell_quantity","sellprice_data","addbtn","Invoice","sell_cost","discount_sell","cash_payment","note_input","order_submit_btn"];
        try {
            for (var i = 0; i < idArray.length; i++) {
                if (e.keyCode === 13 && e.target.id === idArray[i]) {
                    document.querySelector(`#${idArray[i+1]}`).focus();
                    if (idArray[i] == "addbtn"){
                        alertify.set({ buttonReverse: true });
                        alertify.confirm("Do you want to add more products ?", function (e) {
                            if (e) {
                                $('#bercode_input_data').focus();
                            } else {
                                $('#Invoice').focus();
                                document.querySelector(`#${idArray[i+1]}`).focus();
                            }
                        });
                    }
                }
            }
        } catch(error){}
    }


