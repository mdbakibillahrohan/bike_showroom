$(function(){
       var newaccounts ;
    $('#customeriddata').on('change', function(){
        var customer_id = $(this).val();
        //console.log(customer_id);
        $('#customerid').val(customer_id);
        $.ajax({
            type: 'GET',
            url:'/returndata_data/'+customer_id,
            success: function (data) {

                var mydata = $.parseJSON(data);
                var customerdata = (mydata.customer);
                var order = (mydata.orderdata);

                $('#customer_status').val(customerdata.status);
                $('#customer_account').val(customerdata.accounts);
                var accounts = customerdata.accounts;
                newaccounts = accounts.replace(/\-/g, "");

                var nitsellamount = $("#subtotal_data").val();

                if (nitsellamount !=''){
                    if(customerdata.status==1){
                        var lastbalance =  parseFloat(nitsellamount) + parseFloat(newaccounts);
                        $('#grandtotal').val(lastbalance);
                    }else{
                        var lastbalance = nitsellamount - newaccounts ;

                        $('#grandtotal').val(lastbalance);

                    }

                }else{
                    $('#grandtotal').val(accounts);
                }
                $('#cash_payment').val("");

                var availableTags = [];
                for(var k in order){
                    availableTags.push(order[k].product_name + ' = '+order[k].id);
                }
                $( "#tags" ).autocomplete({
                    source: availableTags
                });

            }
        });

    });

    var pdname;

    $('.newtag').on('change', function () {
        $('#tagsname').html('You selected: ' + this.value);
    }).change();
    $('.newtag').on('autocompleteselect', function (e, ui) {
        $('#tagsname').html('You selected: ' + ui.item.value);
        var string =(ui.item.value);
        var arr = string.split("=");
         pdname = arr[0];
        var orderid = arr[1];
        $.ajax({
            type: 'GET',
            url: '/sellingproductdetails/'+orderid,
            success: function (data) {
              //  console.log(data);
                $('#selldate').val(data.selldate);
                $('#productid').val(data.product_id);
                $('#sellquantity').val(data.quantity);
                $('#sellprice').val(data.sellprice);
                $('#returnprice').val(data.sellprice);
                $('#subtotal').val(data.total_sellprice);
                $('#sellinvoice').val(data.invoice_no);
                $('#addbtn').val(data.id);
            }
        });

    });

    $('#return_qty').on('change', function(){
        var return_qty = $("#return_qty").val();
        var returnprice = $("#returnprice").val();

        if (returnprice !=0){
            var returnamount = returnprice * return_qty;
        }else{
            var returnamount = returnprice;
        }
        $('#returnamounttotal').val(returnamount);
    });


    $('#returnprice').on('change', function(){
        var newprice = $("#returnprice").val();
        var return_qty = $("#return_qty").val();
        var newsubtotal = newprice * return_qty;
        $('#returnamounttotal').val(newsubtotal);
    });

    function add(accumulator, a) {
        return accumulator + a;
    }
    var product_info = []; // form submit
    var x = 1;
    var sellValues = [];

    var i="1";
    $("#addbtn").click(function(event){
        var orderid = $(this).val();

        if (orderid){
            var returnprice = $("#returnprice").val();
            var sellquantity = $("#return_qty").val();
            var singletotal= $("#returnamounttotal").val();
            var custid = $("#customeriddata").val();
            var sellinvoice = $("#sellinvoice").val();
            var product_id = $("#productid").val();

            if (returnprice==''){
                var reprice = sellprice;
            }else{
                var reprice = returnprice;
            }

            var tr = '<tr id="item_row">';
            tr += (
                '<td>'+  i +  '</td>'+
                '<td>' + pdname + '</td>' +
                '<td>' + returnprice + '</td>' +
                '<td>' + sellquantity + '</td>' +
                '<td>' + singletotal + '</td>' +
                '<td>' + '<div class="btn btn-sm btn-danger remove_field"> X </div>' +'</td>'
            );

            tr += ('</td>');
            tr += '</tr>';


            $( "#item_list tbody" ).append(tr);

            i++;

            var serialval = i-1;
            var newsl = serialval.toString();
            var newsellprice = returnprice * sellquantity;
            sellValues.push(newsellprice);
            const sub_total = sellValues.reduce(add);

            obj = {product_name:pdname,orderid:orderid,newprice:returnprice,qty:sellquantity,subtotal:singletotal,custid:custid,sellinvoice:sellinvoice,product_id:product_id};

            product_info.push(obj);

            $('#subtotal_data').val(sub_total);
            var status = $("#customer_status").val();
            var accounts = $("#customer_account").val();

            if (accounts !=''){
                if(status==1){
                    var lastbalance =  parseFloat(sub_total) + parseFloat(newaccounts);
                    $("#grandtotal").val(lastbalance);
                }else{
                    var lastbalance =  newaccounts - sub_total ;
                    $("#grandtotal").val(lastbalance);

                }
            }else{
                $("#grandtotal").val(sub_total);
            }



            $('#addbtn').val("");
            $('#tags').val("");
            $('#sellquantity').val("");
            $('#subtotal').val("");
            $('#sellprice').val("");
            $('#return_qty').val("");
            $('#returnprice').val("");
            $('#returnamounttotal').val("");
            $('#sellinvoice').val("");

            $('#tags').focus();
        }

    }); //add + buttom end

    $('#deducted_cash').on('change',function (){
        var deductedval = $(this).val();
        var totalamount = $("#subtotal_data").val();
        var returncash = totalamount - deductedval;

        var status = $("#customer_status").val();
        var accounts = $("#customer_account").val();

        if (accounts !=''){
            if(status==1){
                var lastbalance =  parseFloat(returncash) + parseFloat(newaccounts);
                $("#grandtotal").val(lastbalance);
            }else{
                var lastbalance =  newaccounts - returncash ;
                $("#grandtotal").val(lastbalance);

            }
        }else{
            $("#grandtotal").val(returncash);
        }
    });


    $(document).on('click', '.remove_field', function() {
        var serial_r = $(this).closest('tr').find('td:eq(0)').text();
        $(this).parents('tr').remove();
        if (serial_r) {
            location.reload();
        }
    }); //remove btn end

    $("#checkval").click(function(){
        var check = $(this).prop('checked');
        if(check == true) {
            var stat = "1";
            $('#checkvalue').val(stat);
        } else {
            var stat = "0";
            $('#checkvalue').val(stat);
        }
    });


    $("#return_submit_btn").on('click',function(e) {

        var subtotal_data = $("#subtotal_data").val();
        var deducted_cash = $("#deducted_cash").val();
        var lastbalanchcash = $("#grandtotal").val();
        var returndate = $("#returndate").val();
        var checkvalue = $("#checkvalue").val();
        var customerid = $("#customeriddata").val();


        $.ajax({
            type: 'POST',
            url: '/Return_order',
            data: {
                "requested_data": product_info,
                "subtotal_data": subtotal_data,
                "deductpay": deducted_cash,
                "lastbalanch": lastbalanchcash,
                "returndate": returndate,
                "checkvalue": checkvalue,
                "customerid": customerid
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function (data) {
               // console.log(data);
                if (data.status == "success") {
                    toastr["success"]("Return Order Success")
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
            },

        });

        //location.reload();
    });  // order submit done


}); // function end


var inputs = document.getElementsByClassName('returndatacheck');
var inputIndex = 0;
$(document).on('keypress', 'input,select', function (e) {
    if (e.which == 13) {
        e.preventDefault();

        var newindex = 3;

        var $next = inputs[inputIndex];
        if (inputIndex != newindex) {
            $next = inputs[inputIndex];
            $next.focus();
            inputIndex++;
        }else {
            alertify.set({ buttonReverse: true });
            alertify.confirm("Do you want to add more products ?", function (e) {
                if (e) {
                    inputIndex = 0;
                    $next = inputs[inputIndex];
                    $next.focus();
                    document.getElementById("addbtn").click();
                    $('#tags').focus();
                } else {
                    $('#laber_cost').focus();
                    document.getElementById("addbtn").click();
                    if (inputs.length != inputIndex) {
                        $('#laber_cost').focus();
                        $next = inputs[inputIndex];
                        $next.focus();
                        inputIndex++;
                    }else{
                        document.getElementById("return_submit_btn").click();
                    }
                }
            });

        }
    }
});
