<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

function MailRu ($separator){
	// Initialise variables
    $plugin = JPluginHelper::getPlugin( 'system', 'SunStat' );
    $pluginParams = new JRegistry();
    $pluginParams->loadString($plugin->params);
	$mr_enabled 			= $pluginParams->get( 'mr_enabled', '' );
	$mr_noIndexWrapper 		= $pluginParams->get( 'mr_noindexWrapper', '1' );
	$mr_id 					= $pluginParams->get( 'mr_id', '' );

	$script		= '<!-- Rating Mail.ru counter --><script type="text/javascript">//<![CDATA[var _tmr = _tmr || [];_tmr.push({id: '.$mr_id.', type: "pageView", start: (new Date()).getTime()});(function (d, w) {   var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true;   ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js";   var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};   if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }})(document, window);//]]></script><noscript><div style="position:absolute;left:-10000px;"><img src="//top-fwz1.mail.ru/counter?id='.$mr_id.';js=na" style="border:0;" height="1" width="1" alt="Rating Mail.ru" /></noscript><!-- /Rating Mail.ru counter -->';
	if($mr_noIndexWrapper) $script = '<!--noindex-->' . $script . '<!--/noindex-->';

	if ($mr_enabled){return $script.$separator;} else {return '';}
}

function YandexMetrika ($separator){
	// Initialise variables
    $plugin = JPluginHelper::getPlugin( 'system', 'SunStat' );
    $pluginParams = new JRegistry();
    $pluginParams->loadString($plugin->params);
	$ym_enabled 			= $pluginParams->get( 'ym_enabled', '1' );
	$ym_noIndexWrapper 		= $pluginParams->get( 'ym_noindexWrapper', '1' );
	$ym_id 					= $pluginParams->get( 'ym_id', '000000' );
	$ym_yaParams			= $pluginParams->get( 'ym_yaParams', '' );
	$ym_trackHash			= $pluginParams->get( 'ym_trackHash', '' );
	$ym_webvisor 			= $pluginParams->get( 'ym_webvisor', '1' );
	$ym_clickMap 			= $pluginParams->get( 'ym_clickMap', '1' );
	$ym_linksOut 			= $pluginParams->get( 'ym_linksOut', '1' );
	$ym_accurateTrackBounce = $pluginParams->get( 'ym_accurateTrackBounce', '' );
	$ym_noIndex 			= $pluginParams->get( 'ym_noIndex', '1' );
    $ym_ecommerce 			= $pluginParams->get( 'ym_ecommerce', '1' );
    $ym_ecmdl 			    = $pluginParams->get( 'ym_ecmdl', 'dataLayer' );

	//Extended functions
	if ($ym_yaParams !='')          {$ym_ef_yaParams='<script type="text/javascript">var yaParams = {'.$ym_yaParams.'};</script>'; $ym_ef_yaParams2='params:window.yaParams||{ }';}
	                                                                                                    else{$ym_ef_yaParams=''; $ym_ef_yaParams2='';};
	if ($ym_webvisor)		        $ym_ef_webvisor	="webvisor:true, "; 	        			        else $ym_ef_webvisor='';
	if ($ym_clickMap)		        $ym_ef_clickmap	="clickmap:true, "; 						        else $ym_ef_clickmap='';
	if ($ym_linksOut)		        $ym_ef_linksout	="trackLinks:true, "; 			 			        else $ym_ef_linksout='';
	if ($ym_accurateTrackBounce)    $ym_ef_atb	="accurateTrackBounce:true, "; 					        else $ym_ef_atb='';
	if ($ym_trackHash)	            $ym_ef_trackhash="accurateTrackBounce:true, "; 				        else $ym_ef_trackhash='';
    if ($ym_ecommerce)		        $ym_ef_ecommerce	="ecommerce:\"'.$ym_ecmdl.'\","; 	 			else $ym_ef_ecommerce='';
	if ($ym_noIndex)                {$ym_ef_noindex	='ut:"noindex", '; $ym_ef_noindex2='?ut=noindex';} 	else {$ym_ef_noindex=''; $ym_ef_noindex2='';};

	$script		= '<!-- Yandex.Metrika counter -->' . $ym_ef_yaParams . '<script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter' . $ym_id . ' = new Ya.Metrika({id:' . $ym_id . ', ' .$ym_ef_webvisor.$ym_ef_clickmap.$ym_ef_linksout.$ym_ef_atb.$ym_ef_trackhash.$ym_ef_noindex.$ym_ef_yaParams2.$ym_ef_ecommerce.'}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/' . $ym_id .$ym_ef_noindex2. '" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->';
	if($ym_noIndexWrapper) $ym = '<!--noindex-->' . $script . '<!--/noindex-->';

	if ($ym_enabled){return $script.$separator;} else {return '';}
}

