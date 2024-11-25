if (
  window.location.pathname
    .split("/")
    .filter((e) => e != "")
    .some(
      (e) =>
        e.startsWith("checkout") && e == "checkout" && e != "order-received"
    )
) {
  let translateSelectorsArray = [
    {
      selector: '#contact-fields label[for="email"]',
      translate: "Адреса електронної пошти",
      errorTranslate: "Введіть дійсну адресу електронної пошти",
    },
    {
      selector:
        ".wc-block-components-checkout-step__container:has(#email) .wc-block-components-checkbox .wc-block-components-checkbox__label",
      translate: "Створити аккаунт?",
    },
    {
      selector: '#shipping-fields label[for="shipping-first_name"]',
      translate: "Ім’я",
      errorTranslate: "Введіть дійсне ім'я",
    },
    {
      selector: '#shipping-fields label[for="shipping-last_name"]',
      translate: "Прізвище",
      errorTranslate: "Введіть дійсне прізвище",
    },
    { selector: "#shipping-country label", translate: "Країна / регіон" },
    {
      selector:
        ".wc-block-components-text-input.wc-block-components-address-form__address_1 label",
      translate: "Адреса вулиці",
      errorTranslate: "Введіть дійсну адресу",
    },
    {
      selector: '#shipping-fields label[for="shipping-city"]',
      translate: "Місто / Містечко",
      errorTranslate: "Введіть дійсне місто",
    },
    {
      selector: "#shipping-state label",
      translate: "Область",
      errorTranslate: "Виберіть область.",
    },
    {
      selector: '#shipping-fields label[for="shipping-postcode"]',
      translate: "Поштовий індекс",
      errorTranslate: "Введіть дійсний поштовий індекс",
    },
    {
      selector: '#shipping-fields label[for="shipping-phone"]',
      translate: "Телефон",
      errorTranslate: "Введіть дійсний телефон",
    },
    {
      selector:
        ".wc-block-components-checkbox.wc-block-checkout__use-address-for-billing label span",
      translate: "Використовуйте ту саму адресу для виставлення рахунків",
    },
    {
      selector: '#billing-fields label[for="billing-first_name"]',
      translate: "Ім’я",
      errorTranslate: "Введіть дійсне ім'я",
    },
    {
      selector: '#billing-fields label[for="billing-last_name"]',
      translate: "Прізвище",
      errorTranslate: "Введіть дійсне прізвище",
    },
    { selector: "#billing-country label", translate: "Країна / регіон" },
    {
      selector:
        "#billing .wc-block-components-text-input.wc-block-components-address-form__address_1 label",
      translate: "Адреса вулиці",
      errorTranslate: "Введіть дійсну адресу",
    },
    {
      selector: '#billing-fields label[for="billing-city"]',
      translate: "Місто / Містечко",
      errorTranslate: "Введіть дійсне місто",
    },
    {
      selector: "#billing-state label",
      translate: "Область",
      errorTranslate: "Виберіть область.",
    },
    {
      selector: '#billing-fields label[for="billing-postcode"]',
      translate: "Поштовий індекс",
      errorTranslate: "Введіть дійсний поштовий індекс",
    },
    {
      selector: '#billing-fields label[for="billing-phone"]',
      translate: "Телефон",
      errorTranslate: "Введіть дійсний телефон",
    },
    {
      selector:
        ".wc-block-checkout__shipping-option .wc-block-components-title",
      translate: "Варіанти доставки",
    },
    {
      selector:
        ".wc-block-components-shipping-rates-control__package .wc-block-components-radio-control__option:first-child .wc-block-components-radio-control__label",
      translate: "Безкоштовна доставка",
    },
    {
      selector:
        ".wc-block-components-shipping-rates-control__package .wc-block-components-radio-control__option:nth-child(2) .wc-block-components-radio-control__label",
      translate: "Cамовивіз",
    },
    {
      selector:
        "#order-notes .wc-block-checkout__add-note .wc-block-components-checkbox__label",
      translate: "Чи є ви членом порядної родини",
    },
    {
      selector: ".wc-block-components-textarea",
      translate:
        "Напишіть ваш персональний код або залишіть коментар до замовлення",
      textarea: true,
    },
    {
      selector:
        ".wc-block-checkout__actions_row .wc-block-components-checkout-return-to-cart-button",
      translate: "Повернутись",
    },
    {
      selector:
        ".wc-block-checkout__actions_row .wc-block-components-checkout-place-order-button .wc-block-components-button__text",
      translate: "Зробити замовлення",
    },
    {
      selector:
        ".wp-block-woocommerce-checkout-order-summary-block > .wp-block-woocommerce-checkout-order-summary-cart-items-block .wc-block-components-panel__button .wc-block-components-order-summary__button-text",
      translate: "Ваше замовлення",
    },
    {
      selector:
        ".wc-block-components-totals-wrapper .wc-block-components-totals-footer-item .wc-block-components-totals-item__label",
      translate: "Загальна",
    },
  ];
  const findElement = (node) => {
    let res = [];
    translateSelectorsArray.forEach((obj) => {
      if (
        node.querySelector(obj.selector) ||
        node.tagName.toLowerCase() === "textarea"
      ) {
        if (obj.textarea) {
          res.push({ element: node, translate: obj.translate, textArea: true });
        } else if (node.querySelector(obj.selector)) {
          let ob = {
            element: node.querySelector(obj.selector),
            translate: obj.translate,
            selector: obj.selector,
          };
          if (obj.errorTranslate) ob.errorText = obj.errorTranslate;

          res.push(ob);
        }
      } else if (
        node.classList.contains("wc-block-components-validation-error")
      ) {
        res.push({
          element: node,
          translate: node.parentNode
            .querySelector("label")
            .getAttribute("data-error_text"),
        });
      }
    });
    return res.length !== 0 ? res : -1;
  };

  const translate = (node) => {
    let foundRes = findElement(node);
    if (foundRes != -1) {
      foundRes.forEach((obj) => {
        if (obj.errorText) {
          obj.element.setAttribute("data-error_text", obj.errorText);
        }
        if (obj.textArea) {
          obj.element.placeholder = obj.translate;
        } else {
          obj.element.textContent = obj.translate;
        }
      });
    }
  };

  const mutationCallback = (mutationsList, observer) => {
    mutationsList.forEach((mutation) => {
      mutation.addedNodes.forEach((node) => {
        if (
          node.nodeType === Node.ELEMENT_NODE &&
          node.tagName.toLowerCase() !== "script"
        ) {
          translate(node);
        }
      });
    });
  };

  const observer = new MutationObserver(mutationCallback);
  observer.observe(document.body, { childList: true, subtree: true });
}

