<?php
/**
 * This source file is part of GotCms.
 *
 * GotCms is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * GotCms is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with GotCms. If not, see <http://www.gnu.org/licenses/lgpl-3.0.html>.
 *
 * PHP Version >=5.3
 *
 * @category   Gc
 * @package    Library
 * @subpackage Script
 * @author     Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license    GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link       http://www.got-cms.com
 */

namespace Gc\Ad;

use Gc\Db\AbstractTable;
use Zend\Db\Sql;
use Zend\Db\Sql\Predicate\Expression;

/**
 * Script Model
 *
 * @category   Gc
 * @package    Library
 * @subpackage Script
 */
class Model extends AbstractTable
{
    /**
     * Table name
     *
     * @var string
     */
    protected $name = 'ad';

   
    /**
     * Initiliaze from array
     *
     * @param array $array Data
     *
     * @return Model
     */
    public static function fromArray(array $array)
    {
        $adTable = new Model();
        $adTable->setData($array);
        $adTable->setOrigData();

        return $adTable;
    }

	public static function getAds()
	{
		$adTable = new Model();
        $rows = $adTable->fetchAll($adTable->select());
        $adTable->events()->trigger(__CLASS__, 'before.load', $adTable);
        if (!empty($rows)) {
            $adTable->events()->trigger(__CLASS__, 'after.load', $adTable);
            return $rows;
        } else {
            $adTable->events()->trigger(__CLASS__, 'after.load.failed', $adTable);
            return false;
        }
	}

   
    /**
     * Delete script model
     *
     * @return boolean
     */
    public function delete()
    {
        $this->events()->trigger(__CLASS__, 'before.delete', $this);
        $id = $this->getId();
        if (!empty($id)) {
            try {
                parent::delete(array('id' => $id));
            } catch (\Exception $e) {
                throw new \Gc\Exception($e->getMessage(), $e->getCode(), $e);
            }

            if (file_exists($this->getFilePath())) {
                unlink($this->getFilePath());
            }

            $this->events()->trigger(__CLASS__, 'after.delete', $this);
            unset($this);

            return true;
        }

        $this->events()->trigger(__CLASS__, 'after.delete.failed', $this);

        return false;
    }
}
