<?php


use PHPassword\Component\DataProvider\DataProviderNormalizer;
use PHPassword\Component\DataProvider\KeyValueDataProvider;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;

class DataProviderNormalizerTest extends TestCase
{
    /**
     * @var DataProviderNormalizer
     */
    private static $normalizer;

    /**
     * @var Serializer
     */
    private static $serializer;

    public static function setUpBeforeClass()
    {
        static::$normalizer = new DataProviderNormalizer();
        static::$serializer = new Serializer([static::$normalizer], [new JsonEncoder()]);
    }

    public function testNormalize()
    {
        $data = [
            'id' => 5,
            'name' => 'Cindy',
            'phone' => '+49 2173 0000990090',
            'rating' => 5.6,
            'nicknames' => ['Princess', 'Flower'],
            'is_admin' => false
        ];
        $dataProvider = new KeyValueDataProvider($data);
        $normalized = static::$normalizer->normalize($dataProvider);

        $this->assertSame($data, $normalized);
    }

    public function testDenormalize()
    {
        $data = [
            'id' => 5,
            'name' => 'Cindy',
            'phone' => '+49 2173 0000990090',
            'rating' => 5.6,
            'nicknames' => ['Princess', 'Flower'],
            'is_admin' => false
        ];

        /* @var KeyValueDataProvider $denormalized */
        $denormalized = static::$normalizer->denormalize($data, KeyValueDataProvider::class);
        $this->assertInstanceOf(KeyValueDataProvider::class, $denormalized);

        foreach($data as $name => $value){
            $this->assertSame($value, $denormalized->get($name));
        }
    }
}