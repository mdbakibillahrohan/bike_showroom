<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//php artisan migrate:fresh --seed
//php artisan serve --port=8080

Route::get('/fresh_data', function() {
    $run = Artisan::call('config:clear');
    $run = Artisan::call('cache:clear');
    $run = Artisan::call('config:cache');
    return 'FINISHED';
});

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/Admin/Dashboard', 'Main_Controller\HomeController@index')->name('admin.dashboard');
Route::get('/User/Dashboard', 'Main_Controller\HomeController@index')->name('user.dashboard');

///====================================================================
Route::get('/Showroom/Access/{id}', 'Main_Controller\AccessController@AccessUser_index')->name('access.dashboard');
Route::get('/menupermision_user', 'Main_Controller\AccessController@MenuUpdate');
//==========================================================================
Route::get('/UsermenuData/{user}', 'Admin_Controller\AjaxController@PermissionMenuUser');
Route::get('/showroomedit/{id}', 'Admin_Controller\AjaxController@ShowroomEditdata');
Route::get('/UserEditData/{id}', 'Admin_Controller\AjaxController@UserEditdata');
Route::get('/categorydataid/{id}', 'Admin_Controller\AjaxController@CategoryIddata');
Route::get('/purchesh_suplier_data/{id}', 'Admin_Controller\AjaxController@Purchesh_suplierdata');
Route::get('/productselect_ajax', 'Admin_Controller\AjaxController@Autocompleteproduct');
Route::get('/productselect_ajax_order', 'Admin_Controller\AjaxController@Searchproduct_order');
Route::get('/productdata_select/{id}', 'Admin_Controller\AjaxController@Autocompleteproduct_select');
Route::get('/productdata_orderselect/{pdid}/{code}/{attr}', 'Admin_Controller\AjaxController@Autocompleteproduct_order');
Route::get('/productdata_orderselect_code/{code}', 'Admin_Controller\AjaxController@Autocompleteproduct_order_code');
Route::get('/customer_accounts_data/{id}', 'Admin_Controller\AjaxController@CustomerAccountData');
Route::get('/SupplierpreviusData/{id}', 'Admin_Controller\AjaxController@SupplierpreviusAccount');
Route::get('/CustomerpreviusData/{id}', 'Admin_Controller\AjaxController@CustomerpreviusAccount');
Route::get('/returndata_data/{id}', 'Admin_Controller\AjaxController@DataReturnOrder');
Route::get('/sellingproductdetails/{id}', 'Admin_Controller\AjaxController@sellingproductdetails');
Route::get('/returninvoiceid/{id}', 'Admin_Controller\AjaxController@returninvoiceid');

//=======================================================================================
//===========================================================================
Route::get('/Menu/Permission','Admin_Controller\MainIndexController@MenuPermission')->name('menu.permission');
Route::get('/Showroom_Index','Admin_Controller\MainIndexController@ShowroomIndex')->name('Add.Showroom');
Route::get('/User_Index','Admin_Controller\MainIndexController@UserIndex')->name('Add.User');
Route::get('/Supplier_index','Admin_Controller\MainIndexController@SupplierIndex')->name('supplier.indexdata');
Route::get('/Customer_index','Admin_Controller\MainIndexController@CustomerIndex')->name('customer.index');
Route::get('/Categories_index','Admin_Controller\MainIndexController@CategoriesIndex')->name('categories.index');
Route::get('/Subcategories_index','Admin_Controller\MainIndexController@SubcategoriesIndex')->name('subcategories.index');
Route::get('/Brand_index','Admin_Controller\MainIndexController@BrandIndex')->name('brand.index');
Route::get('/Product_index','Admin_Controller\MainIndexController@ProductIndex')->name('Product.index');
Route::get('/Product/List','Admin_Controller\MainIndexController@Productlist')->name('Product.List');
Route::get('/Product/Purchase','Admin_Controller\MainIndexController@PurchaseIndex')->name('product.purchase_index');
Route::get('/Product/Stoke','Admin_Controller\MainIndexController@ProductStokeIndex')->name('product.stoke_index');
Route::get('/Product/Details','Admin_Controller\MainIndexController@ProductDetailsIndex')->name('product.details_index');
Route::get('/Order/Index','Admin_Controller\MainIndexController@Order_Index')->name('Order.Index');
Route::get('/Order/Invoice/Details','Admin_Controller\MainIndexController@Order_invoicedetails')->name('Order.Invoice');
Route::get('/Order/Details','Admin_Controller\MainIndexController@Details_order')->name('Order.Details');
Route::get('/Showroom/Expense','Admin_Controller\MainIndexController@ShowroomExpense')->name('showroom.cost');
Route::get('/Showroom/Profit','Admin_Controller\MainIndexController@ShowroomProfit')->name('showroom.profit');
Route::get('/Showroom/Cash-Recive','Admin_Controller\MainIndexController@ShowroomCashRecive')->name('showroom.recivecash');
Route::get('/Order/Return','Admin_Controller\MainIndexController@ReturnOrder')->name('order.return');
Route::get('/Return/Details','Admin_Controller\MainIndexController@DetailsReturnOrder')->name('return.details');
Route::get('/Showroom/Summery','Admin_Controller\MainIndexController@ShowroomSummery')->name('showroom.summery');
Route::get('/Product/Stoke-Details','Admin_Controller\MainIndexController@ShowroomProductStoke')->name('product.stokefilter');
Route::get('/Order-Sell/Details','Admin_Controller\MainIndexController@SellingDetails')->name('selling.details');
Route::get('/Vat-Setting','Admin_Controller\MainIndexController@VatSetting')->name('showroom.vatsetting');
Route::get('/Print-Setting','Admin_Controller\MainIndexController@PrintSetting')->name('showroom.printerset');
Route::get('/Barcode/Generate','Admin_Controller\MainIndexController@BarcodeGenerate')->name('barcode.generate');
//================================================================================


