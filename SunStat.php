<?php
# @version		$version 1.0 Amvis United Company Limited  $
# @copyright	Copyright (C) 2016 AUnited Co Ltd. All rights reserved.
# @license		SunStat 1.0 by Vitaliy Zhukov licensed under Apache v2.0, see LICENSE
# Updated		17st October 2016
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

#Prefixes
# mr_ = MailRu
# ym_ = Yandex
# ga_ = Google
# pwk_ = Piwik
# li_ = LiveInternet
# hl_ = Hotlog
# rr_ = Rambler
# os_ = OpenStat (SpyLog)

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
		$params = $this->params;
        $separator = $params->get( 'separator', 'enter' );
        switch ($separator)
        {
            case 'none': $separator=''; break;
            case 'space': $separator=' '; break;
            case 'enter': $separator='
            '; break;
            case 'paragraph': $separator='
            
            '; break;
        }

       include_once ('functions.php');

		//getting body code and storing as buffer
		$buffer = JResponse::getBody();

		//output and separate

        $javascript=MailRu($separator).YandexMetrika($separator).GoogleAnalytics($separator).PiwikCounter($separator).LiveInternet($separator).OpenStat($separator).HotLog($separator).RamblerTop($separator);

		$buffer = preg_replace ("/<body>/", "</body>\n\n.$javascript", $buffer);
		
		//output the buffer
		JResponse::setBody($buffer);
		
		return true;
	}
}
?>
