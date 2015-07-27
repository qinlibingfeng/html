    <?php  
    /** 
     * Conn.php 
     * @author OH.C 
     * QQ: 569742950 
     * BLOG: http://blog.csdn.net/bllqbz 
     * @copyright 2010 
     */  
    $db_host = 'localhost'; //数据库主机名称，一般都为localhost   
    $db_user = 'cron';  //数据库用户帐号，根据个人情况而定   
    $db_passw = '123d';  //数据库用户密码，根据个人情况而定   
    $db_name = 'MyDB';  //数据库具体名称  
    //连接数据库   
    $conn = MySQL_connect($db_host,$db_user,$db_passw) or die ('数据库连接失败！');   
    //设置字符集，如utf8和gbk等，根据数据库的字符集而定   
    //MySQL_query("set names 'utf8'");  
    MySQL_query("set names 'gb2312'");  
    //选定数据库   
    MySQL_select_db($db_name,$conn) or die('数据库选定失败！');   
    //执行SQL语句(查询)   
    $result = MySQL_query($sql) or die('数据库查询失败!<br/>可能数据库中没有记录'); //SQL语句在这里执行  
    ?>  
