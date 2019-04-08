<?php
/**
 *
 * phpBB Studio - Battle.net OAuth2. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, phpBB Studio, https://www.phpbbstudio.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbbstudio\bna\migrations;

class install_configuration extends \phpbb\db\migration\migration
{
	/**
	 * Check if the migration is effectively installed (entirely optional).
	 *
	 * @return bool 		True if this migration is installed, False if this migration is not installed
	 * @access public
	 */
	public function effectively_installed()
	{
		return isset($this->config['auth_oauth_studio_battlenet_eu_key']);
	}

	/**
	 * Assign migration file dependencies for this migration.
	 *
	 * @return array		Array of migration files
	 * @access public
	 * @static
	 */
	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v32x\v325');
	}

	/**
	 * Update or delete data stored in the database during extension installation.
	 *
	 * @return array Array of data update instructions.
	 * @access public
	 */
	public function update_data()
	{
		return array(
			/* Battle.net Asia-Pacific */
			array('config.add', array('auth_oauth_studio_battlenet_apac_key', '')),
			array('config.add', array('auth_oauth_studio_battlenet_apac_secret', '')),

			/* Battle.net China */
			array('config.add', array('auth_oauth_studio_battlenet_cn_key', '')),
			array('config.add', array('auth_oauth_studio_battlenet_cn_secret', '')),

			/* Battle.net Europe */
			array('config.add', array('auth_oauth_studio_battlenet_eu_key', '')),
			array('config.add', array('auth_oauth_studio_battlenet_eu_secret', '')),

			/* Battle.net United States */
			array('config.add', array('auth_oauth_studio_battlenet_us_key', '')),
			array('config.add', array('auth_oauth_studio_battlenet_us_secret', '')),
		);
	}
}
