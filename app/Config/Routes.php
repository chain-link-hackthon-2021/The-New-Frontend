<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ['as' => 'home']);

/*			Login Controller -> Related Routes			*/

// Get routes
$routes->get('/Account/Login', 'Login::showLoginPage', ['as' => 'login', 'filter' => 'noauth']);
$routes->get('/Account/Logout', 'Login::logout', ['as' => 'logout']);
$routes->get('/Account/LogOff', 'Login::logout', ['as' => 'logoff']);
$routes->get('/Completed/(:segment)', 'Login::completePayment/$1');
$routes->get('/Account/Register', 'Login::showRegisterPage', ['as' => 'register', 'filter' => 'noauth']);
$routes->get('/Verify/User/(:segment)/(:segment)', 'Login::verify/$1/$2', ['as' => 'verify']);
$routes->get('/@(:segment)/', 'Login::guestshop/$1');
$routes->get('/@(:segment)/checkout/(:segment)', 'Login::shop/$1/$2');
$routes->get('/@(:segment)/checkout/(:segment)/(:segment)', 'Login::shopnext/$1/$2/$3');
$routes->get('/@(:segment)/OrderDetails/(:segment)', 'Login::productorder/$1/$2');
$routes->get('/@(:segment)/CryptoPayment/(:segment)', 'Login::productorderbtc/$1/$2');

// Post routes
$routes->post('/Account/Login', 'Login::initiateLogin', ['filter' => 'noauth']);


/*			Shop Controller -> Related Routes			*/

// Get routes
$routes->get('/Shop', 'Shop::showShopPage', ['filter' => 'auth', 'as' => 'shop']);
$routes->get('/Shop/CreateShop/CreateShop', 'Shop::createShop', ['filter' => 'auth', 'as' => 'createshop']);
$routes->get('/Shop/(:segment)/Dashboard', 'Shop::showDashboard/$1', ['filter' => 'auth', 'as' => 'showshop']);
$routes->get('/Shop/(:num)/Delete/(:segment)', 'Shop::deleteShop/$1/$2', ['filter' => 'auth', 'as' => 'deleteshop']);
$routes->get('/Manage', 'Shop::showShopPage', ['filter' => 'auth', 'as' => 'manage']);
$routes->get('/ShopAnalytics/BoxDisputes/(:segment)', 'Shop::boxDisputes/$1', ['filter' => 'auth']);
$routes->get('/ShopAnalytics/RecentTickets/(:segment)', 'Shop::analytics/$1', ['filter' => 'auth']);
$routes->get('/ShopAnalytics/Analytics/(:segment)', 'Shop::analytics/$1', ['filter' => 'auth']);
$routes->get('/ShopAnalytics/RecentFeedback/(:segment)', 'Shop::analytics/$1', ['filter' => 'auth']);
$routes->get('/ShopAnalytics/Balances/(:segment)', 'Shop::analytics/$1', ['filter' => 'auth']);

$routes->get('/Shop/@(:segment)', 'Shop::Shop/$1', ['filter' => 'auth']);

$routes->get('/Image/View', 'Image::bgOne', ['filter' => 'auth']);

// Post routes
$routes->post('/Shop/CreateShop/CreateShop', 'Shop::createShopNow', ['filter' => 'auth', 'as' => 'createshopnow']);

/*			Orders Controller -> Related Routes			*/

// Get routes
$routes->get('/ShopAnalytics/RecentActivity/(:segment)', 'Orders::recentOrders/$1', ['filter' => 'auth']);
$routes->get('/Shop/(:segment)/Orders', 'Orders::showOrders/$1', ['filter' => 'auth', 'as' => 'showorders']);
$routes->get('/Shop/(:segment)/Credit', 'Shop::credit/$1', ['filter' => 'auth']);
$routes->get('/Shop/(:segment)/Orders/(:segment)', 'Orders::viewOrder/$1/$2', ['filter' => 'auth']);


/*			Products Controller -> Related Routes			*/

// Get routes
$routes->get('/ShopAnalytics/TopProducts/(:segment)', 'Products::topProducts/$1', ['filter' => 'auth']);
$routes->get('/Shop/(:segment)/Products', 'Products::showProducts/$1', ['filter' => 'auth', 'as' => 'showproducts']);
$routes->get('/Shop/(:segment)/ProductCreate', 'Products::createProduct/$1', ['filter' => 'auth', 'as' => 'createproduct']);
$routes->get('/Shop/(:segment)/ProductEdit/(:segment)', 'Products::editProduct/$1/$2', ['filter' => 'auth', 'as' => 'editproduct']);
$routes->get('/@(:segment)/Product/(:segment)', 'Products::productFace/$1/$2', ['filter' => 'auth']);
$routes->get('/@(:segment)/Product/(:segment)/(:segment)', 'Products::productNextFace/$1/$2/$3', ['filter' => 'auth']);

// Post routes
$routes->post('/Shop/(:segment)/ProductEdit/(:segment)', 'Products::editProductNow/$1/$2', ['filter' => 'auth', 'as' => 'editproductnow']);
$routes->post('/Shop/(:segment)/ProductCreate', 'Products::createProductNow/$1', ['filter' => 'auth', 'as' => 'createproductnow']);
$routes->post('/@(:segment)/Product/(:segment)', 'Orders::orderProduct/$1/$2', ['filter' => 'auth']);


/*			Orders Controller -> Related Routes			*/

