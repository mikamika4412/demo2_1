<?php

namespace AdvancedCoder\ProductTypes\Api;

use AdvancedCoder\ProductTypes\Api\Data\ProductTypesInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface ProductTypesRepositoryInterface
{
    /**
     * @param int $id
     * @return ProductTypesInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get(int $id): ProductTypesInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return ProductTypesSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null): ProductTypesSearchResultInterface;

    /**
     * @param ProductTypesInterface $productTypes
     * @return ProductTypesInterface
     */
    public function save(ProductTypesInterface $productTypes): ProductTypesInterface;

    /**
     * @param ProductTypesInterface $workingHours
     * @return bool
     */
    public function delete(ProductTypesInterface $workingHours): bool;

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool;
}
