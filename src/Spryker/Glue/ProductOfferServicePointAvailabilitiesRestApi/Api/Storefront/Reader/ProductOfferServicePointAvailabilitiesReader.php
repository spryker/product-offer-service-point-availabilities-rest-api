<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace Spryker\Glue\ProductOfferServicePointAvailabilitiesRestApi\Api\Storefront\Reader;

use Generated\Shared\Transfer\ProductOfferServicePointAvailabilityCriteriaTransfer;
use Spryker\Client\ProductOfferServicePointAvailabilityCalculatorStorage\ProductOfferServicePointAvailabilityCalculatorStorageClientInterface;

class ProductOfferServicePointAvailabilitiesReader implements ProductOfferServicePointAvailabilitiesReaderInterface
{
    public function __construct(
        protected ProductOfferServicePointAvailabilityCalculatorStorageClientInterface $productOfferServicePointAvailabilityCalculatorStorageClient,
    ) {
    }

    /**
     * {@inheritDoc}
     *
     * @return list<array<string, mixed>>
     */
    public function getProductOfferServicePointAvailabilities(
        ProductOfferServicePointAvailabilityCriteriaTransfer $criteriaTransfer,
    ): array {
        $availabilitiesByServicePointUuid = $this->productOfferServicePointAvailabilityCalculatorStorageClient
            ->calculateProductOfferServicePointAvailabilities($criteriaTransfer);

        return $this->buildResponseGroups($availabilitiesByServicePointUuid);
    }

    /**
     * @param array<string, list<\Generated\Shared\Transfer\ProductOfferServicePointAvailabilityResponseItemTransfer>> $availabilitiesByServicePointUuid
     *
     * @return list<array<string, mixed>>
     */
    protected function buildResponseGroups(array $availabilitiesByServicePointUuid): array
    {
        $groups = [];

        foreach ($availabilitiesByServicePointUuid as $servicePointUuid => $responseItemTransfers) {
            $groups[] = [
                'servicePointUuid' => $servicePointUuid,
                'productOfferServicePointAvailabilityResponseItems' => $this->buildResponseItems($responseItemTransfers),
            ];
        }

        return $groups;
    }

    /**
     * @param list<\Generated\Shared\Transfer\ProductOfferServicePointAvailabilityResponseItemTransfer> $responseItemTransfers
     *
     * @return list<array<string, mixed>>
     */
    protected function buildResponseItems(array $responseItemTransfers): array
    {
        $items = [];

        foreach ($responseItemTransfers as $responseItemTransfer) {
            $items[] = [
                'productOfferReference' => $responseItemTransfer->getProductOfferReference(),
                'productConcreteSku' => $responseItemTransfer->getProductConcreteSku(),
                'availableQuantity' => $responseItemTransfer->getAvailableQuantity(),
                'isAvailable' => $responseItemTransfer->getIsAvailable(),
                'isNeverOutOfStock' => $responseItemTransfer->getIsNeverOutOfStock(),
                'identifier' => $responseItemTransfer->getIdentifier(),
            ];
        }

        return $items;
    }
}
