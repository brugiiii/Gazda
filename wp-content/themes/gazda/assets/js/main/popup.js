import refs from "./refs"
import {showBackdrop} from "./utils"

const {authBackdrop, authButton} = refs;

authButton.on('click', () => showBackdrop(authBackdrop))