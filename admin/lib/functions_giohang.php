<?php
	function get_product_info($pid)
	{
		global $d, $row;
		$sql = "select * from #_product where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row;
	}
	function get_array_mausize($pid,$kind)
	{
		$arr = array();
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++)
		{
			$idpro = $_SESSION['cart'][$i]['productid'];
			$mau = $_SESSION['cart'][$i]['mau'];
			$size = $_SESSION['cart'][$i]['size'];

			if($pid==$idpro)
			{
				if($kind=='mau') if($mau>0) $arr[] = $mau;
				if($kind=='size') if($size>0) $arr[] = $size;
			}
		}
	
		return $arr;
	}
	function get_product_mau($mau)
	{
		if($mau!=0)
		{
			global $d, $row;
			$sql = "select * from #_product_mau where id=$mau";
			$d->query($sql);
			$row = $d->fetch_array();
			return $row['tenvi'];
		}
	}
	function get_product_size($size)
	{
		if($size!=0)
		{
			global $d, $row;
			$sql = "select * from #_product_size where id=$size";
			$d->query($sql);
			$row = $d->fetch_array();
			return $row['tenvi'];
		}
	}
	function get_price_coupon()
	{
		if($_SESSION['coupon']['loai']==0) 
		{ 
			$gia=$_SESSION['coupon']['price']."%"; 
		} 
		else if($_SESSION['coupon']['loai']==1) 
		{ 
			$gia=number_format($_SESSION['coupon']['price'],0, ',', '.')."đ"; 
		}
		return $gia;
	}
	function get_price($pid)
	{
		global $d, $row;
		$sql = "select gia from table_product where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['gia'];
	}
	function get_price_km($pid)
	{
		global $d, $row;
		$sql = "select giagiam from table_product where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['giagiam'];
	}
	function check_price($pid)
	{
		global $d, $row;
		$sql = "select giagiam from table_product where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		if($row['giagiam']>0) return true;
		else return false;
	}
	function get_total_price_coupon($tong)
	{
		if($_SESSION['coupon']['loai']==0)
		{
			$total_coupon = $tong-(($tong*$_SESSION['coupon']['price'])/100);
		}
		if($_SESSION['coupon']['loai']==1)
		{
			$total_coupon = $tong-$_SESSION['coupon']['price'];
		}
		return $total_coupon;
	}
	function remove_product($pid,$mau,$size)
	{
		$pid=intval($pid);
		$mau=intval($mau);
		$size=intval($size);
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++)
		{
			if($pid==$_SESSION['cart'][$i]['productid'] && $mau==$_SESSION['cart'][$i]['mau'] && $size==$_SESSION['cart'][$i]['size'])
			{
				unset($_SESSION['cart'][$i]);
				break;
			}
		}
		$_SESSION['cart']=array_values($_SESSION['cart']);
	}
	function get_order_total()
	{
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++)
		{
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			if(check_price($pid))
			{
				$price=get_price_km($pid);
			}
			else
			{
				$price=get_price($pid);
			}
			$sum+=$price*$q;
		}
		return $sum;
	}
	function get_total()
	{
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++)
		{
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$sum+=$q;
		}
		return $sum;
	}
	function addtocart($pid,$q,$mau,$size)
	{
		if($pid<1 or $q<1) return;
		
		global $d, $row;

		if($mau==0 && $size==0)
		{
			if(!product_exists($pid,$q,$mau,$size))
			{
				$max=count($_SESSION['cart']);
				$_SESSION['cart'][$max]['productid']=$pid;
				$_SESSION['cart'][$max]['qty']=$q;
				$_SESSION['cart'][$max]['mau']=$mau;
				$_SESSION['cart'][$max]['size']=$size;
			}
		}
		else
		{
			if(is_array($_SESSION['cart']))
			{
				if(!product_exists($pid,$q,$mau,$size))
				{
					$max=count($_SESSION['cart']);
					$_SESSION['cart'][$max]['productid']=$pid;
					$_SESSION['cart'][$max]['qty']=$q;
					$_SESSION['cart'][$max]['mau']=$mau;
					$_SESSION['cart'][$max]['size']=$size;
				}
			}
			else
			{
				$_SESSION['cart']=array();
				$_SESSION['cart'][0]['productid']=$pid;
				$_SESSION['cart'][0]['qty']=$q;
				$_SESSION['cart'][0]['mau']=$mau;
				$_SESSION['cart'][0]['size']=$size;
			}
		}
	}
	function product_exists($pid,$q,$mau,$size)
	{
		$pid=intval($pid);
		$q=(intval($q)>1)?intval($q):1;
		$mau=intval($mau);
		$size=intval($size);
		$max=count($_SESSION['cart']);
		$flag=0;
		for($i=0;$i<$max;$i++)
		{
			if(($pid==$_SESSION['cart'][$i]['productid']) && ($mau==$_SESSION['cart'][$i]['mau']) && ($size==$_SESSION['cart'][$i]['size']))
			{
				$_SESSION['cart'][$i]['qty']+=$q;
				$flag=1;
			}
		}
		return $flag;
	}
	function update_product($pid,$mau,$size,$mauold,$sizeold)
	{
		$pid=intval($pid);
		$mau=intval($mau);
		$size=intval($size);
		$mauold=intval($mauold);
		$sizeold=intval($sizeold);
		$max=count($_SESSION['cart']);
		$flag=0;
		for($i=0;$i<$max;$i++)
		{
			if(($pid==$_SESSION['cart'][$i]['productid']) && ($mauold==$_SESSION['cart'][$i]['mau']) && ($sizeold==$_SESSION['cart'][$i]['size']))
			{
				$_SESSION['cart'][$i]['mau']=$mau;
				$_SESSION['cart'][$i]['size']=$size;
				break;
			}
		}
	}
?>