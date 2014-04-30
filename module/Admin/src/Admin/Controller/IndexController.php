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
 * @category   Gc_Application
 * @package    Admin
 * @subpackage Controller
 * @author     Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license    GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link       http://www.got-cms.com
 */

namespace Admin\Controller;

use Gc\Mvc\Controller\Action;
use Gc\Document\Collection;
use Gc\User\Visitor;
use Gc\Version;
use Gc\Ad\Model as AdModel;
use Gc\AdminNavigation\Model as AdminNavigationModel;
use Gc\AdminLink\Model as AdminLinkModel;
use Gc\CompanyJob\Model as CompanyJobModel;
use Gc\Member\Model as MemberModel;
use Gc\NewsBase\Model as NewsBaseModel;
use Gc\OnceJob\Model as OnceJobModel;
use Gc\ResumeExpect\Model as ResumeExpectModel;
use Zend\Json\Json;
use Zend\View\Model\ViewModel;

/**
 * Index controller for admin module
 *
 * @category   Gc_Application
 * @package    Admin
 * @subpackage Controller
 */
class IndexController extends Action
{
    /**
     * Display dashboard
     *
     * @return array
     */
    public function indexAction()
    {
    	$this->layout()->setTemplate('layouts/adminlayout.phtml');
    	$navigationData = AdminNavigationModel::getNavigation();
    	$this->layout()->setVariables(array('navigationData' => $navigationData));
    	/*
        $data                    = array();
        $data['version']         = Version::VERSION;
        $data['versionIsLatest'] = Version::isLatest();
        $data['versionLatest']   = Version::getLatest();

        $documents                        = new Collection();
        $contentStats                     = array();
        $contentStats['online_documents'] = array(
            'count' => count($documents->getAvailableDocuments()),
            'label' => 'Online documents',
            'route' => 'content',
        );

        $contentStats['total_documents'] = array(
            'count' => count($documents->select()->toArray()),
            'label' => 'Total documents',
            'route' => 'content',
        );

        $data['contentStats'] = $contentStats;

        $visitorModel      = new Visitor();
        $data['userStats'] = array(
            'total_visitors' => array(
                'count' => $visitorModel->getTotalVisitors(),
                'label' => 'Total visitors',
                'route' => 'statistics',
            ),
            'total_visits' => array(
                'count' => $visitorModel->getTotalPageViews(),
                'label' => 'Total page views',
                'route' => 'statistics',
            ),
        );

        $coreConfig                = $this->getServiceLocator()->get('CoreConfig');
        $widgets                   = @unserialize($coreConfig->getValue('dashboard_widgets'));
        $data['dashboardSortable'] = !empty($widgets['sortable']) ? Json::encode($widgets['sortable']) : '{}';
        $data['dashboardWelcome']  = !empty($widgets['welcome']);

        $data['customeWidgets'] = array();
        $this->events()->trigger(__CLASS__, 'dashboard', $this, array('widgets' => &$data['customeWidgets']));

        return $data;
        */
    }
    
    public function dashBoardAction()
    {
    	$soft=$_SERVER['SERVER_SOFTWARE'];

    	$kongjian=round(@disk_free_space(".")/(1024*1024),2);

    	$banben=@mysql_get_server_info();

    	$yonghu=@get_current_user();

    	$server=$_SERVER['SERVER_NAME'];
    	$adRows = AdModel::getAds();
    	$ad_all=count($adRows);
    	$link = AdminLinkModel::getAdminLinks();
    	$companyJobRows = CompanyJobModel::getCompanyJobs();
    	$job_all=count($companyJobRows);

    	$job=$this->getAllNum($companyJobRows,"lastupdate");
    	$memberRows = MemberModel::getMembers(1);
    	$usernum_all=count($memberRows);
    	$user_num=$this->getAllNum($memberRows,"reg_date");
    	$newsBaseRows = NewsBaseModel::getNewsBases();
    	$news_all=count($newsBaseRows);
    	$news=$this->getAllNum($newsBaseRows,"datetime");
    	$once = OnceJobModel::getOnceJobs();
    	$resumeExpectModelRows = ResumeExpectModel::getResumeExpects();
    	$resume_all=count($resumeExpectModelRows);
    	$resume=$this->getAllNum($resumeExpectModelRows,"lastupdate");
    	
    	$memberRows = MemberModel::getMembers(2);
    	$comnum_all=count($memberRows);

    	$com_nums=$this->getAllNum($memberRows,"reg_date");
    	$data = array(
    			'soft'=>$soft,
    			'kongjian'=>$kongjian,
    			'banben'=>$banben,
    			'yonghu'=>$yonghu,
    			'server'=>$server,
    			'user_num'=>$user_num,
    			'usernum_all'=>$usernum_all,
    			'resume'=>$resume,
    			'com_nums'=>$com_nums,
    			'news_all'=>$news_all,
    			'news'=>$news,
    			'job'=>$job,
    			'job_all'=>$job_all,
    			'ad_all'=>$ad_all,
    			'link'=>$link,
    			'once'=>$once
    			);
    
    	$viewModel = new ViewModel($data);

    	$viewModel->setTerminal(true);
    	

    	return $viewModel;
    }
    
    function getAllNum($rows,$field){

    	$time=strtotime(date("Y-m-d"));

    	$num=0;

    	if(@is_array($rows)){

    		foreach($rows as $value){

    			if($value[$field]>=$time){

    				$num++;

    			}

    		}

    	}

    	return $num;

    }

    /**
     * Save dashboard
     *
     * @return \Zend\View\Model\JsonModel
     */
    public function saveDashboardAction()
    {
        $coreConfig = $this->getServiceLocator()->get('CoreConfig');
        $params     = $this->getRequest()->getPost()->toArray();

        $config = @unserialize($coreConfig->getValue('dashboard_widgets'));

        if (empty($config)) {
            $config = array();
        }

        if (!empty($params['dashboard'])) {
            $config['welcome'] = false;
        } else {
            $config['sortable'] = $params;
        }

        $coreConfig->setValue('dashboard_widgets', serialize($config));

        return $this->returnJson(array('success' => true));
    }

    /**
     * Translator js action
     *
     * @return ViewModel
     */
    public function translatorAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        return $viewModel;
    }


    /**
     * Keep alive connection action
     *
     * @return ViewModel
     */
    public function keepAliveAction()
    {
        return $this->returnJson(array('success' => true));
    }
}
