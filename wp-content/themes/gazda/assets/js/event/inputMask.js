import Inputmask from "inputmask";

$(document).ready(function(){
    Inputmask({
        mask: '+380 (999) 999 99 99',
        greedy: false,
        placeholder: 'X',
    }).mask($('#phone'));
});