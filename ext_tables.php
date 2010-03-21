<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}
$tempColumns = array(
	'tx_jquery_fancybox_group' => array(		
		'exclude' => 1,		
		'label' => 'LLL:EXT:jquery_fancybox/locallang_db.xml:tt_content.tx_jquery_fancybox_group',		
		'config' => Array (
			'type' => 'check',
		)
	),
	'tx_jquery_fancybox_swf' => array(		
		'exclude' => 1,		
		'label' => 'LLL:EXT:jquery_fancybox/locallang_db.xml:tt_content.tx_jquery_fancybox_swf',		
		'config' => Array (
			'type' => 'check',
		)
	),
);
t3lib_div::loadTCA('tt_content');
t3lib_extMgm::addTCAcolumns('tt_content', $tempColumns, 1);
t3lib_extMgm::addStaticFile($_EXTKEY,'static/fancybox/', 'FancyBox');
$GLOBALS['TCA']['tt_content']['palettes']['7']['showitem'] .= ', tx_jquery_fancybox_group, tx_jquery_fancybox_swf';
?>