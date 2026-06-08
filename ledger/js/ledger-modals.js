/**
 * Bootstrap 5 modal helper — works with BS5 beta (no getOrCreateInstance).
 */
(function (global) {
    'use strict';

    function resolveEl(el) {
        if (!el) return null;
        if (typeof el === 'string') return document.querySelector(el);
        return el.jquery ? el[0] : el;
    }

    function getModal(el) {
        el = resolveEl(el);
        if (!el) return null;
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            return bootstrap.Modal.getInstance(el) || new bootstrap.Modal(el);
        }
        return null;
    }

    global.LedgerModal = {
        get: getModal,
        show: function (el) {
            el = resolveEl(el);
            if (!el) return;
            var instance = getModal(el);
            if (instance) {
                instance.show();
                return;
            }
            if (typeof jQuery !== 'undefined' && jQuery.fn.modal) {
                jQuery(el).modal('show');
            }
        },
        hide: function (el) {
            el = resolveEl(el);
            if (!el) return;
            var instance = getModal(el);
            if (instance) {
                instance.hide();
                return;
            }
            if (typeof jQuery !== 'undefined' && jQuery.fn.modal) {
                jQuery(el).modal('hide');
            }
        },
        hideClosest: function (formOrBtn) {
            var modal = resolveEl(formOrBtn);
            if (modal) modal = modal.closest ? modal.closest('.modal') : null;
            if (modal) this.hide(modal);
        }
    };

    // jQuery plugin bridge for legacy inline scripts
    if (typeof jQuery !== 'undefined') {
        jQuery.fn.ledgerModal = function (action) {
            this.each(function () {
                if (action === 'show') global.LedgerModal.show(this);
                else if (action === 'hide') global.LedgerModal.hide(this);
            });
            return this;
        };
    }
})(typeof window !== 'undefined' ? window : this);
