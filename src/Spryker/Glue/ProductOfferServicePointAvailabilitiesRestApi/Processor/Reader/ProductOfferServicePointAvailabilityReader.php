<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\ProductOfferServicePointAvailabilitiesRestApi\Processor\Reader;

use Generated\Shared\Transfer\ProductOfferServicePointAvailabilityCriteriaTransfer;
use Generated\Shared\Transfer\RestProductOfferServicePointAvailabilitiesRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\ProductOfferServicePointAvailabilitiesRestApi\Dependency\Client\ProductOfferServicePointAvailabilitiesRestApiToProductOfferServicePointAvailabilityCalculatorStorageClientInterface;
use Spryker\Glue\ProductOfferServicePointAvailabilitiesRestApi\Processor\Builder\ProductOfferServicePointAvailabilityResponseBuilderInterface;
use Spryker\Glue\ProductOfferServicePointAvailabilitiesRestApi\Processor\Mapper\ProductOfferServicePointAvailabilityMapperInterface;

class ProductOfferServicePointAvailabilityReader implements ProductOfferServicePointAvailabilityReaderInterface
{
    /**
     * @var \Spryker\Glue\ProductOfferServicePointAvailabilitiesRestApi\Processor\Mapper\ProductOfferServicePointAvailabilityMapperInterface
     */
    protected ProductOfferServicePointAvailabilityMapperInterface $productOfferServicePointAvailabilityMapper;

    /**
     * @var \Spryker\Glue\ProductOfferServicePointAvailabilitiesRestApi\Dependency\Client\ProductOfferServicePointAvailabilitiesRestApiToProductOfferServicePointAvailabilityCalculatorStorageClientInterface
     */
    protected ProductOfferServicePointAvailabilitiesRestApiToProductOfferServicePointAvailabilityCalculatorStorageClientInterface $productOfferServicePointAvailabilityCalculatorStorageClient;

    /**
     * @var \Spryker\Glue\ProductOfferServicePointAvailabilitiesRestApi\Processor\Builder\ProductOfferServicePointAvailabilityResponseBuilderInterface
     */
    protected ProductOfferServicePointAvailabilityResponseBuilderInterface $productOfferServicePointAvailabilityResponseBuilder;

    /**
     * @param \Spryker\Glue\ProductOfferServicePointAvailabilitiesRestApi\Processor\Mapper\ProductOfferServicePointAvailabilityMapperInterface $productOfferServicePointAvailabilityMapper
     * @param \Spryker\Glue\ProductOfferServicePointAvailabilitiesRestApi\Dependency\Client\ProductOfferServicePointAvailabilitiesRestApiToProductOfferServicePointAvailabilityCalculatorStorageClientInterface $productOfferServicePointAvailabilityCalculatorStorageClient
     * @param \Spryker\Glue\ProductOfferServicePointAvailabilitiesRestApi\Processor\Builder\ProductOfferServicePointAvailabilityResponseBuilderInterface $productOfferServicePointAvailabilityResponseBuilder
     */
    public function __construct(
        ProductOfferServicePointAvailabilityMapperInterface $productOfferServicePointAvailabilityMapper,
        ProductOfferServicePointAvailabilitiesRestApiToProductOfferServicePointAvailabilityCalculatorStorageClientInterface $productOfferServicePointAvailabilityCalculatorStorageClient,
        ProductOfferServicePointAvailabilityResponseBuilderInterface $productOfferServicePointAvailabilityResponseBuilder
    ) {
        $this->productOfferServicePointAvailabilityMapper = $productOfferServicePointAvailabilityMapper;
        $this->productOfferServicePointAvailabilityCalculatorStorageClient = $productOfferServicePointAvailabilityCalculatorStorageClient;
        $this->productOfferServicePointAvailabilityResponseBuilder = $productOfferServicePointAvailabilityResponseBuilder;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestProductOfferServicePointAvailabilitiesRequestAttributesTransfer $restProductOfferServicePointAvailabilitiesRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getProductOfferServicePointAvailabilities(
        RestRequestInterface $restRequest,
        RestProductOfferServicePointAvailabilitiesRequestAttributesTransfer $restProductOfferServicePointAvailabilitiesRequestAttributesTransfer
    ): RestResponseInterface {
        $productOfferServicePointAvailabilityCriteriaTransfer = $this->productOfferServicePointAvailabilityMapper
            ->mapRestProductOfferServicePointAvailabilitiesRequestAttributesTransferToProductOfferServicePointAvailabilityCriteriaTransfer(
                $restProductOfferServicePointAvailabilitiesRequestAttributesTransfer,
                (new ProductOfferServicePointAvailabilityCriteriaTransfer()),
            );

        $productOfferServicePointAvailabilities = $this->productOfferServicePointAvailabilityCalculatorStorageClient
            ->calculateProductOfferServicePointAvailabilities(
                $productOfferServicePointAvailabilityCriteriaTransfer,
            );

        return $this->productOfferServicePointAvailabilityResponseBuilder
            ->createProductOfferServicePointAvailabilityCollectionRestResponse($productOfferServicePointAvailabilities);
    }
}
