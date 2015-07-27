// JavaScript Document
	
 function dial_submit(phone_number,dial_type)
 	{
	//如果拨号类型为空，则调用select_dial_type去自行检测选择
	if (dial_type == null || dial_type == '')
		{
		dial_type = select_dial_type(phone_number);	
		}
		
	switch(dial_type)
		{
		case  "internal" :
			if (internal_legality_check(phone_number))
				{
				//phone_number = '93' + phone_number;
				phone_number="9399909*" + phone_number + "*in";
				//alert("内线"+phone_number);
				return phone_number;
				}
			else return false;
		break;
		
		case  "external" :
			if (external_legality_check(phone_number)) 
				{
				//alert("外线"+phone_number);
				return phone_number;
				}
			else return false;
		break;
		}
	}


 // 判断拨号类型internal内线、　external外线
 function select_dial_type(phone_number)
 	{
	var dial_type = "";
	phone_number = extension_trim(phone_number);
	if (phone_number.length>2 && phone_number.length<6)
		{
		dial_type = "internal";
		}
	else 
		{
		dial_type = "external";
		}
	return dial_type ;
	}
	
 // 去除号码前后空格函数	
 function extension_trim(phone_number)
 	{
	return phone_number.replace(/(^\s*)|(\s*$)/g, "");
	}

 // 判断出局号码的合法性
 function external_legality_check(phone_number)
	{
	re = /^[0-9]\d{7,11}$/ ;
	if(!(re.test(phone_number)))
		{
		alert("非法号码！外线号码必须为数字并且长度为8到12位，请重新输入！");
		return false;
		}
	else { return true; }	
	}	
	
 // 判断内部号码的合法性	
 function internal_legality_check(phone_number)
 	{
	re = /^[1-9]\d{2,4}$/ ;
	if(!(re.test(phone_number)))
		{
		alert("非法号码！内部分机号码必须为数字并且长必须为3到5位，请重新输入！");
		return false;
		}
	else { return true; }
	}