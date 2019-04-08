<?php
/**
 *
 * phpBB Studio - Battle.net OAuth2. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, phpBB Studio, https://www.phpbbstudio.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbbstudio\bna\event;

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Listener.
 */
class listener implements EventSubscriberInterface
{
	/**
	 * Assign functions defined in this class to event listeners in the core.
	 *
	 * @static
	 * @return array
	 * @access public
	 */
	public static function getSubscribedEvents()
	{
		return [
			'core.user_setup_after'		=> 'studio_bna_setup_lang',
		];
	}

	/** @var \phpbb\language\language */
	protected $language;

	/**
	 * Constructor.
	 *
	 * @param  \phpbb\language\language $language Language object
	 * @return void
	 * @access public
	 */
	public function __construct(\phpbb\language\language $language)
	{
		$this->language = $language;
	}

	/**
	 * Load extension language file during user set up.
	 *
	 * @event  core.user_setup_after
	 * @return void
	 * @access public
	 */
	public function studio_bna_setup_lang()
	{
		$this->language->add_lang('bna_common', 'phpbbstudio/bna');
	}
}
