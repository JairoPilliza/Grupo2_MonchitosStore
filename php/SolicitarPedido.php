<?php
include "pedidos.php";
include "../config/conexion.php";
session_start();
$nombre=$_SESSION['nombre'];
$cliId=$_SESSION['cliId'];
$pedidos=new Pedidos;
if (isset($_REQUEST['action']) && !empty($_REQUEST['action']) ) {
    if ($_REQUEST['action']=='addItem'&& !empty($_REQUEST['id'])) {
        $id=$_REQUEST['id'];
        $query=$db->query("select * from mascotas where id=$_REQUEST[id]");
        $row=$query->fetch_assoc();
        $itemData=array(
            'id'=>$row['id'],
            'especie'=>$row['especie'],
            'price'=>$row['precio'],
            'cantidad'=>1
        );
        $_SESSION['total']=$_SESSION['total']+$row['precio'];
        $insertItem=$pedidos->insert($itemData);
        //$query2=$db->query("insert into orden values(0,$cliId,$row[precio],now(),now(),1)");
        $redirectLoc=$insertItem?'Carrito.php':'../principal.php';
        header("Location:".$redirectLoc);
    }else if ($_REQUEST['action']=='crearOrden'&& !empty($_REQUEST['id'])){
        $idd=$_REQUEST['id'];
        if (!isset($_SESSION['orden'])) {
            $query2=$db->query("insert into orden values(0,$cliId,0,now(),now(),1)");
            $query3=$db->query("select max(ordId) as orden from orden");
            $row2=$query3->fetch_assoc();
            $_SESSION['orden']=$row2['orden'];
            header("Location: SolicitarPedido.php?action=addItem&id=$idd");
        }
        else{
            header("Location: SolicitarPedido.php?action=addItem&id=$idd");
        }
        
    }else if ($_REQUEST['action']=='removeItem'&& !empty($_REQUEST['id'])){
        $deleteItem=$pedidos->remove($_REQUEST['id']);
        header("Location: Carrito.php");
    }else if ($_REQUEST['action']=='crearOrden2'){
        $pagar=$_SESSION['cart_contents']['cart_total'];
        $query4=$db->query("insert into orden values(0,$cliId,$pagar,now(),now(),1)");
        $query5=$db->query("select max(ordId) as orden from orden");
        $row2=$query5->fetch_assoc();
        $orden=$row2['orden'];
        foreach($_SESSION['cart_contents'] as $items){
            if (isset($items['id']) && !empty($items['id'])) { 
            $query6=$db->query("insert into detalle values(0,$orden,$items[id],$items[cantidad])");
        }
    }
        
        header("Location:../pago.php");
    }else if ($_REQUEST['action']=='updateItem'&& !empty($_REQUEST['id'])){
        $itemData=array(
            'rowid'=>$_REQUEST['id'],
            'cantidad'=>$_REQUEST['cantidad']
        );
        $updateItem=$pedidos->updateItem($itemData);
        echo $updateItem?'ok':'err';
        die;
    }
}
?>