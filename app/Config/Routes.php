<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Instt');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->post('chkLogin', 'Instt::chkLogin');
$routes->post('logout', 'Instt::index/1');
$routes->get('logout', 'Instt::index/1');
$routes->post('saveStudent','StudentData::saveStudent');
$routes->post('listStudents','StudentData::listStudents');

// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
 //test

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Instt::index');
$routes->post('/', 'Instt::index');

//$routes->match(['get', 'put','post'], 'o', 'Instt::index/1');
$routes->match(['get', 'put','post'],'studEntry','Instt::showPage/1');
$routes->match(['get', 'put','post'],'feesEntry','Instt::showPage/2');
$routes->match(['get', 'put','post'],'home','Instt::index');
$routes->post('getStudent', 'StudentData::getStudent');
$routes->post('delStudent', 'StudentData::delStudent');
$routes->post('getBalance', 'FeesData::getBalance');
$routes->post('saveReceipt', 'FeesData::saveReceipt');
$routes->post('listReceipts', 'FeesData::listReceipts');
$routes->post('getReceipt', 'FeesData::getReceipt');
$routes->post('delReceipt', 'FeesData::delReceipt');

$routes->match(['get', 'put','post'],'studLedger','Instt::showPage/3');
$routes->match(['get', 'put','post'],'collectionReport','Instt::showPage/4');
$routes->match(['get', 'put','post'],'courseWise','Instt::showPage/5');
$routes->match(['get', 'put','post'],'dayWise','Instt::showPage/6');

$routes->post('getFeesReport','FeesData::getFeesReport');

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
