<?php

namespace AdvancedCoder\ProductTypes\Model;

use AdvancedCoder\ProductTypes\Api\Data\ProductTypesInterface;
use AdvancedCoder\ProductTypes\Api\ProductTypesRepositoryInterface;
use AdvancedCoder\ProductTypes\Api\ProductTypesSearchResultInterface;
use AdvancedCoder\ProductTypes\Model\ResourceModel\ProductTypes\CollectionFactory;
use AdvancedCoder\ProductTypes\Model\ResourceModel\ProductTypes as ProductTypesResource;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteriaInterface;
use AdvancedCoder\ProductTypes\Api\ProductTypesSearchResultInterfaceFactory;
use AdvancedCoder\ProductTypes\Model\ProductTypesFactory;

class ProductTypesRepository implements ProductTypesRepositoryInterface
{
    private CollectionFactory $collectionFactory;
    private ProductTypesResource $productTypesResource;
    private ProductTypesFactory $productTypesFactory;
    private ProductTypesSearchResultInterfaceFactory $searchResultInterfaceFactory;
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    /**
     * @param ProductTypesFactory $productTypesFactory
     * @param CollectionFactory $collectionFactory
     * @param ProductTypesResource $productTypesResource
     * @param ProductTypesSearchResultInterfaceFactory $searchResultInterfaceFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        ProductTypesFactory $productTypesFactory,
        CollectionFactory $collectionFactory,
        ProductTypesResource  $productTypesResource,
        ProductTypesSearchResultInterfaceFactory $searchResultInterfaceFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->productTypesFactory = $productTypesFactory;
        $this->collectionFactory = $collectionFactory;
        $this->productTypesResource = $productTypesResource;
        $this->searchResultFactory = $searchResultInterfaceFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @param int $id
     * @return ProductTypesInterface
     * @throws NoSuchEntityException
     */
    public function get(int $id): ProductTypesInterface
    {
        $object = $this->productTypesFactory->create();
        $this->productTypesResource->load($object, $id);
        if (! $object->getId()) {
            throw new NoSuchEntityException(__('Unable to find entity with ID "%1"', $id));
        }
        return $object;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return ProductTypesSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null): ProductTypesSearchResultInterface
    {
        $collection = $this->collectionFactory->create();
        $searchCriteria = $this->searchCriteriaBuilder->create();

        if (null === $searchCriteria) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
        } else {
            foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
                foreach ($filterGroup->getFilters() as $filter) {
                    $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                    $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
                }
            }
        }

        $searchResult = $this->searchResultFactory->create();
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);
        return $searchResult;
    }

    /**
     * @param ProductTypesInterface $productTypes
     * @return ProductTypesInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(ProductTypesInterface $productTypes): ProductTypesInterface
    {
        $this->productTypesResource->save($productTypes);
        return $productTypes;
    }

    /**
     * @param ProductTypesInterface $workingHours
     * @return bool
     */
    public function delete(ProductTypesInterface $workingHours): bool
    {
        try {
            $this->productTypesResource->delete($workingHours);
        } catch (\Exception $e) {
            throw new StateException(__('Unable to remove entity #%1', $workingHours->getId()));
        }
        return true;
    }

    /**
     * @param int $id
     * @return bool
     * @throws NoSuchEntityException
     */
    public function deleteById(int $id): bool
    {
        return $this->delete($this->get($id));
    }

}