//================================================================================
Route::get('/productsearching_name','Admin_Controller\SearchDataController@Allproductdata')->name('product.namedata');
Route::get('/productsearching_stoke','Admin_Controller\SearchDataController@Allproduct_stokedata')->name('product.purcheshdata');
Route::get('/Product/Purchase/Search','Admin_Controller\SearchDataController@Product_Purchesh_search')->name('product_purches_search');
Route::get('/Single/Product/Purchase/Search','Admin_Controller\SearchDataController@Product_Single_Purchesh_search')->name('single_product_purches_search');
Route::get('/Expense-Purchesh/Search','Admin_Controller\SearchDataController@ExpenseOrPurchesh_search')->name('expensesearch');
Route::get('/Showroom/profit/Search','Admin_Controller\SearchDataController@ShowroomProfit_search')->name('showroom.profitsearch');
Route::get('/Showroom/Recive-Cash/Search','Admin_Controller\SearchDataController@ShowroomReciveCash_search')->name('showroom.recivecash_search');
Route::get('/Product/Stoke/Search','Admin_Controller\SearchDataController@ProductStokeSearch')->name('category_Brand_filter');
Route::get('/Order/Selling/details','Admin_Controller\SearchDataController@SellingOrderSearch')->name('category_Brand_orderdata');

Route::get('/Order/Selling/Search','Admin_Controller\SearchDataController@SellingInvoiceOrderSearch')->name('oderInvoicedata_search');
Route::get('/Order/Details/Search','Admin_Controller\SearchDataController@SellingDetailsOrderSearch')->name('OrderDetailsdata_search');
Route::get('/Productbarcode_data','Admin_controller\SearchDataController@OrderdataBybarcode')->name('product.barcodesearch');

//================================================================================

Route::get('/Product/Purchase/Print','Admin_Controller\PrintController@Product_Purchesh_print')->name('product_purchesh_search_print');
Route::get('/Order/Invoice/Print/{id}','Admin_Controller\PrintController@OrderInvoice_print')->name('Order_invoice.Print');
Route::get('/Single/purchesh/Print','Admin_Controller\PrintController@PurcheshSingle_search_print')->name('single_purchesh_search_print');
Route::get('/Purchase/Invoice/Print/{id}','Admin_Controller\PrintController@PurcheshInvoice_print')->name('invoicedata.print');
Route::get('/Showroom/Expense/Print','Admin_Controller\PrintController@ShowroomExpense_print')->name('expencedata.print');
Route::get('/Showroom/Profit/Print','Admin_Controller\PrintController@ShowroomProfit_print')->name('showroomprofit.print');
Route::get('/Showroom/Receive-Cash/Print','Admin_Controller\PrintController@ShowroomReciveCash_print')->name('showroomcashrecive.print');
Route::get('/Showroom/Stoke/Product/Print','Admin_Controller\PrintController@StokeProduct_print')->name('stokeproductsearch.print');
Route::get('/Order/Search-Data/Print','Admin_Controller\PrintController@OrderReport_print')->name('OrderSearchData.print');
Route::get('/Customer/calculation-print','Admin_Controller\PrintController@CustomerCalculation_print')->name('Customer_calculation_print');
Route::get('/Supplier/calculation-print','Admin_Controller\PrintController@SupplierCalculation_print')->name('supplier_calculation_print');
Route::get('/Order/Invoice/Data-print','Admin_Controller\PrintController@OderInvoiceDetails_print')->name('totalorderdata_search_print');
Route::get('/Order/Details/Data-print','Admin_Controller\PrintController@OderDetailssingle_print')->name('totalorderDetails_search_print');


//================================================================================
Route::resource('/showroom','Admin_Controller\ShowroomController');
Route::post('/Showroom/Update','Admin_Controller\ShowroomController@update')->name('showroom_update');
Route::post('/Showroom/Expense','Admin_Controller\ShowroomController@showroomExpense')->name('showroom.expense');
//=======================================================


