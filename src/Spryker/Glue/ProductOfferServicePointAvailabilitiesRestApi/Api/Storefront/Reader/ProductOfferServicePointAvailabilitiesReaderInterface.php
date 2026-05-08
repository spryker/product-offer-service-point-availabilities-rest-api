<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace Spryker\Glue\ProductOfferServicePointAvailabilitiesRestApi\Api\Storefront\Reader;

use Generated\Shared\Transfer\ProductOfferServicePointAvailabilityCriteriaTransfer;

interface ProductOfferServicePointAvailabilitiesReaderInterface
{
    /**
     * Loads product offer service point availabilities for the given criteria
     * and returns the response payload grouped by service point UUID, ready
     * to be assigned to the resource's `productOfferServicePointAvailabilities` property.
     *
     * @return list<array<string, mixed>>
     */
    public function getProductOfferServicePointAvailabilities(
        ProductOfferServicePointAvailabilityCriteriaTransfer $criteriaTransfer,
    ): array;
}