function GoogleAnalytics ($separator) {
	// Initialise variables
    $plugin = JPluginHelper::getPlugin( 'system', 'SunStat' );
    $pluginParams = new JRegistry();
    $pluginParams->loadString($plugin->params);
	$ga_enabled 			= $pluginParams->get( 'ga_enabled', '1' );
	$ga_legacy	 			= $pluginParams->get( 'ga_legacy', '0' );
	$ga_noIndexWrapper 		= $pluginParams->get( 'ga_noindexWrapper', '1' );
	$ga_id 					= $pluginParams->get( 'ga_id', '000000' );
	$ga_domain 				= $pluginParams->get( 'ga_domain', '' );
	$ga_uid 				= $pluginParams->get( 'ga_uid', '' );
	$ga_demographic			= $pluginParams->get( 'ga_demographic', '' );
	$ga_extattrib			= $pluginParams->get( 'ga_extattrib', '' );
	//Extended functions
	//Google Analytics
	if ($ga_demographic)$ga_ef_demographic	="ga('require', 'displayfeatures');"; 										 else $ga_ef_demographic='';
	if ($ga_extattrib) 	$ga_ef_extattrib	="ga('require', 'linkid', 'linkid.js');";									 else $ga_ef_extattrib='';
	if ($ga_uid) 		$ga_ef_uid			='ga(‘set’, ‘&uid’, {{USER_ID}});'; 										 else $ga_ef_uid='';
	//Google legacy
	if ($ga_demographic)$gal_ef_demographic	="ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';"; 										 else $gal_ef_demographic="ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';";
	if ($ga_extattrib) 	$gal_ef_extattrib	="var pluginUrl = '//www.google-analytics.com/plugins/ga/inpage_linkid.js'; _gaq.push(['_require', 'inpage_linkid', pluginUrl]);";						else $gal_ef_extattrib='';

	$script		= "<!-- Universal Analytics counter --><script type='text/javascript'>  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)  })(window,document,'script','//www.google-analytics.com/analytics.js','ga'); ga('create', 'UA-".$ga_id."', '".$ga_domain."'); ".$ga_ef_demographic.$ga_ef_extattrib." ga('send', 'pageview'); ".$ga_ef_uid." </script><!-- /Universal Analytics counter -->";
	if($ga_legacy) $script = "<!-- Google Analytics counter --><script type='text/javascript'>  var _gaq = _gaq || [];".$ga_ef_extattrib.$ga_ef_uid." _gaq.push(['_setAccount', 'UA-".$ga_id."]);  _gaq.push(['_setDomainName', 'none']);  _gaq.push(['_setAllowLinker', true]);_gaq.push(['_addDevId', 'YogEE'],['_trackPageview']);  (function() {    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;"    .$gal_ef_demographic.   " var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);  })();</script><!-- /Google Analytics counter -->";
	if($ga_noIndexWrapper) $script = '<!--noindex-->' . $script . '<!--/noindex-->';

	if ($ga_enabled){return $script.$separator;} else {return '';}
}

function PiwikCounter ($separator){
	// Initialise variables
    $plugin = JPluginHelper::getPlugin( 'system', 'SunStat' );
    $pluginParams = new JRegistry();
    $pluginParams->loadString($plugin->params);
	$pwk_enabled 			= $pluginParams->get( 'pwk_enabled', '1' );
	$pwk_noIndexWrapper 	= $pluginParams->get( 'pwk_noindexWrapper', '1' );
	$pwk_addDomain			= $pluginParams->get( 'pwk_addDomain', '' );
	$pwk_subdomains 		= $pluginParams->get( 'pwk_subdomains', '' );
	$pwk_linksOut 			= $pluginParams->get( 'pwk_linksOut', '' );
	$pwk_address 			= $pluginParams->get( 'pwk_address', '' );
	$pwk_domain 			= $pluginParams->get( 'pwk_domain', '' );
	//Extended functions
	if ($pwk_linksOut) 	$pwk_ef_linksOut	='_paq.push(["setDomains", ["*.'.$pwk_domain.'"]]); '; 						 else $pwk_ef_linksOut='';
	if ($pwk_subdomains)$pwk_ef_subdomains	='_paq.push(["setCookieDomain", "*.'.$pwk_domain.'"]); '; 					 else $pwk_ef_subdomains='';
	if ($pwk_addDomain)	$pwk_ef_addDomain	='_paq.push(["setDocumentTitle", document.domain + "/" + document.title]);'; else $pwk_ef_addDomain='';

	$script	= '<!-- Piwik counter --><script type="text/javascript">  var _paq = _paq || [];'.$pwk_ef_addDomain.$pwk_ef_subdomains.$pwk_ef_linksOut.'_paq.push(["trackPageView"]);  _paq.push(["enableLinkTracking"]);  (function() {    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://'.$pwk_address.'/";    _paq.push(["setTrackerUrl", u+"piwik.php"]);    _paq.push(["setSiteId", 1]);    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";    g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);  })();</script><noscript><p><img src="http://'.$pwk_domain.'/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript><!-- /Piwik counter -->';
	if($pwk_noIndexWrapper) $script = '<!--noindex-->' . $script . '<!--/noindex-->';

	if ($pwk_enabled){return $script.$separator;} else {return '';}
}

