<?php
class Pandan_model extends CI_Model{
	
	public function __construct(){
		$this->load->database();
		}
	public function get_userhost(){
		$userinfo = $this->session->userdata('userinfo');
		$username = $this->session->userdata('username');
		if($username ==='admin'){
			$this->db->select('host.*,hostcloud.Name as CloudName');
			$this->db->from('host');
			$this->db->join('hostcloud','host.CloudID = hostcloud.CloudID');
			$query = $this->db->get();
			}
		else{
			$this->db->select('host.*,hostcloud.Name as CloudName');
			$this->db->from('host');
			$this->db->join('hostcloud','host.CloudID = hostcloud.CloudID');
			$query = $this->db->where('host.UserID',$userinfo['UserID']);
				//admin館的就開放大家讀取
			$query = $this->db->or_where('host.UserID','1');
			$query = $this->db->get();
			}
		return $query->result_array();
		}
	public function get_wherehosts($hostid){
		//單純讀取hostid指定的host
		$this->db->select('host.*,host.Name as hostname,user.Name as username,hostcloud.Name as CloudName');
		$this->db->from('host');
		$this->db->join('user','host.UserID=user.UserID');
		$this->db->join('hostcloud','host.CloudID = hostcloud.CloudID');
		$this->db->where('host.HostID',$hostid);
		$query = $this->db->get();
		//$query = $this->db->get_where('host',array('HostID'=>$hostid));
		return $query->row_array();
		}
		
	public function update_hostRemark($hostid){
		$data = array(
				'Remark' => $this->input->post('EditRemarkText')
			);
		$this->db->update('host',$data,array('HostID'=>$hostid));
		}
	
		
	public function get_softwarepathByhost($hostid){
		//透過機器名稱讀取他的軟體列表
		/*sql語法
SELECT softwarepath.PathID,softwarecloud.Name as SoftwareCloudName,software.Name as SoftwareName,softwarepath.Version ,settingtype.Name as SettingTypeName,softwarepath.SettingPath,logtype.Name as LogTypeName,softwarepath.LogPath,bg.Name as BGName,host.Name as HostName,host.HostID as HostID,softwarepath.HostID,user.Name as UserName
FROM softwarepath

left join
softwarecloud
on softwarepath.SoftwareCloudID=softwarecloud.CloudID

left join
software
on softwarepath.SoftwareID=software.SoftwareID

left join
settingtype
on softwarepath.SettingTypeID=settingtype.SettingTypeID

left join
logtype
on softwarepath.LogTypeID=logtype.LogTypeID

left join
bg
on softwarepath.BGID=bg.BGID

left join
host
on softwarepath.HostID=host.HostID

left join
user
on softwarepath.KeeperID=user.UserID

		*/
		$this->db->select('softwarepath.PathID,softwarecloud.Name as SoftwareCloudName,software.Name as SoftwareName,softwarepath.Version ,settingtype.Name as SettingTypeName,softwarepath.SettingPath,logtype.Name as LogTypeName,softwarepath.LogPath,bg.Name as BGName,host.Name as HostName,host.HostID as HostID,softwarepath.HostID,user.Name as UserName');
		$this->db->from('softwarepath');
		$this->db->join('softwarecloud','softwarepath.SoftwareCloudID=softwarecloud.CloudID'); //拼接軟體群
		$this->db->join('software','softwarepath.SoftwareID=software.SoftwareID');//拼接軟體
		$this->db->join('settingtype','softwarepath.SettingTypeID=settingtype.SettingTypeID');//拼接settingtype
		$this->db->join('logtype','softwarepath.LogTypeID=logtype.LogTypeID');//拼接logtype
		$this->db->join('bg','softwarepath.BGID=bg.BGID');//拼接bg
		$this->db->join('host','softwarepath.HostID=host.HostID');//拼接host
		$this->db->join('user','softwarepath.KeeperID=user.UserID');//拼接user
		$this->db->where('softwarepath.HostID',$hostid);
		$query = $this->db->get();
		return $query->result_array();
		}	
		
public function get_datapathByhost($hostid){
		//透過機器名稱讀取他的資料列表
		/*sql語法
SELECT datapath.PathID,datatype.Name as DatatypeName,datapath.DataPath as Datapath,bg.Name as BGName,host.Name as HostName,host.HostID as HostID,user.Name as UserName
FROM datapath

left join
datatype
on datapath.DataTypeID = datatype.DataTypeID

left join
bg
on datapath.BGID=bg.BGID

left join
host
on datapath.HostID=host.HostID

left join
user
on datapath.KeeperID=user.UserID

		*/
		$this->db->select('datapath.PathID,datatype.Name as DatatypeName,datapath.DataPath as Datapath,bg.Name as BGName,host.Name as HostName,host.HostID as HostID,user.Name as UserName');
		$this->db->from('datapath');
		$this->db->join('datatype','datapath.DataTypeID = datatype.DataTypeID'); //拼接datatype
		$this->db->join('bg','datapath.BGID=bg.BGID');//拼接bg
		$this->db->join('host','datapath.HostID=host.HostID');//拼接host
		$this->db->join('user','datapath.KeeperID=user.UserID');//拼接user
		$this->db->where('datapath.HostID',$hostid);
		$query = $this->db->get();
		return $query->result_array();
		}		
		
