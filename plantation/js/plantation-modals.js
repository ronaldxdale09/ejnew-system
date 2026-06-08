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

    global.PlantationModal = {
        get: getModal,
        show: function (el) {
            el = resolveEl(el);
            if (!el) return;
            if (el.parentElement && el.parentElement !== document.body) {
                document.body.appendChild(el);
            }
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

    global.LedgerModal = global.PlantationModal;

    if (typeof jQuery !== 'undefined' && !jQuery.fn.modal) {
        jQuery.fn.modal = function (action) {
            return this.each(function () {
                if (action === 'show') global.PlantationModal.show(this);
                else if (action === 'hide') global.PlantationModal.hide(this);
            });
        };
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.modal').forEach(function (modal) {
            if (modal.parentElement && modal.parentElement !== document.body) {
                document.body.appendChild(modal);
            }
        });

        document.querySelectorAll('[data-toggle="modal"]').forEach(function (el) {
            if (!el.hasAttribute('data-bs-toggle')) {
                el.setAttribute('data-bs-toggle', 'modal');
            }
            var target = el.getAttribute('data-target');
            if (target && !el.hasAttribute('data-bs-target')) {
                el.setAttribute('data-bs-target', target);
            }
        });
        document.querySelectorAll('[data-dismiss="modal"]').forEach(function (el) {
            if (!el.hasAttribute('data-bs-dismiss')) {
                el.setAttribute('data-bs-dismiss', 'modal');
            }
        });
        document.querySelectorAll('[data-dismiss="alert"]').forEach(function (el) {
            if (!el.hasAttribute('data-bs-dismiss')) {
                el.setAttribute('data-bs-dismiss', 'alert');
            }
        });

        document.body.addEventListener('show.bs.modal', function (ev) {
            var modal = ev.target;
            if (modal && modal.classList && modal.classList.contains('modal')
                && modal.parentElement !== document.body) {
                document.body.appendChild(modal);
            }
        });
    });
})(typeof window !== 'undefined' ? window : this);
