<?php
class Pandan extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('username')===false){
			redirect('signout','refresh');
			return;
			}
		$this->load->model('pandan_model');
		}
	public function view($hostid){
		//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		//取得host相關資訊
		$data['hostdetail'] = $this->pandan_model->get_wherehosts($hostid);
		//取得軟體資訊
		//取得資料資訊
		$this->showPandanPageHost($data);
		}
	public function pandanByHost($filter){
		//確認身分
		$data['filter'] = $filter;
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		//取出使用者的host
		$data['userhost'] = $this->pandan_model->get_userhost();
		//正規分拆
			//建立多個空array儲存機器名稱
			$data['ownhost'] = array();
			$data['ownhost']['A'] = array();$data['ownhost']['B'] = array();$data['ownhost']['C'] = array();$data['ownhost']['D'] = array();
			$data['ownhost']['E'] = array();$data['ownhost']['F'] = array();$data['ownhost']['G'] = array();$data['ownhost']['H'] = array();
			$data['ownhost']['I'] = array();$data['ownhost']['J'] = array();$data['ownhost']['K'] = array();$data['ownhost']['L'] = array();
			$data['ownhost']['M'] = array();$data['ownhost']['N'] = array();$data['ownhost']['O'] = array();$data['ownhost']['P'] = array();
			$data['ownhost']['Q'] = array();$data['ownhost']['R'] = array();$data['ownhost']['S'] = array();$data['ownhost']['T'] = array();
			$data['ownhost']['U'] = array();$data['ownhost']['V'] = array();$data['ownhost']['W'] = array();$data['ownhost']['X'] = array();
			$data['ownhost']['Y'] = array();$data['ownhost']['Z'] = array();$data['ownhost']['num'] = array();
			$data['ownhost']['other'] = array();
		foreach($data['userhost'] as $item){
			switch($item['Name']){
				//ABCD
				case preg_match("/^[aA]/", $item['Name'])==true:
					array_push($data['ownhost']['A'] ,$item);
					break;
				case preg_match("/^[bB]/", $item['Name'])==true:
					array_push($data['ownhost']['B'] ,$item);
					break;
				case preg_match("/^[cC]/", $item['Name'])==true:
					array_push($data['ownhost']['C'] ,$item);
					break;
				case preg_match("/^[dD]/", $item['Name'])==true:
					array_push($data['ownhost']['D'] ,$item);
					break;
				//EFGH	
				case preg_match("/^[eE]/", $item['Name'])==true:
					array_push($data['ownhost']['E'] ,$item);
					break;
				case preg_match("/^[fF]/", $item['Name'])==true:
					array_push($data['ownhost']['F'] ,$item);
					break;
				case preg_match("/^[gG]/", $item['Name'])==true:
					array_push($data['ownhost']['G'] ,$item);
					break;
				case preg_match("/^[hH]/", $item['Name'])==true:
					array_push($data['ownhost']['H'] ,$item);
					break;
				//IJKL
				case preg_match("/^[iI]/", $item['Name'])==true:
					array_push($data['ownhost']['I'] ,$item);
					break;
				case preg_match("/^[jJ]/", $item['Name'])==true:
					array_push($data['ownhost']['J'] ,$item);
					break;
				case preg_match("/^[kK]/", $item['Name'])==true:
					array_push($data['ownhost']['K'] ,$item);
					break;
				case preg_match("/^[lL]/", $item['Name'])==true:
					array_push($data['ownhost']['L'] ,$item);
					break;
				//MNOP
				case preg_match("/^[mM]/", $item['Name'])==true:
					array_push($data['ownhost']['M'] ,$item);
					break;
				case preg_match("/^[nN]/", $item['Name'])==true:
					array_push($data['ownhost']['N'] ,$item);
					break;
				case preg_match("/^[oO]/", $item['Name'])==true:
					array_push($data['ownhost']['O'] ,$item);
					break;
				case preg_match("/^[pP]/", $item['Name'])==true:
					array_push($data['ownhost']['P'] ,$item);
					break;
				//QRST
				case preg_match("/^[qQ]/", $item['Name'])==true:
					array_push($data['ownhost']['Q'] ,$item);
					break;
				case preg_match("/^[rR]/", $item['Name'])==true:
					array_push($data['ownhost']['R'] ,$item);
					break;
				case preg_match("/^[sS]/", $item['Name'])==true:
					array_push($data['ownhost']['S'] ,$item);
					break;
				case preg_match("/^[tT]/", $item['Name'])==true:
					array_push($data['ownhost']['T'] ,$item);
					break;
				//UVWX
				case preg_match("/^[uU]/", $item['Name'])==true:
					array_push($data['ownhost']['U'] ,$item);
					break;
				case preg_match("/^[vV]/", $item['Name'])==true:
					array_push($data['ownhost']['V'] ,$item);
					break;
				case preg_match("/^[wW]/", $item['Name'])==true:
					array_push($data['ownhost']['W'] ,$item);
					break;
				case preg_match("/^[xX]/", $item['Name'])==true:
					array_push($data['ownhost']['X'] ,$item);
					break;
				//YZnum
				case preg_match("/^[yY]/", $item['Name'])==true:
					array_push($data['ownhost']['Y'] ,$item);
					break;
				case preg_match("/^[zZ]/", $item['Name'])==true:
					array_push($data['ownhost']['Z'] ,$item);
					break;
				case preg_match("/^[0-9]/", $item['Name'])==true:
					array_push($data['ownhost']['num'] ,$item);
					break;
				default:
					array_push($data['ownhost']['other'] ,$item);
					break;
				}
			}
		//單元測試用
/*		foreach($data['ownhost']['num'] as $item){
			echo $item['Name']."<br>";
			}*/
		$this->showPandanPage($data);
		}


	public function deleteSoftwarePath($HostID,$PathID){
		//刪除softwarepath
		//取得host相關資訊
				//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		$data['hostdetail'] = $this->pandan_model->get_wherehosts($HostID);
		$this->pandan_model->delete_softwarepath($PathID);
		$this->showPandanPageHost($data);
		
		}
	public function deleteDataPath($HostID,$PathID){
		//刪除datapath
		//取得host相關資訊
				//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		$data['hostdetail'] = $this->pandan_model->get_wherehosts($HostID);
		$this->pandan_model->delete_datapath($PathID);
		$this->showPandanPageHost($data);
		}
		
	public function addSoftwarePath($HostID){
		//新增softwarepath
		$this->form_validation->set_rules('hostid','hostid','required');
		$this->form_validation->set_rules('softwarecloud','softwarecloud','required');
		$this->form_validation->set_rules('software','software','required');
		$this->form_validation->set_rules('settingtype','settingtype','required');
		$this->form_validation->set_rules('logtype','logtype','required');
		$this->form_validation->set_rules('bg','bg','required');
		if($this->form_validation->run() === false){ 
			$this->showPandanPageHost($data);
			return;
		};
		$this->pandan_model->insert_SoftwarePath();
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		$data['hostdetail'] = $this->pandan_model->get_wherehosts($HostID);
		$this->showPandanPageHost($data);
		
		}
		
	public function editSoftwarePath($HostID){
		//修改softwarepath by softwarepathid 
		$this->form_validation->set_rules('hostid','hostid','required');
		$this->form_validation->set_rules('softwarecloud','softwarecloud','required');
		$this->form_validation->set_rules('software','software','required');
		$this->form_validation->set_rules('settingtype','settingtype','required');
		$this->form_validation->set_rules('logtype','logtype','required');
		$this->form_validation->set_rules('bg','bg','required');
		$this->form_validation->set_rules('user','user','required');
		if($this->form_validation->run() === false){ 
			$this->showPandanPageHost($data);
			return;
		};
		$this->pandan_model->update_SoftwarePath();
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		$data['hostdetail'] = $this->pandan_model->get_wherehosts($HostID);
		$this->showPandanPageHost($data);
		
		}
		
		
	public function addDataPath($HostID){
		//新增datapath
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		$data['hostdetail'] = $this->pandan_model->get_wherehosts($HostID);
		$this->form_validation->set_rules('hostid','hostid','required');
		$this->form_validation->set_rules('datatype','datatype','required');
		$this->form_validation->set_rules('bg','bg','required');
		if($this->form_validation->run() === false){ 
			$this->showPandanPageHost($data);
			return;
		};
		$this->pandan_model->insert_DataPath();
		$this->showPandanPageHost($data);
		
		}
		
	public function editDataPath($HostID){
		//更新datapath
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		$data['hostdetail'] = $this->pandan_model->get_wherehosts($HostID);
		$this->form_validation->set_rules('hostid','hostid','required');
		$this->form_validation->set_rules('datatype','datatype','required');
		$this->form_validation->set_rules('bg','bg','required');
		$this->form_validation->set_rules('user','user','required');
		if($this->form_validation->run() === false){ 
			$this->showPandanPageHost($data);
			return;
		};
		$this->pandan_model->update_DataPath();

		$this->showPandanPageHost($data);
		
		}
	
	//盤點頁面中轉移保管者
	public function transkeeper($Newuser,$HostID,$HostName){
		$this->pandan_model->updateHostKeeper($Newuser,$HostID);
		$this->load->model('message_model');
		//寫訊息給轉移的人
		$data['userinfo'] = $this->session->userdata('userinfo');
		$this->message_model->InsertMessage($data['userinfo']['UserID'],$Newuser,'轉移了 '.$HostName." 給您!",'index.php/pandan/view/'.$HostID);
		//$this->pandanByHost();
		redirect('pandan/pandanByHost/all','refresh');
		}
	
	//頁面中設定flag
	public function chageFlag($HostID,$flag){
		$this->pandan_model->update_flag($HostID,$flag);
		}
		
	//頁面中設定remark
	public function changeRemark($HostID){
		$this->pandan_model->update_hostRemark($HostID);
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		$data['hostdetail'] = $this->pandan_model->get_wherehosts($HostID);
		$this->showPandanPageHost($data);
		}
	//頁面中改變groupuse
	public function changeGroupuse($HostID,$Groupuse){
			$this->pandan_model->update_hostGroupuse($HostID,$Groupuse);
		}
	
	//自訂盤點頁
	public function pandanByCustom(){
		$data['username'] = $this->session->userdata('username');
		$this->showPandanPageCustom($data);
		}

	//顯示單元 for view
	public function showPandanPage($data){
			$data['userinfo'] = $this->session->userdata('userinfo');
			$this->load->view('templates/header',$data);
			$this->load->view('pandan/pandanByHost',$data);
			$this->load->view('templates/footer');
		}
	public function showPandanPageHost($data){
			$data['userinfo'] = $this->session->userdata('userinfo');
			$data['softwarepaths'] = $this->pandan_model->get_softwarepathByhost($data['hostdetail']['HostID']);
			$data['datapaths'] = $this->pandan_model->get_datapathByhost($data['hostdetail']['HostID']);
			$data['softwareclouds'] = $this->pandan_model->get_softwarecloud();
			$data['settingtypes'] = $this->pandan_model->get_settingTypeList();
			$data['logtypes'] = $this->pandan_model->get_logTypeList();
			$data['bgs'] = $this->pandan_model->get_bgList();
			$data['users'] = $this->pandan_model->get_userList();
			$data['datatypes'] = $this->pandan_model->get_dataList();
			$this->load->view('templates/header',$data);
			$this->load->view('pandan/pandanByHostID',$data);
			$this->load->view('templates/footer');
		}
	
	private function showPandanPageCustom($data){
			$data['userinfo'] = $this->session->userdata('userinfo');
			$this->load->view('templates/header',$data);
			$this->load->view('pandan/pandanByCustom',$data);
			$this->load->view('templates/footer');
		}
	
	

	//json格式軟體list 選擇軟體群 自動帶出軟體
	public function getJsonSoftwareByCloud($CloudID){
			$data['data'] = $this->pandan_model->get_softwareByCloudID($CloudID);
			print json_encode($data['data']);
		}
		
	/* for pandanByCustom.php 客製化盤點介面  */
	public function testa(){
			$this->load->helper('file');
			$array = array(array('id'=>1,'name'=>'第一個清單','context'=>array(1,2,3,4,5)),array('id'=>'2','name'=>'第二個清單','context'=>array(100,101,102,103,104)));
			$data = json_encode($array,JSON_UNESCAPED_UNICODE);
			var_dump($data);
			if ( ! write_file('./customlist/1.json', $data))
			{
				 echo 'Unable to write the file';
			}
			$string = read_file('./customlist/1.json');
			//echo $string;
			$a = json_decode($string,true);
			foreach($a as $item){
				var_dump($item);
				echo $item['name']."<br>";
				}
		}
	
	public function ReadCustomfile($mode){
		//mode = 0 取得file裡面的清單 並去除部屬於管轄範圍的
		//mode = 1 取得不再file裡面的清單 並去除清單裡面友的
		//讀取自訂清單檔案
			$data['userinfo'] = $this->session->userdata('userinfo');
			$this->load->helper('file');
			if(!file_exists("./customlist/".$data['userinfo']['UserID'].".json")){
				//$arrayfirst = array(array('name'=>'第一個清單','context'=>array()));
				//$data = json_encode($arrayfirst,JSON_UNESCAPED_UNICODE);
				$path = "./customlist/".$data['userinfo']['UserID'].".json";
				write_file($path, "[]");
				}
			$jsonstring = read_file("./customlist/".$data['userinfo']['UserID'].".json");
			//檢查db中的異動
			//先拿出屬於你的全部的hostid
			$arrayallhost = $this->pandan_model->get_userhost();
			$dbhostid = array();
			foreach($arrayallhost as $item){
				array_push($dbhostid,(int)$item['HostID']);
				}
			//解西json檔案
			$arrayjson = json_decode($jsonstring,true);
			$jsonfilehostid = array();
			foreach($arrayjson as $key => $list){
				foreach($list['context'] as $hostkey => $hostid){
					if(!in_array($hostid,$dbhostid)){
						//移除掉已經部屬於user管的hostid
						unset($arrayjson[$key]['context'][$hostkey]);
						continue;
						}
					array_push($jsonfilehostid,$hostid);
					}
				}
			if($mode==0){
				print json_encode($arrayjson,JSON_UNESCAPED_UNICODE);
				}
			if($mode==1){
				print json_encode(array_diff($dbhostid,$jsonfilehostid));
				}
		}
	public function WriteCustomfile(){
		//寫入自訂清單檔案
			$data['userinfo'] = $this->session->userdata('userinfo');
			$this->load->helper('file');
			//html_entity_decode($jsonstring, ENT_QUOTES,"UTF-8");
			if ( ! write_file('./customlist/'.$data['userinfo']['UserID'].'.json', $this->input->get('string')))
			{
				 echo html_entity_decode($jsonstring);
			}
			 //echo $jsonstring."<br>";
			 
		}
	public function ReadHostTitle($hostid){
		$hostdetail = $this->pandan_model->get_wherehosts($hostid);
		$flag_show = "";
		if($hostdetail["flag"]==0) $flag_show='<span class="label label-success pull-right donebtn">Done</span>';
		if($hostdetail["flag"]==1) $flag_show='<span class="label label-warning pull-right donebtn">DNF</span>';
		if($hostdetail["flag"]==2) $flag_show='<span class="label label-danger pull-right donebtn">Never</span>';
		if($hostdetail["Groupuse"]==1){
			$flag_show.= '<br><span class="label label-primary pull-right groupusebtn"><i class="fa fa-group fa-fw"></i> Group</span>';
		}
		//var_dump($hostdetail);
		echo '<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="'.$hostdetail["CloudName"].'" hostgroup="'.$hostdetail["CloudName"].'" href="index.php/pandan/view/'.$hostid.'" data-original-title="'.$hostdetail["CloudName"].'" hostid="'.$hostdetail["HostID"].'"><span class="pull-left">'.$hostdetail['Name'].'</span>'. $flag_show.'<br></a>';
			// ( '.$hostdetail["CloudName"].' )
		}
	/* for pandanByCustom.php 客製化盤點頁面 */
	
	
	
	
	
	
	}
		

?>