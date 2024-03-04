import refs from "./refs"

const {headerLink} = refs;

headerLink.on('click', (e) => $(e.currentTarget).toggleClass('is-active'))