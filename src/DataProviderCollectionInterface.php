<?php


namespace PHPassword\Component\DataProvider;


interface DataProviderCollectionInterface extends DataProviderInterface
{
    public function add(DataProviderInterface $dataProvider): void;
}