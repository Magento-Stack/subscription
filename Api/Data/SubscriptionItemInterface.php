<?php

namespace Pixafy\Subscription\Api\Data;

interface SubscriptionItemInterface
{
    /**
     * String constants for property names
     */
    const ID = "id";
    const SUBSCRIPTION_ID = "subscription_id";
    const ITMREF = "itmref";
    const PRI = "pri";
    const MINQTY = "minqty";
    const MAXQTY = "maxqty";
    const ITMDESC = "itmdesc";
    const QTY = "qty";
    const ITMSTD = "itmstd";
    const TSICOD = "tsicod";


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
     * Getter for Subscription Id.
     *
     * @return int|null
     */
    public function getSubscriptionId() : ?int;

    /**
     * Setter for Subscription Id.
     *
     * @param int|null $SubscriptionId
     *
     * @return void
     */
    public function setSubscriptionId(?int $SubscriptionId) : ?int;

    /**
     * Getter for itmref.
     *
     * @return string|null
     */
    public function getItmRef() : ?string;

    /**
     * Setter for itmref.
     *
     * @param string|null $ItmRef
     *
     * @return void
     */
    public function setItmRef(?string $ItmRef) : ?string;

    /**
     * Getter for pri.
     *
     * @return int|null
     */
    public function getPri() : ?int;

    /**
     * Setter for pri.
     *
     * @param int|null $Pri
     *
     * @return void
     */
    public function setPri(?int $Pri) : void;

    /**
     * Getter for minqty.
     *
     * @return int|null
     */
    public function getMinqty() : ?int;

    /**
     * Setter for minqty.
     *
     * @param int|null $MinQty
     *
     * @return void
     */
    public function setMinqty(?int $MinQty) : void;

    /**
     * Getter for maxqty.
     *
     * @return int|null
     */
    public function getMaxqty() : ?int;

    /**
     * Setter for maxqty.
     *
     * @param int|null $MaxQty
     *
     * @return void
     */
    public function setMaxqty(?int $MaxQty) : void;

    /**
     * Getter for itmdesc.
     *
     * @return string|null
     */
    public function getItmdesc() : ?string;

    /**
     * Setter for itmdesc.
     *
     * @param string|null $ItmDesc
     *
     * @return void
     */
    public function setItmdesc(?string $ItmRef) : ?string;

    /**
     * Getter for qty.
     *
     * @return int|null
     */
    public function getQty() : ?int;

    /**
     * Setter for qty.
     *
     * @param int|null $Qty
     *
     * @return void
     */
    public function setQty(?int $Qty) : void;

    /**
     * Getter for ship_site.
     *
     * @return int|null
     */
    public function getShipSite() : ?string;

    /**
     * Setter for ship_site.
     *
     * @param int|null $ShipSite
     *
     * @return void
     */
    public function setShipSite(?string $ShipSite) : ?string;

    /**
     * Getter for itmstd.
     *
     * @return int|null
     */
    public function getItmstd() : ?string;

    /**
     * Setter for itmstd.
     *
     * @param int|null $ItmStd
     *
     * @return void
     */
    public function setItmstd(?string $ItmStd) : ?string;

    /**
     * Getter for tsicod.
     *
     * @return string|null
     */
    public function getTsicod() : ?string;

    /**
     * Setter for tsicod.
     *
     * @param string|null $TsiCod
     *
     * @return void
     */
    public function setTsicod(?string $TsiCod) : ?string;

}
