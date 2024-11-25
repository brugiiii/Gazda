function generateModal() {
  var modalDiv = document.createElement("div");
  modalDiv.id = "mySizeChartModal";
  modalDiv.classList.add("ebcf_modal");

  var contentDiv = document.createElement("div");
  contentDiv.classList.add("ebcf_modal-content");

  var closeButton = document.createElement("span");
  closeButton.classList.add("ebcf_close");
  closeButton.innerHTML = "&times;";
  contentDiv.appendChild(closeButton);

  var iframe = document.createElement("iframe");
  iframe.src = settings.iframe_link;
	iframe.title = "Size Chart";
  iframe.style.width = "100%";
  iframe.style.height = "100%";
  iframe.style.border = "none";
  contentDiv.appendChild(iframe);

  modalDiv.appendChild(contentDiv);
  document.querySelector('.modal-container').appendChild(modalDiv);
	window.scrollTo(0, 0)
}

var modalContainer = document.createElement("div");
modalContainer.classList.add("modal-container");
document.body.appendChild(modalContainer);


let list = [
    {selector: '.header-wrapper button.mySizeChart'},
    {selector: '#menu-main-menu li:nth-child(2) a'},
    {selector: '#menu-main-menu-eng li:nth-child(2) a'},
    {selector: '.burger-wrapper #menu-burger-menu-mobile li ul.sub-menu li:nth-child(2) a'},
		{selector: '.burger-wrapper #menu-burger-menu-mobile-eng li ul.sub-menu li:nth-child(2) a'}
]
list.forEach(({selector})=>{
    if(document.querySelector(selector)){
        let element = document.querySelector(selector)

if (element.tagName.toLowerCase() === 'a') {
            element.removeAttribute('href');
        }

        element.addEventListener('click',  () => {
				if(document.querySelector('.modal-container').children.length == 0){
					generateModal()
				}

                let modal = document.querySelector('#mySizeChartModal')

				modal.style.display = "flex"
				modal.addEventListener('click', (e) => {
					if(e.target.id == 'mySizeChartModal' || e.target.classList.contains('ebcf_close')){
						modal.remove()
					}
				})
			})
    }

})