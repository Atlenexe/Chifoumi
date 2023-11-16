<?php

class MysqlDB
{
    private static $con;

    private const HOST = "localhost";
    private const USER = "root";
    private const PASSWORD = "root";
    private const DATABASE = "chifoumi";
    private const PORT = 3306;

    public static function initConnection()
    {
        self::$con = new mysqli(self::HOST, self::USER, self::PASSWORD, self::DATABASE, self::PORT);

        if (self::$con->connect_error) {
            die("Connection failed: " . self::$con->connect_error);
        }
    }

    public static function closeConnection()
    {
        if (self::$con) {
            self::$con->close();
        }
    }

    public static function createValue(mixed $payload): void
    {
        self::initConnection();
        $con = self::$con;

        $score = $payload["score"];
        $name = $payload["name"];

        $query = "INSERT INTO score (name, score) VALUES ('" . $name . "', " . $score . ")";

        if (!$con->query($query)) {
            echo "Error: " . $con->error;
        }

        self::closeConnection();
    }

    public static function putValue(string $key, mixed $payload): void
    {
        self::initConnection();
        $con = self::$con;

        $score = $payload["score"];
        $name = $payload["name"];

        $query = "UPDATE score SET name = '" . $name . "', score = " . $score . " WHERE " . $key . " = '" . $name . "'";

        if (!$con->query($query)) {
            echo "Error: " . $con->error;
        }

        self::closeConnection();
    }

    public static function selectFrom(string $attributeName, string $value): array
    {
        self::initConnection();
        $con = self::$con;

        $resultArray = [];

        $query = "SELECT * FROM score WHERE " . $attributeName . " = '" . $value . "'";
        $result = $con->query($query);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $resultArray[] = $row;
            }
            $result->free_result();
        } else {
            echo "Error: " . $con->error;
        }

        self::closeConnection();

        return $resultArray;
    }


    public static function selectAll(): array
    {
        self::initConnection();
        $con = self::$con;

        $resultArray = [];

        $query = "SELECT * FROM score";
        $result = $con->query($query);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $resultArray[] = $row;
            }
            $result->free_result();
        } else {
            echo "Error: " . $con->error;
        }

        self::closeConnection();

        return $resultArray;
    }
}
