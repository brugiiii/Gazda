import refs from "./refs"
import {showBackdrop, hideBackdrop} from "./utils"

const {authBackdrop, authButton} = refs;

authButton.on('click', () => showBackdrop(authBackdrop))