<?php

namespace Pixafy\Subscription\Api\Data;

interface SubscriptionStagingDetailsInterface
{
    /**
     * String constants for property names
     */
    const ID = "subscription_staging_details_id";
    const SUBSCRIPTION_STAGING_ID = "subscription_staging_id";
    const FIELD_NAME = "field_name";
    const OLD_VALUE = "old_value";
    const NEW_VALUE = "new_value";
    const NOTES = "notes";

    /**
     * Getter for subscription_staging_details_id.
     *
     * @return int|null
     */
    public function getSubscriptionStagingDetailsId() : ?int;

    /**
     * Setter for subscription_staging_details_id.
     *
     * @param int|null $subscription_staging_details_id
     *
     * @return void
     */
    public function setSubscriptionStagingDetailsId(?int $subscription_staging_details_id) : void;

    /**
     * Getter for subscription_staging_id.
     *
     * @return int|null
     */
    public function getSubscriptionStagingId() : ?int;

    /**
     * Setter for subscription_staging_id.
     *
     * @param int|null $subscription_staging_id
     *
     * @return void
     */
    public function setSubscriptionStagingId(?int $subscription_staging_id) : void;


    /**
     * Getter for subscription_staging_id.
     *
     * @return int|null
     */
    public function getProductId() : ?int;

    /**
     * Setter for subscription_staging_id.
     *
     * @param int|null $productId
     *
     * @return void
     */
    public function setProductId(?int $productId) : void;


    /**
     * Getter for field_name.
     *
     * @return string|null
     */
    public function getFieldName() : ?string;

    /**
     * Setter for field_name.
     *
     * @param string|null $field_name
     *
     * @return void
     */
    public function setFieldName(?string $field_name) : void;

    /**
     * Getter for old_value.
     *
     * @return string|null
     */
    public function getOldValue() : ?string;

    /**
     * Setter for old_value.
     *
     * @param string|null $old_value
     *
     * @return void
     */
    public function setOldValue(?string $old_value) : void;

    /**
     * Getter for new_value.
     *
     * @return string|null
     */
    public function getNewValue() : ?string;

    /**
     * Setter for new_value.
     *
     * @param string|null $new_value
     *
     * @return void
     */
    public function setNewValue(?string $new_value) : void;

    /**
     * Getter for notes.
     *
     * @return string|null
     */
    public function getNotes() : ?string;

    /**
     * Setter for notes.
     *
     * @param string|null $notes
     *
     * @return void
     */
    public function setNotes(?string $notes) : void;

}
