<?php
class Pandanoutput extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('pandan_model');
		}
	//輸出xml格是 所有盤點資料
	public function GetAllSoftwarePathData($user,$pwd){
		if($user==="root" && $pwd==="Admin123"){
			$data = $this->pandan_model->get_softwarepathXML();
			/*foreach($data as $row){
				echo $row['PathID']."<br>";
				}*/
			
			ob_start();
			header('Content-Type: text/xml');
			
			$dom = new DOMDocument('1.0');
			$dom->encoding = 'UTF-8';
			
			// 建立母節點 $root
			$root = $dom->createElement('Paths');
			$dom->appendChild($root);
			
			// 設定屬性
			//$root->setAttribute('name', 'xxx');
			foreach($data as $row){
				$child = $dom->createElement('Path');
				$root->appendChild($child);
				
				/*$PathIDtag = $dom->createElement('PathID');
				$child->appendChild($PathIDtag);
				$text = $dom->createTextNode($row["PathID"]);
				$PathIDtag->appendChild($text);*/
				
				//PathID
				$PathIDtag = $dom->createElement('PathID');
				$child->appendChild($PathIDtag);
				$text = $dom->createTextNode($row["PathID"]);
				$PathIDtag->appendChild($text);
				//host.name
				$Hostnametag = $dom->createElement('Hostname');
				$child->appendChild($Hostnametag);
				$text = $dom->createTextNode($row["Hostname"]);
				$Hostnametag->appendChild($text);
				//hostcloud.name
				$VMtag = $dom->createElement('VM');
				$child->appendChild($VMtag);
				$text = $dom->createTextNode($row["VM"]);
				$VMtag->appendChild($text);
				//softwarecloud.name
				$Typetag = $dom->createElement('Type');
				$child->appendChild($Typetag);
				$text = $dom->createTextNode($row["Type"]);
				$Typetag->appendChild($text);
				//software.name
				$Nametag = $dom->createElement('Name');
				$child->appendChild($Nametag);
				$text = $dom->createTextNode($row["Name"]);
				$Nametag->appendChild($text);
				//softwarepath.version
				$Versiontag = $dom->createElement('Version');
				$child->appendChild($Versiontag);
				$text = $dom->createTextNode($row["Version"]);
				$Versiontag->appendChild($text);
				//usergroup.name
				$Grouptag = $dom->createElement('Group');
				$child->appendChild($Grouptag);
				$text = $dom->createTextNode($row["Group"]);
				$Grouptag->appendChild($text);
				//settingtype.name
				$SettingFiletag = $dom->createElement('SettingFile');
				$child->appendChild($SettingFiletag);
				$text = $dom->createTextNode($row["SettingFile"]);
				$SettingFiletag->appendChild($text);
				//softwarepath.settingpath 
				$Setting_pathtag = $dom->createElement('Setting_path');
				$child->appendChild($Setting_pathtag);
				$text = $dom->createTextNode($row["Setting_path"]);
				$Setting_pathtag->appendChild($text);
				//logtype.name
				$Logtag = $dom->createElement('Log');
				$child->appendChild($Logtag);
				$text = $dom->createTextNode($row["Log"]);
				$Logtag->appendChild($text);
				//softwarepath.logpath 
				$Log_pathtag = $dom->createElement('Log_path');
				$child->appendChild($Log_pathtag);
				$text = $dom->createTextNode($row["Log_path"]);
				$Log_pathtag->appendChild($text);
				//user.name 
				$Keepertag = $dom->createElement('Keeper');
				$child->appendChild($Keepertag);
				$text = $dom->createTextNode($row["Keeper"]);
				$Keepertag->appendChild($text);
				//bg.name 
				$BGtag = $dom->createElement('BG');
				$child->appendChild($BGtag);
				$text = $dom->createTextNode($row["BG"]);
				$BGtag->appendChild($text);
				//softwarepath.modifyname 
				$Updatetimetag = $dom->createElement('Updatetime');
				$child->appendChild($Updatetimetag);
				$text = $dom->createTextNode($row["Updatetime"]);
				$Updatetimetag->appendChild($text);
				/*
				$SoftwareCloudtag = $dom->createElement('SoftwareCloud');
				$child->appendChild($SoftwareCloudtag);
				$text = $dom->createTextNode($row["SoftwareCloudID"]);
				$SoftwareCloudtag->appendChild($text);
				
				$SoftwareCloudtag = $dom->createElement('SoftwareCloud');
				$child->appendChild($SoftwareCloudtag);
				$text = $dom->createTextNode($row["SoftwareCloudID"]);
				$SoftwareCloudtag->appendChild($text);
				
				$SoftwareCloudtag = $dom->createElement('SoftwareCloud');
				$child->appendChild($SoftwareCloudtag);
				$text = $dom->createTextNode($row["SoftwareCloudID"]);
				$SoftwareCloudtag->appendChild($text);*/
				}
			
			
			
			// 建立 $root 的子節點 $child
			//$child = $dom->createElement('Paths');
			//$root->appendChild($child);
			
			
			
			
			$xmlStr = $dom->saveXML();
			echo $xmlStr;
			
				
				
			}
		else{
			redirect('signout','refresh');
			return;
			}


		
		}
	
	
	public function GetAllDataPathData($user,$pwd){
		if($user==="root" && $pwd==="Admin123"){
			$data = $this->pandan_model->get_datapathXML();
			/*foreach($data as $row){
				echo $row['PathID']."<br>";
				}*/
			
			ob_start();
			header('Content-Type: text/xml');
			
			$dom = new DOMDocument('1.0');
			$dom->encoding = 'UTF-8';
			
			// 建立母節點 $root
			$root = $dom->createElement('Paths');
			$dom->appendChild($root);
			
			// 設定屬性
			//$root->setAttribute('name', 'xxx');
			foreach($data as $row){
				$child = $dom->createElement('Path');
				$root->appendChild($child);
				
				/*$PathIDtag = $dom->createElement('PathID');
				$child->appendChild($PathIDtag);
				$text = $dom->createTextNode($row["PathID"]);
				$PathIDtag->appendChild($text);*/
				
				//PathID
				$PathIDtag = $dom->createElement('PathID');
				$child->appendChild($PathIDtag);
				$text = $dom->createTextNode($row["PathID"]);
				$PathIDtag->appendChild($text);
				//host.name
				$Hostnametag = $dom->createElement('Hostname');
				$child->appendChild($Hostnametag);
				$text = $dom->createTextNode($row["Hostname"]);
				$Hostnametag->appendChild($text);
				//hostcloud.name
				$Cloudtag = $dom->createElement('Cloud');
				$child->appendChild($Cloudtag);
				$text = $dom->createTextNode($row["Cloud"]);
				$Cloudtag->appendChild($text);
				//usergroup.name
				$Grouptag = $dom->createElement('Data_Group');
				$child->appendChild($Grouptag);
				$text = $dom->createTextNode($row["Data_Group"]);
				$Grouptag->appendChild($text);
				//datatype.name
				$Typetag = $dom->createElement('Type');
				$child->appendChild($Typetag);
				$text = $dom->createTextNode($row["Type"]);
				$Typetag->appendChild($text);
				//datapath.path
				$PATHtag = $dom->createElement('PATH');
				$child->appendChild($PATHtag);
				$text = $dom->createTextNode($row["PATH"]);
				$PATHtag->appendChild($text);
				//user.name 
				$Keepertag = $dom->createElement('Keeper');
				$child->appendChild($Keepertag);
				$text = $dom->createTextNode($row["Keeper"]);
				$Keepertag->appendChild($text);
				//bg.name 
				$BGtag = $dom->createElement('BG');
				$child->appendChild($BGtag);
				$text = $dom->createTextNode($row["BG"]);
				$BGtag->appendChild($text);
				//softwarepath.modifyname 
				$Updatetimetag = $dom->createElement('Updatetime');
				$child->appendChild($Updatetimetag);
				$text = $dom->createTextNode($row["Updatetime"]);
				$Updatetimetag->appendChild($text);
				/*
				$SoftwareCloudtag = $dom->createElement('SoftwareCloud');
				$child->appendChild($SoftwareCloudtag);
				$text = $dom->createTextNode($row["SoftwareCloudID"]);
				$SoftwareCloudtag->appendChild($text);
				
				$SoftwareCloudtag = $dom->createElement('SoftwareCloud');
				$child->appendChild($SoftwareCloudtag);
				$text = $dom->createTextNode($row["SoftwareCloudID"]);
				$SoftwareCloudtag->appendChild($text);
				
				$SoftwareCloudtag = $dom->createElement('SoftwareCloud');
				$child->appendChild($SoftwareCloudtag);
				$text = $dom->createTextNode($row["SoftwareCloudID"]);
				$SoftwareCloudtag->appendChild($text);*/
				}
			
			
			
			// 建立 $root 的子節點 $child
			//$child = $dom->createElement('Paths');
			//$root->appendChild($child);
			
			
			
			
			$xmlStr = $dom->saveXML();
			echo $xmlStr;
			
				
				
			}
		else{
			redirect('signout','refresh');
			return;
			}


		
		}
}
