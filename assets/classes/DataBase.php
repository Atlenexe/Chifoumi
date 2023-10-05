<?php

class DataBase
{
    public string $filePath = "assets/db/";
    public string $dbName = "";
    public array $values;

    public function __construct(string $dbName)
    {
        $this->dbName = $dbName;
        $this->initDB();
    }

    private function initDB()
    {
        file_exists($this->filePath . $this->dbName) ?: mkdir($this->filePath);
        file_put_contents($this->filePath . $this->dbName . ".json", json_encode([]));
    }

    public function createValue(mixed $payload): void
    {
        $this->values[] = $payload;
        file_put_contents($this->filePath . $this->dbName . ".json", json_encode($this->values));
    }

    public function putValue(string $key, mixed $payload): void
    {
        foreach ($this->values as $valuesKey => $value) {
            if ($value[$key] === $payload[$key]) {
                $this->values[$valuesKey] = $payload;
                file_put_contents($this->filePath . $this->dbName . ".json", json_encode($this->values));
            }
        }
    }

    public function selectFrom(string $attributeName, string $value)
    {
        $result = [];

        if (isset($this->values)) {
            foreach ($this->values as $dbValue) {
                if ($dbValue[$attributeName] === $value) {
                    $result[] = $dbValue;
                }
            }
        }

        return $result;
    }
}
