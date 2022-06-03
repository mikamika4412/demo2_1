<?php

namespace AdvancedCoder\ProductTypes\Model\Resolver;

use AdvancedCoder\ProductTypes\Api\ProductTypesRepositoryInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class ProductTypesToProduct implements ResolverInterface
{
    private ProductRepositoryInterface $productRepository;
    private ProductTypesRepositoryInterface $productTypesRepository;

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param ProductTypesRepositoryInterface $productTypesRepository
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        ProductTypesRepositoryInterface $productTypesRepository
    ) {
        $this->productRepository = $productRepository;
        $this->productTypesRepository = $productTypesRepository;
    }

    /**
     * @param Field $field
     * @param ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array
     * @throws GraphQlInputException
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $productId = trim($args['productId']);
        $typeId = trim($args['typeId']);


        if (empty($productId) || empty($typeId)) {
            throw new GraphQlInputException(
                __('You must specify an productId and typeId.')
            );
        }

        try {
            $this->productTypesRepository->get($typeId);
            $product = $this->productRepository->getById($productId);
            $product->setCustomAttribute('product_type_id', $typeId);
            $this->productRepository->save($product);
            return [
                'success' => true,
                'error' => '',
            ];
        } catch (\Exception $exception) {
            return [
                'success' => false,
                'error' => $exception->getMessage(),
            ];
        }
    }
}
