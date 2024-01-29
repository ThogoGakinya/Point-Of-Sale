<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Admin Routes
Route::get('/inventory', 'Admin\AdminController@fetchInventory')->name('inventory');
Route::get('/settings', 'Admin\AdminController@fetchSettings')->name('settings');
Route::post('/add_category', 'Admin\AdminController@addCategory')->name('add_category');
Route::put('/update-category/{id}', 'Admin\AdminController@updateCategory')->name('update-category');
Route::delete('/category/{id}',  'Admin\AdminController@destroyCategory')->name('delete-category');
Route::post('/add_size', 'Admin\AdminController@addSize')->name('add_size');
Route::put('/update-size/{id}', 'Admin\AdminController@updateSize')->name('update-size');
Route::delete('/size/{id}',  'Admin\AdminController@destroySize')->name('delete-size');
Route::post('/add_uom', 'Admin\AdminController@addUom')->name('add_uom');
Route::put('/update-uom/{id}', 'Admin\AdminController@updateUom')->name('update-uom');
Route::delete('/uom/{id}',  'Admin\AdminController@destroyUom')->name('delete-uom');
Route::post('/add_topping', 'Admin\AdminController@addTopping')->name('add_topping');
Route::put('/update-topping/{id}', 'Admin\AdminController@updateTopping')->name('update-topping');
Route::delete('/topping/{id}',  'Admin\AdminController@destroyTopping')->name('delete-topping');
Route::post('/add_flavour', 'Admin\AdminController@addFlavour')->name('add_flavour');
Route::put('/update-flavour/{id}', 'Admin\AdminController@updateFlavour')->name('update-flavour');
Route::delete('/flavour/{id}',  'Admin\AdminController@destroyFlavour')->name('delete-flavour');
Route::get('/category/{id}/{mode}', 'Admin\AdminController@fetchCategoryMembers')->name('expand_category');
Route::post('/new_product', 'Admin\AdminController@newProduct')->name('new_product');
Route::put('/update-product/{id}', 'Admin\AdminController@updateProduct')->name('update-product');
Route::delete('/product/{id}',  'Admin\AdminController@destroyProduct')->name('delete-product');
Route::post('/find_product',  'Admin\AdminController@findProduct')->name('find_product');
// Route::post('/add_to_cart',  'Admin\AdminController@addToCartOffers')->name('add_to_cart');
Route::post('/add_to_cart',  'Admin\AdminController@addToCart')->name('add_to_cart');
Route::delete('/remove/{id}',  'Admin\AdminController@removeFromCart')->name('remove_from_cart');
Route::delete('/discard/{id}',  'Admin\AdminController@removeDelivery')->name('remove_delivery');
Route::post('/complete',  'Admin\AdminController@completeTransaction')->name('complete_transaction');
Route::put('/company/{id}',  'Admin\AdminController@submitCompanyDetails')->name('update-company');
Route::post('/add_table', 'Admin\AdminController@addTable')->name('add_table');
Route::put('/update-table/{id}', 'Admin\AdminController@updateTable')->name('update-table');
Route::delete('/table/{id}',  'Admin\AdminController@destroyTable')->name('delete-table');
Route::get('/mode/{id}', 'Admin\AdminController@getMode')->name('mode');
Route::get('/categories/{id}', 'Admin\AdminController@getCategories')->name('categories');
Route::post('/invoice',  'Admin\AdminController@processInvoice')->name('invoice');
Route::post('/order-receipt',  'Admin\AdminController@processOrderReceipt')->name('order-receipt');
Route::get('/receipts-invoices',  'Admin\AdminController@getReceiptsInvoices')->name('receipts-invoices');
Route::get('/view-invoice/{receipt}/{id}', 'Admin\AdminController@viewInvoice')->name('view-invoice');
Route::put('/pay',  'Admin\AdminController@payInvoice')->name('pay-invoice');
Route::get('/view-receipt/{receipt}/{id}', 'Admin\AdminController@viewReceipt')->name('view-receipt');
Route::get('/view-flavour/{id}', 'Admin\AdminController@viewFlavour')->name('view-flavour');
Route::post('/assign', 'Admin\AdminController@assignCategoryFlavour')->name('assign');
Route::put('/update-assign/{id}',  'Admin\AdminController@updateCategoryFlavour')->name('update-assign');
Route::get('/recent-orders',  'Admin\AdminController@recentOrders')->name('recent-orders');
Route::get('/pos',  'Admin\AdminController@pos')->name('admin_pos');
Route::get('/invoices',  'Admin\AdminController@getInvoices')->name('invoices');
Route::get('/receipts',  'Admin\AdminController@getReceipts')->name('receipts');
Route::get('/receive/stock',  'Admin\AdminController@receiveStock')->name('receive_stock');
Route::post('whatsapp',  'Admin\AdminController@sendWhatsapp')->name('whatsapp');
Route::get('/clients',  'Admin\AdminController@getClients')->name('clients');
Route::post('/add/client',  'Admin\AdminController@addClient')->name('add_client');
Route::put('/update-client/{id}',  'Admin\AdminController@updateClient')->name('update_client');
Route::delete('/client/{id}',  'Admin\AdminController@destroyClient')->name('delete_client');
Route::get('/suppliers',  'Admin\AdminController@getSuppliers')->name('suppliers');
Route::post('/add/supplier',  'Admin\AdminController@addSupplier')->name('add_supplier');
Route::put('/update-supplier/{id}',  'Admin\AdminController@updateSupplier')->name('update_supplier');
Route::delete('/supplier/{id}',  'Admin\AdminController@destroySupplier')->name('delete_supplier');
Route::put('/receive-stock/{id}',  'Admin\AdminController@updateStock')->name('update_stock');
Route::get('/product/history/{id}',  'Admin\AdminController@productHistory')->name('product_history');
Route::get('/users',  'Admin\AdminController@getUsers')->name('users');
Route::post('/add/user',  'Admin\AdminController@addUser')->name('add_user');
Route::put('/update-user/{id}',  'Admin\AdminController@updateUser')->name('update_user');
Route::delete('/user/{id}',  'Admin\AdminController@destroyUser')->name('delete_user');
Route::get('/cat/{id}',  'Admin\AdminController@getCategoryProducts')->name('cat');
Route::get('/report',  'Admin\AdminController@dateRangePicker')->name('report');
Route::get('/delivery/routes',  'Admin\AdminController@deliveryRoutes')->name('delivery_routes');
Route::post('/add/delivery/routes',  'Admin\AdminController@addDeliveryRoute')->name('add_delivery_route');
Route::put('/update-delivery_route/{id}',  'Admin\AdminController@updateDeliveryRoute')->name('update_delivery_route');
Route::delete('/delivery_route/{id}',  'Admin\AdminController@destroyDeliveryRoute')->name('delete_delivery_route');
Route::post('/add/delivery_charges',  'Admin\AdminController@addDeliveryCharges')->name('add_delivery_charges');
Route::put('/update-status/{id}',  'Admin\AdminController@updateOrderStatus')->name('update_order_status');
Route::get('/change-status/{id}',  'Admin\AdminController@changeStatus')->name('change_status');
Route::post('/secret',  'Admin\AdminController@saveSecret')->name('save_secret');
Route::post('/confirm/secret',  'Admin\AdminController@confirmSecret')->name('confirm_secret');
Route::get('/admin/station',  'Admin\AdminController@adminStation')->name('admin_station');
Route::get('/admin/change-status/{id}',  'Admin\AdminController@adminchangeStatus')->name('admin_change_status');
Route::get('/ready',  'Admin\AdminController@readyOrders')->name('my_ready_orders');
Route::post('/combine/receipt',  'Admin\AdminController@combineReceipt')->name('combine_receipt');
Route::get('/password/reset',  'Admin\AdminController@getPasswordForm')->name('get_form');
Route::post('/change/password',  'Admin\AdminController@changePassword')->name('change_password');
Route::get('/daily-sales',  'Admin\AdminController@dailySales')->name('daily_sales');
Route::get('/waiter-daily/{id}',  'Admin\AdminController@waiterDailySales')->name('waiter_daily');
Route::get('/product-daily/{id}',  'Admin\AdminController@productDailySales')->name('product_daily');
Route::get('register',  'Admin\AdminController@getRegister')->name('register');
Route::put('/updateflavour/{id}',  'Admin\AdminController@EditFlavour')->name('edit-flavour');
Route::get('/category-details/{id}', 'Admin\AdminController@getCategoryDetails')->name('category-details');
Route::post('/add-flavour/{id}', 'Admin\AdminController@addCategoryFlavour')->name('add-category-flavour');
Route::post('/add-size/{id}', 'Admin\AdminController@addCategorySize')->name('add-category-size');
Route::delete('/category-flavour/{id}',  'Admin\AdminController@destroyCategoryFlavour')->name('delete-category-flavour');
Route::delete('/category-size/{id}',  'Admin\AdminController@destroyCategorySize')->name('delete-category-size');
Route::get('/dailysales/{id}',  'Admin\AdminController@dailySalesByDate')->name('dailysales');
Route::post('/dailysales',  'Admin\AdminController@filterByDate')->name('findbydate');
Route::get('/close-of-day/{id}',  'Admin\AdminController@closeOfDay')->name('close-of-day');
Route::delete('/recall/{id}',  'Admin\AdminController@recallBill')->name('recall');
Route::post('/monthlysales',  'Admin\AdminController@monthlySales')->name('monthlysales');
Route::get('/monthly',  'Admin\AdminController@currentMonthSales')->name('currentmonth');
Route::get('/expenses',  'Admin\AdminController@fetchExpenses')->name('expenses');
Route::get('/accounts',  'Admin\AdminController@fetchAccounts')->name('accounts');
Route::post('/add_expenses',  'Admin\AdminController@addExpense')->name('add_expense');
Route::post('/add_account',  'Admin\AdminController@addAccount')->name('add_account');
Route::delete('/delete/{id}',  'Admin\AdminController@destroyExpense')->name('delete_expense');
Route::delete('/destroy/{id}',  'Admin\AdminController@destroyAccount')->name('delete_account');
Route::put('/update-account/{id}',  'Admin\AdminController@updateAccount')->name('update_account');
Route::post('/transfer',  'Admin\AdminController@transfer')->name('transfer');
Route::get('/statement/{id}',  'Admin\AdminController@accountStatement')->name('statement');
Route::get('/mpesas',  'Admin\AdminController@getMpesatransactions')->name('mpesas');
Route::post('/withdraw',  'Admin\AdminController@withdrawMoney')->name('withdraw');
Route::post('/ctf',  'Admin\AdminController@cashToFloat')->name('ctf');
Route::post('/deposit',  'Admin\AdminController@depositMoney')->name('deposit');
Route::post('/float',  'Admin\AdminController@addFloat')->name('float');
Route::post('/cash',  'Admin\AdminController@addCash')->name('cash');


