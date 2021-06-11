<?php
    include ("config/conexion.php");
    session_start();
    $nombre=$_SESSION['nombre'];
    if (!isset($nombre)) {
        header("location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!--<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>-->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <title>Tienda M</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
      
      <a class="navbar-brand"><img src="img/logo.png" height="70px" width="80px;" /></a>
         <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div id="my-nav" class="collapse navbar-collapse">
             <ul class="navbar-nav mr-auto">
                 <li class="nav-item active">
                     <a class="nav-link" href="principal.php">Inicio <span class="sr-only">(current)</span></a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="php/Carrito.php">Carrito <span class="sr-only">(current)</span></a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="#">Pagos <span class="sr-only">(current)</span></a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link disabled" href="php/salir.php" tabindex="-1" aria-disabled="true">Salir</a>
                 </li>
             </ul>
         </div>
  </nav>
  
  <div class="container">
         <br><br><br><br><br>
         <div class="alert alert-info">
             <h1>Bienvenido <?php echo $nombre; ?></h1>           
         </div>
          <div class="row">
            <?php
                $query=$db->query("select * from mascotas");
                if ($query->num_rows>0) {
                    while($row=$query->fetch_assoc()){
            ?>
                        <div class="col-3">
                        <div class="card">
                            <img class="card-img-top" src="<?php echo $row['rutaFoto']?>" width="100px" height="150px">
                            <div class="card-body">
                                <h3 class="card-title"><strong> Especie: </strong> <?php echo $row['especie']?></h3>
                                <h4 class="card-title"><strong> Raza: </strong><?php echo $row['raza']?></h4>
                                <h3 class="card-title"><strong> Descripcion: </strong><?php echo $row['detalle']?></h3>
                            </div>
                        </div> 
                        <div class="col-1">
                            <a href="php/SolicitarPedido.php?action=addItem&id=<?php echo $row['id']?>" class="btn btn-dark">Comprar</a>
                        </div>             
                    </div>  
                 
            <?php
                    }
                }else{
                    echo "<h1>No existen Mascotas</h1>";
                }

            ?>
                     
     </div>
  </body>
  </html>