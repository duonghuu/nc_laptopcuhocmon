<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$type=$_REQUEST['type'];

switch($act)
{
	case "capnhat":
		get_news_static();
		$template = "news_static/man/item_add";
		break;
	case "save":
		save_news_static();
		break;

	/* Begin Man Photo News Static */
	case "man_photo":
		get_photos();
		$template = "news_static/photo/photos";
		break;
	case "add_photo":
		$template = "news_static/photo/photo_add";
		break;
	case "edit_photo":
		get_photo();
		$template = "news_static/photo/photo_edit";
		break;
	case "save_photo":
		save_photo();
		break;
	case "delete_photo":
		delete_photo();
		break;
	/* End Man Photo News Static */

	default:
		$template = "index";
}

function fns_Rand_digit($min,$max,$num)
{
	$result='';
	for($i=0;$i<$num;$i++){
		$result.=rand($min,$max);
	}
	return $result;	
}

function get_news_static()
{
	global $d, $item, $list_hinhanh;
	$type=$_REQUEST['type'];

	$d->setTable('news_static');
	$d->setWhere('type', $type);
	$d->select();
	$item = $d->fetch_array();

	/* Lấy nhiều hình ảnh */
	$sql = "select * from #_news_static_hinhanh where type='".$type."' order by id asc";
	$d->query($sql);
	$list_hinhanh = $d->result_array();	
}

function save_news_static()
{
	global $d,$config;
	
	$type=$_REQUEST['type'];
	$file_name=fns_Rand_digit(0,9,5);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=news_static&act=capnhat&type=".$type."");
	
	$d->setTable('news_static');
	$d->setWhere('type', $type);
	$d->select();
	$row_news_static = $d->result_array();

	if($photo = upload_image("file", $config['news_static'][$type]['img_type'],_upload_news,$file_name))
	{
		$data['photo'] = $photo;
		$data['thumb'] = create_thumb($data['photo'], $config['news_static'][$type]['thumb_width'], $config['news_static'][$type]['thumb_height'], _upload_news,$file_name,$config['news_static'][$type]['thumb_ratio']);
		$d->setTable('news_static');
		$d->setWhere('type',$type);			
		$d->select();
		if($d->num_rows()>0)
		{
			$row = $d->fetch_array();
			delete_file(_upload_news.$row['photo']);
			delete_file(_upload_news.$row['thumb']);
		}
	}
	
	foreach($config['lang'] as $key => $value) 
	{
		$data['ten'.$key] = magic_quote($_POST['ten'.$key]);
		$data['mota'.$key] = magic_quote($_POST['mota'.$key]);
		$data['noidung'.$key] = magic_quote($_POST['noidung'.$key]);
	}
	$data['tenkhongdau'] = changeTitle(magic_quote($_POST['tenvi']));
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['link_video'] = magic_quote($_POST['link_video']);
	$data['seo_h1'] = magic_quote($_POST['seo_h1']);
	$data['seo_h2'] = magic_quote($_POST['seo_h2']);
	$data['seo_h3'] = magic_quote($_POST['seo_h3']);
	$data['title'] = magic_quote($_POST['title']);
	$data['keywords'] = magic_quote($_POST['keywords']);
	$data['description'] = magic_quote($_POST['description']);
	$data['type'] = $type;

	if(count($row_news_static)>0)
	{
		/* Xử Lý Lưu Nhiều Hình Ảnh */
		if (isset($_FILES['files'])) 
		{
	        $myFile = $_FILES['files'];
	        $fileCount = count($myFile["name"]);
	        $file_name=fns_Rand_digit(0,9,6);

	        for ($i = 0; $i < $fileCount; $i++) 
	        {  
	            if(move_uploaded_file($myFile["tmp_name"][$i], _upload_news."/".$file_name."_".$myFile["name"][$i]))
	            {       							
					$data1['photo'] = $file_name."_".$myFile["name"][$i];
					$data1['thumb'] = create_thumb($data1['photo'], $config['news_static'][$type]['thumb_width_photo'], $config['news_static'][$type]['thumb_height_photo'], _upload_news, $file_name."_".$myFile["name"][$i],$config['news_static'][$type]['thumb_ratio_photo']);	
					$data1['stt'] = (int)$_POST['stt-multi-pic'][$i];		
					// $data1['tenvi'] = $_POST['ten-multi-pic'][$i];
					$data1['type'] = $type;
					$data1['hienthi'] = 1;
					$d->reset();
					$d->setTable('news_static_hinhanh');
					$d->insert($data1);
	            }
	        }
	    }
	    $d->reset();
		$d->setTable('news_static');
		$d->setWhere('type',$type);
		
		if($d->update($data))
			redirect("index.php?com=news_static&act=capnhat&type=".$type."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=news_static&act=capnhat&type=".$type."");
	}
	else
	{
		if($data['tenkhongdau']!='' || $data['motavi']!='' || $data['noidungvi']!='')
		{
			$d->reset();
			$d->setTable('news_static');

			if($d->insert($data))
			{
				/* Xử Lý Lưu Nhiều Hình Ảnh */
				if (isset($_FILES['files'])) 
				{
		            $myFile = $_FILES['files'];
		            $fileCount = count($myFile["name"]);
		            $file_name=fns_Rand_digit(0,9,6);

		            for ($i = 0; $i < $fileCount; $i++) 
		            {  
			            if(move_uploaded_file($myFile["tmp_name"][$i], _upload_news."/".$file_name."_".$myFile["name"][$i]))
			            {       							
							$data1['photo'] = $file_name."_".$myFile["name"][$i];
							$data1['thumb'] = create_thumb($data1['photo'], $config['news_static'][$type]['thumb_width_photo'], $config['news_static'][$type]['thumb_height_photo'], _upload_news, $file_name."_".$myFile["name"][$i],$config['news_static'][$type]['thumb_ratio_photo']);	
							$data1['stt'] = (int)$_POST['stt-multi-pic'][$i];		
							// $data1['tenvi'] = $_POST['ten-multi-pic'][$i];	
							$data1['type'] = $type;
							$data1['hienthi'] = 1;
							$d->reset();
							$d->setTable('news_static_hinhanh');
							$d->insert($data1);
			            }
		            }
		        }
				redirect("index.php?com=news_static&act=capnhat&type=".$type."");
			}
			else
				transfer("Lưu dữ liệu bị lỗi", "index.php?com=news_static&act=capnhat&type=".$type."");
		}
		redirect("index.php?com=news_static&act=capnhat&type=".$type."");
	}
}