//========================================================
Route::POST('/User/Registration','Admin_Controller\UserController@store')->name('user.registration');
Route::POST('/User/profile/Update','Admin_Controller\UserController@update')->name('profice_update');
Route::POST('/User/Update','Admin_Controller\UserController@UserUpdate')->name('userdata_update');
//========================================================
Route::resource('/supplier','Admin_Controller\SupplierController');
Route::post('/Supplier/Payment','Admin_Controller\SupplierController@supplierpayment')->name('supplier.payment');
//================================================
Route::resource('/Customer','Admin_Controller\CustomerController');
Route::post('/Customer/Payment','Admin_Controller\CustomerController@CustomerPaymentSubmit')->name('customer.paymentdata');
//===============================================
Route::resource('/Categories','Product_Controller\CategorieControlle');
Route::get('/Categories/delete/{id}','Product_Controller\CategorieControlle@destroy')->name('categorie.delete');

//======================================================
Route::resource('/SubCategories','Product_Controller\SubcategorieControlle');
Route::get('/Subcategories/delete/{id}','Product_Controller\SubcategorieControlle@destroy')->name('subcategorie.delete');
//=======================================================
Route::resource('/Brands','Product_Controller\BrandControlle');
Route::get('/Brands/delete/{id}','Product_Controller\BrandControlle@destroy')->name('brand.delete');
//=======================================================

//==============================================================
Route::resource('/Products','Product_Controller\ProductControlle');
Route::get('/Products/delete/{id}','Product_Controller\ProductControlle@destroy')->name('Product.delete');

//==============================================================

//==============================================================
Route::resource('/Purchase','Product_Controller\ProductPurcheshControlle');
Route::get('/Purchase/delete/{id}','Product_Controller\ProductPurcheshControlle@destroy')->name('purchase.delete');

Route::get('/Purchase/Invoice/Details/{id}','Product_Controller\ProductPurcheshControlle@PurchaseInvoiceDetails')->name('Purchase_invoice.Details');

Route::get('/Product/Purchase/Details/{id}','Product_Controller\ProductPurcheshControlle@ProductPurchaseSingleDetails')->name('single_Purchase.view');

//Route::get('/Products/delete/{id}','Product_Controller\ProductControlle@destroy')->name('Product.delete');
//==============================================================
//===========================================================
Route::resource('/Order','Order_controller\OrderController');
Route::get('/Order/delete/{id}','Order_controller\OrderController@destroy')->name('sellorder.delete');
Route::resource('/Return_order','Order_controller\ReturnController');
//===========================================================






/////////////////////===============================/////////////////////////////////
Route::get('/Bike/Add','Bike_Controller\BikeControllerIndex@AddBike')->name('bike.nameadd');
Route::get('/Bike/Purchase','Bike_Controller\BikeControllerIndex@Bike_Purchase_Index')->name('bike.purchase');
Route::get('/Bike/Sell','Bike_Controller\BikeControllerIndex@Bike_Sell_index')->name('bike.sell');
Route::get('/Bike/Sell/details','Bike_Controller\BikeControllerIndex@Bike_Sell_Detail')->name('bikesell.details');
Route::get('/Installment/details','Bike_Controller\BikeControllerIndex@Installment_Detail')->name('bikesell.installment');
Route::get('/Payment/Receive','Bike_Controller\BikeControllerIndex@Paymentrecived')->name('payment.received');
Route::get('/Bike/Registration','Bike_Controller\BikeControllerIndex@RegistrationIndex')->name('registration.details');
Route::get('/Customer/Accounts/Details','Bike_Controller\BikeControllerIndex@AccountCustomer')->name('customer.accounts_details');
Route::get('/Bike/Stoke/Details','Bike_Controller\BikeControllerIndex@BikeStoke_Detail')->name('bike.stokedetails');
///========================================================================

Route::get('/Customer/Search/data','Bike_Controller\InstallmentController@AllCustomerdata')->name('bikecustomer.data');
Route::get('/Customer/view/data/{id}','Bike_Controller\InstallmentController@CustomerViewDetails')->name('customer_view_details');

//========================================================================

//=================================///======================================
Route::get('/Customer/Installment/details/{id}','Bike_Controller\InstallmentController@index')->name('customer.installment');
Route::post('/Customer/Installment/Payment','Bike_Controller\InstallmentController@store')->name('instalment_payment.customer');
Route::get('/Installment/Payment/Print/{id}','Bike_Controller\InstallmentController@installmentprint')->name('installmentdetails_print');

////=======================================================================


Route::get('/bikesearch_ajax', 'Admin_Controller\AjaxController@bikesearch_ajax');
Route::get('/bikedetails_select/{id}', 'Admin_Controller\AjaxController@bikesearchselect_ajax');
Route::get('/bikedetails_selectengineno/{id}', 'Admin_Controller\AjaxController@bikedetails_selectengineno');
Route::get('/Installment_pay/{id}', 'Admin_Controller\AjaxController@Installment_pay');


Route::resource('/Bikeadd','Bike_Controller\BikeAddController');
Route::resource('/Bikepurchase','Bike_Controller\BikePurchaseController');
Route::resource('/BikeOrder','Bike_Controller\BikeOrderController');


// new route by rohan

Route::get('product_panel', 'Product_controller\ProductControlle@index')->name('product_panel');
Route::get('bike_panel', 'Bike_Controller\BikeControllerIndex@index')->name('bike_panel');
