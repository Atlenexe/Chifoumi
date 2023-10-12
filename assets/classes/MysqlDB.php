<?php

class MysqlDB
{

    /*
    public static function initDB(string $tableName, string $host = "localhost", string $username = "root", string $password = "root"): void
    {
        $con = new mysqli($host, $username, $password);

        if (!$con) {
            die("Connection failed: " . $con->connect_error);
        }

        if (!$con->select_db("database")) {

            $query = "CREATE DATABASE database";

            if ($con->query($query)) {
                echo "Database created successfully";
            } else {
                echo "Error creating database: " . $con->error;
            }

            $con->select_db("database");
        }

        $query = "CREATE TABLE " . $tableName . "";

            if ($con->query($query)) {
                echo "Table created successfully";
            } else {
                echo "Error creating table: " . $con->error;
            }

        $con->close();
    }

    public static function createValue(string $tableName, string $host, string $username, string $password, mixed $payload): void
    {
        $con = new mysqli($host, $username, $password);

        if (!$con) {
            die("Connection failed: " . $con->connect_error);
        }

        $query = "";

        if ($con->query($query)) {
            echo "Value created successfully";
        } else {
            echo "Error creating database: " . $con->error;
        }

        $con->close();
    }

    public static function putValue(string $tableName, string $host, string $username, string $password, string $key, mixed $payload): void
    {
        $con = new mysqli($host, $username, $password);

        if (!$con) {
            die("Connection failed: " . $con->connect_error);
        }

        $query = "";

        if ($con->query($query)) {
            echo "Value edit successfully";
        } else {
            echo "Error creating database: " . $con->error;
        }

        $con->close();
    }

    public static function selectFrom(string $tableName, string $host, string $username, string $password, string $attributeName, string $value): array
    {
        $result = [];

        $con = new mysqli($host, $username, $password);

        if (!$con) {
            die("Connection failed: " . $con->connect_error);
        }

        $query = "SELECT * FROM " . $tableName . " WHERE " . $attributeName . " = " . $value;

        if (!$con->query($query)) {
            echo "Select error: " . $con->error;
        }

        $con->close();

        return $result;
    }
    */
}
