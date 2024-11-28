import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";
import throttle from "lodash.throttle";
import refs from "./refs";

const { bodyEl } = refs;

const throttledHandleResize = throttle(handleResize, 200);

let currentBackdrop = null;

export const showBackdrop = (backdrop, hideOnResize = false) => {
  if (!backdrop) {
    return;
  }
  disableBodyScroll();

  backdrop.removeClass("is-hidden");
  backdrop.on("click", handleBackdropClick);
  $(window).on("keydown", handleKeyDown);
  currentBackdrop = backdrop;

  if (hideOnResize) {
    $(window).on("resize", throttledHandleResize);
  }
};

export const hideBackdrop = (backdrop) => {
  if (!backdrop) {
    return;
  }

  enableBodyScroll();

  backdrop.addClass("is-hidden");
  backdrop.removeClass("click", handleBackdropClick);
  $(window).off("keydown", handleKeyDown);
  $(window).off("resize", throttledHandleResize);

  currentBackdrop = null;
};

function handleBackdropClick(e) {
  if (e.target === e.currentTarget) {
    hideBackdrop(currentBackdrop);
  }
}

function handleKeyDown(e) {
  if (e.key === "Escape") {
    hideBackdrop(currentBackdrop);
  }
}

function handleResize() {
  const { innerWidth } = window;

  if (innerWidth >= 992) {
    hideBackdrop(currentBackdrop);
  }
}

export function enableBodyScroll() {
  bodyEl.css({
    "overflow-y": "auto",
    "touch-action": "unset",
    "padding-right": '0'
  });
}

export function disableBodyScroll() {
  const scrollbarWidth = window.innerWidth - document.body.getBoundingClientRect().width

  bodyEl.css({
    "overflow-y": "hidden",
    "touch-action": "none",
    "padding-right": `${scrollbarWidth}px`
  });
}

export function showToastMessage($message, $class) {
  Toastify({
    text: $message,
    duration: 7000,
    gravity: "top",
    position: "right",
    stopOnFocus: true,
    className: $class,
  }).showToast();
}

$("document").ready(function () {
  bodyEl.css("visibility", "visible");
});

document.addEventListener("DOMContentLoaded", function () {
  if (document.querySelector(".scroll-to-top")) return;

  const button = document.createElement("button");
  button.innerHTML = `
	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
  <path d="M4.71896 14.719L12.219 7.21896C12.2886 7.14922 12.3713 7.09391 12.4624 7.05616C12.5534 7.01842 12.651 6.99899 12.7496 6.99899C12.8481 6.99899 12.9457 7.01842 13.0368 7.05616C13.1278 7.09391 13.2106 7.14922 13.2802 7.21896L20.7802 14.719C20.9209 14.8597 21 15.0506 21 15.2496C21 15.4486 20.9209 15.6395 20.7802 15.7802C20.6395 15.9209 20.4486 16 20.2496 16C20.0506 16 19.8597 15.9209 19.719 15.7802L12.7496 8.80989L5.78021 15.7802C5.71052 15.8499 5.6278 15.9052 5.53675 15.9429C5.44571 15.9806 5.34813 16 5.24958 16C5.15104 16 5.05345 15.9806 4.96241 15.9429C4.87137 15.9052 4.78864 15.8499 4.71896 15.7802C4.64927 15.7105 4.594 15.6278 4.55629 15.5368C4.51858 15.4457 4.49916 15.3481 4.49916 15.2496C4.49916 15.151 4.51858 15.0535 4.55629 14.9624C4.594 14.8714 4.64927 14.7886 4.71896 14.719Z" fill="white"/>
</svg>`;
  button.classList.add("scroll-to-top");
  document.body.appendChild(button);

  button.addEventListener("click", function () {
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  });

  window.addEventListener("scroll", function () {
    if (window.scrollY < 1000) {
      button.removeAttribute("show");
    } else {
      button.setAttribute("show", "");
    }
  });
});
document.addEventListener("DOMContentLoaded", function () {
  document
    .querySelector(".popup-menu")
    ?.addEventListener("click", function (e) {
      const backdrop = document.querySelector(".backdrop.menu");

      if (!backdrop) return;
      backdrop.setAttribute("show", "");
      backdrop.addEventListener("click", function (e) {
        if (e.target === e.currentTarget) {
          backdrop.removeAttribute("show");
        }
      });
    });
});
