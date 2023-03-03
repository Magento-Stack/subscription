define(
    [
        'ko',
        'jquery',
        'uiComponent',
        'mage/url'
    ],
    function (ko, $, Component, url) {
        'use strict';
        return Component.extend({

                defaults: {
                    template: 'Pixafy_Subscription/checkout/subscription'
                },
                subscriptionIntervals: function () {
                    return window.checkoutConfig.subscription_intervals;
                },
                isDropDownVisible: function () {
                    return window.checkoutConfig.is_subscription === "recurring";
                },
                initObservable: function () {
                    this._super().observe({
                        CheckVals: ko.observable(window.checkoutConfig.is_subscription),
                        selectedInterval: ko.observable(window.checkoutConfig.selected_interval)
                    });
                    self = this;
                    this.selectedValueChanged = function (data, event) {
                        var linkUrls = url.build('pixafy_subscription/checkout/save');
                        $.ajax({
                            showLoader: true,
                            url: linkUrls,
                            data: {type: "recurring", value: event.target.value},
                            type: "POST",
                            dataType: 'json'
                        }).done(function (data) {
                            console.log(' ');
                        });
                    }
                    this.CheckVals.subscribe(function (newValue) {
                        function showRecurringForm() {
                            Array.from(document.getElementsByClassName('recurring_form')).forEach(elem => {
                                elem.style.display = "block";
                            });
                        }

                        function hideRecurringForm() {
                            Array.from(document.getElementsByClassName('recurring_form')).forEach(elem => {
                                elem.style.display = "none";
                            });
                        }

                        var linkUrls = url.build('pixafy_subscription/checkout/save');
                        if (newValue === "recurring") {
                            showRecurringForm();
                        } else {
                            hideRecurringForm();
                        }
                        $.ajax({
                            showLoader: true,
                            url: linkUrls,
                            data: {type: newValue},
                            type: "POST",
                            dataType: 'json'
                        }).done(function (data) {
                            console.log(' ');

                        });
                    });

                    return this;
                }

            }
        );
    }
);
