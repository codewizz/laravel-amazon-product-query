<?php

namespace CodeWizz\Amazon\ProductAdvertising\Request;

use CodeWizz\Amazon\ProductAdvertising\Market;
use Amazon\ProductAdvertisingAPI\v1\ApiException;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\{
    Availability,
    Condition,
    DeliveryFlag,
    Item,
    MaxPrice,
    Merchant,
    MinPrice,
    MinReviewsRating,
    MinSavingPercent,
    OfferCount,
    Properties,
    SearchItemsRequest,
    SearchItemsResource,
    SortBy
};

/**
 * @method self actor(string $actor)
 * @method self artist(string $artist)
 * @method self author(string $author)
 * @method self availability(Availability $availability)
 * @method self brand(string $brand)
 * @method self browseNodeId(string $browseNodeId)
 * @method self condition(Condition $condition)
 * @method self currencyOfPreference(string $currencyOfPreference)
 * @method self deliveryFlags(DeliveryFlag[] $deliveryFlags)
 * @method self itemCount(int $itemCount)
 * @method self itemPage(int $itemPage)
 * @method self keywords(string $keywords)
 * @method self languagesOfPreference(string[] $languagesOfPreference)
 * @method self marketplace(string $marketplace)
 * @method self maxPrice(MaxPrice $maxPrice)
 * @method self merchant(Merchant $merchant)
 * @method self minPrice(MinPrice $minPrice)
 * @method self minReviewsRating(MinReviewsRating $minReviewsRating)
 * @method self minSavingPercent(MinSavingPercent $minSavingPercent)
 * @method self offerCount(OfferCount $offerCount)
 * @method self partnerTag(string $partnerTag)
 * @method self partnerType(string $partnerType)
 * @method self properties(Properties $properties)
 * @method self resources(SearchItemsResource[] $resources)
 * @method self searchIndex(string $searchIndex)
 * @method self sortBy(SortBy $sortBy)
 * @method self title(string $title)
 */
class SearchItems extends BaseItems
{
    protected $request;

    public function __construct(Market $market, SearchItemsRequest $request)
    {
        $this->request = $request;

        parent::__construct($market);
    }

    /**
     * @return SearchItemsRequest
     */
    public function request(): SearchItemsRequest
    {
        return $this->request;
    }

    /**
     * Alias to itemCount
     *
     * @param int $value
     * @return $this
     */
    public function limit(int $value)
    {
        $this->request()->setItemCount($value);

        return $this;
    }

    /**
     * @return Item[]|null
     * @throws ApiException
     */
    public function get()
    {
        $this->request->setResources(
            SearchItemsResource::getAllowableEnumValues()
        );

        $response = $this->market->api()
            ->searchItems($this->request)
            ->getSearchResult();

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
