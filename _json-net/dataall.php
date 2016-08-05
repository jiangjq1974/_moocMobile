<?php
// 说明：获取完整URL

function curPageURL() 
{
    $pageURL = 'http';

    if ($_SERVER["HTTPS"] == "on") 
    {
        $pageURL .= "s";
    }
    $pageURL .= "://";

    if ($_SERVER["SERVER_PORT"] != "80") 
    {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } 
    else 
    {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
	
	$pageURL = substr($pageURL, -1);//om 负数从结尾开始取
	//echo $pageURL; //om 负数从结尾开始
	//$sql = "SELECT * FROM article where category_id = ".$pageURL." order by last_date desc";
	//echo $sql;
	
	
	$conn = @mysql_connect("mysql.dldns.cn","db_dlintnav","1k4M)nNlyH%omP5@");
	if (!$conn){
	  die("连接数据库失败：" . mysql_error());
	}
	
	mysql_select_db("db_dlintnav", $conn);
	//mysql_query("set character set 'gbk'");   //避免中文乱码字符转换
	mysql_query("set character set 'utf8'");   // PHP 文件为 utf-8 格式时使用
	
	if( $pageURL == 0){
		$sql = "SELECT * FROM article order by last_date desc";
	
		$result = mysql_query($sql);                //得到查询结果数据集
	

		
	}else{	
		$sql = "SELECT * FROM article where category_id = ".$pageURL." order by last_date desc";
		
		$result = mysql_query($sql);                //得到查询结果数据集		

		//循环从数据集取出数据
		$row = mysql_fetch_array($result);
		
		/*单条数据*/
		//echo $_GET['callback'].'('.json_encode(array('jsonObj'=>$row)).')'; 
		
		//OK
		//$jsondata = "{symbol:'IBM', price:120}";  
		//echo $_GET['callback'].'('.$jsondata.')'; 
		
		//OK
		//echo json_encode(array('jsonObj'=>$row));
		
		/*
		while( $row = mysql_fetch_array($result) ){		
		  echo "{".$sTemp."title".$sTemp.":".$sTemp.$row['title'].$sTemp.",";
		  echo $sTemp."content".$sTemp.":".$sTemp.$row['content'].$sTemp.",";
		}
		echo"]";
		*/
		
		
		
		//数据集
		$users=array();
		$i=0;
		while( $row = mysql_fetch_array($result) ){
			//echo $row['id'].'———–'.$row['name'].'</br>';
			$users[$i]=$row;
			$i++;
		}
		//echo json_encode(array('dataList'=>$users));
		echo $_GET['callback'].'('.json_encode(array('dataList'=>$users)).')';
		//echo $_GET['callback'].'('.json_encode(array('dataList'=>$users)).')';

		
	}
	mysql_close(); //关闭连接

}
?> 






