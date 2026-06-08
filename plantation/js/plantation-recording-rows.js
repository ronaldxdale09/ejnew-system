(function ($) {
    'use strict';

    window.PlantaRecording = {
        readRow: function ($tr) {
            var d = $tr.data();
            return {
                recordingId: String(d.recordingId || ''),
                supplier: String(d.supplier || ''),
                location: String(d.location || ''),
                lotNum: String(d.lotNum || ''),
                reweight: parseFloat(d.reweight) || 0,
                weight: parseFloat(d.weight) || 0,
                crumbedWeight: parseFloat(d.crumbedWeight) || 0,
                dryWeight: parseFloat(d.dryWeight) || 0,
                stageDate: String(d.stageDate || ''),
                receivingDate: String(d.receivingDate || ''),
                totalCost: parseFloat(d.totalCost) || 0,
                driver: String(d.driver || ''),
                truckNum: String(d.truckNum || ''),
                produceTotalWeight: parseFloat(d.produceTotalWeight) || 0,
                drc: parseFloat(d.drc) || 0,
                productionExpense: parseFloat(d.productionExpense) || 0,
                millingCost: parseFloat(d.millingCost) || 0,
                prodExpenseDesc: String(d.prodExpenseDesc || ''),
            };
        },

        formatNum: function (value) {
            return (parseFloat(value) || 0).toLocaleString('en-US');
        },

        loadTable: function (url, recordingId, target) {
            return $.ajax({
                url: url,
                method: 'POST',
                data: { recording_id: recordingId },
                success: function (html) {
                    $(target).html(html);
                },
            });
        },

        confirmStageTransfer: function (options) {
            var proceedClass = 'planta-swal-proceed';
            var updateClass = 'planta-swal-update';
            var closeClass = 'planta-swal-close';

            Swal.fire({
                title: options.title,
                showConfirmButton: false,
                html:
                    '<div class="text-center pt-2">' +
                    '<button type="button" class="btn btn-success me-2 ' + updateClass + '">Update</button>' +
                    '<button type="button" class="btn btn-warning me-2 ' + proceedClass + '">Proceed</button>' +
                    '<button type="button" class="btn btn-secondary ' + closeClass + '">Close</button>' +
                    '</div>',
                didOpen: function () {
                    var popup = Swal.getPopup();
                    popup.querySelector('.' + proceedClass).addEventListener('click', function () {
                        Swal.close();
                        if (options.onProceed) {
                            options.onProceed();
                        }
                    });
                    popup.querySelector('.' + updateClass).addEventListener('click', function () {
                        Swal.close();
                        if (options.onUpdate) {
                            options.onUpdate();
                        }
                    });
                    popup.querySelector('.' + closeClass).addEventListener('click', function () {
                        Swal.close();
                    });
                },
            });
        },
    };
})(jQuery);
