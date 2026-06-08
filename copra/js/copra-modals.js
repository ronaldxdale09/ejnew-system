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

    global.CopraModal = {
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

    if (typeof jQuery !== 'undefined') {
        var origModal = jQuery.fn.modal;
        jQuery.fn.modal = function (action) {
            return this.each(function () {
                if (action === 'show') {
                    global.CopraModal.show(this);
                } else if (action === 'hide') {
                    global.CopraModal.hide(this);
                } else if (typeof origModal === 'function') {
                    origModal.call(jQuery(this), action);
                }
            });
        };
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.modal').forEach(function (el) {
            reparentModal(el);
            el.classList.add('copra-modal');
        });

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
        });
        document.body.addEventListener('shown.bs.modal', function (ev) {
            reparentModal(ev.target);
        });
    });
})(typeof window !== 'undefined' ? window : this);
