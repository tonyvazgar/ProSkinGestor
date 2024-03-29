<?php
    require_once "../../Model/Inventario/Producto.php";
    require_once "../../Model/Clientes/Cliente.php";

    $ModelCliente = new Cliente();
    $ModelProducto = new Producto();

    $marca = $_POST['marca'];
    $id_cento = $_POST['id_centro'];

    if(isset($_POST['linea'])){
      $productos = $ModelProducto->getAllProductosFromLinea($_POST['linea'], $_POST['id_centro']);
      echo "<h5>".$_POST['linea']."</h5>";
      if(empty($productos)){
        echo "<h3 class='text-center'>No hay productos de la linea ".$_POST['linea']."</h3>";
      }else{
          $selectInicio = "<select class='last_producto form-control col-sm-10' id='selectOptionIdProducto' name='selectOptionIdProducto'>";
          $selectFinal  = "</select>";
          $optionsValue = "";
          foreach($productos as $d){
              if($d['stock_disponible_producto'] != 0){
                $optionsValue .= "<option value='".$d['id_producto']."'>".$d['descripcion_producto']." (".$d['presentacion_producto'].")</option>";
              }
          }
          if($optionsValue != ""){
            echo "<div class='row'>";
            echo $selectInicio.$optionsValue.$selectFinal;
            echo "<button type='button' class='last_producto btn btn-info col-sm-2' id='selecionarProductoBtn' name='selecionarProductoBtn'>Seleccionar</button>
                  </div>";
          }else{
            echo "<h3 class='text-center'>No hay stock de la linea ".$_POST['linea']."</h3>";
          }
      }
    }else{
        echo "<h5>".$marca."</h5>";
        if($marca != "AINHOA"){     //No liene lineas de productos aparte
            $productos = $ModelProducto->getAllProductosFromMarca($marca, $id_cento);
            if(empty($productos)){
                echo "<h3 class='text-center'>No hay productos de la marca ".$marca."</h3>";
            }else{
                $selectInicio = "<select class='last_producto form-control col-sm-10' id='selectOptionIdProducto' name='selectOptionIdProducto'>";
                $selectFinal  = "</select>";
                $optionsValue = "";
                foreach($productos as $d){
                    if($d['stock_disponible_producto'] != 0){
                      $optionsValue .= "<option value='".$d['id_producto']."'>".$d['descripcion_producto']." (".$d['presentacion_producto'].")</option>";
                    }
                }
                if($optionsValue != ""){
                  echo "<div class='row'>";
                  echo $selectInicio.$optionsValue.$selectFinal;
                  echo "<button type='button' class='last_producto btn btn-info col-sm-2' id='selecionarProductoBtn' name='selecionarProductoBtn'>Seleccionar</button>
                        </div>";
                }else{
                  echo "<h3 class='text-center'>No hay stock de la marca ".$marca."</h3>";
                }
            }
        }
    }
?>