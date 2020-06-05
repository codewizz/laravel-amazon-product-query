<?php

namespace CodeWizz\Amazon\ProductAdvertising;

use Amazon\ProductAdvertisingAPI\v1\Configuration;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\api\DefaultApi;
use Exception;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\{
    GetBrowseNodesRequest,
    GetItemsRequest,
    GetVariationsRequest,
    SearchItemsRequest,
    ItemIdType,
    PartnerType
};

use CodeWizz\Amazon\ProductAdvertising\Request\{
    BrowseNodes,
    Items,
    SearchItems,
    Variations
};

use GuzzleHttp;

class Market
{
    /**
     * Partner Tag assigned with instance.
     *
     * @var string
     */
    protected $partnerTag;

    /**
     * Native PAAPI handler
     *
     * @var DefaultApi
     */
    protected $api;

    /**
     * Market constructor.
     *
     * @param array $market
     * @param string $accessKey
     * @param string $secretKey
     * @param string $partnerTag
     */
    public function __construct(array $market, $accessKey, $secretKey, $partnerTag)
    {
        $this->api = new DefaultApi(
            new GuzzleHttp\Client,
            (new Configuration)
                ->setAccessKey($accessKey)
                ->setSecretKey($secretKey)
                ->setHost($market['host'])
                ->setRegion($market['region'])
        );

        $this->partnerTag = $partnerTag;
    }

    /**
     * Build products search query
     *
     * @param string|null $keywords
     * @return SearchItems
     */
    public function search(string $keywords = null): SearchItems
    {
        return new SearchItems($this, (new SearchItemsRequest)
            // pre-fill partner details
            ->setPartnerTag($this->partnerTag)
            ->setPartnerType(PartnerType::ASSOCIATES)
            // pre-set an additional parameters
            ->setKeywords($keywords)
        );
    }

    /**
     * Build products query.
     *
     * @param string|string[] $itemIds
     * @return Items
     */
    public function items(...$itemIds): Items
    {
        return new Items($this, (new GetItemsRequest)
            // pre-fill partner details
            ->setPartnerTag($this->partnerTag)
            ->setPartnerType(PartnerType::ASSOCIATES)
            // pre-set an additional parameters
            ->setItemIds($itemIds)
            ->setItemIdType(ItemIdType::ASIN)
        );
    }

    /**
     * Build variations of the product query.
     *
     * @param string $asin
     * @return Variations
     */
    public function variations(string $asin): Variations
    {
        return new Variations($this, (new GetVariationsRequest)
            // pre-fill partner details
            ->setPartnerTag($this->partnerTag)
            ->setPartnerType(PartnerType::ASSOCIATES)
            // pre-set an additional parameters
            ->setASIN($asin)
        );
    }

    /**
     * Build browse nodes query.
     *
     * @param string|string[] $browseNodeIds
     * @return BrowseNodes
     */
    public function browseNodes(...$browseNodeIds): BrowseNodes
    {
        return new BrowseNodes($this, (new GetBrowseNodesRequest)
            // pre-fill partner details
            ->setPartnerTag($this->partnerTag)
            ->setPartnerType(PartnerType::ASSOCIATES)
            // pre-set an additional parameters
            ->setBrowseNodeIds($browseNodeIds)
        );
    }

    /**
     * @return DefaultApi
     */
    public function api(): DefaultApi
    {
        return $this->api;
    }
}