if (
  window.location.pathname
    .split("/")
    .filter((e) => e != "")
    .some((e) => e == "order-received")
) {
  const translateList = [
    {
      selector: ".woocommerce-notice",
      translate: "Дякую тобі. Ваше замовлення отримано.",
    },
    {
      selector: ".woocommerce-order-overview__order.order",
      translate: "НОМЕР ЗАМОВЛЕННЯ",
    },
    { selector: ".woocommerce-order-overview__date.date", translate: "Дата" },
    {
      selector: ".woocommerce-order-overview__email.email",
      translate: "Пошта",
    },
    {
      selector: ".woocommerce-order-overview__total.total",
      translate: "Разом",
    },
    {
      selector: ".woocommerce-order-overview__payment-method.method",
      translate: "Спосіб оплати",
    },
    {
      selector: ".woocommerce-order-details__title",
      translate: "Деталі замовлення",
    },
    {
      selector: ".woocommerce-table__product-name.product-name",
      translate: "Продукт",
    },
    {
      selector: ".woocommerce-table__product-table.product-total",
      translate: "Всього",
    },
    {
      selector:
        ".woocommerce-table.woocommerce-table--order-details.shop_table.order_details tfoot tr:nth-child(1) th",
      translate: "Проміжний підсумок:",
    },
    {
      selector:
        ".woocommerce-table.woocommerce-table--order-details.shop_table.order_details tfoot tr:nth-child(2) th",
      translate: "Доставка:",
    },
    {
      selector:
        ".woocommerce-table.woocommerce-table--order-details.shop_table.order_details tfoot tr:nth-child(2) td",
      translate: "Безкоштовна доставка",
    },
    {
      selector:
        ".woocommerce-table.woocommerce-table--order-details.shop_table.order_details tfoot tr:nth-child(3) th",
      translate: "Спосіб оплати:",
    },
    {
      selector:
        ".woocommerce-table.woocommerce-table--order-details.shop_table.order_details tfoot tr:nth-child(4) th",
      translate: "Всього:",
    },
    {
      selector:
        ".woocommerce-customer-details .woocommerce-column--billing-address .woocommerce-column__title",
      translate: "Платіжна адреса",
    },
    {
      selector:
        ".woocommerce-customer-details .woocommerce-column--shipping-address .woocommerce-column__title",
      translate: "Адреса доставки",
    },
  ];

  translateList.forEach((obj) => {
    const element = document.querySelector(obj.selector);
    if (element) {
      if (element.querySelector("strong")) {
        let st = element.querySelector("strong").cloneNode(true);
        element.innerText = obj.translate;
        element.appendChild(st);
      } else {
        element.innerText = obj.translate;
      }
    }
  });
}
