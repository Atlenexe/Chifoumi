<?php

require_once("JsonDB.php");
require_once("MysqlDB.php");

class DataBase
{
    public string $filePath = "assets/db/";

    public string $host;
    public string $port;
    public string $username;
    public string $password;

    public string $dbName = "";
    public string $dbType = "json";

    public function __construct(string $dbName, string $dbType)
    {
        $this->dbName = $dbName;
        $this->dbType = $dbType;
        $this->initDB();
    }

    private function initDB(): void
    {
        switch ($this->dbType) {
            case 'mysql':
                //MysqlDB::initDB($this->dbName, $this->host, $this->port, $this->username, $this->password);
                break;

            default:
                JsonDB::initDB($this->filePath, $this->dbName);
                break;
        }
    }

    public function createValue(mixed $payload): void
    {
        switch ($this->dbType) {
            case 'mysql':
                break;

            default:
                JsonDB::createValue($this->filePath, $this->dbName, $payload);
                break;
        }
    }

    public function putValue(string $key, mixed $payload): void
    {
        switch ($this->dbType) {
            case 'mysql':
                break;

            default:
                JsonDB::putValue($this->filePath, $this->dbName, $key, $payload);
                break;
        }
    }

    public function selectFrom(string $attributeName, string $value): array
    {
        switch ($this->dbType) {
            case 'mysql':
                break;

            default:
                return JsonDB::selectFrom($this->filePath, $this->dbName, $attributeName, $value);
                break;
        }
    }

    public function selectAll(): array
    {
        switch ($this->dbType) {
            case 'mysql':
                break;

            default:
                return JsonDB::selectAll($this->filePath, $this->dbName);
                break;
        }
    }
}
