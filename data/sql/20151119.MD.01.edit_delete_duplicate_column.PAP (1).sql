drop procedure if exists proc_process_cgm;
delimiter //
CREATE PROCEDURE `proc_process_cgm`(IN `INglobal_merchant_id` BIGINT)
	LANGUAGE SQL
	NOT DETERMINISTIC
	CONTAINS SQL
	SQL SECURITY DEFINER
	COMMENT 'procedure for calculating statistics by customer and global merchant (-1 all global merchant)'
BEGIN
  declare _customerid BIGINT(20) default null;
  declare _globalmerchantid BIGINT(20) default null;
  declare _sumvalue FLOAT default '0';
  declare _numberoftransactions INT(11) default '0';
  declare _numbersdaysfirsttr INT(11) default '0';
  declare _avgtransaction FLOAT default '0';
  declare _cgmcustomerid BIGINT(20) default null;
  declare _cgmglobalmerchantid BIGINT(20) default null;
   				
  INSERT INTO stat_customer_global_merchant_date_first_tr (customer_id , global_merchant_id, date_first_tr) 
	      select  
	        customerId, 
		     globalMerchantId, 
			  min(ict.postedDate) 
		   from 
			  intuit_customer_transaction_tmp_import ict 
		   where 
			  postedDate is not null and globalMerchantId is not null
			  and (globalMerchantId=INglobal_merchant_id or INglobal_merchant_id=-1)
	      group by 
			  customerId, globalMerchantId
			on duplicate key update customer_id = customer_id, global_merchant_id = global_merchant_id;
   	
   delete stat_customer_global_merchant from stat_customer_global_merchant
   inner join ( 
    select  
				scgm.customer_id,
				scgm.global_merchant_id   
			from 
				intuit_customer_transaction_tmp_import ict
				left join stat_customer_global_merchant scgm 
				  on  scgm.customer_id=ict.customerId  and scgm.global_merchant_id=ict.globalMerchantId
			where 
				ict.globalMerchantId is not null 
				and scgm.customer_id is not null 
				and scgm.global_merchant_id is not null
				and (scgm.global_merchant_id=INglobal_merchant_id or INglobal_merchant_id=-1)
			group by 
				ict.customerId, 
				ict.globalMerchantId)
		    AS duplicate USING (customer_id,global_merchant_id);
	
	INSERT INTO stat_customer_global_merchant (customer_id , global_merchant_id, sum_value, 
		                                        number_of_transactions,avg_transaction,
															 numbers_days_first_tr)		 
	select  
				ict.customerId, 
				ict.globalMerchantId,
				sum(ict.amount)+coalesce(scgm.sum_value,0),
				count(ict.transactionId)+coalesce(scgm.number_of_transactions,0),
				(sum(ict.amount)+coalesce(scgm.sum_value,0))/
				(count(ict.transactionId)+coalesce(scgm.number_of_transactions,0)),
				abs(datediff(curdate(), scgmdft.date_first_tr))     
			from 
				intuit_customer_transaction_tmp_import ict
				left join stat_customer_global_merchant scgm 
				  on  scgm.customer_id=ict.customerId  and scgm.global_merchant_id=ict.globalMerchantId
				left join stat_customer_global_merchant_date_first_tr scgmdft 
				  on scgmdft.customer_id = ict.customerId and scgmdft.global_merchant_id  = ict.globalMerchantId
			where 
				ict.globalMerchantId is not null
				and (ict.globalMerchantId=INglobal_merchant_id or INglobal_merchant_id=-1)
			group by 
				ict.customerId, 
				ict.globalMerchantId;										     
END//
delimiter ;

drop procedure if exists proc_process_scc;
delimiter //
CREATE PROCEDURE `proc_process_scc`(IN `INglobal_merchant_id` BIGINT)
	LANGUAGE SQL
	NOT DETERMINISTIC
	CONTAINS SQL
	SQL SECURITY DEFINER
	COMMENT 'procedure for calculating statistics by customer and business category (-1 all global merchant)'