	public function insert_SoftwarePath(){
		//新增資料到softwarepath
		$userinfo = $this->session->userdata('userinfo');
		$data = array(
			'SoftwareID' => $this->input->post('software'),
			'SoftwareCloudID' => $this->input->post('softwarecloud'),
			'Version' => $this->input->post('version'),
			'SettingTypeID' => $this->input->post('settingtype'),
			'SettingPath' => $this->input->post('settingpath'),
			'LogTypeID' => $this->input->post('logtype'),
			'LogPath' => $this->input->post('logpath'),
			'BGID' => $this->input->post('bg'),
			'HostID' => $this->input->post('hostid'),
			'HostCloudID' => $this->input->post('hostcloudid'),
			'Modifytime' => date('Y-m-d H:i:s',time()),
			'Createtime' => date('Y-m-d H:i:s',time()),
			'KeeperID' => $userinfo['UserID'],
			'Modifyuser' => $userinfo['UserID']
		);
		return $this->db->insert('softwarepath',$data);
		}
		
	public function update_SoftwarePath(){
		//更新資料by softwarePath
		$userinfo = $this->session->userdata('userinfo');
		$data = array(
			'SoftwareID' => $this->input->post('software'),
			'SoftwareCloudID' => $this->input->post('softwarecloud'),
			'Version' => $this->input->post('version'),
			'SettingTypeID' => $this->input->post('settingtype'),
			'SettingPath' => $this->input->post('settingpath'),
			'LogTypeID' => $this->input->post('logtype'),
			'LogPath' => $this->input->post('logpath'),
			'BGID' => $this->input->post('bg'),
			'HostID' => $this->input->post('hostid'),
			'HostCloudID' => $this->input->post('hostcloudid'),
			'Modifytime' => date('Y-m-d H:i:s',time()),
			'Createtime' => date('Y-m-d H:i:s',time()),
			'KeeperID' => $userinfo['UserID'],
			'Modifyuser' => $userinfo['UserID']
		);
		$this->db->update('softwarepath',$data,array("PathID"=>$this->input->post('editsoftwarepathid')));
		}	
	
	public function insert_DataPath(){
		//新增資料到datapath
		$userinfo = $this->session->userdata('userinfo');
		$data = array(
			'DataTypeID' => $this->input->post('datatype'),
			'DataPath' => $this->input->post('datapath'),
			'BGID' => $this->input->post('bg'),
			'HostID' => $this->input->post('hostid'),
			'HostCloudID' => $this->input->post('hostcloudid'),
			'Modifytime' => date('Y-m-d H:i:s',time()),
			'Createtime' => date('Y-m-d H:i:s',time()),
			'KeeperID' => $userinfo['UserID'],
			'Modifyuser' => $userinfo['UserID']
		);
		return $this->db->insert('datapath',$data);
		}

	public function update_DataPath(){
		//更新dataPath
		$userinfo = $this->session->userdata('userinfo');
		$data = array(
			'DataTypeID' => $this->input->post('datatype'),
			'DataPath' => $this->input->post('datapath'),
			'BGID' => $this->input->post('bg'),
			'HostID' => $this->input->post('hostid'),
			'HostCloudID' => $this->input->post('hostcloudid'),
			'Modifytime' => date('Y-m-d H:i:s',time()),
			'Createtime' => date('Y-m-d H:i:s',time()),
			'KeeperID' => $userinfo['UserID'],
			'Modifyuser' => $userinfo['UserID']
		);
		$this->db->update('datapath',$data,array("PathID"=>$this->input->post('editdatapathid')));
		}	



	public function get_softwarecloud(){
		//讀取softwarecloud
		$query = $this->db->get('softwarecloud');
		return $query->result_array();
		}
		
