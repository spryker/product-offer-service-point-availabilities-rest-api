<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\ProductOfferServicePointAvailabilitiesRestApi\Dependency\Client;

use Generated\Shared\Transfer\ProductOfferServicePointAvailabilityCriteriaTransfer;

interface ProductOfferServicePointAvailabilitiesRestApiToProductOfferServicePointAvailabilityCalculatorStorageClientInterface
{
    /**
     * @return array<string, list<\Generated\Shared\Transfer\ProductOfferServicePointAvailabilityResponseItemTransfer>>
     */
    public function calculateProductOfferServicePointAvailabilities(
        ProductOfferServicePointAvailabilityCriteriaTransfer $productOfferServicePointAvailabilityCriteriaTransfer
    ): array;
}
