<?php

namespace Pixafy\Subscription\Api\Data;

interface SubscriptionOrderScheduleInterface
{
    /**
     * String constants for property names
     */
    const ID = "schedule_id";
    const SUBSCRIPTION_ID = "subscription_id";
    const IS_VALID = "is_valid";
    const IS_POSTED = "is_posted";
    const EXPECTED_DELIVERY_DATE = "expected_delivery_date";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";

    /**
     * Getter for schedule_id.
     *
     * @return int|null
     */
    public function getScheduleId() : ?int;

    /**
     * Setter for schedule_id.
     *
     * @param int|null $schedule_id
     *
     * @return void
     */
    public function setScheduleId(?int $schedule_id) : void;


    /**
     * Getter for subscription_id.
     *
     * @return int|null
     */
    public function getSubscriptionId() : ?int;

    /**
     * Setter for subscription_id.
     *
     * @param int|null $subscription_id
     *
     * @return void
     */
    public function setSubscriptionId(?int $subscription_id) : void;

    /**
     * Getter for is_valid.
     *
     * @return int|null
     */
    public function getIsValid() : ?int;

    /**
     * Setter for is_valid.
     *
     * @param int|null $is_valid
     *
     * @return void
     */
    public function setIsValid(?int $is_valid) : void;

    /**
     * Getter for is_posted.
     *
     * @return int|null
     */
    public function getIsPosted() : ?int;

    /**
     * Setter for is_posted.
     *
     * @param int|null $is_posted
     *
     * @return void
     */
    public function setIsPosted(?int $is_posted) : void;

    /**
     * Getter for expected_delivery_date.
     *
     * @return string
     */
    public function getExpectedDeliveryDate() : ?string;

    /**
     * Setter for expected_delivery_date.
     *
     * @param string|null $expected_delivery_date
     *
     * @return void
     */
    public function setExpectedDeliveryDate(?string $expected_delivery_date) : void;

    /**
     * Getter for created_at.
     *
     * @return string
     */
    public function getCreatedAt() : ?string;

    /**
     * Setter for created_at.
     *
     * @param string|null $created_at
     *
     * @return void
     */
    public function setCreatedAt(?string $created_at) : void;

    /**
     * Getter for created_at.
     *
     * @return string
     */
    public function getUpdatedAt() : ?string;

    /**
     * Setter for updated_at.
     *
     * @param string|null $updated_at
     *
     * @return void
     */
    public function setUpdatedAt(?string $updated_at) : void;

}
