<?php if ($direction == 'rtl') { ?>
<link rel="stylesheet" type="text/css" href="catalog/view/supermenu/supermenu-rtl.css?v=23" />
<script type="text/javascript" src="catalog/view/supermenu/supermenu-responsive-rtl.js?v=23"></script>
<?php } else { ?>
<link rel="stylesheet" type="text/css" href="catalog/view/supermenu/supermenu.css?v=23" />
<script type="text/javascript" src="catalog/view/supermenu/supermenu-responsive.js?v=23"></script>
<?php } ?>
<?php if ($usehoverintent) { ?>
<script type="text/javascript" src="catalog/view/supermenu/jquery.hoverIntent.minified.js"></script>
<?php } ?>
<?php if ($supermenu_settings_status) { ?>
<style type="text/css">
<?php if ($supermenu_settings['fontf']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> { font-family: <?php echo $supermenu_settings['fontf']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['topfont']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li a.tll { font-size: <?php echo $supermenu_settings['topfont']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['dropfont']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div a { font-size: <?php echo $supermenu_settings['dropfont']; ?> !important; }
<?php } ?>
<?php if ($supermenu_settings['bg'] && $supermenu_settings['bg2']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> { 
    background-color:<?php echo $supermenu_settings['bg']; ?>;
	background-image: linear-gradient(to bottom, <?php echo $supermenu_settings['bg']; ?>, <?php echo $supermenu_settings['bg2']; ?>);
	background-repeat: repeat-x;
	border: none;
	-moz-box-shadow: none;
	-webkit-box-shadow: none;
	box-shadow: none;
 }
<?php } elseif ($supermenu_settings['bg'] && !$supermenu_settings['bg2']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> { background:<?php echo $supermenu_settings['bg']; ?>;
	border: none;
	-moz-box-shadow: none;
	-webkit-box-shadow: none;
	box-shadow: none; }
<?php } elseif (!$supermenu_settings['bg'] && $supermenu_settings['bg2']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> { background:<?php echo $supermenu_settings['bg2']; ?>;
	border: none;
	-moz-box-shadow: none;
	-webkit-box-shadow: none;
	box-shadow: none; }
<?php } ?>
<?php if ($supermenu_settings['tmborderpx'] && $supermenu_settings['tmborders'] && $supermenu_settings['tmbordero'] && $supermenu_settings['tmborderc']) { ?>
	<?php if ($supermenu_settings['tmborderpx'] != 'default') { ?>
#supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> { 
		<?php if ($supermenu_settings['tmbordero'] == 'all-around') { ?>
border: <?php echo $supermenu_settings['tmborderpx']; ?> <?php echo $supermenu_settings['tmborders']; ?> <?php echo $supermenu_settings['tmborderc']; ?>; 
		<?php } else {?>
border-<?php echo $supermenu_settings['tmbordero']; ?>: <?php echo $supermenu_settings['tmborderpx']; ?> <?php echo $supermenu_settings['tmborders']; ?> <?php echo $supermenu_settings['tmborderc']; ?>; 		
		<?php } ?>
	}
	<?php } ?>
<?php } ?>
<?php if ($supermenu_settings['tlc']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li a.tll { color: <?php echo $supermenu_settings['tlc']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['tlch']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li.tlli:hover a.tll { color: <?php echo $supermenu_settings['tlch']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['tlcts']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li a.tll { text-shadow: 0px 1px 1px <?php echo $supermenu_settings['tlcts']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['tlchts']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li.tlli:hover a.tll { text-shadow: 0px 1px 1px <?php echo $supermenu_settings['tlchts']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['tlb']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li.tlli:hover a.tll { background: <?php echo $supermenu_settings['tlb']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['dbg']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div.bigdiv { background: <?php echo $supermenu_settings['dbg']; ?>; }
<?php if (!$supermenu_settings['fybg']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div.bigdiv.withflyout > .withchildfo > .flyouttoright { background: <?php echo $supermenu_settings['dbg']; ?>; }
<?php } ?>
<?php } ?>
<?php if ($supermenu_settings['slborderpx'] && $supermenu_settings['slborders'] && $supermenu_settings['slbordero'] && $supermenu_settings['slborderc']) { ?>
	<?php if ($supermenu_settings['slborderpx'] != 'default') { ?>
#supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div.bigdiv { 
		<?php if ($supermenu_settings['slbordero'] == 'all-around') { ?>
border: <?php echo $supermenu_settings['slborderpx']; ?> <?php echo $supermenu_settings['slborders']; ?> <?php echo $supermenu_settings['slborderc']; ?>; 
		<?php } else {?>
border: none;
border-<?php echo $supermenu_settings['slbordero']; ?>: <?php echo $supermenu_settings['slborderpx']; ?> <?php echo $supermenu_settings['slborders']; ?> <?php echo $supermenu_settings['slborderc']; ?>; 		
		<?php } ?>
	}
	<?php } ?>
<?php } ?>
<?php if ($supermenu_settings['dic']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div .withchild a.theparent, #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div .dropbrands ul li a, #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div .withimage .name a { color: <?php echo $supermenu_settings['dic']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['dich']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div .withchild a.theparent:hover, #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div .withimage .name a:hover, #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div .dropbrands ul li a:hover { color: <?php echo $supermenu_settings['dich']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['dib']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div .withchild a.theparent { background: <?php echo $supermenu_settings['dib']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['dibh']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div .withchild a.theparent:hover { background: <?php echo $supermenu_settings['dibh']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['diborderpx'] && $supermenu_settings['diborders'] && $supermenu_settings['dibordero'] && $supermenu_settings['diborderc']) { ?>
	<?php if ($supermenu_settings['diborderpx'] != 'default') { ?>
#supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div .withchild a.theparent { 
		<?php if ($supermenu_settings['dibordero'] == 'all-around') { ?>
border: <?php echo $supermenu_settings['diborderpx']; ?> <?php echo $supermenu_settings['diborders']; ?> <?php echo $supermenu_settings['diborderc']; ?>; 
		<?php } else {?>
border-<?php echo $supermenu_settings['dibordero']; ?>: <?php echo $supermenu_settings['diborderpx']; ?> <?php echo $supermenu_settings['diborders']; ?> <?php echo $supermenu_settings['diborderc']; ?>; 		
		<?php } ?>
	}
	<?php } ?>
<?php } ?>
<?php if ($supermenu_settings['slc']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div .withchild ul.child-level li a, #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div .withimage .name ul a { color: <?php echo $supermenu_settings['slc']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['slch']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div .withchild ul.child-level li a:hover, #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div .withimage .name ul a:hover { color: <?php echo $supermenu_settings['slch']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['slb']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div .withchild ul.child-level li a { background: <?php echo $supermenu_settings['slb']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['slbh']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div .withchild ul.child-level li a:hover { background: <?php echo $supermenu_settings['slbh']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['fybg']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div.bigdiv.withflyout > .withchildfo > .flyouttoright { background: <?php echo $supermenu_settings['fybg']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['flyic']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> .withchildfo > a.theparent { color: <?php echo $supermenu_settings['flyic']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['flyich']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> .withchildfo:hover > a.theparent { color: <?php echo $supermenu_settings['flyich']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['flyiborderpx'] && $supermenu_settings['flyiborders'] && $supermenu_settings['flyibordero'] && $supermenu_settings['flyiborderc']) { ?>
	<?php if ($supermenu_settings['flyiborderpx'] != 'default') { ?>
#supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> .withchildfo { 
		<?php if ($supermenu_settings['flyibordero'] == 'all-around') { ?>
border: <?php echo $supermenu_settings['flyiborderpx']; ?> <?php echo $supermenu_settings['flyiborders']; ?> <?php echo $supermenu_settings['flyiborderc']; ?>; 
		<?php } else {?>
border-<?php echo $supermenu_settings['flyibordero']; ?>: <?php echo $supermenu_settings['flyiborderpx']; ?> <?php echo $supermenu_settings['flyiborders']; ?> <?php echo $supermenu_settings['flyiborderc']; ?>; 		
		<?php } ?>
	}
	<?php } ?>
<?php } ?>
<?php if (isset($supermenu_settings['expbm'])) { ?>
<?php if ($supermenu_settings['expbm']) { ?>
#supermenu.respsmall<?php echo ($skin) ? '.'.$skin : ''; ?> .superdropper span, #supermenu.respsmall .withchildfo.hasflyout .superdropper span { background-color: <?php echo $supermenu_settings['expbm']; ?>; }
<?php } ?>
<?php } ?>
<?php if (isset($supermenu_settings['expbmc'])) { ?>
<?php if ($supermenu_settings['expbmc']) { ?>
#supermenu.respsmall<?php echo ($skin) ? '.'.$skin : ''; ?> .superdropper span, #supermenu.respsmall .withchildfo.hasflyout .superdropper span { color: <?php echo $supermenu_settings['expbmc']; ?>; }
<?php } ?>
<?php } ?>
<?php if (isset($supermenu_settings['expbme'])) { ?>
<?php if ($supermenu_settings['expbme']) { ?>
#supermenu.respsmall<?php echo ($skin) ? '.'.$skin : ''; ?> .superdropper span + span, #supermenu.respsmall .withchildfo.hasflyout.exped .superdropper span + span { background-color: <?php echo $supermenu_settings['expbme']; ?>; }
<?php } ?>
<?php } ?>
<?php if (isset($supermenu_settings['expbmec'])) { ?>
<?php if ($supermenu_settings['expbmec']) { ?>
#supermenu.respsmall<?php echo ($skin) ? '.'.$skin : ''; ?> .superdropper span + span, #supermenu.respsmall .withchildfo.hasflyout.exped .superdropper span + span { color: <?php echo $supermenu_settings['expbmec']; ?>; }
<?php } ?>
<?php } ?>
<?php if ($supermenu_settings['flyib']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> .withchildfo:hover { background: <?php echo $supermenu_settings['flyib']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['drtc']) { ?>
 #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div.bigdiv .headingoftopitem h2 a, #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div.bigdiv .headingoftopitem h2, #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div .dropbrands span { color: <?php echo $supermenu_settings['drtc']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['drtborderpx'] && $supermenu_settings['drtborders'] && $supermenu_settings['drtbordero'] && $supermenu_settings['drtborderc']) { ?>
	<?php if ($supermenu_settings['drtborderpx'] != 'default') { ?>
#supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div.bigdiv .headingoftopitem, #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div .dropbrands span { 
		<?php if ($supermenu_settings['drtbordero'] == 'all-around') { ?>
border: <?php echo $supermenu_settings['drtborderpx']; ?> <?php echo $supermenu_settings['drtborders']; ?> <?php echo $supermenu_settings['drtborderc']; ?>; 
		<?php } else {?>
border-<?php echo $supermenu_settings['drtbordero']; ?>: <?php echo $supermenu_settings['drtborderpx']; ?> <?php echo $supermenu_settings['drtborders']; ?> <?php echo $supermenu_settings['drtborderc']; ?>; 		
		<?php } ?>
	}
	<?php } ?>
<?php } ?>
<?php if ($supermenu_settings['pricec']) { ?>
#supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div .withimage .dropprice { color: <?php echo $supermenu_settings['pricec']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['pricech']) { ?>
#supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div .withimage .dropprice span { color: <?php echo $supermenu_settings['pricech']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['valc']) { ?>
#supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div.bigdiv .linkoftopitem a { color: <?php echo $supermenu_settings['valc']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['valch']) { ?>
#supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div.bigdiv .linkoftopitem a:hover { color: <?php echo $supermenu_settings['valch']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['valb'] && $supermenu_settings['valb2']) { ?>
#supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div.bigdiv .linkoftopitem a {
    background-color:<?php echo $supermenu_settings['valb']; ?>;
    background-image: linear-gradient(to bottom, <?php echo $supermenu_settings['valb']; ?>, <?php echo $supermenu_settings['valb2']; ?>);
	background-repeat: repeat-x;
 }
#supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div.bigdiv .linkoftopitem a:hover {
    background-color:<?php echo $supermenu_settings['valb2']; ?>;
    background-image: linear-gradient(to bottom, <?php echo $supermenu_settings['valb2']; ?>, <?php echo $supermenu_settings['valb']; ?>);
	background-repeat: repeat-x;
 }
<?php } elseif ($supermenu_settings['valb'] && !$supermenu_settings['valb2']) { ?>
#supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div.bigdiv .linkoftopitem a, #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div.bigdiv .linkoftopitem a:hover { background-image: none; background-color:<?php echo $supermenu_settings['valb']; ?>; }
<?php } elseif (!$supermenu_settings['valb'] && $supermenu_settings['valb2']) { ?>
#supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div.bigdiv .linkoftopitem a, #supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div.bigdiv .linkoftopitem a:hover { background-image: none; background-color:<?php echo $supermenu_settings['valb2']; ?>; }
<?php } ?>
<?php if ($supermenu_settings['valborderpx'] && $supermenu_settings['valborders'] && $supermenu_settings['valbordero'] && $supermenu_settings['valborderc']) { ?>
	<?php if ($supermenu_settings['valborderpx'] != 'default') { ?>
#supermenu<?php echo ($skin) ? '.'.$skin : ''; ?> ul li div.bigdiv .linkoftopitem a { 
		<?php if ($supermenu_settings['valbordero'] == 'all-around') { ?>
border: <?php echo $supermenu_settings['valborderpx']; ?> <?php echo $supermenu_settings['valborders']; ?> <?php echo $supermenu_settings['valborderc']; ?>; 
		<?php } else {?>
border: 0px;
border-<?php echo $supermenu_settings['valbordero']; ?>: <?php echo $supermenu_settings['valborderpx']; ?> <?php echo $supermenu_settings['valborders']; ?> <?php echo $supermenu_settings['valborderc']; ?>; 		
		<?php } ?>
	}
	<?php } ?>
<?php } ?>
</style>
<?php } ?>