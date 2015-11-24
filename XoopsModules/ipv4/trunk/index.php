<?php
/**
 * Private message module
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         pm
 * @since           2.3.0
 * @author          Jan Pedersen
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 * @version         $Id: index.php 12033 2013-09-14 03:16:44Z beckmi $
 */

require ( "../../mainfile.php");

if ($GLOBALS['xoopsModuleConfig']['htaccess'])
	if (strpos($_SERVER['REQUEST_URI'], 'odules/')>0) {
		$uri = XOOPS_URL.'/'.$GLOBALS['xoopsModuleConfig']['base_url'].'/debt'.$GLOBALS['xoopsModuleConfig']['end_url'];
		header( "HTTP/1.1 301 Moved Permanently" );
		header('Location: '.$uri);	
	}

$fee = 0.50 * 4294967296;
$interest = 0.27;
$period = 3600 * 24 * 7 * 4;
$when = strtotime("2008-12-08");

$segments = array();
$due = $fee;
if ($when < time())
{
	$j = $when; 
	while($j < time())
	{
		$j = $j + $period;
		$segments[date("D, d-m-Y",$j)] = number_format($due * $interest, 2);
		$due = $due + ($due * $interest);
	}
}

$xoopsOption['template_main'] = 'ipv4_index.tpl';
include $GLOBALS['xoops']->path('header.php');

$GLOBALS['xoopsTpl']->assign('when', date("D, d-m-Y", $when));
$GLOBALS['xoopsTpl']->assign('fee', number_format($fee,2));
$GLOBALS['xoopsTpl']->assign('due', number_format($due, 2));
$GLOBALS['xoopsTpl']->assign('interest', $segments);
	$GLOBALS['xoopsTpl']->assign('xoops_pagetitle', "IPv4 -- $ " . number_format($due, 2) . " AUD due Right now IP Address Stack 2 @ChronolabsCoop");	
include $GLOBALS['xoops']->path('footer.php');
