<?php


namespace PHPassword\Component\DataProvider;


interface DataProviderInterface
{
    public function toArray(): array;

    public function fromArray(array $data): void;
}