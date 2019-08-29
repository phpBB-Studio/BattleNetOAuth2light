<?php
/**
 *
 * phpBB Studio - Battle.net OAuth2. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, phpBB Studio, https://www.phpbbstudio.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

/**
* Some characters you may want to copy&paste: ’ » “ ” …
*/
$lang = array_merge($lang, [
	'AUTH_PROVIDER_OAUTH_SERVICE_STUDIO_BATTLENET_APAC'	=> '<span>Battle.net</span> APAC',
	'AUTH_PROVIDER_OAUTH_SERVICE_STUDIO_BATTLENET_CN'	=> '<span>Battle.net</span> CN',
	'AUTH_PROVIDER_OAUTH_SERVICE_STUDIO_BATTLENET_EU'	=> '<span>Battle.net</span> EU',
	'AUTH_PROVIDER_OAUTH_SERVICE_STUDIO_BATTLENET_US'	=> '<span>Battle.net</span> USA',

	'STUDIO_BNA_EXCEPTION_TOKEN'						=> 'Something went wrong requesting an Battle.net OAuth2 access token.<br />
															Did you perhaps refresh the page after linking an account?<br /><br />
															Original error message:<br />
															<samp class="error">%s</samp>',
	'STUDIO_BNA_EXCEPTION_USER_INFO'					=> 'Something went wrong requesting the Battle.net OAuth2 account information.<br /><br />
															Original error message:<br />
															<samp class="error">%s</samp>',

	// Translators please do not change the following line, no need to translate it!
	'PHPBBSTUDIO_BNA_CREDIT_LINE'						=> '<a href="https://phpbbstudio.com" target="_blank">Battle.net OAuth2 light</a> &copy; 2019 - phpBB Studio',
]);
