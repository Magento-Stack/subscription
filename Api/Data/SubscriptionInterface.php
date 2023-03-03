<?php

namespace Pixafy\Subscription\Api\Data;

interface SubscriptionInterface
{
    /**
     * String constants for property names
     */
    const ID = "subscription_id";
    const CUSTOMER_ID = "customer_id";
    const INCREMENT_ID = "increment_id";
    const NAME = "name";
    const BPC_NUM = "bpc_num";
    const BPC_NAME = "bpc_name";
    const DATE_CREATED = "date_created";
    const ENABLE = "enable";
    const SCHEDULE_ID = "schedule_id";
    const SUBSCRIPTION_INTERVAL_TYPE = "subscription_interval_type";
    const SUBSCRIPTION_INTERVAL_NUMBER = "subscription_interval_number";
    const SUBSCRIPTION_INTERVAL_LABEL = "subscription_interval_label";
    const PONUMBER = "ponumber";
    const UNIQUE_ID = "unique_id";
    const NEXT_SHIP_DATE = "next_ship_date";
    const NOTES = "notes";
    const TOTAL_COST = "total_cost";
    const DISABLE_CONFIRMATION = "disable_confirmation";
    const X3_ORDER_REBUILD_FLAG = "x3_order_rebuild_flag";


    /**
     * Getter for Id.
     *
     * @return int|null
     */
    public function getId() : ?int;

    /**
     * Setter for Id.
     *
     * @param int|null $id
     *
     * @return void
     */
    public function setId(?int $id) : void;

    /**
     * Getter for Customer Id.
     *
     * @return int|null
     */
    public function getCustomerId() : ?int;

    /**
     * Setter for Customer Id.
     *
     * @param int|null $CustomerId
     *
     * @return void
     */
    public function setCustomerId(?int $CustomerId) : ?int;

    /**
     * Getter for Increment Id.
     *
     * @return int|null
     */
    public function getIncrementId() : ?int;

    /**
     * Setter for Increment Id.
     *
     * @param int|null $id
     *
     * @return void
     */
    public function setIncrementId(?int $id) : ?int;

    /**
     * Getter for Name.
     *
     * @return string|null
     */
    public function getName() : ?string;

    /**
     * Setter for Name.
     *
     * @param string|null $name
     *
     * @return void
     */
    public function setName(?string $name) : ?string;

    /**
     * Getter for bpc_num.
     *
     * @return string|null
     */
    public function getBpcNum() : ?string;

    /**
     * Setter for bpc_num.
     *
     * @param string|null $bpcnum
     *
     * @return void
     */
    public function setBpcNum(?string $bpcnum) : ?string;

    /**
     * Getter for bpc_name.
     *
     * @return string|null
     */
    public function getBpcName() : ?string;

    /**
     * Setter for bpc_name.
     *
     * @param string|null $bpcname
     *
     * @return void
     */
    public function setBpcName(?string $bpcname) : ?string;

    /**
     * Getter for Date Created.
     *
     * @return string|null
     */
    public function getDateCreated() : ?string;

    /**
     * Setter for Date Created.
     *
     * @param string|null $date
     *
     * @return void
     */
    public function setDateCreated(?string $date) : ?string;

    /**
     * Getter for enable.
     *
     * @return int|null
     */
    public function getEnable() : ?int;

    /**
     * Setter for enable.
     *
     * @param int|null $enable
     *
     * @return void
     */
    public function setEnable(?int $enable) : ?int;

    /**
     * Getter for Schedule Id.
     *
     * @return int|null
     */
    public function getScheduleId() : ?int;

    /**
     * Setter for Schedule Id.
     *
     * @param int|null $schedule_id
     *
     * @return void
     */
    public function setScheduleId(?int $schedule_id) : ?int;

    /**
     * Getter for subscription interval type.
     *
     * @return string|null
     */
    public function getSubscriptionIntervalType() : ?string;

    /**
     * Setter for subscription interval type.
     *
     * @param string|null $subscription_interval_type
     *
     * @return void
     */
    public function setSubscriptionIntervalType(?string $subscription_interval_type) : ?string;

    /**
     * Getter for subscription interval number.
     *
     * @return int|null
     */
    public function getSubscriptionIntervalNumber() : ?int;

    /**
     * Setter for subscription interval number.
     *
     * @param int|null $subscription_interval_number
     *
     * @return void
     */
    public function setSubscriptionIntervalNumber(?int $subscription_interval_number) : ?int;

    /**
     * Getter for subscription interval label.
     *
     * @return string|null
     */
    public function getSubscriptionIntervalLabel() : ?string;

    /**
     * Setter for subscription interval label.
     *
     * @param string|null $subscription_interval_label
     *
     * @return void
     */
    public function setSubscriptionIntervalLabel(?string $subscription_interval_label) : ?string;

    /**
     * Getter for ponumber.
     *
     * @return string|null
     */
    public function getPonumber() : ?string;

    /**
     * Setter for ponumber.
     *
     * @param string|null $ponumber
     *
     * @return void
     */
    public function setPonumber(?string $ponumber) : ?string;

    /**
     * Getter for Unique Id.
     *
     * @return int|null
     */
    public function getUniqueId() : ?int;

    /**
     * Setter for Unique Id.
     *
     * @param int|null $unique_id
     *
     * @return void
     */
    public function setUniqueId(?int $unique_id) : ?int;

    /**
     * Getter for Next Ship Date.
     *
     * @return string|null
     */
    public function getNextShipDate() : ?string;

    /**
     * Setter for Next Ship Date.
     *
     * @param string|null $next_ship_date
     *
     * @return void
     */
    public function setNextShipDate(?string $next_ship_date) : ?string;

    /**
     * Getter for Notes.
     *
     * @return string|null
     */
    public function getNotes() : ?string;

    /**
     * Setter for Notes.
     *
     * @param string|null $notes
     *
     * @return void
     */
    public function setNotes(?string $notes) : ?string;

    /**
     * Getter for Total Cost.
     *
     * @return float|null
     */
    public function getTotalCost() : ?float;

    /**
     * Setter for Total Cost.
     *
     * @param float|null $TotalCost
     *
     * @return void
     */
    public function setTotalCost(?float $TotalCost) : ?float;

    /**
     * Getter for Disable Confirmation.
     *
     * @return int|null
     */
    public function getDisableConfirmation() : ?int;

    /**
     * Setter for Disable Confirmation.
     *
     * @param int|null $DisableConfirmation
     *
     * @return void
     */
    public function setDisableConfirmation(?int $DisableConfirmation) : ?int;

    /**
     * Getter for X3OrderRebuildFlag.
     *
     * @return int|null
     */
    public function getX3OrderRebuildFlag() : ?int;

    /**
     * Setter for Name.
     *
     * @param int|null $X3OrderRebuildFlag
     *
     * @return void
     */
    public function setX3OrderRebuildFlag(?int $X3OrderRebuildFlag) : ?int;

    /**
     * Getter for Products.
     *
     * @return array|null
     */
    public function getProducts() : ?array;
}
