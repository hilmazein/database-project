<?php
require 'function.php';
require 'check.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Entry Items</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand ps-3" href="index.php">DB Assignment</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Stock Items
                            </a>
                            <a class="nav-link" href="getin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Entry Items
                            </a>
                            <a class="nav-link" href="getout.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Exit Items
                            </a>  
                            <a class="nav-link" href="logout.php">
                                Logout
                            </a>  
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Entry Items</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Add Item
                                </button>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Item Name</th>
                                            <th>Amount</th>
                                            <th>Recipient</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php

                                        $overalldatastock=mysqli_query($conn, "select * from getin g, stock s where s.id_item = g.id_item");
                                        while($data=mysqli_fetch_array($overalldatastock)){
                                            $id_item=$data['id_item'];
                                            $id_getin=$data['id_getin'];
                                            $date=$data['date'];
                                            $item_name=$data['item_name'];
                                            $qty=$data['qty'];
                                            $recipient=$data['recipient'];
                                        ?>
                                        <tr>
                                            <td><?=$date;?></td>
                                            <td><?=$item_name;?></td>
                                            <td><?=$qty;?></td>
                                            <td><?=$recipient;?></td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$id_getin;?>">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                             <!-- Delete Modal -->
                                             <div class="modal fade" id="delete<?=$id_getin;?>">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                        <h4 class="modal-title">Delete Item</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                        <div class="modal-body">
                                                        Are you sure you want to delete <?=$item_name;?>?
                                                        <input type="hidden" name="id_item" value="<?=$id_item;?>">
                                                        <input type="hidden" name="qty" value="<?=$qty;?>">
                                                        <br>
                                                        <br>
                                                        <button type="submit" name="deleteentryitem" class="btn btn-danger">Delete</button>                     
                                                        </div>
                                                        </form>
                                                        
                                                    </div>
                                                    </div>
                                                </div>
                  
                                        <?php
                                        };
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Add Entry Item</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form method="post">
            <div class="modal-body">
            <select name="item" class="form-control">
                <?php
                    $overalldata=mysqli_query($conn, "select * from stock");
                    while($fetcharray=mysqli_fetch_array($overalldata)) {
                        $itemname=$fetcharray['item_name'];
                        $iditem=$fetcharray['id_item'];
                ?>
                <option value="<?=$iditem;?>"><?=$itemname;?></option>
                <?php
                    }
                ?>
            </select>
            <br> 
            <input type="number" name="qty" class="form-control" placeholder="Quantity" required>
            <br>
            <input type="text" name="recipient" class="form-control" placeholder="Recipient" required>
            <br>
            <button type="submit" name="entryitem" class="btn btn-primary">Submit</button>                     
            </div>
            </form>
            
        </div>
        </div>
    </div>
</html>
