import refs from "./refs"
import {hideBackdrop, showBackdrop} from "./utils"

const {authBackdrop, authButton, cartBackdrop, cartButton, hideCartButton } = refs;



authButton.on('click', () => showBackdrop(authBackdrop))
cartButton.on('click', () => showBackdrop(cartBackdrop))
hideCartButton.on("click", () => hideBackdrop(cartBackdrop));