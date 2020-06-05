<?php

namespace CodeWizz\Amazon\ProductAdvertising\Request;

use CodeWizz\Amazon\ProductAdvertising\Market;
use Amazon\ProductAdvertisingAPI\v1\ApiException;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\{
    Condition,
    GetVariationsRequest,
    GetVariationsResource,
    Item,
    Merchant,
    OfferCount,
    Properties
};

/**
 * @method self condition(Condition $condition)
 * @method self currencyOfPreference(string $currencyOfPreference)
 * @method self languagesOfPreference(string[] $languagesOfPreference)
 * @method self marketplace(string $marketplace)
 * @method self merchant(Merchant $merchant)
 * @method self offerCount(OfferCount $offerCount)
 * @method self partnerTag(string $partnerTag)
 * @method self partnerType(string $partnerType)
 * @method self properties(Properties $properties)
 * @method self resources(GetVariationsResource[] $resources)
 * @method self variationCount(int $variationCount)
 * @method self variationPage(int $variationPage)
 */
class Variations extends BaseItems
{
    protected $request;

    public function __construct(Market $market, GetVariationsRequest $request)
    {
        $this->request = $request;

        parent::__construct($market);
    }

    /**
     * @return GetVariationsRequest
     */
    public function request(): GetVariationsRequest
    {
        return $this->request;
    }

    /**
     * @param string $asin
     * @return $this
     */
    public function asin(string $asin)
    {
        $this->request()->setASIN($asin);

        return $this;
    }

    /**
     * Alias to variationCount.
     *
     * @param int $value
     * @return $this
     */
    public function limit(int $value)
    {
        $this->request()->setVariationCount($value);

        return $this;
    }

    /**
     * @return Item[]|null
     * @throws ApiException
     */
    public function get()
    {
        $this->request->setResources(
            GetVariationsResource::getAllowableEnumValues()
        );

        $response = $this->market->api()
            ->getVariations($this->request)
            ->getVariationsResult();

        return $response !== null ? $response->getItems() : null;
    }

    /**
     * @return Item|mixed|null
     * @throws ApiException
     */
    public function first()
    {
        if (($response = $this->limit(1)->get()) === null) {
            return null;
        }

        return $response[0];
    }
}
