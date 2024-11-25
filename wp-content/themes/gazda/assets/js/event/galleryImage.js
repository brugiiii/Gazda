import Swiper from "swiper";
console.log("galleryImage.js");
document.addEventListener("DOMContentLoaded", function () {
  const gallery = document.querySelector(".gallery .swiper");
  console.log("gallery", gallery);
  if (!gallery) return;

  const { backdrop, swiper } = init(gallery);

  clickOn(".gallery .swiper-slide img", (e) => openPopup(e, backdrop, swiper));
  clickOn(".image-backdrop.gallery-image", (e) => closePopup(e, backdrop));
});

function openPopup(e, backdrop, swiper) {
  console.log(e);
  try {
    const index =
      parseInt(
        e.target
          .closest(".swiper-slide")
          .getAttribute("aria-label")
          .split("/")[0]
          .trim()
      ) - 1;
    swiper.slideTo(index);

    setTimeout(() => {
      backdrop.classList.add("show");
    }, 200);
  } catch (e) {
    return false;
  }
}
function closePopup(e, backdrop) {
  console.log(e);
  backdrop.classList.remove("show");
  if (e.target === e.currentTarget) {
  }
}

function init(gallery) {
  const backdrop = document.createElement("div");
  const ctrls = document.createElement("ul");
  ctrls.classList.add("ctrls-list");
  ctrls.innerHTML = `
    <li class="ctrls-list__item prev">
      <svg class="ctrls-list__icon" width="64" height="64">
        <path stroke="transparent" d="m19.625 27.041-10-10a.991.991 0 0 1-.293-.708 1.006 1.006 0 0 1 .293-.708l10-10a1 1 0 1 1 1.414 1.414l-9.294 9.293 9.294 9.293a.991.991 0 0 1 .293.708 1.006 1.006 0 0 1-.618.925 1.01 1.01 0 0 1-.766 0 1.002 1.002 0 0 1-.325-.217z"/>
      </svg>
    </li>
    <li class="ctrls-list__item next">
      <svg class="ctrls-list__icon" width="64" height="64">
        <path stroke="transparent" d="m11.041 6.292 10 10a.991.991 0 0 1 .293.708 1.006 1.006 0 0 1-.293.708l-10 10a1 1 0 1 1-1.414-1.414l9.294-9.293-9.294-9.293A.991.991 0 0 1 9.334 7a1.01 1.01 0 0 1 .293-.708.991.991 0 0 1 .708-.293 1.01 1.01 0 0 1 .708.293z"/>
      </svg>
    </li>
  `;
  backdrop.classList.add("image-backdrop", "gallery-image");
  backdrop.innerHTML = `<div class="swiper-container"></div>`;
  backdrop
    .querySelector(".swiper-container")
    .appendChild(gallery.cloneNode(true));
  backdrop.querySelector(".swiper-container").appendChild(ctrls);

  backdrop.querySelector(".swiper").classList.remove("gallery-swiper");

  document.body.appendChild(backdrop);

  const swiper = new Swiper(".image-backdrop .swiper", {
    slidesPerView: 1,
    autoHeight: true,
    breakpoints: {
      992: {
        slidesPerView: 1.4,
      },
    },
    spaceBetween: 30,
    centeredSlides: true,
    navigation: {
      nextEl: ".image-backdrop  .next",
      prevEl: ".image-backdrop  .prev",
    },
  });
  return { backdrop, swiper };
}

function clickOn(element, callback) {
  list[element] = callback;
}
document.addEventListener("click", (event) => {
  Object.keys(list).forEach((selector) => {
    if (event.target.matches(selector)) {
      list[selector](event);
    }
  });
});
const list = {};
