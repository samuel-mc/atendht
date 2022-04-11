<?php

require 'flight/Flight.php';
include "classes/LoadModels.php";

$whitelist = array(
    '127.0.0.1',
    '::1'
);
if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
    define('__ROOT__', "");
}else{
    define('__ROOT__', "http://localhost/atend");
}

//session_start();
/*Flight::route('/', function () {
    Flight::redirect('admin/login');
});*/

Flight::route('/', function () {
    Flight::set('flight.views.path', 'intranet');
    Flight::render('dashboard/index', ['title' => 'Dashboard', 'header' => 'headerIndex']);
});

Flight::route('/cliente', function () {
    Flight::set('flight.views.path', 'intranet');
    Flight::render('dashboard/cliente', ['title' => 'Cliente', 'header' => 'headerCliente']);
});

Flight::route('/pagos', function () {
    Flight::set('flight.views.path', 'intranet');
    Flight::render('dashboard/pagos', ['title' => 'Historial De Pagos', 'header' => 'headerPagos']);
});

Flight::route('/servicios', function () {
    Flight::set('flight.views.path', 'intranet');
    Flight::render('dashboard/servicios', ['title' => 'Servicios', 'header' => 'headerServicios']);
});

Flight::route('/bitacora', function () {
    Flight::redirect('/bitacora/ingresosYEgresos');
});

Flight::route('/bitacora/ingresosYEgresos', function () {
    Flight::set('flight.views.path', 'intranet');
    Flight::render('dashboard/bitacora/ingresos', ['title' => 'Bitacora - Ingresos Y Egresos', 'header' => 'headerBitacora']);
});

Flight::route('/bitacora/signosVitales', function () {
    Flight::set('flight.views.path', 'intranet');
    Flight::render('dashboard/bitacora/signos', ['title' => 'Bitacora - Signos Vitales', 'header' => 'headerBitacora']);
});

Flight::route('/bitacora/movilizaciones', function () {
    Flight::set('flight.views.path', 'intranet');
    Flight::render('dashboard/bitacora/movilizaciones', ['title' => 'Bitacora - Movilizaciones', 'header' => 'headerBitacora']);
});

Flight::route('/bitacora/apoyoRespiratorio', function () {
    Flight::set('flight.views.path', 'intranet');
    Flight::render('dashboard/bitacora/apoyo', ['title' => 'Bitacora - Apoyo Respiratorio', 'header' => 'headerBitacora']);
});

Flight::route('/bitacora/medicamentos', function () {
    Flight::set('flight.views.path', 'intranet');
    Flight::render('dashboard/bitacora/medicamentos', ['title' => 'Bitacora - Medicamentos', 'header' => 'headerBitacora']);
});

Flight::route('/bitacora/evaluacion', function () {
    Flight::set('flight.views.path', 'intranet');
    Flight::render('dashboard/bitacora/evaluacion', ['title' => 'Bitacora - Evaluación y reevaluación del dolor', 'header' => 'headerBitacora']);
});

Flight::route('/bitacora/pupilar', function () {
    Flight::set('flight.views.path', 'intranet');
    Flight::render('dashboard/bitacora/pupilar', ['title' => 'Bitacora - Pupilar', 'header' => 'headerBitacora']);
});

Flight::route('/bitacora/glasgow', function () {
    Flight::set('flight.views.path', 'intranet');
    Flight::render('dashboard/bitacora/glasgow', ['title' => 'Bitacora - Glasgow', 'header' => 'headerBitacora']);
});

Flight::route('/bitacora/perimetros', function () {
    Flight::set('flight.views.path', 'intranet');
    Flight::render('dashboard/bitacora/perimetros', ['title' => 'Bitacora - Perímetros', 'header' => 'headerBitacora']);
});

Flight::route('/bitacora/norton', function () {
    Flight::set('flight.views.path', 'intranet');
    Flight::render('dashboard/bitacora/norton', ['title' => 'Bitacora - Norton', 'header' => 'headerBitacora']);
});

