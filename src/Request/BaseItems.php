<?php

namespace CodeWizz\Amazon\ProductAdvertising\Request;

use CodeWizz\Amazon\ProductAdvertising\Market;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\{
    GetBrowseNodesRequest,
    GetItemsRequest,
    GetVariationsRequest,
    SearchItemsRequest
};

use BadMethodCallException;

abstract class BaseItems implements Request
{
    protected $market;

    public function __construct(Market $market)
    {
        $this->market = $market;
    }

    /**
     * @return GetBrowseNodesRequest|GetItemsRequest|GetVariationsRequest|SearchItemsRequest
     */
    abstract public function request();

    /**
     * @param string $method
     * @param array $parameters
     * @return $this
     */
    public function __call(string $method, array $parameters)
    {
        $nativeMethod = $this->request()::setters()[$method] ?? null;

        if (! $nativeMethod) {
            throw new BadMethodCallException(
                'Call to undefined method ' . get_parent_class($this) . '::'.$method . '()'
            );
        }

        $this->request()->{$nativeMethod}(...$parameters);

        return $this;
    }
}