	public function get_softwareByCloudID($CloudID){
		//讀取software BY CloudID
		$query = $this->db->get_where('software',array('CloudID'=>$CloudID));
		return $query->result_array();
		}
	public function get_settingTypeList(){
		//讀取settingType列表
		$query = $this->db->get('settingtype');
		return $query->result_array();
		}
	public function get_logTypeList(){
		//讀取logType列表
		$query = $this->db->get('logtype');
		return $query->result_array();
		}
	public function get_bgList(){
		//讀取bg表
		$query = $this->db->get('bg');
		return $query->result_array();
		}
	public function get_dataList(){
		//讀取datatype表
		$query = $this->db->get('datatype');
		return $query->result_array();
		}
	
	public function delete_softwarepath($PathID){
		//刪除softwarepath
		$query = $this->db->delete('softwarepath', array('PathID' => $PathID)); 
		}
	public function delete_datapath($PathID){
		//刪除datapath
		$query = $this->db->delete('datapath', array('PathID' => $PathID)); 
		}
	
	public function get_wherehostclouds($hostid){
		//透過指定cloudid讀取資料 left join hostcloudid
		$this->db->select('*,host.Name as HostName,hostcloud.Name as CloudName');
		$this->db->from('host');
		$this->db->join('hostcloud','host.CloudID = hostcloud.CloudID');
		$this->db->where('host.cloudid',$hostid);
		$query = $this->db->get();
		return $query->result_array();
		}
	public function update_hosts(){
		//透過指定的host id 更新資料
		$username = $this->session->userdata('username');
		$data = array(
				'Name' => $this->input->post('hostname'),
				'CloudID' => $this->input->post('hostcloudid'),
				'Remark' => $this->input->post('remark'),
				'Modifytime' => date('Y-m-d H:i:s',time()),
				'Modifyuser' => $username
			);
		$hostid = $this->input->post('hostid');
		$this->db->update('host',$data,array('HostID'=>$hostid));
		}
	
	public function delete_hosts($hostid){
		//指定主機id刪除
		$query = $this->db->delete('host', array('HostID' => $hostid)); 
		}
	public function insert_hosts(){
		//新增軟體
		$username = $this->session->userdata('username');
		$data = array(
			'Name' => $this->input->post('hostname'),
			'CloudID' => $this->input->post('hostcloudid'),
			'Remark' => $this->input->post('remark'),
			'Modifyuser' => $username
		);
		return $this->db->insert('host',$data);
		
		}
	public function update_flag($hostid,$flag){
		$data = array(
				'flag' => $flag
			);
		$this->db->update('host',$data,array('HostID'=>$hostid));
		}
		
		
		
