<?php

class FinanceController {
    private $command;

    private $db;
    
    // If using Monolog (with Composer)
    //private $logger;

    public function __construct($command) {
        //***********************************
        // If we use Composer to include the Monolog Logger
        // global $log;
        // $this->logger = new \Monolog\Logger("TriviaController");
        // $this->logger->pushHandler($log);
        //***********************************

        $this->command = $command;

        $this->db = new Database();
    }

    public function run() {
        switch($this->command) {
            case "transaction":
                $this->transaction();
                break;
            case "addtransaction":
                $this->addTransaction();
                break;
            case "logout":
                $this->destroySession();
            case "login":
            default:
                $this->login();
        }
    }

    private function destroySession() {
        session_destroy();
        header("Location: ?command=login");
    }

    private function login() {
        $error_msg = "";
        if (isset($_POST["email"])) {
            $data = $this->db->query("select * from hw5_user where email = ?;", "s", $_POST["email"]);
            if ($data === false) {
                $error_msg = "Error checking for user";
            } else if (!empty($data)) {
                if($data[0]["name"] === $_POST["name"]){
                    if (password_verify($_POST["password"], $data[0]["password"])) {
                    $_SESSION["name"] = $data[0]["name"];
                    $_SESSION["email"] = $data[0]["email"];
                    $_SESSION["id"] = $data[0]["id"];

                    header("Location: ?command=transaction");
                    } else {
                        $error_msg = "Wrong password";
                    }
                }
                else{
                    $error_msg = "Name doesn't correlate to email.";
                }
            } else { // empty, no user found
                // TODO: input validation
                // Note: never store clear-text passwords in the database
                //       PHP provides password_hash() and password_verify()
                //       to provide password verification
                $insert = $this->db->query("insert into hw5_user (name, email, password) values (?, ?, ?);", 
                        "sss", $_POST["name"], $_POST["email"], 
                        password_hash($_POST["password"], PASSWORD_DEFAULT));
                if ($insert === false) {
                    $error_msg = "Error inserting user";
                } else {
                    $data = $this->db->query("select id from hw5_user where email = ?;", "s", $_POST["email"]);
                    $_SESSION["id"] = $data[0]["id"];
                    $_SESSION["name"] = $_POST["name"];
                    $_SESSION["email"] = $_POST["email"];
                    header("Location: ?command=transaction");
                }
            }
        }
        include("login.php");
    }

    private function transaction() {
        $user = [
            "name" => $_SESSION["name"],
            "email" => $_SESSION["email"],
            "id" => $_SESSION["id"]
        ];

        $transdata = $this->db->query("select * from hw5_transaction where user_id = ? ORDER BY t_date DESC;", "s", $_SESSION["id"]);
        $_SESSION["transactions"] = $transdata;
        
        include("transaction.php");
    }

    private function addTransaction() {
        $user = [
            "name" => $_SESSION["name"],
            "email" => $_SESSION["email"],
            "id" => $_SESSION["id"]
        ];

        $error_msg = "";
        $success_msg = "";
        if(isset($_POST["name"], $_POST["date"], $_POST["amount"], $_POST["category"], $_POST["type"])){
            if($_POST["type"] === "Debit"){
                $_POST["amount"] = -$_POST["amount"];
            }
            $insert = $this->db->query("insert into hw5_transaction (user_id, name, t_date, amount, Category, Type) values (?, ?, ?, ?, ?, ?);", 
                        "issdss", $user["id"], $_POST["name"], $_POST["date"], $_POST["amount"], $_POST["category"], $_POST["type"]);
            if (!$insert) {
                $error_msg = "Error adding transaction";
            } else {
                $success_msg = "Transaction added succesfully";
                header("Location: ?command=transaction");
            }
        }
        include("addtransaction.php");
    }
}