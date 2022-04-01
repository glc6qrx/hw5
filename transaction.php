<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">  

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="CS4640">
        <meta name="description" content="Transactions">  

        <title>Transactions</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> 
    </head>
    <body>
        <div class="container" style="margin-top: 15px;">
            <div class="row col-xs-8">
                <h1>Transactions</h1>
                <h3>Hello <?=$user["name"]?>! Id: <?=$user["id"]?> Email: <?=$user["email"]?></h3>
                
                <a href="?command=addtransaction" class="mt-3 btn btn-primary col-12">Add New Transaction</a>
                <a href="?command=logout" class="mt-3 btn btn-danger col-12">Logout</a>
                <hr>
                <table>
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Name</td>
                            <td>Date</td>
                            <td>Amount</td>
                            <td>Category</td>
                            <td>Type</td>
                        </tr>
                    </thead>
                    <tbody>

                    <?php 
                        foreach($_SESSION["transactions"] as $transaction) {
                            ?>
                            <tr>
                                <td><?php echo $transaction['id']?></td>
                                <td><?php echo $transaction['name']?></td>
                                <td><?php echo $transaction['t_date']?></td>
                                <td><?php echo $transaction['amount']?></td>
                                <td><?php echo $transaction['Category']?></td>
                                <td><?php echo $transaction['Type']?></td>
                            </tr>
                    <?php
                    }
                    ?>
                    <h3>Total Amount: <?=$sum?></h3> 
                    </tbody>
                </table>

                <br>

                <table>
                    <thead>
                        <tr>
                            <td><b>Category</b></td>
                            <td><b>Total</b></td>
                        </tr>
                    </thead>
                    <tbody>

                    <?php 
                        foreach($sumArr as $key => $value) {
                            ?>
                            <tr>
                                <td><?php echo $key?></td>
                                <td><?php echo $value?></td>

                            </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>


            </div>




        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    </body>
</html>