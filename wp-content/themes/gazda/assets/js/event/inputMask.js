import Inputmask from "inputmask";

$(document).ready(function(){
    Inputmask({
        mask: '+380 (99) 999 99 99',
        greedy: false,
        placeholder: 'X',
    }).mask($('#phone'));
});