<?php

namespace CodeWizz\Amazon\ProductAdvertising;

use CodeWizz\Amazon\ProductAdvertising\Request\{
    BrowseNodes,
    Items,
    SearchItems,
    Variations
};

use Exception;

class AmazonProduct
{
    const AVAILABLE_MARKETS = [
        'au' => ['host' => 'webservices.amazon.com.au', 'region' => 'us-west-2'],
        'ae' => ['host' => 'webservices.amazon.ae', 'region' => 'eu-west-1'],
        'br' => ['host' => 'webservices.amazon.com.br', 'region' => 'us-east-1'],
        'ca' => ['host' => 'webservices.amazon.ca', 'region' => 'us-east-1'],
        'de' => ['host' => 'webservices.amazon.de', 'region' => 'eu-west-1'],
        'es' => ['host' => 'webservices.amazon.es', 'region' => 'eu-west-1'],
        'fr' => ['host' => 'webservices.amazon.fr', 'region' => 'eu-west-1'],
        'in' => ['host' => 'webservices.amazon.in', 'region' => 'eu-west-1'],
        'it' => ['host' => 'webservices.amazon.it', 'region' => 'eu-west-1'],
        'jp' => ['host' => 'webservices.amazon.co.jp', 'region' => 'us-west-2'],
        'mx' => ['host' => 'webservices.amazon.mx', 'region' => 'us-east-1'],
        'nl' => ['host' => 'webservices.amazon.nl', 'region' => 'eu-west-1'],
        'sg' => ['host' => 'webservices.amazon.sg', 'region' => 'us-west-2'],
        'tr' => ['host' => 'webservices.amazon.com.tr', 'region' => 'eu-west-1'],
        'uk' => ['host' => 'webservices.amazon.co.uk', 'region' => 'eu-west-1'],
        'us' => ['host' => 'webservices.amazon.com', 'region' => 'us-east-1']
    ];

    /**
     * Cached marketplace instances.
     *
     * @var array
     */
    protected $markets = [];

    /**
     * Default Amazon market.
     *
     * @var string
     */
    protected $defaultMarket;

    /**
     * AmazonProduct constructor.
     */
    public function __construct()
    {
        $this->defaultMarket = config('amazon-product.default_market', 'us');
    }

    /**
     * @param string|null $marketId
     * @return Market
     *
     * @throws Exception
     */
    public function market($marketId = null)
    {
        $marketId = strtolower($marketId ?: $this->defaultMarket);

        if (! isset(self::AVAILABLE_MARKETS[$marketId])) {
            throw new Exception("Marketplace [{$marketId}] is not supported.");
        }

        if (! isset($this->markets[$marketId])) {
            $this->markets[$marketId] = new Market(
                self::AVAILABLE_MARKETS[$marketId],
                config('amazon-product.api_key'),
                config('amazon-product.api_secret_key'),
                config("amazon-product.associate_tags.{$marketId}")
            );
        }

        return $this->markets[$marketId];
    }

    /**
     * 	Searches for items on Amazon based on keywords
     *
     * @param string $keyword
     * @param string|null $market
     * @return SearchItems
     *
     * @throws Exception
     */
    public function search(string $keyword, string $market = null): SearchItems
    {
        return $this->market($market)->search($keyword);
    }

    /**
     * 	Provides item attributes, offer listings, images, and other details for a given item
     *
     * @param string|string[] $itemIDs
     * @param string|null $market
     * @return Items
     *
     * @throws Exception
     */
    public function items($itemIDs, string $market = null): Items
    {
        return $this->market($market)->items($itemIDs);
    }

    /**
     * Returns variations for an item i.e. a set of items that are the same product, but differ according to a consistent theme, for example size and color
     *
     * @param string $asin
     * @param string|null $market
     * @return Variations
     *
     * @throws Exception
     */
    public function variations(string $asin, string $market = null): Variations
    {
        return $this->market($market)->variations($asin);
    }

    /**
     * Lookup information for a Browse Node
     *
     * @param string|string[] $browseNodeIds
     * @param string|null $market
     * @return BrowseNodes
     *
     * @throws Exception
     */
    public function browseNodes($browseNodeIds, string $market = null): BrowseNodes
    {
        return $this->market($market)->browseNodes($browseNodeIds);
    }
}
