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

namespace Gc\AdminNavigation;

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
    protected $name = 'admin_navigation';

   
    /**
     * Initiliaze from array
     *
     * @param array $array Data
     *
     * @return Model
     */
    public static function fromArray(array $array)
    {
        $navigationTable = new Model();
        $navigationTable->setData($array);
        $navigationTable->setOrigData();

        return $navigationTable;
    }
	
    public static function getNavigation()
    {
    	$navigationTable = new Model();
    	$select = new Sql\Select();

    	$select->from('admin_navigation');
    	$select->where(array('display <> 1'));

    	$select->order('sort desc');
    	$All         = $navigationTable->fetchAll($select);

    	$navigationTable->events()->trigger(__CLASS__, 'before.load', $navigationTable);

    	if (!empty($All)) {
    		$navigation = array();
    		$menu = array();
    		$data = array();
    		$one_menu = array();
    		$two_menu = array();
    		$i=0;$j=0;$a=0;$b=0;

    		if(@is_array($All)){

    			foreach($All as $key=>$v){

    				if($v['keyid']==0){

    					$navigation[$i]["id"]=$v["id"];

    					$navigation[$i]["name"]=$v["name"];

    					$navigation[$i]["classname"]=$v["classname"];

    					$i++;

    				}

    				if($v['menu']==2){

    					$menu[$j]["id"]=$v["id"];

    					$menu[$j]["keyid"]=$v["keyid"];

    					$menu[$j]["name"]=$v["name"];

    					$menu[$j]["classname"]=$v["classname"];

    					$menu[$j]["url"]=$v["url"];

    					$j++;

    				}

    			}

    		}
    		
    		if(@is_array($navigation)){

    			foreach($navigation as $va){

    				if(@is_array($All)){

    					foreach($All as $key=>$v){

    						if($v['keyid']==$va["id"]){

    							if(!@is_array($one_menu[$va["id"]]))$a=0;

    							$one_menu[$va["id"]][$a]["id"]=$v["id"];

    							$one_menu[$va["id"]][$a]["name"]=$v["name"];

    							$one_menu[$va["id"]][$a]["keyid"]=$v["keyid"];

    							$a++;

    							foreach($All as $key=>$vaa){

    								if($vaa['keyid']==$v["id"]){

    									if(!@is_array($two_menu[$v["id"]]))$b=0;

    									$two_menu[$v["id"]][$b]["id"]=$vaa["id"];

    									$two_menu[$v["id"]][$b]["keyid"]=$vaa["keyid"];

    									$two_menu[$v["id"]][$b]["name"]=$vaa["name"];

    									$two_menu[$v["id"]][$b]["url"]=$vaa["url"];

    									$b++;

    								}

    							}

    						}

    					}

    				}

    			}

    		}
    		$power = array();
    		if(@is_array($navigation)){

    			foreach($navigation as $v){

    				$navigation_url_id[]=$v["id"];

    			}

    			$navigation_url=self::getWebDefault($navigation_url_id,$power);

    		}
    		$data['navigation'] = $navigation;
    		$data['menu'] = $menu;
    		$data['one_menu'] = $one_menu;
    		$data['two_menu'] = $two_menu;
    		$data['navigation_url'] = $navigation_url;

    		$navigationTable->events()->trigger(__CLASS__, 'after.load', $navigationTable);

    		return $data;

    	} else {

    		$navigationTable->events()->trigger(__CLASS__, 'after.load.failed', $navigationTable);

    		return false;

    	}
    	
    }
    
    public static function getWebDefault($keyid,$power)
    {
    	$navigationTable = new Model();

    	$select = new Sql\Select();

    	$select->from('admin_navigation');

    	$select->where(array('keyid' =>$keyid));

    	$select->order('sort desc');

    	$web = $navigationTable->fetchAll($select);
    	
    	if(is_array($web)){

    		foreach($web as $v){

    			if(!@in_array($v['id'],$power)){

    				$arr[]=$v['id'];

    				$arr2[$v['id']]=$v['keyid'];

    			}

    		}
    		$select = new Sql\Select();

    		$select->from('admin_navigation');

    		$select->where(array('keyid' =>$arr));

    		$select->order('sort desc');

    		$webaa = $navigationTable->fetchAll($select);

    		if(is_array($webaa)){

    			foreach($webaa as $va){

    				if(!@in_array($va['id'],$power)){

    					$value[$arr2[$va['keyid']]]=$va['url'];

    				}

    			}

    		}

    	}

    	return $value;
    } 
    /**
     * Initiliaze from id
     *
     * @param integer $scriptId Script id
     *
     * @return \Gc\Script\Model
     */
    public static function fromId($Id)
    {
        $navigationTable = new Model();
        $row         = $navigationTable->fetchRow($navigationTable->select(array('id' => (int) $Id)));
        $navigationTable->events()->trigger(__CLASS__, 'before.load', $navigationTable);
        if (!empty($row)) {
            $navigationTable->setData((array) $row);
            $navigationTable->setOrigData();
            $navigationTable->events()->trigger(__CLASS__, 'after.load', $navigationTable);
            return $navigationTable;
        } else {
            $navigationTable->events()->trigger(__CLASS__, 'after.load.failed', $navigationTable);
            return false;
        }
    }
    /**
     * Initiliaze from id
     *
     * @param integer $identifier Identifier
     *
     * @return \Gc\Script\Model
     */
    public static function fromIdentifier($identifier)
    {
        $navigationTable = new Model();
        $row         = $navigationTable->fetchRow($navigationTable->select(array('identifier' => $identifier)));
        $navigationTable->events()->trigger(__CLASS__, 'before.load', $navigationTable);
        if (!empty($row)) {
            $navigationTable->setData((array) $row);
            $navigationTable->setOrigData();
            $navigationTable->events()->trigger(__CLASS__, 'after.load', $navigationTable);
            return $navigationTable;
        } else {
            $navigationTable->events()->trigger(__CLASS__, 'after.load.failed', $navigationTable);
            return false;
        }
    }

    /**
     * Save script model
     *
     * @return integer
     */
    public function save()
    {
        $this->events()->trigger(__CLASS__, 'before.save', $this);
        $arraySave = array(
            'name' => $this->getName(),
            'identifier' => $this->getIdentifier(),
            'description' => $this->getDescription(),
            'content' => $this->getContent(),
            'updated_at' => new Expression('NOW()'),
        );

        try {
            if ($this->getId() == null) {
                $arraySave['created_at'] = new Expression('NOW()');
                $this->insert($arraySave);
                $this->setId($this->getLastInsertId());
            } else {
                $this->update($arraySave, array('id' => (int) $this->getId()));
            }

            $oldFilename = sprintf(GC_TEMPLATE_PATH . '/script/%s.phtml', $this->getOrigData('identifier'));
            if (file_exists($oldFilename)) {
                unlink($oldFilename);
            }

            file_put_contents($this->getFilePath(), $this->getContent());
            $this->events()->trigger(__CLASS__, 'after.save', $this);

            return $this->getId();
        } catch (\Exception $e) {
            $this->events()->trigger(__CLASS__, 'after.save.failed', $this);
            throw new \Gc\Exception($e->getMessage(), $e->getCode(), $e);
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
