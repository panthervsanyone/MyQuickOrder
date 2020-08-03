<?php

namespace ALevel\MyQuickOrder\Repository;

use ALevel\MyQuickOrder\Api\Model\StatusInterface;
use ALevel\MyQuickOrder\Api\Repository\StatusRepositoryInterface;
use ALevel\MyQuickOrder\Model\ResourceModel\Status as ResourceModel;
use ALevel\MyQuickOrder\Model\ResourceModel\Status\Collection;
use ALevel\MyQuickOrder\Model\ResourceModel\Status\CollectionFactory;
use ALevel\MyQuickOrder\Model\StatusFactory as ModelFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class StatusRepository implements StatusRepositoryInterface
{
    /**
     * @var ResourceModel
     */
    private $resource;

    /**
     * @var ModelFactory
     */
    private $modelFactory;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $processor;

    /**
     * @var SearchResultsInterfaceFactory
     */
    private $searchResultFactory;

    public function __construct(
        ResourceModel $resource,
        ModelFactory $modeFactory,
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        SearchResultsInterfaceFactory $searchResultFactory
    ) {
        $this->resource             = $resource;
        $this->modelFactory         = $modeFactory;
        $this->collectionFactory    = $collectionFactory;
        $this->processor            = $collectionProcessor;
        $this->searchResultFactory  = $searchResultFactory;
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id): StatusInterface
    {
        $order = $this->modelFactory->create();

        $this->resource->load($order, $id);

        if (empty($order->getId())) {
            throw new NoSuchEntityException(__("Status %1 not found", $id));
        }

        return $order;
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultsInterface
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();

        $this->processor->process($searchCriteria, $collection);

        /** @var SearchResultsInterface $searchResult */
        $searchResult = $this->searchResultFactory->create();

        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setItems($collection->getItems());

        return $searchResult;
    }

    /**
     * @inheritDoc
     */
    public function save(StatusInterface $status): StatusInterface
    {
        try {
            $this->resource->save($status);
        } catch (\Exception $e) {
            // added logger
            throw new CouldNotSaveException(__("Status could not save"));
        }

        return $status;
    }

    /**
     * @inheritDoc
     */
    public function delete(StatusInterface $status): StatusRepositoryInterface
    {
        try {
            $this->resource->delete($status);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException("Order not delete");
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function deleteById(int $id): StatusRepositoryInterface
    {
        $status = $this->getById($id);
        $this->delete($status);
        return $this;
    }
}