		//get path api for softwarepath
	public function get_softwarepathXML(){
		
		$query = $this->db->query("select host.Name as 'Hostname',hostcloud.Name as 'VM',softwarecloud.Name as 'Type',software.Name as 'Name',softwarepath.Version as 'Version',userinfo.GroupNickname as 'Group',userinfo.Name as 'Keeper',bg.Name as 'BG',softwarepath.Modifytime as 'Updatetime' from softwarepath
left join software on softwarepath.SoftwareID = software.SoftwareID
left join softwarecloud on softwarepath.SoftwareCloudID = softwarecloud.CloudID
left join host on softwarepath.HostID = host.HostID
left join hostcloud on softwarepath.HostCloudID = hostcloud.CloudID
left join (
    select user.Name as Name,user.UserID as UserID,usergroup.Name as GroupName,usergroup.Nickname as GroupNickname from user 
left join usergroup on user.GroupID = usergroup.GroupID
    ) userinfo on userinfo.UserID = softwarepath.KeeperID
left join bg on softwarepath.BGID = bg.BGID
left join settingtype on softwarepath.SettingTypeID = settingtype.SettingTypeID
left join logtype on softwarepath.LogTypeID = logtype.LogTypeID
 order by Hostname");
		
		/* 舊語法 包含logpath settingpath
		select PathID,host.Name as 'Hostname',hostcloud.Name as 'VM',softwarecloud.Name as 'Type',software.Name as 'Name',softwarepath.Version as 'Version',userinfo.GroupNickname as 'Group',settingtype.Name as 'SettingFile',softwarepath.SettingPath as '
Setting_path',logtype.Name as 'Log',softwarepath.LogPath as 'Log_path',userinfo.Name as 'Keeper',bg.Name as 'BG',softwarepath.Modifytime as 'Updatetime' from softwarepath
left join software on softwarepath.SoftwareID = software.SoftwareID
left join softwarecloud on softwarepath.SoftwareCloudID = softwarecloud.CloudID
left join host on softwarepath.HostID = host.HostID
left join hostcloud on softwarepath.HostCloudID = hostcloud.CloudID
left join (
    select user.Name as Name,user.UserID as UserID,usergroup.Name as GroupName,usergroup.Nickname as GroupNickname from user 
left join usergroup on user.GroupID = usergroup.GroupID
    ) userinfo on userinfo.UserID = softwarepath.KeeperID
left join bg on softwarepath.BGID = bg.BGID
left join settingtype on softwarepath.SettingTypeID = settingtype.SettingTypeID
left join logtype on softwarepath.LogTypeID = logtype.LogTypeID

新語法 不包
select host.Name as 'Hostname',hostcloud.Name as 'VM',softwarecloud.Name as 'Type',software.Name as 'Name',softwarepath.Version as 'Version',userinfo.GroupNickname as 'Group',userinfo.Name as 'Keeper',bg.Name as 'BG',softwarepath.Modifytime as 'Updatetime' from softwarepath
left join software on softwarepath.SoftwareID = software.SoftwareID
left join softwarecloud on softwarepath.SoftwareCloudID = softwarecloud.CloudID
left join host on softwarepath.HostID = host.HostID
left join hostcloud on softwarepath.HostCloudID = hostcloud.CloudID
left join (
    select user.Name as Name,user.UserID as UserID,usergroup.Name as GroupName,usergroup.Nickname as GroupNickname from user 
left join usergroup on user.GroupID = usergroup.GroupID
    ) userinfo on userinfo.UserID = softwarepath.KeeperID
left join bg on softwarepath.BGID = bg.BGID
left join settingtype on softwarepath.SettingTypeID = settingtype.SettingTypeID
left join logtype on softwarepath.LogTypeID = logtype.LogTypeID
 order by Hostname

		*/
		return $query->result_array();
		}
		
		//get path api for datapath
		public function get_datapathXML(){
				//讀取datatype表
				$query = $this->db->query("(select host.Name as 'Hostname',hostcloud.Name as 'Cloud',userinfo.GroupNickname as 'Data_Group',settingtype.Name as 'Type',softwarepath.SettingPath as '
PATH',userinfo.Name as 'Keeper',bg.Name as 'BG',softwarepath.Modifytime as 'Updatetime' from softwarepath
left join software on softwarepath.SoftwareID = software.SoftwareID
left join softwarecloud on softwarepath.SoftwareCloudID = softwarecloud.CloudID
left join host on softwarepath.HostID = host.HostID
left join hostcloud on softwarepath.HostCloudID = hostcloud.CloudID
left join (
    select user.Name as Name,user.UserID as UserID,usergroup.Name as GroupName,usergroup.Nickname as GroupNickname from user 
left join usergroup on user.GroupID = usergroup.GroupID
    ) userinfo on userinfo.UserID = softwarepath.KeeperID
left join bg on softwarepath.BGID = bg.BGID
left join settingtype on softwarepath.SettingTypeID = settingtype.SettingTypeID
left join logtype on softwarepath.LogTypeID = logtype.LogTypeID
where softwarepath.SettingTypeID <> '1')

union all

(select host.Name as 'Hostname',hostcloud.Name as 'Cloud',userinfo.GroupNickname as 'Data_Group',datatype.Name as 'Type',datapath.DataPath as 'PATH',userinfo.Name as 'Keeper',bg.Name as 'BG',datapath.Modifytime as 'Updatetime' from datapath
left join host on datapath.HostID = host.HostID
left join hostcloud on datapath.HostCloudID = hostcloud.CloudID
left join (
    select user.Name as Name,user.UserID as UserID,usergroup.Name as GroupName,usergroup.Nickname as GroupNickname from user 
left join usergroup on user.GroupID = usergroup.GroupID
    ) userinfo on userinfo.UserID = datapath.KeeperID
left join bg on datapath.BGID = bg.BGID
left join datatype on datapath.DataTypeID = datatype.DataTypeID)

union all

(select host.Name as 'Hostname',hostcloud.Name as 'Cloud',userinfo.GroupNickname as 'Data_Group',logtype.Name as 'Type',softwarepath.LogPath as '
PATH',userinfo.Name as 'Keeper',bg.Name as 'BG',softwarepath.Modifytime as 'Updatetime' from softwarepath
left join software on softwarepath.SoftwareID = software.SoftwareID
left join softwarecloud on softwarepath.SoftwareCloudID = softwarecloud.CloudID
left join host on softwarepath.HostID = host.HostID
left join hostcloud on softwarepath.HostCloudID = hostcloud.CloudID
left join (
    select user.Name as Name,user.UserID as UserID,usergroup.Name as GroupName,usergroup.Nickname as GroupNickname from user 
left join usergroup on user.GroupID = usergroup.GroupID
    ) userinfo on userinfo.UserID = softwarepath.KeeperID
left join bg on softwarepath.BGID = bg.BGID
left join settingtype on softwarepath.SettingTypeID = settingtype.SettingTypeID
left join logtype on softwarepath.LogTypeID = logtype.LogTypeID
where softwarepath.LogTypeID <> '1')

order by Hostname");
				
				/* 舊語法 只有datapath
				select PathID,host.Name as 'Hostname',hostcloud.Name as 'Cloud',userinfo.GroupNickname as 'Data_Group',datatype.Name as 'Type',datapath.DataPath as 'PATH',userinfo.Name as 'Keeper',bg.Name as 'BG',datapath.Modifytime as 'Updatetime' from datapath
left join host on datapath.HostID = host.HostID
left join hostcloud on datapath.HostCloudID = hostcloud.CloudID
left join (
    select user.Name as Name,user.UserID as UserID,usergroup.Name as GroupName,usergroup.Nickname as GroupNickname from user 
left join usergroup on user.GroupID = usergroup.GroupID
    ) userinfo on userinfo.UserID = datapath.KeeperID
left join bg on datapath.BGID = bg.BGID
left join datatype on datapath.DataTypeID = datatype.DataTypeID

新語法 包含softwarepath 跟 datapath
(select host.Name as 'Hostname',hostcloud.Name as 'Cloud',userinfo.GroupNickname as 'Data_Group',settingtype.Name as 'Type',softwarepath.SettingPath as '
PATH',userinfo.Name as 'Keeper',bg.Name as 'BG',softwarepath.Modifytime as 'Updatetime' from softwarepath
left join software on softwarepath.SoftwareID = software.SoftwareID
left join softwarecloud on softwarepath.SoftwareCloudID = softwarecloud.CloudID
left join host on softwarepath.HostID = host.HostID
left join hostcloud on softwarepath.HostCloudID = hostcloud.CloudID
left join (
    select user.Name as Name,user.UserID as UserID,usergroup.Name as GroupName,usergroup.Nickname as GroupNickname from user 
left join usergroup on user.GroupID = usergroup.GroupID
    ) userinfo on userinfo.UserID = softwarepath.KeeperID
left join bg on softwarepath.BGID = bg.BGID
left join settingtype on softwarepath.SettingTypeID = settingtype.SettingTypeID
left join logtype on softwarepath.LogTypeID = logtype.LogTypeID
where softwarepath.SettingTypeID <> '1')

union all

(select host.Name as 'Hostname',hostcloud.Name as 'Cloud',userinfo.GroupNickname as 'Data_Group',datatype.Name as 'Type',datapath.DataPath as 'PATH',userinfo.Name as 'Keeper',bg.Name as 'BG',datapath.Modifytime as 'Updatetime' from datapath
left join host on datapath.HostID = host.HostID
left join hostcloud on datapath.HostCloudID = hostcloud.CloudID
left join (
    select user.Name as Name,user.UserID as UserID,usergroup.Name as GroupName,usergroup.Nickname as GroupNickname from user 
left join usergroup on user.GroupID = usergroup.GroupID
    ) userinfo on userinfo.UserID = datapath.KeeperID
left join bg on datapath.BGID = bg.BGID
left join datatype on datapath.DataTypeID = datatype.DataTypeID)

union all

(select host.Name as 'Hostname',hostcloud.Name as 'Cloud',userinfo.GroupNickname as 'Data_Group',logtype.Name as 'Type',softwarepath.LogPath as '
PATH',userinfo.Name as 'Keeper',bg.Name as 'BG',softwarepath.Modifytime as 'Updatetime' from softwarepath
left join software on softwarepath.SoftwareID = software.SoftwareID
left join softwarecloud on softwarepath.SoftwareCloudID = softwarecloud.CloudID
left join host on softwarepath.HostID = host.HostID
left join hostcloud on softwarepath.HostCloudID = hostcloud.CloudID
left join (
    select user.Name as Name,user.UserID as UserID,usergroup.Name as GroupName,usergroup.Nickname as GroupNickname from user 
left join usergroup on user.GroupID = usergroup.GroupID
    ) userinfo on userinfo.UserID = softwarepath.KeeperID
left join bg on softwarepath.BGID = bg.BGID
left join settingtype on softwarepath.SettingTypeID = settingtype.SettingTypeID
left join logtype on softwarepath.LogTypeID = logtype.LogTypeID
where softwarepath.LogTypeID <> '1')

order by Hostname

				*/
				return $query->result_array();
				}
			
			
			
	
	}

?>