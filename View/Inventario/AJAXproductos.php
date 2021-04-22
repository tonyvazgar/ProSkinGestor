<?php
    require_once "../../Model/Inventario/Producto.php";
    require_once "../../Model/Clientes/Cliente.php";

    $ModelCliente = new Cliente();
    $ModelProducto = new Producto();

    $marca = $_POST['marca'];
    $id_cento = $_POST['id_centro'];
    echo "<h1>".$marca."</h1>";
    if($marca != "AINHOA"){     //No liene lineas de productos aparte
      $productos = $ModelProducto->getAllProductosFromMarca($marca, $id_cento);
      foreach($productos as $d){
        if($d['stock_disponible_producto'] == 0){
          echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                  <a href='detallesProducto.php?id=".$d['id_producto']."' role='button'>".$d['descripcion_producto']."</a><span class='badge bg-warning rounded-pill'>Sin Stock</span>
                </li>";
        }else{
          echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                  <a href='detallesProducto.php?id=".$d['id_producto']."' role='button'>".$d['descripcion_producto']."</a>
                  <div>
                    <span class='badge bg-success rounded-pill'>Stock</span>
                    <a class='btn btn-success' href='ventaProducto.php?id=".$d['id_producto']."' role='button'>Vender</a>
                  </div>
                </li>";
        }
      }
    }else{
      echo "<div class='form-group'>
                    <label>Selecciona la linea de la marca</label>
                    <select name='linea' id='linea' class='form-control'>
                      <option value=''>** SELECCIONA **</option>
                      <option value='PURITY'>PURITY</option>
                      <option value='WHITESS'>WHITESS</option>
                      <option value='OXYGEN'>OXYGEN</option>
                      <option value='SENSKIN'>SENSKIN</option>
                      <option value='COLLAGEN%2B'>COLLAGEN +</option>
                      <option value='MULTIVIT'>MULTIVIT</option>
                      <option value='BIOME CARE'>BIOME CARE</option>
                      <option value='OLIVE'>OLIVE</option>
                      <option value='SPECIFIC'>SPECIFIC</option>
                      <option value='HYALURONIC'>HYALURONIC</option>
                      <option value='SKIN PRIMES'>SKIN PRIMES</option>
                      <option value='BODY LINE UP'>BODY LINE UP</option>
                      <option value='CANNABI7'>CANNABI7</option>
                      <option value='SPA LUXURY'>SPA LUXURY</option>
                      <option value='OTRO'>OTRO</option>
                      <option value='PACKS'>PACKS</option>
                    </select>
                  </div>";
    }

    if(isset($_POST['linea'])){
      $productos = $ModelProducto->getAllProductosFromLinea($_POST['linea'], $_POST['id_centro']);
      foreach($productos as $d){
        if($d['stock_disponible_producto'] == 0){
          echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                  <a href='detallesProducto.php?id=".$d['id_producto']."' role='button'>".$d['descripcion_producto']."</a><span class='badge bg-warning rounded-pill'>Sin Stock</span>
                </li>";
        }else{
          echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                  <a href='detallesProducto.php?id=".$d['id_producto']."' role='button'>".$d['descripcion_producto']."</a>
                  <div>
                    <span class='badge bg-success rounded-pill'>Stock</span>
                    <a class='btn btn-success' href='ventaProducto.php?id=".$d['id_producto']."' role='button'>Vender</a>
                  </div>
                </li>";
        }
      }
    }
?>