// Get routes
$routes->get('/Shop/(:segment)/Categories', 'Categories::index/$1', ['filter' => 'auth', 'as' => 'categories']);
$routes->get('/Shop/(:segment)/CategoryEdit/(:segment)', 'Categories::edit/$1/$2', ['filter' => 'auth', 'as' => 'edit_category']);

// Post routes
$routes->post('/Shop/(:segment)/Categories', 'Categories::create/$1', ['filter' => 'auth', 'as' => 'create_categories']);
$routes->post('/Shop/(:segment)/CategoryEdit/(:segment)', 'Categories::editNow', ['filter' => 'auth']);

/*			Licensing Controller -> Related Routes			*/

// Get routes
$routes->get('/Shop/(:segment)/Licensing', 'Licensing::index/$1', ['filter' => 'auth', 'as' => 'licensing']);
$routes->get('/Shop/(:segment)/Project/New', 'Licensing::create/$1', ['filter' => 'auth', 'as' => 'createproject']);
$routes->get('/Shop/(:segment)/Licenses', 'Licensing::licenses/$1', ['filter' => 'auth', 'as' => 'licenses']);
$routes->get('/Shop/(:segment)/License/New', 'Licensing::newLicense/$1', ['filter' => 'auth', 'as' => 'createnewlicense']);

// Post routes
$routes->post('/Shop/(:segment)/Project/New', 'Licensing::createNow/$1', ['filter' => 'auth', 'as' => 'createprojectnow']);
$routes->post('/Shop/(:segment)/License/New', 'Licensing::newLicenseNow/$1', ['filter' => 'auth', 'as' => 'createnewlicensenow']);

/*			Developers Controller -> Related Routes			*/

// Get routes
$routes->get('/Shop/(:segment)/Developer', 'Developer::index/$1', ['filter' => 'auth', 'as' => 'developer']);


/*			Feedback Controller -> Related Routes			*/

// Get routes
$routes->get('/Shop/(:segment)/Feedback', 'Feedback::index/$1', ['filter' => 'auth', 'as' => 'feedback']);


/*			Tickets Controller -> Related Routes			*/

// Get routes
$routes->get('/Shop/(:segment)/Tickets', 'Tickets::index/$1', ['filter' => 'auth', 'as' => 'tickets']);


/*			Blacklist Controller -> Related Routes			*/

// Get routes
$routes->get('/Shop/(:segment)/Blacklist', 'Blacklist::index/$1', ['filter' => 'auth', 'as' => 'blacklist']);
$routes->get('/Shop/(:segment)/Blacklist/New', 'Blacklist::add/$1', ['filter' => 'auth', 'as' => 'addblacklist']);

$routes->post('/Shop/(:segment)/Blacklist/New', 'Blacklist::addNow/$1', ['filter' => 'auth', 'as' => 'addblacklistnow']);

/*			Coupons Controller -> Related Routes			*/

// Get routes
$routes->get('/Shop/(:segment)/Coupons', 'Coupons::index/$1', ['filter' => 'auth', 'as' => 'coupons']);
$routes->get('/Shop/(:segment)/CouponEdit/(:segment)', 'Coupons::edit/$1/$2', ['filter' => 'auth', 'as' => 'editcoupon']);

// Posts
$routes->post('/Shop/(:segment)/Coupon', 'Coupons::create/$1', ['filter' => 'auth', 'as' => 'create_coupons']);
$routes->post('/Shop/(:segment)/CouponEdit/(:segment)', 'Coupons::editNow/$1/$2', ['filter' => 'auth', 'as' => 'editcouponnow']);

/*			Members Controller -> Related Routes			*/

// Get routes
$routes->get('/Shop/(:segment)/Members', 'Members::index/$1', ['filter' => 'auth', 'as' => 'members']);
$routes->post('/Shop/(:segment)/Members', 'Members::add/$1', ['filter' => 'auth', 'as' => 'addmember']);


/*			Settings Controller -> Related Routes			*/

// Get routes
$routes->get('/Shop/(:segment)/Settings', 'Settings::settings/$1', ['filter' => 'auth', 'as' => 'settings']);
$routes->get('/Shop/(:segment)/CryptoCurrencySettings', 'Settings::CryptoCurrencySettings/$1', ['filter' => 'auth', 'as' => 'CryptoCurrencySettings']);
$routes->get('/Shop/(:segment)/Design', 'Settings::Design/$1', ['filter' => 'auth', 'as' => 'Design']);

// Post routes
$routes->post('/Shop/(:segment)/Settings', 'Settings::SaveSetings/$1', ['filter' => 'auth', 'as' => 'savesettings']);
$routes->post('/Shop/(:segment)/Design', 'Settings::DesignNow/$1', ['filter' => 'auth', 'as' => 'DesignNow']);





$routes->post('/Shop/(:segment)/ApplyCoupon', 'Products::ApplyCoupon/$1', ['filter' => 'auth', 'as' => 'ApplyCoupon']);




$routes->post('/api/getDepositBalance', 'Login::getDepositBalance');
$routes->post('/api/UpdateBtcOrder', 'Login::UpdateBtcOrder');
$routes->post('/api/UpdateCredit', 'Shop::UpdateCredit');



$routes->group('/backend', function ($routes) {
	$routes->add('', 'Admin::index');
	$routes->add('shop', 'Admin::shop');
	$routes->add('users', 'Admin::users');
	//$routes->add('blog', 'Admin\Blog::index');
});















/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}