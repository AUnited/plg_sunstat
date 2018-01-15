<?php
# @version		$version 1.0 Amvis United Company Limited  $
# @copyright	Copyright (C) 2016 AUnited Co Ltd. All rights reserved.
# @license		SunStat 1.0 by Vitaliy Zhukov licensed under Apache v2.0, see LICENSE
# Updated		15st January 2018
#
# Site: http://aunited.ru
# Email: info@aunited.ru
# Phone
#
# Joomla! is free software. This version may have been modified pursuant
# to the GNU General Public License, and as distributed it includes or
# is derivative of works licensed under the GNU General Public License or
# other free or open source software licenses.
# See COPYRIGHT.php for copyright notices and details.

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin');

class plgSystemSunStat extends JPlugin
{
	function plgSunStat(&$subject, $config)
	{		
		parent::__construct($subject, $config);
		$this->_plugin = JPluginHelper::getPlugin( 'system', 'SunStat' );
		$params = new JParameter( $this->_plugin->params );
		return $params;
	}
	
	function onAfterRender()
	{
        $app = JFactory::getApplication();
        if($app->isAdmin())
        {
            return;
        }
        $plugin = JPluginHelper::getPlugin( 'system', 'SunStat' );
        $pluginParams = new JRegistry();
        $pluginParams->loadString($plugin->params);
        $separator = $pluginParams->get( 'separator', 'enter' );
        switch ($separator)
        {
            case "none": $separator=""; break;
            case "space": $separator=""; break;
            case "enter": $separator="
            "; break;
            case "paragraph": $separator="
            
            "; break;
            default: $separator=" 
            "; break;  //Debug only, never must be used
        }

       include_once ('functions.php');

        $javascript=MailRu($separator).YandexMetrika($separator).GoogleAnalytics($separator).PiwikCounter($separator).LiveInternet($separator).OpenStat($separator).HotLog($separator).RamblerTop($separator);

        //getting body code, changing and writing
		$buffer = JResponse::getBody();
		$buffer = str_replace ("</body>", $javascript."</body>", $buffer);
		JResponse::setBody($buffer);
		
		return true;
	}
}
?>
