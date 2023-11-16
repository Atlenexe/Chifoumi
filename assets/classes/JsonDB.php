<?php

require_once("assets/interfaces/DatabaseInterface.php");

class JsonDB implements DatabaseInterface
{
    private string $filePath = "assets/db/";
    private string $dbName = "score";

    public static function initDB(string $filePath, string $dbName): void
    {
        file_exists($filePath . $dbName) ?: mkdir($filePath);
        if (json_decode(file_get_contents($filePath . $dbName . ".json"), true) === null) {
            file_put_contents($filePath . $dbName . ".json", json_encode([]));
        }
    }

    public static function createValue(mixed $payload): void
    {
        $values = json_decode(file_get_contents(self::$filePath . self::$dbName . ".json"), true);

        $values === null ? [] : $values;

        $values[] = $payload;
        file_put_contents(self::$filePath . self::$dbName . ".json", json_encode($values));
    }

    public static function putValue(string $key, mixed $payload): void
    {
        $values = json_decode(file_get_contents(self::$filePath . self::$dbName . ".json"), true);

        $values === null ? [] : $values;

        foreach ($values as $valuesKey => $value) {
            if ($value[$key] === $payload[$key]) {
                $values[$valuesKey] = $payload;
                file_put_contents(self::$filePath . self::$dbName . ".json", json_encode($values));
            }
        }
    }

    public static function selectFrom(string $attributeName, string $value): array
    {
        $result = [];
        $values = json_decode(file_get_contents(self::$filePath . self::$dbName . ".json"), true);

        if (isset($values)) {
            foreach ($values as $dbValue) {
                if ($dbValue[$attributeName] === $value) {
                    $result[] = $dbValue;
                }
            }
        }

        return $result === null ? [] : $result;
    }

    public static function selectAll(): array
    {
        $values = json_decode(file_get_contents(self::$filePath . self::$dbName . ".json"), true);

        return $values === null ? [] : $values;
    }
}
