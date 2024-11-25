<?php
$value = $args['value'] ?? null;
if($value) :
?>
    <div class="text-content__visible">
        <h2>
            <?php echo $value['title'];?>
        </h2>
        <p>
            <?php echo $value['content'];?>
        </p>
    </div>


<?php  endif;?>