/* Begin Man Photo News Static */
function get_photos()
{
	global $d, $items, $paging;	
	$type=$_REQUEST['type'];
	
	$sql = "select * from #_news_static_hinhanh where type='".$type."' order by stt,id desc ";			
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=news_static&act=man_photo&type=".$type."";
	$maxR=10;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_photo()
{
	global $d, $item, $list_cat;
	$type = $_REQUEST['type'];
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=news_static&act=man_photo&type=".$type."");
	
	$d->setTable('news_static_hinhanh');
	$d->setWhere('type', $type);
	$d->setWhere('id', $id);
	$d->select();
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=news_static&act=man_photo&type=".$type."");
	$item = $d->fetch_array();
	$d->reset();
}

function save_photo()
{
	global $d,$config;

	$type = $_REQUEST['type'];
	$file_name=fns_Rand_digit(0,9,10);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=news_static&act=man_photo&type=".$type."");
	
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	if($id)
	{
		if($photo = upload_image("file", $config['news_static'][$type]['img_type_photo'], _upload_news,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['news_static'][$type]['thumb_width_photo'], $config['news_static'][$type]['thumb_height_photo'], _upload_news,$file_name,$config['news_static'][$type]['thumb_ratio_photo']);
			$d->setTable('news_static_hinhanh');
			$d->setWhere('type', $type);
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0)
			{
				$row = $d->fetch_array();
				delete_file(_upload_news.$row['photo']);				
				delete_file(_upload_news.$row['thumb']);				
			}
		}
		
		foreach($config['lang'] as $key => $value) 
		{
			$data['ten'.$key] = magic_quote($_POST['ten'.$key]);
			$data['mota'.$key] = magic_quote($_POST['mota'.$key]);
			$data['noidung'.$key] = magic_quote($_POST['noidung'.$key]);
		}
		$data['tenkhongdau'] = changeTitle(magic_quote($_POST['tenvi']));
		$data['mau'] = magic_quote($_POST['mau']);
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;

		$d->reset();
		$d->setTable('news_static_hinhanh');
		$d->setWhere('type', $type);
		$d->setWhere('id', $id);
		if(!$d->update($data)) transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=news_static&act=man_photo&type=".$type."");
		redirect("index.php?com=news_static&act=man_photo&type=".$type."");
	}
	{
		for($i=0; $i<5; $i++)
		{
			if($photo = upload_image("file".$i, $config['news_static'][$type]['img_type_photo'], _upload_news,$file_name.$i))
			{
				$data['photo'] = $photo;
				$data['thumb'] = create_thumb($data['photo'], $config['news_static'][$type]['thumb_width_photo'], $config['news_static'][$type]['thumb_height_photo'], _upload_news,$file_name.$i,$config['news_static'][$type]['thumb_ratio_photo']);
				
				foreach($config['lang'] as $key => $value) 
				{
					$data['ten'.$key] = magic_quote($_POST['ten'.$key.$i]);
					$data['mota'.$key] = magic_quote($_POST['mota'.$key.$i]);
					$data['noidung'.$key] = magic_quote($_POST['noidung'.$key.$i]);
				}
				$data['tenkhongdau'] = changeTitle(magic_quote($_POST['tenvi'.$i]));
				$data['mau'] = magic_quote($_POST['mau'.$i]);
				$data['stt'] = $_POST['stt'.$i];
				$data['hienthi'] = isset($_POST['hienthi'.$i]) ? 1 : 0;
				$data['type'] = $type;
				
				$d->setTable('news_static_hinhanh');
				if(!$d->insert($data)) transfer("Lưu dữ liệu bị lỗi", "index.php?com=news_static&act=man_photo&type=".$type."");
			}
		}
		redirect("index.php?com=news_static&act=man_photo&type=".$type."");
	}
}

function delete_photo()
{
	global $d;
	$type=$_REQUEST['type'];
	
	if(isset($_GET['id']))
	{
		$id=themdau($_GET['id']);

		$d->setTable('news_static_hinhanh');
		
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		$d->select();
		if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=news_static&act=man_photo&type=".$type."");
		$row = $d->fetch_array();
			delete_file(_upload_news.$row['photo']);		
			delete_file(_upload_news.$row['thumb']);		
		if($d->delete())
			redirect("index.php?com=news_static&act=man_photo&type=".$type."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=news_static&act=man_photo&type=".$type."");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_news_static_hinhanh where id='".$id."' and type='".$type."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);
			}
			$sql = "delete from #_news_static_hinhanh where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=news_static&act=man_photo&type=".$type."");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=news_static&act=man_photo&type=".$type."");
}
/* End Man Photo News Static */
?>