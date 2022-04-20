<?php
declare(strict_types=1);
/**
 * @by ProfStep, inc. 11.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\MessagesGraphQl\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use ProfStep\Messages\Api\MessageRepositoryInterface;
use ProfStep\MessagesGraphQl\Api\ProviderInterface;

/**
 * GetMessageResolver GraphQl class.
 * @package ProfStep\Messages\Model\Resolver
 */
class MessagesResolver implements ResolverInterface
{
    /**
     * Array of graphql providers.
     *
     * @var ProviderInterface[]
     */
    private array $providers;

    /**
     * MessagesResolver constructor.
     * @param ProviderInterface[] $providers
     */
    public function __construct(
        array $providers = []
    ) {
        $this->providers = $providers;
    }

    /**
     * Return GraphQl response.
     *
     * @param Field $field
     * @param $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ): array {
        $provider = $this->providers[$field->getName()];

        return $provider->process($args);
    }
}
