   
<html>

<body>
 <form id="form1" name="form1" method="post" action="Post.php">  
      <table width="381" border="1" align="center" bordercolor="#DDDDDD">  
        <tr>  
          <td width="64">姓名</td>  
          <td width="307"><label>  
            <input name="name" type="text" id="name" />  
          </label></td>  
        </tr>  
        <tr>  
          <td>性别</td>  
          <td><label>  
            <input name="sex" type="radio" value="0" checked="checked" />  
          男   
          <input type="radio" name="sex" value="1" />  
          女</label></td>  
        </tr>  
        <tr>  
          <td>生日</td>  
          <td><label>  
            <input name="birthday" type="text" id="birthday" />  
            <input type="button" name="Submit" value="选择" />  
          </label></td>  
        </tr>  
        <tr>  
          <td>QQ</td>  
          <td><label>  
            <input name="qq" type="text" id="qq" />  
          </label></td>  
        </tr>  
        <tr>  
          <td>手机</td>  
          <td><label>  
            <input name="mobile" type="text" id="mobile" />  
          </label></td>  
        </tr>  
        <tr>  
          <td>邮箱</td>  
          <td><label>  
            <input name="email" type="text" id="email" />  
          </label></td>  
        </tr>  
        <tr>  
          <td>地址</td>  
          <td><label>  
            <input name="address" type="text" id="address" size="40" />  
          </label></td>  
        </tr>  
        <tr>  
          <td colspan="2"><label>  
            <div align="right">  
              <input type="submit" name="Submit3" value="提交" />  
              <input type="reset" name="Submit2" value="清空" />  
          </div>        </label></td>  
        </tr>  
      </table>  
    </form>  

</body>
</html>
