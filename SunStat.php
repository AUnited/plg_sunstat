<?php
# @version		$version 1.0 Amvis United Company Limited  $
# @copyright	Copyright (C) 2012 AUnited Co Ltd. All rights reserved.
# @license		GNU/GPL, see LICENSE.php
# Updated		28th Dec 2013
#
# Site: http://amvis.ru
# Email: info@amvis.ru
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

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin');

class plgSystemSunStat extends JPlugin
{
	function plgSunStat(&$subject, $config)
	{		
		parent::__construct($subject, $config);
		$this->_plugin = JPluginHelper::getPlugin( 'system', 'SunStat' );
		$this->_params = new JParameter( $this->_plugin->params );
	}
	
	function onAfterRender()
	{
        $app = JFactory::getApplication();
        if($app->isAdmin())
        {
            return;
        }
		// Initialise variables
		//mailru
		$mr_enabled = $this->params->get( 'mr_enabled', '' );
		$mr_noIndexWrapper = $this->params->get( 'mr_noindexWrapper', '1' );
		$mr_id = $this->params->get( 'mr_id', '' );
        $mr_noIndex = $this->params->get( 'mr_noIndex', '' );
		//yandex metrika
		$ym_enabled = $this->params->get( 'ym_enabled', '' );
		$ym_noIndexWrapper = $this->params->get( 'ym_noindexWrapper', '1' );
		$ym_id = $this->params->get( 'ym_id', '' );
        $ym_webvisor = $this->params->get( 'ym_webvisor', '' );
		$ym_clickMap = $this->params->get( 'ym_clickMap', '' );
        $ym_linksOut = $this->params->get( 'ym_linksOut', '' );
        $ym_accurateTrackBounce = $this->params->get( 'ym_accurateTrackBounce', '' );
        $ym_noIndex = $this->params->get( 'ym_noIndex', '' );
		//google analytics
		$ga_enabled = $this->params->get( 'ga_enabled', '' );
		$ga_noIndexWrapper = $this->params->get( 'ga_noindexWrapper', '1' );
		$ga_id = $this->params->get( 'ga_id', '' );
		$ga_domain = $this->params->get( 'ga_domain', '' );
		//piwik
		$pwk_enabled = $this->params->get( 'pwk_enabled', '' );
		$pwk_noIndexWrapper = $this->params->get( 'pwk_noindexWrapper', '1' );
		$pwk_subdomains = $this->params->get( 'pwk_subdomains', '' );
		$pwk_addDomain = $this->params->get( 'pwk_addDomain', '' );
		$pwk_linksOut = $this->params->get( 'pwk_linksOut', '' );
		$pwk_address = $this->params->get( 'pwk_address', '' );
		$pwk_domain = $this->params->get( 'pwk_domain', '' );
		//liveinternet
		$li_enabled = $this->params->get( 'li_enabled', '' );
		$li_noIndexWrapper = $this->params->get( 'li_noindexWrapper', '1' );
		
		//getting body code and storing as buffer
		$buffer = JResponse::getBody();
		
		//embed code
        $noIndex = $noIndex ? 'ut:"noindex",' : '';

        $mr = '<!-- Rating@Mail.ru counter --><script type="text/javascript">//<![CDATA[var _tmr = _tmr || [];_tmr.push({id: '.$mr_id.', type: "pageView", start: (new Date()).getTime()});(function (d, w) {   var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true;   ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js";   var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};   if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }})(document, window);//]]></script><noscript><div style="position:absolute;left:-10000px;"><img src="//top-fwz1.mail.ru/counter?id='.$mr_id.';js=na" style="border:0;" height="1" width="1" alt="Рейтинг@Mail.ru" /></noscript><!-- //Rating@Mail.ru counter -->';
		if($mr_noIndexWrapper) $mr = '<!--noindex-->' . $mr . '<!--/noindex-->';
		$ym = '<!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter' . $ym_id . ' = new Ya.Metrika({id:' . $ym_id . ', clickmap:' . $ym_clickMap . ', trackLinks:' . $ym_linksOut . ', accurateTrackBounce:' . $ym_accurateTrackBounce  . ','. $ym_noIndex . ' webvisor:' . $ym_webvisor . '}); } catch(e) {} }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/' . $ym_id . '" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->';
		if($ym_noIndexWrapper) $ym = '<!--noindex-->' . $ym . '<!--/noindex-->';
		$ga = "<!-- Google Analytics counter --><script type='text/javascript'>  var _gaq = _gaq || [];  _gaq.push(['_setAccount', 'UA-".$ga_id."]);  _gaq.push(['_setDomainName', 'none']);  _gaq.push(['_setAllowLinker', true]);_gaq.push(['_addDevId', 'YogEE'],['_trackPageview']);  (function() {    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);  })();</script><!-- End of Google Analytics code -->";		
		if($ga_noIndexWrapper) $ga = '<!--noindex-->' . $ga . '<!--/noindex-->';
		$li = '<!--LiveInternet counter--><script type="text/javascript"><!--new Image().src = "//counter.yadro.ru/hit?r"+escape(document.referrer)+((typeof(screen)=="undefined")?"":";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+";"+Math.random();//--></script><!--/LiveInternet-->';
		if($li_noIndexWrapper) $li = '<!--noindex-->' . $li . '<!--/noindex-->';
		$pwk = '<!-- Piwik --><script type="text/javascript">  var _paq = _paq || [];  _paq.push(["setDocumentTitle", document.domain + "/" + document.title]);  _paq.push(["setCookieDomain", *.'.$pwk_domain.'"]);  _paq.push(["setDomains", ["*.'.$pwk_domain.'"]]);  _paq.push(["trackPageView"]);  _paq.push(["enableLinkTracking"]);  (function() {    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://'.$pwk_address.'";    _paq.push(["setTrackerUrl", u+"piwik.php"]);    _paq.push(["setSiteId", "1"]);    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";    g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);  })();</script><!-- End Piwik Code -->';
		if($pwk_noIndexWrapper) $pwk = '<!--noindex-->' . $pwk . '<!--/noindex-->';
		
		//is it enabled?
		$javascript='';
        if ($mr_enabled) $javascript= $mr.$javascript;
		if ($ym_enabled) $javascript= $ym.$javascript;
		if ($ga_enabled) $javascript= $ga.$javascript;
		if ($li_enabled) $javascript= $li.$javascript;
		if ($pwk_enabled) $javascript= $pwk.$javascript;

		$buffer = preg_replace ("/<\/body>/", $javascript."\n\n</body>", $buffer);
		
		//output the buffer
		JResponse::setBody($buffer);
		
		return true;
	}
}
?>