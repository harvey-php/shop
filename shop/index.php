<!DOCTYPE html>
<html>
  <head>
    <title>商城首页</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <script type="text/javascript">
      function shopBook(bookId)
      {
          window.location = "act.php?act=buy&bookId="+bookId;
      }
    </script>
  </head>
  <body>
    <center>
      <h2>商城首页</h2>
    </center>
    <br>
    <table border="1" align="center" width="600">
      <tr>
        <td>编号</td>
        <td>名称</td>
        <td>单价</td>
        <td>操作</td>
      </tr>
<?php
$url = "mysql:host=localhost;dbname=shop";
$user = "root";
$pwd = "";
$conn = new PDO($url, $user, $pwd);
$stmt = $conn->query("select * from bookInfo");
$rs = $stmt->fetchAll();
foreach ($rs as $v) {
	echo "<tr>";
	echo "  <td>{$v["bookId"]}</td>";
	echo "  <td>{$v["bookName"]}</td>";
	echo "  <td>{$v["price"]}</td>";
	echo "  <td><input type='button' value='放入购物车' onclick='shopBook({$v["bookId"]})'></td>";
	echo "</tr>";
}
?>
    </table>
  </body>
</html>

