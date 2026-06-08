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

    function reparentModal(el) {
        if (el && el.parentElement && el.parentElement !== document.body) {
            document.body.appendChild(el);
        }
    }

    global.SalesModal = {
        get: getModal,
        show: function (el) {
            el = resolveEl(el);
            if (!el) return;
            reparentModal(el);
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

    global.PlantationModal = global.SalesModal;
    global.LedgerModal = global.SalesModal;

    if (typeof jQuery !== 'undefined' && !jQuery.fn.modal) {
        jQuery.fn.modal = function (action) {
            return this.each(function () {
                if (action === 'show') global.SalesModal.show(this);
                else if (action === 'hide') global.SalesModal.hide(this);
            });
        };
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.modal').forEach(reparentModal);

        document.querySelectorAll('[data-toggle="modal"]').forEach(function (el) {
            if (!el.hasAttribute('data-bs-toggle')) el.setAttribute('data-bs-toggle', 'modal');
            var target = el.getAttribute('data-target');
            if (target && !el.hasAttribute('data-bs-target')) el.setAttribute('data-bs-target', target);
        });
        document.querySelectorAll('[data-dismiss="modal"]').forEach(function (el) {
            if (!el.hasAttribute('data-bs-dismiss')) el.setAttribute('data-bs-dismiss', 'modal');
        });

        document.body.addEventListener('show.bs.modal', function (ev) {
            reparentModal(ev.target);
            var firstTab = ev.target.querySelector('.sales-modal-tabs .nav-link');
            if (firstTab && typeof bootstrap !== 'undefined' && bootstrap.Tab) {
                bootstrap.Tab.getOrCreateInstance(firstTab).show();
            }
        });
    });
})(typeof window !== 'undefined' ? window : this);
