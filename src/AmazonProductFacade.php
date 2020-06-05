<?php

namespace CodeWizz\Amazon\ProductAdvertising;

use CodeWizz\Amazon\ProductAdvertising\Request\{
    BrowseNodes,
    Items,
    SearchItems,
    Variations
};

use Illuminate\Support\Facades\Facade;

/**
 * @method static SearchItems search(string $keyword, string $market = null)
 * @method static Items items($itemIDs, string $market = null)
 * @method static Variations variations(string $asin, string $market = null)
 * @method static BrowseNodes browseNodes(string $browseNodeIds, string $market = null)
 *
 * @see AmazonProduct
 */
class AmazonProductFacade extends Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return AmazonProduct::class;
    }
}
