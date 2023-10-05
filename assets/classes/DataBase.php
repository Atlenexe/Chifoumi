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

    public function createValue(string $key, mixed $payload): void
    {
        $this->values[$key] = $payload;
        file_put_contents($this->filePath . $this->dbName . ".json", json_encode($this->values));
    }

    public function putValue(string $key, mixed $payload): void
    {
        $this->values[$key] = $payload;
        file_put_contents($this->filePath . $this->dbName . ".json", json_encode($this->values));
    }

    public function selectFrom(string $attributeName, string $value)
    {
        $result = [];

        foreach ($this->values as $dbValue) {
            if($dbValue[$attributeName] === $value){
                $result[] = $dbValue;
            }
        }

        return $result;
    }
}
