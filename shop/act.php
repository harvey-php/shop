<?php
header("content-type:text/html;charset=utf-8");
//操纵购物车
session_start();

//获得url中的参数
$bookId = $_GET["bookId"];
$act = $_GET["act"]; //操作类型

if ($act == "delete") //删除单个商品
{
	unset($_SESSION["car"][$bookId]);
} elseif ($act == "clear") //清空购物车
{
	unset($_SESSION["car"]);
} elseif ($act == "buy") //购买商品
{
	//2、获得该商品的详细信息
	$url = "mysql:host=localhost;dbname=shop";
	$user = "root";
	$pwd = "";
	$conn = new PDO($url, $user, $pwd);
	$stmt = $conn->query("select * from bookInfo where bookId={$bookId}");
	$rs = $stmt->fetch();
	$bookInfo = array(
		"bookId" => $rs["bookId"],
		"bookName" => $rs["bookName"],
		"price" => $rs["price"],
		"bookCount" => 1, //产品数量，默认第一次购买该商品时，数量应为1
	);

	//3、将产品信息，添加到session
	if (isset($_SESSION["car"][$bookId])) {
		//数量加一
		$_SESSION["car"][$bookId]["bookCount"]++;
	} else {
		$_SESSION["car"][$bookId] = $bookInfo;
	}
}

//跳转到购物车页面
header("location:car.php");
