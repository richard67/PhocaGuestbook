<?php
/* @package Joomla
 * @copyright Copyright (C) Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @extension Phoca Extension
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.html.pagination');
class PhocaGuestbookPaginationPosts extends JPagination
{
	function getLimitBox() {
		$app	= JFactory::getApplication();
		$paramsC 			= JComponentHelper::getParams('com_phocaguestbook') ;
		$pagination 		= $paramsC->get( 'pagination_posts', '5,10,15,20' );
		$paginationArray	= explode( ',', $pagination );
		
		// Initialize variables
		$limits = array ();

		foreach ($paginationArray as $paginationValue) {
			$limits[] = JHTML::_('select.option', $paginationValue);
		}
		$limits[] = JHTML::_('select.option', '0', JText::_('COM_PHOCAGUESTBOOK_ALL'));

		$selected = $this->viewall ? 0 : $this->limit;

		// Build the select list
		if ($app->isAdmin()) {
			$html = JHTML::_('select.genericlist',  $limits, 'limit', 'class="inputbox input-mini" size="1" onchange="Joomla.submitform();"', 'value', 'text', $selected);
		} else {
			$html = JHTML::_('select.genericlist',  $limits, 'limit', 'class="inputbox input-mini" size="1" onchange="this.form.submit()"', 'value', 'text', $selected);
		}
		return $html;
	}
}
?>