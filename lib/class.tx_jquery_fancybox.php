<?php
/***************************************************************
*  Copyright notice
*  
*  (c) 2009 Arnd Messer <typo3@civit.de>
*  All rights reserved
*
*  This script is part of the Typo3 project. The Typo3 project is 
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
* 
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
* 
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/** 
 * Script 'class.tx_jquery_fancybox.php'
 *
 * @author	Arnd Messer <typo3@civit.de>
 */

class tx_jquery_fancybox {
	
	/**
     * Content object
     * @var object
     */
    public $cObj;

	/**
     * Extension Key
     * @var string
     */
    public $extKey = 'jquery_fancybox';

	/**
	 * Main function 
	 *
	 * @param array	$content:
	 * @param array	$conf: 
	 */
    public function main($content,$conf) {
    	
		// uid of the curent content element
		$uid = $this->cObj->data['uid'];
		
		// if titleText is set
		if ($this->cObj->data['image_zoom'] != '') {
			// fetch TypoScript Configuration for titleText
			$titleTextConfiguration = $GLOBALS['TSFE']->tmpl->setup['tt_content.']['image.']['20.']['1.']['titleText.'];
			// parse through cObject TEXT
			$titleText = $this->cObj->TEXT($titleTextConfiguration);
			if ($titleText) {
				$titleParams = ' title="' . $titleText . '" ';
			}
		}

		// if tt_content.image_zoom is true
    	if ($this->cObj->data['image_zoom'] == 1) {
			$fancyboxParams = 'class="fancybox"';
			#$this->additionalHeaderData();
		}

		// if tt_content.image_zoom AND tt_content.tx_jquery_fancybox_group is true
		if ($this->cObj->data['image_zoom']==1 && $this->cObj->data['tx_jquery_fancybox_group']==1) {
			$fancyboxParams = 'class="fancybox" rel="fancybox-group-'.$uid.'"';
		}
		
		// Open swf Content if tt_content.image_link AND tt_content.tx_jquery_fancybox_sef is true
		if ($this->cObj->data['image_link'] != '' && $this->cObj->data['tx_jquery_fancybox_swf']==1) {
			$fancyboxParams = 'class="fancybox-swf"';
		}

		return '<a href="'.$content["url"].'"'.$content["targetParams"].' '.$content["aTagParams"].' '.$titleParams . $fancyboxParams.'>';
    }

	/**
	 * Insert HeaderData
	 *
	 */
	function additionalHeaderData() {
		$GLOBALS['TSFE']->additionalHeaderData['tx_jquery_fancybox'] = '
	
	<script src="' . t3lib_extMgm::siteRelpath($this->extKey) . 'res/jquery.fancybox-1.2.6.js" type="text/javascript"></script>
	<link href="' . t3lib_extMgm::siteRelpath($this->extKey) . 'res/jquery.fancybox-1.2.6.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
		$(document).ready(function() {
			$("a.fancybox").fancybox({
				\'padding\': 2
			});
		});
	</script>
		';
	}
}

// XCLASS inclusion code
if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/jquery_fancybox/lib/class.tx_jquery_fancybox.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/jquery_fancybox/lib/class.tx_jquery_fancybox.php']);
}
?>