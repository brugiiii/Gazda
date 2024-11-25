import  refs  from "../main/refs"
let targetID = null

if(refs.heroButtonToGiftSet.length){
  targetID = refs.heroButtonToGiftSet[0].getAttribute('data-taxonomy') ?? false;
}

$(document).ready(function(){
    refs.heroButtonToGiftSet.click(function(){
            localStorage.setItem('handleHeroButtonRedirecter', targetID);
    });
});