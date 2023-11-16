<?php

class JsonDB
{
    public static function initDB(string $filePath, string $dbName): void
    {
        file_exists($filePath . $dbName) ?: mkdir($filePath);
        if (json_decode(file_get_contents($filePath . $dbName . ".json"), true) === null) {
            file_put_contents($filePath . $dbName . ".json", json_encode([]));
        }
    }

    public static function createValue(string $filePath, string $dbName, mixed $payload): void
    {
        $values = json_decode(file_get_contents($filePath . $dbName . ".json"), true);

        $values === null ? [] : $values;

        $values[] = $payload;
        file_put_contents($filePath . $dbName . ".json", json_encode($values));
    }

    public static function putValue(string $filePath, string $dbName, string $key, mixed $payload): void
    {
        $values = json_decode(file_get_contents($filePath . $dbName . ".json"), true);

        $values === null ? [] : $values;

        foreach ($values as $valuesKey => $value) {
            if ($value[$key] === $payload[$key]) {
                $values[$valuesKey] = $payload;
                file_put_contents($filePath . $dbName . ".json", json_encode($values));
            }
        }
    }

    public static function selectFrom(string $filePath, string $dbName, string $attributeName, string $value): array
    {
        $result = [];
        $values = json_decode(file_get_contents($filePath . $dbName . ".json"), true);

        if (isset($values)) {
            foreach ($values as $dbValue) {
                if ($dbValue[$attributeName] === $value) {
                    $result[] = $dbValue;
                }
            }
        }

        return $result === null ? [] : $result;
    }

    public static function selectAll(string $filePath, string $dbName): array
    {
        $values = json_decode(file_get_contents($filePath . $dbName . ".json"), true);

        return $values === null ? [] : $values;
    }
}
