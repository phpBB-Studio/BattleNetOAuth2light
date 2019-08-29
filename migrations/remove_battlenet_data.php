<?php
/**
 *
 * phpBB Studio - Battle.net OAuth2 light. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, phpBB Studio, https://www.phpbbstudio.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbbstudio\bna\migrations;

/**
 * Let "container_aware_migration" give us access to "$this->container".
 */
class remove_battlenet_data extends \phpbb\db\migration\container_aware_migration
{
	/**
	 * Assign migration file dependencies for this migration.
	 *
	 * @return array		Array of migration files
	 * @access public
	 * @static
	 */
	static public function depends_on()
	{
		return ['\phpbb\db\migration\data\v32x\v325'];
	}

	/**
	 * Assign reverting actions.
	 *
	 * @return array		Array of reverting actions
	 * @access public
	 */
	public function revert_data()
	{
		return [
			['custom', [[$this, 'remove_battlenet_oauths_garbage']]],
		];
	}

	/**
	 * Remove all Battlenet's OAuth data from the OAuth tables.
	 *
	 * @return void
	 * @access public
	 */
	public function remove_battlenet_oauths_garbage()
	{
		$tokens		= $this->container->getParameter('tables.auth_provider_oauth_token_storage');
		$states		= $this->container->getParameter('tables.auth_provider_oauth_states');
		$accounts	= $this->container->getParameter('tables.auth_provider_oauth_account_assoc');

		$table_ary = [
			$tokens		=> 'auth.provider.oauth.service.studio_battlenet',
			$states		=> 'auth.provider.oauth.service.studio_battlenet',
			$accounts	=> 'studio_battlenet',
		];

		$this->db->sql_transaction('begin');

		foreach ($table_ary as $table => $provider)
		{
			$sql = 'DELETE FROM ' . $table . '
					WHERE provider ' . $this->db->sql_like_expression($provider . $this->db->get_any_char());
			$this->sql_query($sql);
		}

		$this->db->sql_transaction('commit');
	}
}
