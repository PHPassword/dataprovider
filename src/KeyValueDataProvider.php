<?php


namespace PHPassword\Component\DataProvider;


class KeyValueDataProvider implements DataProviderInterface
{
    /**
     * @var array
     */
    private $store;

    /**
     * KeyValueDataProvider constructor.
     * @param array $store
     */
    public function __construct(array $store = [])
    {
        $this->store = $store;
    }

    public function set(string $name, $value): void
    {
        $this->store[$name] = $value;
    }

    public function get(string $name)
    {
        return $this->store[$name] ?? null;
    }

    public function toArray(): array
    {
        return $this->store;
    }

    public function fromArray(array $data): void
    {
        $this->store = $data;
    }
}