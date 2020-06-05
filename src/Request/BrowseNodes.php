<?php

namespace CodeWizz\Amazon\ProductAdvertising\Request;

use CodeWizz\Amazon\ProductAdvertising\Market;
use Amazon\ProductAdvertisingAPI\v1\ApiException;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\{
    BrowseNode,
    GetBrowseNodesRequest,
    GetBrowseNodesResource
};

/**
 * @method self languagesOfPreference(string[] $languagesOfPreference)
 * @method self marketplace(string $marketplace)
 * @method self partnerTag(string $partnerTag)
 * @method self partnerType(string $partnerType)
 * @method self resources(GetBrowseNodesResource[] $resources)
 */
class BrowseNodes extends BaseItems
{
    protected $request;

    public function __construct(Market $market, GetBrowseNodesRequest $request)
    {
        $this->request = $request;

        parent::__construct($market);
    }

    /**
     * @return GetBrowseNodesRequest
     */
    public function request(): GetBrowseNodesRequest
    {
        return $this->request;
    }

    /**
     * @param string[] $browseNodeIds
     *
     * @return $this
     */
    public function browseNodeIds(...$browseNodeIds)
    {
        $this->request()->setBrowseNodeIds($browseNodeIds);

        return $this;
    }

    /**
     * @return BrowseNode[]|null
     * @throws ApiException
     */
    public function get()
    {
        $this->request->setResources(
            GetBrowseNodesResource::getAllowableEnumValues()
        );

        $response = $this->market->api()
            ->getBrowseNodes($this->request)
            ->getBrowseNodesResult();

        return $response !== null ? $response->getBrowseNodes() : null;
    }

    /**
     * @return BrowseNode|mixed|null
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