/*Flight::route('/dashboard/recept-vials/@id',function($id){
    $id = str_replace(".", "", $id);
    Flight::redirect('/recept-vials/'.$id);
});

Flight::route('/recept-vials/@id', function ($id) {
    $admin = new Model;
    $delivery = $admin->deliveries->GetDetails($id);
    Flight::render('patients/recept', ['title' => 'Recepción de viales',"delivery"=>$delivery]);
});

Flight::route('/admin/login', function () {
    $admin = new Model;
    if (isset($_SESSION['user']) && ($_SESSION['user']['type']=="1")){
        Flight::redirect("/admin/deliveries");
    }
    Flight::set('flight.views.path', 'intranet');
    Flight::render('account/login', ['title' => 'Iniciar sesión', "options"=>["navbar"=>false]]);
});

Flight::route('/admin/recover', function () {
    $admin = new Model;
    if (isset($_SESSION['user']) && ($_SESSION['user']['type']=="1")){
        Flight::redirect("/admin/deliveries");
    }
    Flight::set('flight.views.path', 'intranet');
    Flight::render('account/recover', ['title' => 'Recuperar contraseña', "options"=>["navbar"=>false]]);
});

Flight::route('/admin/restore', function () {
    $admin = new Model;
    Flight::set('flight.views.path', 'intranet');
    Flight::render('account/restore', ['title' => 'Nueva contraseña', "options"=>["navbar"=>false]]);
});

Flight::route('/admin/logout', function () {
    session_destroy();
    Flight::redirect("admin/login");
});


Flight::route('/admin/deliveries(/@type)(/@id)', function ($type,$id) {
    $admin = new Model;
    if (!isset($_SESSION['user']) || ($_SESSION['user']['type']!="1")){
        Flight::redirect("/admin/login");
    }
    $css = ["../vendor/datatables/dataTables.bootstrap4"];
    $js = ["../vendor/datatables/jquery.dataTables","../vendor/datatables/dataTables.bootstrap4","../vendor/datatables/buttons.min","../vendor/datatables/buttonsHtml5.min","../vendor/datatables/jzip.min"];
    Flight::set('flight.views.path', 'intranet');
    Flight::render('dashboard/deliveries', ['title' => 'Envíos',"css"=>$css,"js"=>$js,"type"=>$type,"id"=>$id]);
    Flight::modal("deliveries");
});


Flight::route('/admin/patients', function () {
    $admin = new Model;
    if (!isset($_SESSION['user']) || ($_SESSION['user']['type']!="1")){
        Flight::redirect("/admin/login");
    }
    $css = ["../vendor/datatables/dataTables.bootstrap4"];
    $js = ["../vendor/datatables/jquery.dataTables","../vendor/datatables/dataTables.bootstrap4","../vendor/datatables/buttons.min","../vendor/datatables/buttonsHtml5.min","../vendor/datatables/jzip.min"];
    Flight::set('flight.views.path', 'intranet');
    Flight::render('patients/index', ['title' => 'Pacientes', "admin" => $admin,"css"=>$css,"js"=>$js]);
});

Flight::route('/admin/stock', function () {
    $admin = new Model;
    if (!isset($_SESSION['user']) || ($_SESSION['user']['type']!="1")){
        Flight::redirect("/admin/login");
    }
    $css = ["../vendor/datatables/dataTables.bootstrap4"];
    $js = ["../vendor/datatables/jquery.dataTables","../vendor/datatables/dataTables.bootstrap4","../vendor/datatables/buttons.min","../vendor/datatables/buttonsHtml5.min","../vendor/datatables/jzip.min"];
    Flight::set('flight.views.path', 'intranet');
    Flight::render('dashboard/stock', ['title' => 'Inventario',"css"=>$css,"js"=>$js]);
    Flight::modal("stock");
});*/

/*Flight::route('/admin/stock/history/@id', function ($id) {
    $admin = new Model;
    if (!isset($_SESSION['user']) || ($_SESSION['user']['type']!="1")){
        Flight::redirect("/admin/login");
    }
    $css = ["../vendor/datatables/dataTables.bootstrap4"];
    $js = ["../vendor/datatables/jquery.dataTables","../vendor/datatables/dataTables.bootstrap4","../vendor/datatables/buttons.min","../vendor/datatables/buttonsHtml5.min","../vendor/datatables/jzip.min"];

    $drug = $admin->drugs->GetDetails(new Request(["id"=>$id]));*/
    /*if ($drug['summary']['quantity']<1)
        Flight::redirect("/admin/stock");*/
    /*Flight::set('flight.views.path', 'intranet');
    Flight::render('dashboard/drug-history', ['title' => 'Inventario',"css"=>$css,"js"=>$js,"id"=>$id,"drug"=>$drug]);
    Flight::modal("stock");
});*/

/*Flight::route('/admin/users', function () {
    $admin = new Model;
    if (!isset($_SESSION['user']) || ($_SESSION['user']['type']!="1")){
        Flight::redirect("/admin/login");
    }
    $css = ["../vendor/datatables/dataTables.bootstrap4"];
    $js = ["../vendor/datatables/jquery.dataTables","../vendor/datatables/dataTables.bootstrap4","../vendor/datatables/buttons.min","../vendor/datatables/buttonsHtml5.min","../vendor/datatables/jzip.min"];

    Flight::set('flight.views.path', 'intranet');
    Flight::render('account/users', ['title' => 'Usuarios',"css"=>$css,"js"=>$js]);
    Flight::modal("users");
});*/


Flight::start();

?>