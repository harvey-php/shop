<?php
header("content-type:text/html;charset=utf-8");
session_start();

//获得session中所有商品
$product = $_SESSION["car"];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>我的购物车</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <script type="text/javascript">
      //删除单个商品
      function delBook(bookId)
      {
          window.location = "act.php?act=delete&bookId="+bookId;
      }
      //清空购物车
      function clearCar()
      {
          if(confirm("是否清空购物车？"))
          {
              window.location = "act.php?act=clear";
          }
      }
    </script>
  </head>
  <body>
    <center>
      <h2>我的购物车</h2>
    </center>
    <br>
    <table border="1" align="center" width="600">
      <tr>
        <td>编号</td>
        <td>名称</td>
        <td>单价</td>
        <td>数量</td>
        <td>该商品总价</td>
        <td>操作</td>
      </tr>
<?php
$totalPrice = 0; //所有商品总价
if (!empty($product)) {
	//显示所有商品
	foreach ($product as $v) {
		$price = $v["price"] * $v["bookCount"]; //计算该商品总价
		$totalPrice += $price; //累加求和
		echo "<tr>";
		echo "  <td>{$v["bookId"]}</td>";
		echo "  <td>{$v["bookName"]}</td>";
		echo "  <td>{$v["price"]}</td>";
		echo "  <td>{$v["bookCount"]}</td>";
		echo "  <td>{$price}</td>";
		echo "  <td><input type='button' value='删除' onclick='delBook({$v["bookId"]})'></td>";
		echo "</tr>";
	}
} else {
	echo "<tr>";
	echo "  <td colspan='6' align='center' height='50'><i>购物车中暂时没有可以查看的商品</i></td>";
	echo "</tr>";
}
?>
      <tr>
        <td colspan="6" align="left">
          <a href="index.php">继续购物</a>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          所有商品总价：<?php echo $totalPrice ?>￥
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="javascript:clearCar()">清空购物车</a>
        </td>
      </tr>
    </table>
  </body>
</html>
