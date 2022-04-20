<?php

declare(strict_types=1);
/**
 * @by ProfStep, inc. 16.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\MessagesGraphQl\Model\Resolver\DataProviders;


use Magento\Framework\Api\Filter;
use Magento\Framework\Api\FilterFactory;
use Magento\Framework\Api\Search\FilterGroupFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaBuilderFactory;
use ProfStep\Messages\Api\MessageRepositoryInterface;
use ProfStep\MessagesGraphQl\Api\ProviderInterface;

/**
 * GetMessagesProvider class.
 * @package ProfStep\MessagesGraphQl\Model\Resolver\DataProviders
 */
class GetMessagesListProvider implements ProviderInterface
{
    /**
     * Messages repository class.
     *
     * @var MessageRepositoryInterface
     */
    private MessageRepositoryInterface $messageRepository;

    /**
     * Search criteria builder class.
     *
     * @var SearchCriteriaBuilderFactory
     */
    private SearchCriteriaBuilderFactory $searchCriteriaBuilder;

    /**
     * Filter group class.
     *
     * @var FilterGroupFactory
     */
    private FilterGroupFactory $filterGroup;

    /**
     * Filter class.
     *
     * @var FilterFactory
     */
    private FilterFactory $filter;

    /**
     * GetMessagesListProvider constructor.
     * @param MessageRepositoryInterface $messageRepository
     * @param SearchCriteriaBuilderFactory $searchCriteriaBuilder
     * @param FilterGroupFactory $filterGroup
     * @param FilterFactory $filter
     */
    public function __construct(
        MessageRepositoryInterface $messageRepository,
        SearchCriteriaBuilderFactory $searchCriteriaBuilder,
        FilterGroupFactory $filterGroup,
        FilterFactory $filter
    ) {
        $this->messageRepository = $messageRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterGroup = $filterGroup;
        $this->filter = $filter;
    }

    /**
     * Generate filter for search criteria.
     *
     * @param array $data
     * @return Filter
     */
    public function generateFilter(array $data): Filter
    {
        /** @var Filter $filter */
        $filter = $this->filter->create();
        $filter->setField($data['field'])
            ->setValue($data['value'])
            ->setConditionType($data['condition_type']);

        return $filter;
    }

    /**
     * Method process a request and return result
     *
     * @param array $data
     *
     * @return array
     */
    public function process(array $data)
    {
        $searchBuilder = $this->searchCriteriaBuilder->create();

        foreach($data['filter_groups'] as $filterGroupData) {
            $filters = [];

            foreach($filterGroupData['filters'] as $filterData) {
                $filters[] = $this->generateFilter($filterData);
            }
            $searchBuilder->addFilters($filters);
        }

        $searchBuilder->setCurrentPage(
            isset($data['currentPage']) ? $data['currentPage'] : 1
        );
        $searchBuilder->setPageSize(
            isset($data['pageSize']) ? $data['pageSize'] : 20
        );

        $result = $this->messageRepository->getList($searchBuilder->create());

        return $result->getItems();
    }

}
