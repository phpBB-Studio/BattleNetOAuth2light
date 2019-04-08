<?php
/**
 *
 * phpBB Studio - Battle.net OAuth2 light. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, phpBB Studio, https://www.phpbbstudio.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbbstudio\bna\auth\provider\oauth\service;

use phpbb\auth\provider\oauth\service\base;
use phpbb\auth\provider\oauth\service\exception;
use OAuth\Common\Http\Exception\TokenResponseException;
use OAuth\Common\Exception\Exception as AccountResponseException;

class battlenet_base extends base
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\language\language */
	protected $lang;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var string Battle.net region */
	protected $region;

	/** @var \OAuth\OAuth2\Service\AbstractService */
	protected $class;

	/**
	 * Constructor.
	 *
	 * @param  \phpbb\config\config		$config		Config object
	 * @param  \phpbb\language\language	$lang		Language object
	 * @param  \phpbb\request\request	$request	Request object
	 * @return void
	 * @access public
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\language\language $lang, \phpbb\request\request $request)
	{
		$this->config	= $config;
		$this->lang		= $lang;
		$this->request	= $request;
	}

	/**
	 * Set Battle.net region
	 *
	 * @param  string	$region		Battle.net region
	 * @return void
	 * @access public
	 */
	public function set_region($region)
	{
		$this->region = $region;

		$this->class = '\OAuth\OAuth2\Service\Studio_battlenet_' . $region;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_service_credentials()
	{
		return array(
			'key'		=> $this->config["auth_oauth_studio_battlenet_{$this->region}_key"],
			'secret'	=> $this->config["auth_oauth_studio_battlenet_{$this->region}_secret"],
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function perform_auth_login()
	{
		if (!($this->service_provider instanceof $this->class))
		{
			throw new exception('AUTH_PROVIDER_OAUTH_ERROR_INVALID_SERVICE_TYPE');
		}

		// This was a callback request from battlenet, get the token
		try
		{
			$this->service_provider->requestAccessToken($this->request->variable('code', ''));
		}
		catch (TokenResponseException $e)
		{
			trigger_error($this->lang->lang('STUDIO_BNA_EXCEPTION_TOKEN', $e->getMessage()), E_USER_WARNING);
		}

		$result['battletag'] = '';

		// Send a request with it
		try
		{
			$result = json_decode($this->service_provider->request('oauth/userinfo'), true);
		}
		catch (AccountResponseException $e)
		{
			trigger_error($this->lang->lang('STUDIO_BNA_EXCEPTION_USER_INFO', $e->getMessage()), E_USER_WARNING);
		}

		// Return the unique identifier returned from battlenet
		return $result['battletag'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function perform_token_auth()
	{
		if (!($this->service_provider instanceof $this->class))
		{
			throw new exception('AUTH_PROVIDER_OAUTH_ERROR_INVALID_SERVICE_TYPE');
		}

		$result['battletag'] = '';

		// Send a request with it
		try
		{
			$result = json_decode($this->service_provider->request('oauth/userinfo'), true);
		}
		catch (AccountResponseException $e)
		{
			trigger_error($this->lang->lang('STUDIO_BNA_EXCEPTION_USER_INFO', $e->getMessage()), E_USER_WARNING);
		}

		// Return the unique identifier returned from battlenet
		return $result['battletag'];
	}
}
