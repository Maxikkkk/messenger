<?php
declare(strict_types=1);
/**
 * @by ProfStep, inc. 11.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\Messages\Ui\DataProvider\Form;

use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Ui\DataProvider\ModifierPoolDataProvider;
use ProfStep\Messages\Api\Data\MessageInterface;
use ProfStep\Messages\Model\ResourceModel\Message\Collection;

/**
 * Message form DataProvider class.
 * @package ProfStep\Messages\Ui\DataProvider\Form
 */
class DataProvider extends ModifierPoolDataProvider
{
    /**
     * DataProvider constructor.
     *
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param Collection $collection
     * @param array $meta
     * @param array $data
     * @param PoolInterface|null $pool
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        Collection $collection,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    ) {
        $this->collection = $collection;

        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
    }

    /**
     * Method return data for messenger form.
     *
     * @return array
     */
    public function getData(): array
    {
        /** @var MessageInterface $item */
        $item = $this->collection->getFirstItem();

        if ($item->getId()) {
            $data[$item->getId()] = $item->toArray();
            return $data;
        }

        return parent::getData();
    }
}
