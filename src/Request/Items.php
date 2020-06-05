<?php

namespace CodeWizz\Amazon\ProductAdvertising\Request;

use CodeWizz\Amazon\ProductAdvertising\Market;
use Amazon\ProductAdvertisingAPI\v1\ApiException;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\{
    Condition,
    GetItemsRequest,
    GetItemsResource,
    Item,
    Merchant,
    OfferCount,
    Properties
};

/**
 * @method self condition(Condition $condition)
 * @method self currencyOfPreference(string $currencyOfPreference)
 * @method self itemIdType(ItemIdType $itemIdType)
 * @method self languagesOfPreference(string[] $languagesOfPreference)
 * @method self marketplace(string $marketplace)
 * @method self merchant(Merchant $merchant)
 * @method self offerCount(OfferCount $offerCount)
 * @method self partnerTag(string $partnerTag)
 * @method self partnerType(string $partnerType)
 * @method self properties(Properties $properties)
 * @method self resources(GetItemsResource[] $resources)
 */
class Items extends BaseItems
{
    protected $request;

    public function __construct(Market $market, GetItemsRequest $request)
    {
        $this->request = $request;

        parent::__construct($market);
    }

    /**
     * @return GetItemsRequest
     */
    public function request(): GetItemsRequest
    {
        return $this->request;
    }

    /**
     * @param string[] $itemIds
     *
     * @return $this
     */
    public function itemIds(...$itemIds)
    {
        $this->request()->setItemIds($itemIds);

        return $this;
    }

    /**
     * @return Item[]|null
     * @throws ApiException
     */
    public function get()
    {
        $this->request->setResources(
            GetItemsResource::getAllowableEnumValues()
        );

        $response = $this->market->api()
            ->getItems($this->request)
            ->getItemsResult();

        return $response !== null ? $response->getItems() : null;
    }

    /**
     * @return Item|mixed|null
     * @throws ApiException
     */
    public function first()
    {
        if (($response = $this->get()) === null) {
            return null;
        }

        return $response[0];
    }
}
