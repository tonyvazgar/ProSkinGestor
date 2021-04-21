<?php
    require_once "../../Model/Inventario/Producto.php";
    require_once "../../Model/Clientes/Cliente.php";

    $ModelCliente = new Cliente();
    $ModelProducto = new Producto();

    $marca = $_POST['marca'];

    if($marca != "AINHOA"){     //No liene lineas de productos aparte
        if($marca == "MIGUETT"){
            
        }else{

        }
    }else{
        $productos = $ModelProducto->getAllProductosFromMarca($marca);
        foreach($productos as $d){
            if($d['stock_disponible_producto'] == 0){
              echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                      <a href='detallesProducto.php?id=".$d['id_producto']."' role='button'>".$d['marca_producto'].$d['nombre_producto']."</a><span class='badge bg-warning rounded-pill'>Sin Stock</span>
                      </li>";
            }else{
              echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                      <a href='detallesProducto.php?id=".$d['id_producto']."' role='button'>".$d['marca_producto'].$d['descripcion_producto']."</a><span class='badge bg-success rounded-pill'>Stock</span>
                      </li>";
            }
          }
    }
    echo "<h1>".$marca."</h1>";
?>