BEGIN
  declare _customerid BIGINT(20) default null;
  declare _category_id int(11) default null;
  declare _numbers_days_first_tr  DATE default null;
      
  -- unroll global merchant categories tree
  insert into stat_global_merchant_category_unrolled (global_merchant_id, category_id) 
    select t.global_merchant_id, t.id from( 
	    select 
		   bc.id,
		   gbc.global_merchant_id
	    from  global_business_categories gbc
	    left join business_category bc on bc.id = gbc.Category1
	    where bc.id is not null and (gbc.global_merchant_id=INglobal_merchant_id or INglobal_merchant_id=-1)							  
	     union 
	    select 
		   bc1.id,
		   gbc.global_merchant_id
	    from  global_business_categories gbc
	    left join business_category bc on bc.id = gbc.Category1
	    left join business_category bc1 on bc1.id=bc.parent_id
	    where  bc.id is not null and bc1.id is not null
		   and (gbc.global_merchant_id=INglobal_merchant_id or INglobal_merchant_id=-1)	     
	     union
	    select 
		  bc2.id,
		  gbc.global_merchant_id
	    from  global_business_categories gbc
	    left join business_category bc on bc.id = gbc.Category1 
	    left join business_category bc1 on bc1.id=bc.parent_id
	    left join business_category bc2 on bc2.id=bc1.parent_id
	    where bc.id is not null and bc1.id is not null and bc2.id is not null
	      and (gbc.global_merchant_id=INglobal_merchant_id or INglobal_merchant_id=-1)	
	    union
		 select 
		   bc.id,
		   gbc.global_merchant_id
	    from  global_business_categories gbc
	    left join business_category bc on bc.id = gbc.Category2                                
	    where bc.id is not null
		   and (gbc.global_merchant_id=INglobal_merchant_id or INglobal_merchant_id=-1)							  
	     union 
	    select 
		   bc1.id,
		   gbc.global_merchant_id
	    from  global_business_categories gbc
	    left join business_category bc on bc.id = gbc.Category2 
	    left join business_category bc1 on bc1.id = bc.parent_id
	    where  bc.id is not null and bc1.id is not null
		   and (gbc.global_merchant_id=INglobal_merchant_id or INglobal_merchant_id=-1)	     
	     union
	    select 
		  bc2.id,
		  gbc.global_merchant_id
	    from  global_business_categories gbc
	    left join business_category bc on bc.id = gbc.Category2                              
	    left join business_category bc1 on bc1.id=bc.parent_id
	    left join business_category bc2 on bc2.id=bc1.parent_id
	    where bc.id is not null and bc1.id is not null and bc2.id is not null
	      and (gbc.global_merchant_id=INglobal_merchant_id or INglobal_merchant_id=-1)	
		 union
		 select 
		   bc.id,
		   gbc.global_merchant_id
	    from  global_business_categories gbc
	    left join business_category bc on bc.id = gbc.Category3
	    where bc.id is not null
		   and (gbc.global_merchant_id=INglobal_merchant_id or INglobal_merchant_id=-1)	 								  
	     union 
	    select 
		   bc1.id,
		   gbc.global_merchant_id
	    from  global_business_categories gbc
	    left join business_category bc on bc.id = gbc.Category3
	    left join business_category bc1 on bc1.id=bc.parent_id
	    where  bc.id is not null and bc1.id is not null
		   and (gbc.global_merchant_id=INglobal_merchant_id or INglobal_merchant_id=-1)	     
	     union
	    select 
		  bc2.id,
		  gbc.global_merchant_id
	    from  global_business_categories gbc
	    left join business_category bc on bc.id=gbc.Category3 
	    left join business_category bc1 on bc1.id=bc.parent_id
	    left join business_category bc2 on bc2.id=bc1.parent_id
	    where bc.id is not null and bc1.id is not null and bc2.id is not null
		   and (gbc.global_merchant_id=INglobal_merchant_id or INglobal_merchant_id=-1)	 	      
	     ) t
	ON DUPLICATE KEY UPDATE stat_global_merchant_category_unrolled.global_merchant_id = t.global_merchant_id, category_id = category_id;

	-- get first dates 
  delete stat_customer_category_date_first_tr from stat_customer_category_date_first_tr
   INNER JOIN (
  select  
	 sccdft.customer_id,
	 sccdft.category_id,
	 sccdft.date_first_tr
	from 
	  intuit_customer_transaction_tmp_import ictti 
	  left join stat_global_merchant_category_unrolled as sgmcu 
		on  sgmcu.global_merchant_id=ictti.globalMerchantId
	  left join stat_customer_category_date_first_tr sccdft
	  on (sccdft.customer_id=ictti.customerId and sgmcu.global_merchant_id=ictti.globalMerchantId)
	where sgmcu.global_merchant_id=INglobal_merchant_id or INglobal_merchant_id=-1	   
   group by
	  customerId, sgmcu.category_id	  
   HAVING min(ictti.postedDate)<sccdft.date_first_tr)
  AS duplicate USING (customer_id,category_id,date_first_tr);	 

  INSERT INTO stat_customer_category_date_first_tr (customer_id , category_id, date_first_tr) 
	select  
	  customerId, 
	  sgmcu.category_id, 
	  min(postedDate) 
	from 
	  intuit_customer_transaction_tmp_import ict 
	  left join stat_global_merchant_category_unrolled as sgmcu 
		on  sgmcu.global_merchant_id=ict.globalMerchantId
	where 
	  ict.postedDate is not null and ict.globalMerchantId is not null and sgmcu.category_id is not null
	   and (ict.globalMerchantId=INglobal_merchant_id or INglobal_merchant_id=-1)
	group by
	  customerId, sgmcu.category_id
	ON DUPLICATE KEY UPDATE customer_id = customer_id, category_id = category_id;
	
  -- get mounth data
  INSERT INTO stat_customer_category_month_tmp (customer_id , category_id, sum_month, 
		                                      number_transactions,fist_day) 
  select DISTINCT 
     sccm.customer_id,
	  sccm.category_id,
	  sccm.sum_month,
	  sccm.number_transactions,
	  sccm.fist_day   
   from intuit_customer_transaction_tmp_import ictti
	join stat_customer_category_month sccm 
	  on (sccm.customer_id=ictti.customerId and sccm.fist_day=ictti.first_day_of_month)    
   join stat_global_merchant_category_unrolled sgmcu 
	  on  sgmcu.category_id=sccm.category_id and sgmcu.global_merchant_id=ictti.globalMerchantId
	where sgmcu.global_merchant_id=INglobal_merchant_id or INglobal_merchant_id=-1;
	
  delete stat_customer_category_month from stat_customer_category_month
    INNER JOIN (select DISTINCT 
     sccm.customer_id,
	  sccm.category_id,
	  sccm.fist_day     
    from intuit_customer_transaction_tmp_import ictti
	join stat_customer_category_month sccm 
	  on (sccm.customer_id=ictti.customerId and sccm.fist_day=ictti.first_day_of_month)    
   join stat_global_merchant_category_unrolled sgmcu 
	  on  sgmcu.category_id=sccm.category_id and sgmcu.global_merchant_id=ictti.globalMerchantId 
  where sgmcu.global_merchant_id=INglobal_merchant_id or INglobal_merchant_id=-1)	  
	AS duplicate USING (customer_id,category_id,fist_day);

  delete stat_customer_category from stat_customer_category
   INNER JOIN (select DISTINCT 
     sccm.customer_id,
	  sccm.category_id  
   from intuit_customer_transaction_tmp_import ictti
	join stat_customer_category_month sccm 
	  on (sccm.customer_id=ictti.customerId and sccm.fist_day=ictti.first_day_of_month)    
   join stat_global_merchant_category_unrolled sgmcu 
	  on  sgmcu.category_id=sccm.category_id and sgmcu.global_merchant_id=ictti.globalMerchantId
	where sgmcu.global_merchant_id=INglobal_merchant_id or INglobal_merchant_id=-1)   
  AS duplicate USING (customer_id,category_id);

  -- calculate monthly data	  
  INSERT INTO stat_customer_category_month (customer_id , category_id, sum_month, 
		                                      number_transactions,fist_day) 
	select 
	 ict.customerId,
	 sgmcu.category_id,     
	 sum(ict.amount)+coalesce(sccmt.sum_month,0),
	 count(ict.transactionId)+coalesce(sccmt.number_transactions,0),
	 ict.first_day_of_month
	from 
	 intuit_customer_transaction_tmp_import ict
	 left join stat_global_merchant_category_unrolled as sgmcu 
		on  sgmcu.global_merchant_id=ict.globalMerchantId
	 left join stat_customer_category_month_tmp sccmt 
	   on (sccmt.customer_id=ict.customerId and sccmt.category_id=sgmcu.category_id 
		  and sccmt.fist_day=ict.first_day_of_month)	 
	where ict.globalMerchantId is not null and sgmcu.category_id is not null 
	  and (ict.globalMerchantId=INglobal_merchant_id or INglobal_merchant_id=-1)
	group by 
	 ict.customerId,
	 fist_day,
	 sgmcu.category_id;
         
  -- calculate total data
	 INSERT INTO stat_customer_category (customer_id , category_id, sum_category, 
		                                  numbers_days_first_tr,monthly_avg,
													 number_transactions,avg_transaction_value,
													 avg_daily_value)
	  select  
	   sccm.customer_id,
	   sccm.category_id,
	   sum(sum_month),
	   abs(datediff(curdate(), sccdft.date_first_tr)),
	   sum(sum_month)*30/abs(datediff(curdate(), sccdft.date_first_tr)),
	   sum(number_transactions),
	   sum(sum_month)/sum(number_transactions),
	   sum(sum_month)/abs(datediff(curdate(), sccdft.date_first_tr))
	 from stat_customer_category_month  sccm
	   left join stat_customer_category_date_first_tr sccdft 
		   on sccdft.customer_id = sccm.customer_id and sccdft.category_id  = sccm.category_id	   
	group by 
	  sccm.customer_id,
	  sccm.category_id;    
	  
	delete from stat_customer_category_month_tmp; 									 
	 												    
END//
delimiter ;