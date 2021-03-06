<?php

/**
 * Mail
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Tahaa Karim <tahaalibra@gmail.com>
 * @copyright Tahaa Karim 2016
 */

namespace OCA\Mail\Db;

use OCP\AppFramework\Db\Mapper;
use OCP\IDb;

class AliasMapper extends Mapper {

	/**
	 * @param IDb $db
	 */
	public function __construct(IDb $db) {
		parent::__construct($db, 'mail_aliases');
	}

	/**
	 * @param int $aliasId
	 * @param string $currentUserId
	 * @return Alias[]
	 */
	public function find($aliasId, $currentUserId) {
		$sql = 'select *PREFIX*mail_aliases.* from *PREFIX*mail_aliases join *PREFIX*mail_accounts on oc_mail_aliases.account_id = oc_mail_accounts.id where *PREFIX*mail_accounts.user_id = ? and *PREFIX*mail_aliases.id=?';
		return $this->findEntity($sql, [$currentUserId, $aliasId]);
	}

	/**
	 * @param int $accountId
	 * @param string $currentUserId
	 * @return Alias[]
	 */
	public function findAll($accountId, $currentUserId) {
		$sql = 'select *PREFIX*mail_aliases.* from *PREFIX*mail_aliases join *PREFIX*mail_accounts on oc_mail_aliases.account_id = oc_mail_accounts.id where *PREFIX*mail_accounts.user_id = ? AND *PREFIX*mail_aliases.account_id=?';
		$params = [
			$currentUserId,
			$accountId
		];
		return $this->findEntities($sql, $params);
	}
}
