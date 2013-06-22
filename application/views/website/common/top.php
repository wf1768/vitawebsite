<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="top"><a href="<?php echo site_url('w/main') ?>"><img src="<?php echo base_url('public/website/images/logo.png') ?>" width="98" height="42"></a></div>
<div class="menu_top">
     <div style="width:1%; float:left">&nbsp;</div>
    <p id="furniture" style="width:9%"><img class="n1" src="<?php echo base_url('public/website/images/left_topmenu.png') ?>" width="55" height="33"/><img class="n2" src="<?php echo base_url('public/website/images/left_topmenuhover.png') ?>" width="55" height="33"/></p>
    <ul id="furniture_menu"  style="width:80%">
        <?php if ($product_brand_furniture) : ?>
            <?php foreach ($product_brand_furniture as $furn) : ?>
                <li id="<?php echo $furn->id ?>">
                    <a href="<?php echo site_url('w/product/product_get').'?brandid='.$furn->id.'&type=brand' ?>">
                        <img class="n1" src="<?php echo base_url($furn->imagepath) ?>" /><!-- 默认 -->
                        <img class="n2" src="<?php echo base_url($furn->imagepathchange) ?>"/><!-- 选中 -->
                    </a>
                </li>
            <?php endforeach ?>
        <?php endif ?>
    </ul>
    <div style="width:10%;float:right">&nbsp;</div>
</div>
<?php if ($product_brand_housewares) : ?>
<div class="mid_top">
    <div style="width:1%; float:left">&nbsp;</div>
    <p id="housewares" style="width:9%">
        <img class="n1" src="<?php echo base_url('public/website/images/left_midmenu.png') ?>" width="76" height="33"/>
        <img class="n2" src="<?php echo base_url('public/website/images/left_midmenuhover.png') ?>" width="76" height="33"/>
    </p>
    <ul id="housewares_menu" style="width:80%">
    <?php foreach ($product_brand_housewares as $house) : ?>
            <li id="<?php echo $house->id ?>">
                <a href="<?php echo site_url('w/product/product_get').'?brandid='.$house->id.'&type=brand' ?>">
                    <img class="n1" src="<?php echo base_url($house->imagepath) ?>" /><!-- 默认 -->
                    <img class="n2" src="<?php echo base_url($house->imagepathchange) ?>"/><!-- 选中 -->
                </a>
            </li>
    <?php endforeach ?>
    </ul>
    <div style="width:10%;float:right">&nbsp;</div>
</div>
<?php endif ?>