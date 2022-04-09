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
    Flight::render('dashboard/index', ['title' => 'Dashboard']);
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