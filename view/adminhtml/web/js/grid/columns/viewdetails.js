define([
    'Magento_Ui/js/grid/columns/column',
    'jquery',
    'mage/template',
    'text!Pixafy_Subscription/templates/grid/cells/customer/viewdetails.html',
    'Magento_Ui/js/modal/modal'
], function (Column, $, mageTemplate, sendmailPreviewTemplate) {
    'use strict';

    $('#save').click(function(){
        var productQtyarr = [];
        $("input[name='qty']").each( function(){
            if ($(this).val() > 0) {
                productQtyarr.push({
                    'qty':$(this).val()
                });
            }
        });
        $.ajax({
            url: '/admin/subscription/pixafysubscription/stagesave',
            data: {productQtyarr: productQtyarr},
            method: 'POST',
            showLoader: true
        }).done(function(response){
            if (response.status) {
            }
        });
    });

    return Column.extend({
        defaults: {
            bodyTmpl: 'ui/grid/cells/html',
            fieldClass: {
                'data-grid-html-cell': true
            }
        },
        gethtml: function (row) {
            return row[this.index + '_html'];
        },
        getFormaction: function (row) {
            return row[this.index + '_formaction'];
        },
        getSubscriptionStagingId: function (row) {
            return row[this.index + '_subscriptionstagingid'];
        },
        getStagingDetails: function (row) {
            var stagingDetailsObj =  row[this.index + '_subscriptionstagingdetails']
            return Object.keys(stagingDetailsObj).map((k) => stagingDetailsObj[k]);
        },
        getLabel: function (row) {
            return row[this.index + '_html']
        },
        getTitle: function (row) {
            return row[this.index + '_title']
        },
        getSubmitlabel: function (row) {
            return row[this.index + '_submitlabel']
        },
        getCancellabel: function (row) {
            return row[this.index + '_cancellabel']
        },
        preview: function (row) {
            var modalHtml = mageTemplate(
                sendmailPreviewTemplate,
                {
                    html: this.gethtml(row),
                    title: this.getTitle(row),
                    label: this.getLabel(row),
                    formaction: this.getFormaction(row),
                    subscriptionstagingid: this.getSubscriptionStagingId(row),
                    submitlabel: this.getSubmitlabel(row),
                    cancellabel: this.getCancellabel(row),
                    stagingDetails: this.getStagingDetails(row),
                    linkText: $.mage.__('Go to Details Page')
                }
            );
            var previewPopup = $('<div/>').html(modalHtml);
            previewPopup.modal({
                title: this.getTitle(row),
                innerScroll: true,
                modalClass: '_image-box',
                buttons: []}).trigger('openModal');
        },
        getFieldHandler: function (row) {
            return this.preview.bind(this, row);
        }
    });
});
