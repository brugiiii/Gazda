if (window.location.pathname.includes('en') || window.location.pathname.includes('eng')) {

    const translate = (node) => {
        const translations = [
            {selector: ".xoo-wsch-top .xoo-wsch-text", translate: 'Basket'},
            {selector: ".xoo-wsc-footer .xoo-wsc-ft-totals .xoo-wsc-ft-amt-label", translate: 'total'},
            {selector: ".xoo-wsc-footer .xoo-wsc-ft-buttons-cont .cart-button", translate: 'To order'}
        ];

        translations.forEach(item => {
            const element = node.querySelector(item.selector);
            if (element) {
                element.innerText = item.translate;
                if (item.selector === ".xoo-wsc-footer .xoo-wsc-ft-buttons-cont .cart-button") {
                    const currentLink = element.getAttribute('href');
                    if (currentLink && currentLink.includes('/checkout/')) {
                        const newLink = currentLink.replace('/checkout/', '/eng-checkout/');
                        element.setAttribute('href', newLink);
                    }
                }
            }
        });
    };

    const observer = new MutationObserver((mutationsList) => {
        mutationsList.forEach(mutation => {
            if (mutation.type === 'childList') {
                mutation.addedNodes.forEach(node => {
                    if (node.nodeType === Node.ELEMENT_NODE && node.classList.contains('xoo-wsc-container')) {
                        translate(node);
                    }
                });
            }
        });
    });

    observer.observe(document.body, { childList: true, subtree: true });
}
