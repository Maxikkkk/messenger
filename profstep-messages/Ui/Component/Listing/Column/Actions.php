<?php
declare(strict_types=1);
/**
 * @by ProfStep, inc. 11.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\Messages\Ui\Component\Listing\Column;

use Magento\Backend\Model\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Column actions class.
 * @package ProfStep\Messages\Ui\Component\Listing\Column
 */
class Actions extends Column
{
    /**
     * Url backend model class.
     *
     * @var UrlInterface
     */
    private UrlInterface $urlBuilder;

    /**
     * Actions constructor.
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);

        $this->urlBuilder = $urlBuilder;
    }

    /**
     * Method which prepare data for actions column.
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $id = $item['id'];

                $item[$this->getData('name')]['edit'] = [
                    'href' => $this->urlBuilder->getUrl(
                        'messenger/index/actions',
                        [
                            'id' => $id
                        ]
                    ),
                    'label' => __('Edit'),
                    'hidden' => false,
                ];
                $item[$this->getData('name')]['delete'] = [
                    'href' => $this->urlBuilder->getUrl(
                        'messenger/actions/delete',
                        [
                            'id' => $id
                        ]
                    ),
                    'label' => __('Delete'),
                    'hidden' => false,
                ];
            }
        }

        return $dataSource;
    }
}
