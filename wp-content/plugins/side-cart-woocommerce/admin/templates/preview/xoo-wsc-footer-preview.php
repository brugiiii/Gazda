<?php

$subtotal = wc_price(100);

?>

<div class="xoo-wsc-ft-totals">

	<# if ( data.footer.subtotal ) { #>
	
	<div class="xoo-wsc-ft-amt">
		<span class="xoo-wsc-ft-amt-label">
            <?= translate_and_output('total_sum'); ?>
        </span>
		<span class="xoo-wsc-ft-amt-value">
            <?= $subtotal; ?>
        </span>
	</div>

	<# } #>

</div>

<# if ( data.footer.footerTxt ) { #>
<# } #>


<!--<div class="xoo-wsc-ft-buttons-cont">-->
<!---->
<!--	<# _.each( data.footer.buttonsPosition, function( key ) { #>-->
<!--		<# if( data.footer.buttonsText[key] ){ #>-->
<!--			<a href="#" class="xoo-wsc-ft-btn ">{{{data.footer.buttonsText[key]}}} <# if( key === 'checkout' && data.footer.checkoutTotal === 'yes' ){ #> - --><?php //echo $subtotal; ?><!-- <# } #></a>-->
<!--		<# } #>-->
<!--	<# }) #>-->
<!---->
<!--</div>-->

