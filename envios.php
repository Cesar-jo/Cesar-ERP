<?php 
// PHP Y SUS FUNCIONES PREDEFINIDAS ESTÁN TODAS ATRAS DE ESTO
require_once 'app/config.php';



$data =
[
  'title' => 'Todos los Pedidos',
  'active' => 'envios'
 
];

// Renderizado de la vista
render_view('envios' , $data);