<?php
declare(strict_types=1);
/**
 * @by ProfStep, inc. 16.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\MessagesGraphQl\Api;

/**
 * ProviderInterface for which must implement all DataProviders
 * @package ProfStep\MessagesGraphQl\Api
 */
interface ProviderInterface
{
    /**
     * Method process a request and return result
     *
     * @param array $data
     *
     * @return array
     */
    public function process(array $data);
}
