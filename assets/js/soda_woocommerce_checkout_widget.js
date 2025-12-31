(function() {
    function setupSummaryHeading(wrapper) {
        var summaryHeading = wrapper.getAttribute('data-summary-heading');
        if (!summaryHeading) {
            return;
        }

        var summary = wrapper.querySelector('#order_review');
        if (!summary) {
            return;
        }

        if (wrapper.querySelector('.soda-woo-checkout__summary-heading')) {
            return;
        }

        var heading = document.createElement('div');
        heading.className = 'soda-woo-checkout__summary-heading';
        heading.textContent = summaryHeading;
        summary.parentNode.insertBefore(heading, summary);
    }

    function setupToggle(wrapper) {
        if (!wrapper.classList.contains('has-summary-toggle')) {
            return;
        }

        var toggle = wrapper.querySelector('.soda-woo-checkout__summary-toggle');
        var summary = wrapper.querySelector('#order_review');
        if (!toggle || !summary) {
            return;
        }

        var showLabel = wrapper.getAttribute('data-summary-toggle-show') || toggle.textContent;
        var hideLabel = wrapper.getAttribute('data-summary-toggle-hide') || showLabel;
        var labelTarget = toggle.querySelector('.soda-woo-checkout__summary-toggle-label');

        function updateState(isOpen) {
            wrapper.classList.toggle('is-summary-open', isOpen);
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            if (labelTarget) {
                labelTarget.textContent = isOpen ? hideLabel : showLabel;
            }
        }

        updateState(false);

        toggle.addEventListener('click', function() {
            var isExpanded = toggle.getAttribute('aria-expanded') === 'true';
            updateState(!isExpanded);
        });
    }

    function init(context) {
        var scope = context instanceof Element ? context : document;
        var wrappers = scope.querySelectorAll('.soda-woo-checkout');
        if (!wrappers.length && scope.classList && scope.classList.contains('soda-woo-checkout')) {
            wrappers = [scope];
        }

        Array.prototype.forEach.call(wrappers, function(wrapper) {
            setupSummaryHeading(wrapper);
            setupToggle(wrapper);
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        init(document);
    });

    if (window.elementorFrontend && window.elementorFrontend.hooks) {
        window.elementorFrontend.hooks.addAction('frontend/element_ready/soda-woo-checkout.default', function($scope) {
            var element = $scope && $scope[0] ? $scope[0] : $scope;
            if (element instanceof Element) {
                init(element);
            }
        });
    }
})();
