<?php


namespace PHPassword\Component\DataProvider;


interface DataProviderInterface
{
    public function toArray(): array;

    public function fromArray(array $data): void;

    public function set(string $name, $value): void;

    public function get(string $name);
}