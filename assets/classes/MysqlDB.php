<?php

class MysqlDB
{

    public static function createValue(mixed $payload): void
    {
        $con = new mysqli("localhost", "root", "root", "chifoumi", 3306);

        if (!$con) {
            die("Connection failed: " . $con->connect_error);
        }

        $score = $payload["score"];
        $name = $payload["name"];

        $query = "INSERT INTO score (name, score) VALUES ('" . $name . "', " . $score . ")";

        if (!$con->query($query)) {
            echo "Error: " . $con->error;
        }

        $con->close();
    }

    public static function putValue(string $key, mixed $payload): void
    {
        $con = new mysqli("localhost", "root", "root", "chifoumi", 3306);

        if (!$con) {
            die("Connection failed: " . $con->connect_error);
        }

        $score = $payload["score"];
        $name = $payload["name"];

        $query = "UPDATE score SET name = '" . $name . "', score = " . $score . " WHERE " . $key . " = '" . $name . "'";

        if (!$con->query($query)) {
            echo "Error: " . $con->error;
        }

        $con->close();
    }

    public static function selectFrom(string $attributeName, string $value): array
    {
        $resultArray = [];

        $con = new mysqli("localhost", "root", "root", "chifoumi", 3306);

        if (!$con) {
            die("Connection failed: " . $con->connect_error);
        }

        $query = "SELECT * FROM score WHERE " . $attributeName . " = '" . $value . "'";
        $result = $con->query($query);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $resultArray[] = $row;
            }
            $result->free_result();
        }

        $con->close();

        return $resultArray;
    }

    public static function selectAll(): array
    {
        $result = [];

        $con = new mysqli("localhost", "root", "root", "chifoumi", 3306);

        if (!$con) {
            die("Connection failed: " . $con->connect_error);
        }

        $query = "SELECT * FROM score";

        if (!$con->query($query)) {
            echo "Error: " . $con->error;
        }

        $con->close();

        return $result;
    }
}
