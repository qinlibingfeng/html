<html>


<body>
    <div align="right">  
        <a href="http://172.17.1.90/tongxun/input.php" mce_href="input.php">添加</a> 
    </div>  
    <?php  
    /** 
     * Index.php 
     * @author OH.C 
     * QQ: 569742950 
     * BLOG: http://blog.csdn.net/bllqbz 
     * @copyright 2010 
     */  
    $sql = "SELECT * FROM `AddrList`"; //查询数据库  
    require('conn.php');    //调用conn.php文件，执行数据库操作  
    ?>  
    <!---创建一个表格--->  
    <table width="100%" border="1">  
        <tr>  
            <th bgcolor="#CCCCCC" scope="col">姓名</th>  
            <th bgcolor="#CCCCCC" scope="col">性别</th>  
            <th bgcolor="#CCCCCC" scope="col">生日</th>  
            <th bgcolor="#CCCCCC" scope="col">QQ</th>  
            <th bgcolor="#CCCCCC" scope="col">手机</th>  
            <th bgcolor="#CCCCCC" scope="col">邮箱</th>  
            <th bgcolor="#CCCCCC" scope="col">地址</th>  
        </tr>  
    <?php  
    while($row = MySQL_fetch_row($result)) //循环开始  
    {  
        //判断性别  
        if($row[2]==0)  
        {  
            $sex = 'Boy';  
        }  
        else  
        {  
            $sex = 'Gril';  
        }  
    ?>  
        <!---被循环的HTML表格中带有PHP代码--->  
          <tr>  
            <td><?php echo $row[1];?></td>  <!--姓名-->  
            <td><?php echo $sex;?></td> <!--性别-->  
            <td><?php echo $row[3];?></td>  <!--生日-->  
            <td><?php echo $row[4];?></td>  <!--QQ-->  
            <td><?php echo $row[5];?></td> <!--手机-->  
            <td><?php echo $row[6];?></td> <!--邮箱-->  
            <td><?php echo $row[7];?></td> <!--地址-->  
          </tr>  
    <?php  
    }  
    ?>  
    </table>  
</body>
<html>
