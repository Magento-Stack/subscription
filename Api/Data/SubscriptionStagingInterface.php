<?php

namespace Pixafy\Subscription\Api\Data;

interface SubscriptionStagingInterface
{
    /**
     * String constants for property names
     */
    const ID = "subscription_staging_id";
    const SUBSCRIPTION_ID = "subscription_id";
    const DATE_CREATED = "date_created";
    const DATE_SCHEDULED = "date_scheduled";
    const IS_APPROVED = "is_approved";
    const IS_EXECUTED = "is_executed";
    const USER_ID = "user_id";

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
     * Getter for date_created.
     *
     * @return string|null
     */
    public function getDateCreated() : ?string;

    /**
     * Setter for date_created.
     *
     * @param string|null $date_created
     *
     * @return void
     */
    public function setDateCreated(?string $date_created) : void;

    /**
     * Getter for date_created.
     *
     * @return string|null
     */
    public function getDateScheduled() : ?string;

    /**
     * Setter for date_scheduled.
     *
     * @param string|null $date_scheduled
     *
     * @return void
     */
    public function setDateScheduled(?string $date_scheduled) : void;

    /**
     * Getter for is_approved.
     *
     * @return int|null
     */
    public function getIsApproved() : ?int;

    /**
     * Setter for is_approved.
     *
     * @param int|null $is_approved
     *
     * @return void
     */
    public function setIsApproved(?int $is_approved) : void;

    /**
     * Getter for is_executed.
     *
     * @return int|null
     */
    public function getIsExecuted() : ?int;

    /**
     * Setter for is_executed.
     *
     * @param int|null $is_executed
     *
     * @return void
     */
    public function setIsExecuted(?int $is_executed) : void;

    /**
     * Getter for user_id.
     *
     * @return int|null
     */
    public function getUserId() : ?int;

    /**
     * Setter for user_id.
     *
     * @param int|null $user_id
     *
     * @return void
     */
    public function setUserId(?int $user_id) : void;

}
