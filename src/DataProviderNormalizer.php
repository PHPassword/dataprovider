<?php


namespace PHPassword\Component\DataProvider;

use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class DataProviderNormalizer implements NormalizerInterface, DenormalizerInterface, NormalizerAwareInterface, DenormalizerAwareInterface
{
    use NormalizerAwareTrait;
    use DenormalizerAwareTrait;

    /**
     * @inheritdoc
     */
    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof DataProviderInterface;
    }

    /**
     * @inheritdoc
     */
    public function supportsDenormalization($data, $type, $format = null): bool
    {
        $implementsInterface = false;
        try {
            $implementsInterface = (new \ReflectionClass($type))->implementsInterface(DataProviderInterface::class);
        }
        catch(\ReflectionException $e){}

        return $implementsInterface && is_array($data);
    }

    /**
     * @inheritdoc
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        try {
            /* @var DataProviderInterface $object */
            $object = (new \ReflectionClass($class))->newInstance();
            $object->fromArray($data);
        }
        catch(\ReflectionException $e){
            throw new InvalidArgumentException('', $e->getCode(), $e);
        }

        return $object;
    }

    /**
     * @inheritdoc
     */
    public function normalize($object, $format = null, array $context = array())
    {
        /* @var DataProviderInterface $object */
        return $this->normalizer->normalize($object->toArray());
    }
}