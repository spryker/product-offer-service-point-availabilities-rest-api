<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\ProductOfferServicePointAvailabilitiesRestApi\Processor\Mapper;

use Generated\Shared\Transfer\ProductOfferServicePointAvailabilityCriteriaTransfer;
use Generated\Shared\Transfer\RestProductOfferServicePointAvailabilitiesRequestAttributesTransfer;
use Generated\Shared\Transfer\RestProductOfferServicePointAvailabilitiesResponseAttributesCollectionTransfer;

interface ProductOfferServicePointAvailabilityMapperInterface
{
    public function mapRestProductOfferServicePointAvailabilitiesRequestAttributesTransferToProductOfferServicePointAvailabilityCriteriaTransfer(
        RestProductOfferServicePointAvailabilitiesRequestAttributesTransfer $restProductOfferServicePointAvailabilitiesRequestAttributesTransfer,
        ProductOfferServicePointAvailabilityCriteriaTransfer $productOfferServicePointAvailabilityCriteriaTransfer
    ): ProductOfferServicePointAvailabilityCriteriaTransfer;

    /**
     * @param array<string, list<\Generated\Shared\Transfer\ProductOfferServicePointAvailabilityResponseItemTransfer>> $productOfferServicePointAvailabilities
     * @param \Generated\Shared\Transfer\RestProductOfferServicePointAvailabilitiesResponseAttributesCollectionTransfer $restProductOfferServicePointAvailabilitiesResponseAttributesCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductOfferServicePointAvailabilitiesResponseAttributesCollectionTransfer
     */
    public function mapProductOfferServicePointAvailabilitiesToRestProductOfferServicePointAvailabilitiesResponseAttributesCollectionTransfer(
        array $productOfferServicePointAvailabilities,
        RestProductOfferServicePointAvailabilitiesResponseAttributesCollectionTransfer $restProductOfferServicePointAvailabilitiesResponseAttributesCollectionTransfer
    ): RestProductOfferServicePointAvailabilitiesResponseAttributesCollectionTransfer;
}
