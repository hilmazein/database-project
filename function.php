<?php
session_start();

$conn = mysqli_connect("localhost","root","","dbproject",3307);

if(isset($_POST['addnewitem'])) {
    $itemname=$_POST['itemname'];
    $description=$_POST['description'];
    $stock=$_POST['stock'];

    $addtotable=mysqli_query($conn, "insert into stock (item_name, description, stock) values('$itemname','$description','$stock')");
    if($addtotable) {
        header('location:index.php');
    } else{
        echo 'fail';
        header('location:index.php');
    }
};

if(isset($_POST['entryitem'])) {
    $item=$_POST['item'];
    $recipient=$_POST['recipient'];
    $qty=$_POST['qty'];

    $checkstocknow=mysqli_query($conn, "select * from stock where id_item='$item'");
    $getdata=mysqli_fetch_array($checkstocknow);

    $stocknow=$getdata['stock'];
    $addstocknowwithquantity=$stocknow+$qty;

    $addtoentry=mysqli_query($conn, "insert into getin (id_item, recipient, qty) values('$item','$recipient','$qty')");
    $updatestockentry=mysqli_query($conn, "update stock set stock='$addstocknowwithquantity' where id_item='$item'");
    if($addtoentry&&$updatestockentry) {
        header('location:getin.php');
    } else{
        echo 'fail';
        header('location:getin.php');
    }
};

if(isset($_POST['exititem'])) {
    $item=$_POST['item'];
    $customer=$_POST['customer'];
    $qty=$_POST['qty'];

    $checkstocknow=mysqli_query($conn, "select * from stock where id_item='$item'");
    $getdata=mysqli_fetch_array($checkstocknow);

    $stocknow=$getdata['stock'];
    $addstocknowwithquantity=$stocknow-$qty;

    $addtoexit=mysqli_query($conn, "insert into getout (id_item, customer, qty) values('$item','$customer','$qty')");
    $updatestockexit=mysqli_query($conn, "update stock set stock='$addstocknowwithquantity' where id_item='$item'");
    if($addtoexit&&$updatestockexit) {
        header('location:getout.php');
    } else{
        echo 'fail';
        header('location:getout.php');
    }
};

if(isset($_POST['updateitem'])) {
    $id_item=$_POST['id_item'];
    $item_name=$_POST['item_name'];
    $description=$_POST['description'];

    $update=mysqli_query($conn, "update stock set item_name='$item_name', description='$description' where id_item='$id_item'");
    if($update) {
        header('location:index.php');
    } else{
        echo 'fail';
        header('location:index.php');
    }
};

if(isset($_POST['deleteitem'])) {
    $id_item=$_POST['id_item'];

    $delete=mysqli_query($conn, "delete from stock where id_item='$id_item'");
    if($delete) {
        header('location:index.php');
    } else{
        echo 'fail';
        header('location:index.php');
    }
};

if(isset($_POST['deleteentryitem'])) {
    $id_getin=$_POST['id_getin'];
    $qty=$_POST['qty'];
    $id_item=$_POST['id_item'];

    $getdatastock=mysqli_query($conn, "select * from stock where id_item='$id_item'");
    $data=mysqli_fetch_array($getdatastock);
    $stock=$data['stock'];

    $difference=$stock-$qty;

    $update=mysqli_query($conn, "update stock set stock='$difference' where id_item='$id_item'");
    $delete=mysqli_query($conn, "delete from getin where id_getin='$id_getin'");
    if($delete) {
        header('location:getin.php');
    } else{
        echo 'fail';
        header('location:getin.php');
    }
};

if(isset($_POST['deleteexititem'])) {
    $id_getout=$_POST['id_getout'];
    $qty=$_POST['qty'];
    $id_item=$_POST['id_item'];

    $getdatastock=mysqli_query($conn, "select * from stock where id_item='$id_item'");
    $data=mysqli_fetch_array($getdatastock);
    $stock=$data['stock'];

    $difference=$stock+$qty;

    $update=mysqli_query($conn, "update stock set stock='$difference' where id_item='$id_item'");
    $delete=mysqli_query($conn, "delete from getout where id_getout='$id_getout'");
    if($delete) {
        header('location:getout.php');
    } else{
        echo 'fail';
        header('location:getout.php');
    }
};
?>