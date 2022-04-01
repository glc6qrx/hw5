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
                <h1>Add Transactions</h1>
                <h3>Hello <?=$user["name"]?>! Id: <?=$user["id"]?></h3>
                
                <a href="?command=transaction" class="mt-3 btn btn-primary col-12">See Transactions</a>
                <div class="row">
                    <div class="col-xs-8 mx-auto">
                        <form action="?command=addtransaction" method="post" id="form1">
                            <div class="h-10 p-5 mb-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name of transaction">
                                <br>
                                <label for="date">Date</label>
                                <input type="date" class="form-control" id="date" name="date" placeholder="Date of transaction">
                                <br>
                                <label for="amount">Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount" placeholder="Transaction amount" min="0" step="0.01">
                                <br>
                                <label for="category">Category</label>
                                <input type="text" class="form-control" id="category" name="category" placeholder="Transaction Category">
                                <br>
                                <label for="type">Type</label>
                                <select class="form-control" id="type" name="type" placeholder="Transaction type">
                                    <option value="Debit">Debit</option>
                                    <option value="Credit">Credit</option>
                                </select>
                            </div>
                            <div class="text-center">
                                <input type="hidden" name="userid" value="<?=$_SESSION["id"]?>">               
                                <button type="submit" class="btn btn-primary">Add Transaction</button>
                            </div>
                        </form>
                        <?=$error_msg?>
                        <?=$success_msg?>
                    </div>
                </div>
            </div>
        </div>


            </div>




        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    </body>
</html>