function LiveInternet ($separator) {
	// Initialise variables
    $plugin = JPluginHelper::getPlugin( 'system', 'SunStat' );
    $pluginParams = new JRegistry();
    $pluginParams->loadString($plugin->params);
	$li_enabled 			= $pluginParams->get( 'li_enabled', '1' );
	$li_noIndexWrapper 		= $pluginParams->get( 'li_noindexWrapper', '1' );

	$script	= '<!-- LiveInternet counter --><script type="text/javascript"><!--new Image().src = "//counter.yadro.ru/hit?r"+escape(document.referrer)+((typeof(screen)=="undefined")?"":";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+";"+Math.random();//--></script><!-- /LiveInternet counter -->';
	if($li_noIndexWrapper) $script = '<!--noindex-->' . $script . '<!--/noindex-->';

	if ($li_enabled){return $script.$separator;} else {return '';}
}

function OpenStat ($separator){
	// Initialise variables
    $plugin = JPluginHelper::getPlugin( 'system', 'SunStat' );
    $pluginParams = new JRegistry();
    $pluginParams->loadString($plugin->params);
	$os_enabled 			= $pluginParams->get( 'os_enabled', '1' );
	$os_identified			= $pluginParams->get( 'os_identified', '0' );
	$os_id 					= $pluginParams->get( 'os_id', '000000' );
	$os_noIndexWrapper 		= $pluginParams->get( 'os_noindexWrapper', '1' );
	//Extended functions
	if (!$os_identified) $os_id = 1;

	$script		= '<!--Openstat--><span id="openstat'.$os_id.'"></span><script type="text/javascript">var openstat = { counter: '.$os_id.', next: openstat };(function(d, t, p) {var j = d.createElement(t); j.async = true; j.type = "text/javascript";j.src = ("https:" == p ? "https:" : "http:") + "//openstat.net/cnt.js";var s = d.getElementsByTagName(t)[0]; s.parentNode.insertBefore(j, s);})(document, "script", document.location.protocol);</script><!--/Openstat-->';
	if($os_noIndexWrapper) $script = '<!--noindex-->' . $script . '<!--/noindex-->';

	if ($os_enabled){return $script.$separator;} else {return '';}
}

function HotLog ($separator){
	// Initialise variables
    $plugin = JPluginHelper::getPlugin( 'system', 'SunStat' );
    $pluginParams = new JRegistry();
    $pluginParams->loadString($plugin->params);
	$hl_enabled 			= $pluginParams->get( 'hl_enabled', '1' );
	$hl_noIndexWrapper 		= $pluginParams->get( 'hl_noindexWrapper', '1' );
	$hl_id 					= $pluginParams->get( 'hl_id', '000000' );

	$script		= "<!-- HotLog counter --><span id='hotlog_counter'></span><span id='hotlog_dyn'></span><script type='text/javascript'> var hot_s = document.createElement('script'); hot_s.type = 'text/javascript'; hot_s.async = true; hot_s.src = 'http://js.hotlog.ru/dcounter/" . $hl_id ."; hot_d = document.getElementById('hotlog_dyn');hot_d.appendChild(hot_s);</script><noscript><a href='http://click.hotlog.ru/?" . $hl_id ."' target='_blank'><img src='http://hit.hotlog.ru/cgi-bin/hotlog/count?s=" . $hl_id ."&amp;im=307' border='0' alt='HotLog'></a></noscript><!-- /HotLog counter -->";
	if($hl_noIndexWrapper) $script = '<!--noindex-->' . $script . '<!--/noindex-->';

	if ($hl_enabled){return $script.$separator;} else {return '';}
}

function RamblerTop ($separator){
	// Initialise variables
    $plugin = JPluginHelper::getPlugin( 'system', 'SunStat' );
    $pluginParams = new JRegistry();
    $pluginParams->loadString($plugin->params);
	$rr_enabled 			= $pluginParams->get( 'rr_enabled', '1' );
	$rr_noIndexWrapper 		= $pluginParams->get( 'rr_noindexWrapper', '1' );
	$rr_id 					= $pluginParams->get( 'rr_id', '' );

	$script		= '<!-- Rambler counter --><script id="top100Counter" type="text/javascript" src="http://counter.rambler.ru/top100.jcn?'. $rr_id .'"></script><noscript><a href="http://top100.rambler.ru/navi/'. $rr_id .'/"><img src="http://counter.rambler.ru/top100.cnt?'. $rr_id .'" alt="Ramblers Top100" border="0" /></a></noscript><!-- /Rambler counter -->';
	if($rr_noIndexWrapper) $script = '<!--noindex-->' . $script . '<!--/noindex-->';

	if ($rr_enabled){return $script.$separator;} else {return '';}
}