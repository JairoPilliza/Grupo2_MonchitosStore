<?php
    include "pedidos.php";
    $pedidos = new Pedidos;
    //print_r($_SESSION['cart_contents']);
    //foreach($_SESSION['cart_contents'] as $items){
      //  if (isset($items['id']) && !empty($items['id'])) { 
        //printf($items['id']."<br>");
        //printf($items['cantidad']."<br>");
    //}
//}
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
    <!--<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>-->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <title>Document</title>
    <script>
    function updateItem(e ,id){
       let cantidad = e.value;
       let xhttp = new XMLHttpRequest();
       xhttp.onload = function(){
              window.location="Carrito.php";  
       }
       xhttp.open("GET","SolicitarPedido.php?action=updateItem&id="+id+"&cantidad="+cantidad);
       xhttp.send();

    }
    //$(document).ready(function () {
        //alert('hola');
      //  var sum=0;
        //$(".star").each(function(i) {
        //sum = sum + parseInt($(this).text());
        //$("#suma").text("$"+sum);
        //});
    //});
    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
      <a class="navbar-brand"><img src="../img/logo.png" height="70px" width="80px;" /></a>
         <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div id="my-nav" class="collapse navbar-collapse">
             <ul class="navbar-nav mr-auto">
                 <li class="nav-item">
                     <a class="nav-link" href="../principal.php">Inicio <span class="sr-only">(current)</span></a>
                 </li>
                 <li class="nav-item active">
                     <a class="nav-link" href="#">Carrito <span class="sr-only">(current)</span></a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="#">Pagos <span class="sr-only">(current)</span></a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Contactenos</a>
                 </li>
             </ul>
             
         </div>
</nav>
<br><br><br><br><br>
<div class="container">   
    <h1>Carrito de Compras</h1>  
    
    <table class="table table-dark">
        <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Especie:</th>
        <th scope="col">Precio</th>
        <th scope="col">Cantidad</th>
        <th scope="col">Importe</th>
        <th scope="col">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php
               if (($_SESSION['cart_contents']) && $_SESSION['cart_contents']>0 && $_SESSION['cart_contents']['total_items'] !=0) {
                    foreach($_SESSION['cart_contents'] as $items){
                        if (isset($items['id']) && !empty($items['id'])) {                           
                        
                        echo "
                        <tr>
                        <td>".$items['id']."</td>
                        <td>".$items['especie']."</td>
                        <td>".$items['price']."</td>
                        <td> <input type='number' onchange='updateItem(this,". $items['id'] .")' value='".$items['cantidad']."'></td>
                        <td class='star'> $".$items['subtotal']."</td>
                        <td><a href='SolicitarPedido.php?action=removeItem&id=".$items['id']."' class='btn btn-dark'"."onclick=''><i class='fas fa-trash'> Eliminar</i></a></t>
                        </tr>
                        
                        ";
                        
                    }
                }
                }else{
                    echo "<tr><td colspan='6'><h1>No hay Datos</h1></td></tr>";
                }
                
        ?>
        </tbody>
        <tfoot>
        <tr>
        <th>ID</th>
        <th>Especie:</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>$ <?php echo $_SESSION['cart_contents']['cart_total'] ?></th>
        <th>&nbsp;</th>
        </tr>
        </tfoot>
    </table>
    <a href="SolicitarPedido.php?action=crearOrden2&id=1" class="btn btn-dark"><i class="fa fa-cart-arrow-down" aria-hidden="true"> Comprar</i></a>

       </div>
</div>
</body>
</html>