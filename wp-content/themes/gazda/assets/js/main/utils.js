import Toastify from "toastify-js";
import "toastify-js/src/toastify.css"
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
  bodyEl.css("overflow-y", "scroll");
}

export function disableBodyScroll() {
  bodyEl.css("overflow-y", "hidden");
}

export function showToastMessage($message, $class){
  Toastify({
    text: $message,
    duration: 7000,
    gravity: "top",
    position: "right",
    stopOnFocus: true,
    className: $class
  }).showToast();
}

$("document").ready(function () {
  bodyEl.css("visibility", "visible");
});