//Routes to autopopulate toppings
Route::get('/findtoppings', 'Admin\AdminController@findToppings')->name('findtoppings');

//Routes to autopopulate flavours
Route::get('/findflavours', 'Admin\AdminController@findFlavours')->name('findflavours');

//Routes to autopopulate sizes
Route::get('/findsizes', 'Admin\AdminController@findSizes')->name('findsizes');

//Routes to autopopulate units
Route::get('/findunits', 'Admin\AdminController@findUnits')->name('findunits');

//Routes to autopopulate clients data
Route::get('/findclientdata', 'Admin\AdminController@findClientData')->name('findclientdata');

//Routes to autopopulate account balance
Route::get('/findbalance', 'Admin\AdminController@findBalance')->name('findbalance');

//Routes to autopopulate delivery routes data
Route::get('/findroutedata', 'Admin\AdminController@findRouteData')->name('findroutedata');

Route::get('/see', function (Codedge\Fpdf\Fpdf\Fpdf $fpdf) {

    $fpdf->AddPage();
    $fpdf->SetFont('Courier', 'B', 18);
    $fpdf->Cell(50, 25, 'Hello World!');
    $fpdf->Output();

});

Route::get('print/test', 'Admin\AdminController@test')->name('printtest');
// Route::delete('/addcompany/{id}', 'CompanyController@destroy')->name('company.destroy');
// Route::delete('/remove/{id}',  'Admin\AdminController@removeFromCart')->name('remove_from_cart');
