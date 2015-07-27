$group_sql=",sum(case when status ='CG' then counts else 0 end ) as '成功',sum(case when status in('CG','SB','GJ15','HY','BXY','ZJBHG'".$sql_drop_p.") then counts else 0 end ) as '呼通',sum(counts) as '呼叫量',ceil(sum(".$time_sum_len_type.")/60)*0.07 as '费用合计',sum(case when status ='CG' then ".$time_sum_len_type." else 0 end ) as '成功费用',sum(".$time_sum_len_type.") as '计费时长',max(max_".$time_sum_len_type.") as '最长时',ceil(max(max_".$time_sum_len_type.")/60)*0.07 as '最长费用'";
		
		$case_sql=",max(最长时) as '最长时',min(最短时) as '最短时',sum(成功) as '成功',sum(呼通) as '呼通',sum(呼叫量) as '呼叫量',case when SUM(计费时长)=0 or SUM(呼通)=0 then 0 else ROUND((SUM(计费时长)/SUM(呼通)),2) end  as '平均时',case when SUM(费用合计)=0 then 0 else ROUND((SUM(费用合计)/SUM(呼通)),2) end  as '平均费用',case when SUM(成功费用)=0 then 0 else ROUND((SUM(成功费用)/SUM(成功)),2) end  as '平均成功费用',case when SUM(费用合计)=0 then concat(0,'%') else concat(ROUND((SUM(成功费用)/SUM(费用合计))*100,2),'%') end as '成功费用比',sum(计费时长) as '计费时长',sum(费用合计) as '费用合计',case when SUM(成功)=0 then concat(0,'%') else concat(ROUND((SUM(成功)/SUM(呼叫量))*100,2),'%') end as '成功率',case when SUM(成功)=0 then concat(0,'%') else concat(ROUND((SUM(成功)/SUM(呼通))*100,2),'%') end as '呼通成功率'";
		
		if($time_type=="times"){
			$time_field="sec_to_time(计费时长) as 计费计费时长,sec_to_time(最长时) as 最长时,sec_to_time(平均时) as 平均时,最长费用,平均费用,平均成功费用,成功费比率,";
		}elseif($time_type=="sec"){
			$time_field="最长时,平均时,计费时长,最长费用,平均费用,平均成功费用,成功费比率,";	
		}else{
			$time_field="ROUND(计费时长/60,2) as 计费时长,ROUND(最长时/60,2) as 最长时,ROUND(平均时/60,2) as 平均时,最长费用,平均费用,平均成功费用,成功费比率,";	
		}
		