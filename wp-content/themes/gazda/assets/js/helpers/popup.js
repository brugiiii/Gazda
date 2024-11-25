import { showBackdrop, hideBackdrop } from "../main/utils";
document.querySelectorAll(".popup-open").forEach((button) => {
  button.addEventListener("click", (e) => {
    if (
      button.classList.contains("window-form") &&
      !(button.classList.contains("single-doctor"))
    ) {
      showBackdrop(
        $(button.parentNode.querySelector(`.backdrop.window-form`)),
        true
      );
    } else {
      showBackdrop(
        $(document.querySelector(`.backdrop.${button.classList[1]}`)),
        true
      );
    }
		document.querySelectorAll('.close-button').forEach((closeButton) => {
			$(closeButton).on("click",()=>{
				hideBackdrop($(closeButton.closest('.backdrop')));
			})
		})
  });
});
