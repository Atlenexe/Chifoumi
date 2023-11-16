<?php

interface DatabaseInterface
{
    public static function createValue(mixed $payload): void;
    public static function putValue(string $key, mixed $payload): void;
    public static function selectFrom(string $attributeName, string $value): array;
    public static function selectAll(): array;
}