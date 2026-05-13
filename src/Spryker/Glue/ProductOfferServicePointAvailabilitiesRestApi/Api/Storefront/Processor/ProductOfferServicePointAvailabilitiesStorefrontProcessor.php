<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace Spryker\Glue\ProductOfferServicePointAvailabilitiesRestApi\Api\Storefront\Processor;

use ArrayObject;
use Generated\Api\Storefront\ProductOfferServicePointAvailabilitiesStorefrontResource;
use Generated\Shared\Transfer\ProductOfferServicePointAvailabilityConditionsTransfer;
use Generated\Shared\Transfer\ProductOfferServicePointAvailabilityCriteriaTransfer;
use Generated\Shared\Transfer\ProductOfferServicePointAvailabilityRequestItemTransfer;
use Spryker\ApiPlatform\State\Processor\AbstractStorefrontProcessor;
use Spryker\Glue\ProductOfferServicePointAvailabilitiesRestApi\Api\Storefront\Reader\ProductOfferServicePointAvailabilitiesReaderInterface;

class ProductOfferServicePointAvailabilitiesStorefrontProcessor extends AbstractStorefrontProcessor
{
    public function __construct(
        protected ProductOfferServicePointAvailabilitiesReaderInterface $productOfferServicePointAvailabilitiesReader,
    ) {
    }

    protected function processPost(mixed $data): ProductOfferServicePointAvailabilitiesStorefrontResource
    {
        $criteriaTransfer = $this->buildCriteriaTransfer($data);

        $data->productOfferServicePointAvailabilities = $this->productOfferServicePointAvailabilitiesReader
            ->getProductOfferServicePointAvailabilities($criteriaTransfer);

        return $data;
    }

    protected function buildCriteriaTransfer(
        ProductOfferServicePointAvailabilitiesStorefrontResource $resource,
    ): ProductOfferServicePointAvailabilityCriteriaTransfer {
        $conditionsTransfer = (new ProductOfferServicePointAvailabilityConditionsTransfer())
            ->fromArray($resource->toArray(), true)
            ->setProductOfferServicePointAvailabilityRequestItems(new ArrayObject());

        foreach ($resource->productOfferServicePointAvailabilityRequestItems ?? [] as $requestItem) {
            $conditionsTransfer->addProductOfferServicePointAvailabilityRequestItem(
                $this->buildRequestItemTransfer($requestItem, $resource->merchantReference ?? null),
            );
        }

        return (new ProductOfferServicePointAvailabilityCriteriaTransfer())
            ->setProductOfferServicePointAvailabilityConditions($conditionsTransfer);
    }

    /**
     * @param array<string, mixed> $requestItem
     */
    protected function buildRequestItemTransfer(
        array $requestItem,
        ?string $merchantReference,
    ): ProductOfferServicePointAvailabilityRequestItemTransfer {
        $transfer = (new ProductOfferServicePointAvailabilityRequestItemTransfer())
            ->setProductConcreteSku($requestItem['productConcreteSku'] ?? null)
            ->setProductOfferReference($requestItem['productOfferReference'] ?? null)
            ->setQuantity($requestItem['quantity'] ?? null);

        if (isset($requestItem['merchantReference'])) {
            $transfer->setMerchantReference($requestItem['merchantReference']);

            return $transfer;
        }

        if ($merchantReference !== null) {
            $transfer->setMerchantReference($merchantReference);
        }

        return $transfer;
    }
}
