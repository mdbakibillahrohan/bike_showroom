<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SubmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dt = Carbon::now();
        $dateNow = $dt->toDateTimeString();
        DB::table('submenus')->insert(array(
            array(
                'index_no' => '1',
                'mainmenu_id' => 'Showroom Panel',
                'submenu_name' => 'Add Showroom',
                'submenu_route' => 'Add.Showroom',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'index_no' => '1',
                'mainmenu_id' => 'Showroom Staff',
                'submenu_name' => 'User Details',
                'submenu_route' => 'Add.User',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),

            array(
                'index_no' => '2',
                'mainmenu_id' => 'Showroom Staff',
                'submenu_name' => 'Menu Permission',
                'submenu_route' => 'menu.permission',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),

            array(
                'index_no' => '1',
                'mainmenu_id' => 'Product',
                'submenu_name' => 'Add Category',
                'submenu_route' => 'categories.index',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'index_no' => '2',
                'mainmenu_id' => 'Product',
                'submenu_name' => 'Sub Category',
                'submenu_route' => 'subcategories.index',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'index_no' => '3',
                'mainmenu_id' => 'Product',
                'submenu_name' => 'Brand',
                'submenu_route' => 'brand.index',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'index_no' => '4',
                'mainmenu_id' => 'Product',
                'submenu_name' => 'Add Product',
                'submenu_route' => 'Product.index',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'index_no' => '5',
                'mainmenu_id' => 'Product',
                'submenu_name' => 'Product List',
                'submenu_route' => 'Product.List',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'index_no' => '6',
                'mainmenu_id' => 'Product',
                'submenu_name' => 'Product Purchase',
                'submenu_route' => 'product.purchase_index',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'index_no' => '7',
                'mainmenu_id' => 'Product',
                'submenu_name' => 'Product Stoke',
                'submenu_route' => 'product.stoke_index',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'index_no' => '8',
                'mainmenu_id' => 'Product',
                'submenu_name' => 'Purchase Details',
                'submenu_route' => 'product.details_index',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),

            array(
                'index_no' => '9',
                'mainmenu_id' => 'Product',
                'submenu_name' => 'Bike Add',
                'submenu_route' => 'bike.nameadd',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'index_no' => '10',
                'mainmenu_id' => 'Product',
                'submenu_name' => 'Bike Purchase',
                'submenu_route' => 'bike.purchase',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),

            array(
                'index_no' => '11',
                'mainmenu_id' => 'Product',
                'submenu_name' => 'Bike Stoke',
                'submenu_route' => 'bike.stokedetails',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),

            array(
                'index_no' => '1',
                'mainmenu_id' => 'Order',
                'submenu_name' => 'Bike Sell',
                'submenu_route' => 'bike.sell',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),

            array(
                'index_no' => '2',
                'mainmenu_id' => 'Order',
                'submenu_name' => 'Sell Details',
                'submenu_route' => 'bikesell.details',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),

            array(
                'index_no' => '3',
                'mainmenu_id' => 'Order',
                'submenu_name' => 'Sell Order',
                'submenu_route' => 'Order.Index',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'index_no' => '4',
                'mainmenu_id' => 'Order',
                'submenu_name' => 'Invoice Order',
                'submenu_route' => 'Order.Invoice',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'index_no' => '5',
                'mainmenu_id' => 'Order',
                'submenu_name' => 'Order Details',
                'submenu_route' => 'Order.Details',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'index_no' => '6',
                'mainmenu_id' => 'Order',
                'submenu_name' => 'Return Order',
                'submenu_route' => 'order.return',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'index_no' => '7',
                'mainmenu_id' => 'Order',
                'submenu_name' => 'Return Details',
                'submenu_route' => 'return.details',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),


            array(
                'index_no' => '1',
                'mainmenu_id' => 'Bike',
                'submenu_name' => 'Installment',
                'submenu_route' => 'bikesell.installment',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),

            array(
                'index_no' => '2',
                'mainmenu_id' => 'Bike',
                'submenu_name' => 'Payment Receive',
                'submenu_route' => 'payment.received',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'index_no' => '3',
                'mainmenu_id' => 'Bike',
                'submenu_name' => 'Bike Registration',
                'submenu_route' => 'registration.details',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'index_no' => '4',
                'mainmenu_id' => 'Bike',
                'submenu_name' => 'Customer Accounts',
                'submenu_route' => 'customer.accounts_details',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),

            array(
                'index_no' => '1',
                'mainmenu_id' => 'Accounts',
                'submenu_name' => 'Suppliers',
                'submenu_route' => 'supplier.indexdata',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'index_no' => '2',
                'mainmenu_id' => 'Accounts',
                'submenu_name' => 'Customers',
                'submenu_route' => 'customer.index',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'index_no' => '3',
                'mainmenu_id' => 'Accounts',
                'submenu_name' => 'Showroom Cost',
                'submenu_route' => 'showroom.cost',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'index_no' => '4',
                'mainmenu_id' => 'Accounts',
                'submenu_name' => 'Showroom Profit',
                'submenu_route' => 'showroom.profit',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'index_no' => '5',
                'mainmenu_id' => 'Accounts',
                'submenu_name' => 'Receive Cash',
                'submenu_route' => 'showroom.recivecash',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),

            array(
                'index_no' => '1',
                'mainmenu_id' => 'Report',
                'submenu_name' => 'Showroom Summery',
                'submenu_route' => 'showroom.summery',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),

            array(
                'index_no' => '2',
                'mainmenu_id' => 'Report',
                'submenu_name' => 'Product Stoke Search',
                'submenu_route' => 'product.stokefilter',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),

            array(
                'index_no' => '3',
                'mainmenu_id' => 'Report',
                'submenu_name' => 'Selling Report',
                'submenu_route' => 'selling.details',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),

            array(
                'index_no' => '1',
                'mainmenu_id' => 'Setting',
                'submenu_name' => 'Vat setting',
                'submenu_route' => 'showroom.vatsetting',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),

            array(
                'index_no' => '2',
                'mainmenu_id' => 'Setting',
                'submenu_name' => 'Print Setting',
                'submenu_route' => 'showroom.printerset',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'index_no' => '3',
                'mainmenu_id' => 'Setting',
                'submenu_name' => 'Product Barcode',
                'submenu_route' => 'barcode.generate',
                'status' => '1',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),



        ));

    }
}
