BEGIN
  DECLARE _resultprocedure LONGTEXT DEFAULT ''; 
  DECLARE _addmaincomma BOOL DEFAULT False; 
  DECLARE _addcomma BOOL DEFAULT False; 
  
  DECLARE _customer_id TEXT DEFAULT '';
  DECLARE _name TEXT DEFAULT '';
  DECLARE _select_concat TEXT DEFAULT '';
  DECLARE _select_concat_all_select TEXT DEFAULT '';
  DECLARE _action_time timestamp;
  DECLARE _action_type TEXT DEFAULT '';
  DECLARE _flag INT DEFAULT 0;
  
  DECLARE _done INT DEFAULT FALSE;
    
  -- main cursor select customer
  DECLARE _cursor_selectcustomer CURSOR
    for 
    select 
		customer.id, 
	   concat(customer.first_name,' ',left(UCASE(customer.last_name),1)), 
		max(action_time), 
		action_type  
	  from
     ((select customerId as customer_id, max(postedDate) as action_time, 'reservations' as action_type
        from intuit_customer_transaction 
      where globalMerchantId=GlobalMerchantIDSelect 
        and ((`IsBefore`=1 and `postedDate`<=`TimeStampSelect`) or (`IsBefore`=0 and `postedDate`>=`TimeStampSelect`))
		 group by customerId
       order by action_time  desc limit Feed_limit
      )
      union
      (select customer_id, max(time_stamp) as action_time, 'checkin' as action_type 
       from customer_checkins 
      where global_merchant_id=GlobalMerchantIDSelect 
       and ((`IsBefore`=1 and time_stamp<=`TimeStampSelect`) or (`IsBefore`=0 and time_stamp>=`TimeStampSelect`))
      group by customer_id 
      order by action_time  desc limit Feed_limit
      )
      union
      (select customer_id, max(review_date) as action_time, 'review' as action_type 
       from customer_review 
      where global_merchant_id=GlobalMerchantIDSelect 
        and ((`IsBefore`=1 and `review_date`<=`TimeStampSelect`) or (`IsBefore`=0 and `review_date`>=`TimeStampSelect`))
      group by customer_id 
      order by action_time  desc limit Feed_limit
      )
     order by customer_id,action_time desc) as `selectsuctomer`
  left join customer on customer.id=`selectsuctomer`.customer_id
  group by `selectsuctomer`.customer_id
  order by `selectsuctomer`.customer_id,`selectsuctomer`.action_time desc limit Feed_limit ;
  
  -- cursor intuit_customer_transaction 
  DECLARE _cursor_ict CURSOR                           
     for 
    select CONCAT('{"date":"',intuit_customer_transaction.postedDate,'","amount":"$',abs(intuit_customer_transaction.amount),'"}') 
              from intuit_customer_transaction 
            where globalMerchantId=GlobalMerchantIDSelect
              and customerId=_customer_id
              and ((`IsBefore`=1 and `postedDate`<=`TimeStampSelect`) or (`IsBefore`=0 and `postedDate`>=`TimeStampSelect`)) 
              order by `postedDate`  desc limit Nest_limit;

  -- cursor customer_checkins            
  DECLARE _cursor_cc CURSOR                           
     for 
       select CONCAT('"',customer_checkins.time_stamp,'"') 
          from customer_checkins 
      where global_merchant_id=GlobalMerchantIDSelect 
       and customer_id=_customer_id 
       and ((`IsBefore`=1 and time_stamp<=`TimeStampSelect`) or (`IsBefore`=0 and time_stamp>=`TimeStampSelect`))
      order by time_stamp  desc limit Nest_limit;  

  -- cursor customer_review  
  DECLARE _cursor_cr CURSOR                           
     for 
       select CONCAT('{"review_text":"',coalesce(customer_review.comments,0),'","timestamp":"',coalesce(customer_review.review_date,0),'","star_rattings":"',coalesce(customer_review.rating),'"}') 
           from customer_review 
      where global_merchant_id=GlobalMerchantIDSelect 
        and customer_id=_customer_id  
        and ((`IsBefore`=1 and `review_date`<=`TimeStampSelect`) or (`IsBefore`=0 and `review_date`>=`TimeStampSelect`))
      order by `review_date`  desc limit Nest_limit;
      
   -- cursor for cursor_deals_eligible   
  DECLARE _cursor_deals_eligible CURSOR                           
     for 
     select CONCAT('{"id":"',md.id,'","title":"',coalesce(md.title,''),'","redeem_limit":"',coalesce(md.redeem_limit,''),
           '","retail_price":"',coalesce(md.retail_price,''),'","discount":"',coalesce(md.discount,''),'","coupon_code":"',coalesce(md.coupon_code,''), 
           '","summary":"',coalesce(md.summary,''),'","detail":"',coalesce(md.detail,''),'","address1":"',coalesce(md.address1,''),'","address2":"',coalesce(md.address2,''),
           '","city":"',coalesce(md.`city`,''),'","state":"',coalesce(md.`state`,''),'","zip":"',coalesce(md.`zip`,''),'"}') 
       from customer_qualified as cq 
     join merchant_deal as md on cq.campaign_id=md.merchant_campaign_id 
    where cq.customer_id=_customer_id and cq.global_merchant_id=GlobalMerchantIDSelect
    order by `id`  desc limit Nest_limit;   
    
  -- cursor for vip_privilieges
  DECLARE _cursor_vp CURSOR 
    for 
    select distinct CONCAT('{"option_text":"',COALESCE(som.option_text,0),'","option_icon_url":"',COALESCE(som.option_icon_url,0),'"}') 
    from customer_qualified cq 
    right join merchant_campaign_service_options mcso on cq.campaign_id=mcso.campaign_id and option_value='Yes' 
    right join service_options_master som on som.id=mcso.service_option_id
    where 
      cq.customer_id=_customer_id and cq.global_merchant_id=GlobalMerchantIDSelect
    order by som.option_text desc limit Nest_limit;  
       
  -- cursor for merchant_notes
  DECLARE _cursor_merchant_notes CURSOR 
    for 
    select CONCAT('{"notes":"',coalesce(muc.comment,''),'","date":"',coalesce(muc.time_stamp,''),'","merchant_user_name":"',coalesce(mu.first_name,''),'"}') 
    from merchant_user_comments muc 
    left join merchant_user mu on muc.merchant_user_id=mu.id    
    where 
      customer_id=_customer_id and merchant_id=GlobalMerchantIDSelect
    and ((`IsBefore`=1 and muc.time_stamp<=`TimeStampSelect`) or (`IsBefore`=0 and muc.time_stamp>=`TimeStampSelect`))
    order by muc.time_stamp desc limit Nest_limit;  

  -- favourite_locations
  DECLARE _cursor_favourite_locations CURSOR 
    for 
    select CONCAT('{"name":"',coalesce(gm.name,''),'","id":"',gm.id,'"}') 
    from global_merchant gm 
    left join stat_customer_global_merchant scgm on gm.id=scgm.global_merchant_id
	left join stat_global_merchant_category_unrolled sgmcu on scgm.global_merchant_id=sgmcu.global_merchant_id
    where 
      scgm.customer_id=_customer_id and scgm.global_merchant_id != GlobalMerchantIDSelect
	  and sgmcu.category_id in (select category_id from stat_global_merchant_category_unrolled sgmcu2, business_category bc2  
	  where sgmcu2.global_merchant_id = GlobalMerchantIDSelect and sgmcu2.category_id = bc2.id and bc2.`level` != 1)
	group by gm.id  
    order by scgm.sum_value desc limit 3;  

  -- favourite_location_type
  DECLARE _cursor_favourite_location_type CURSOR 
    for 
    select CONCAT('{"type":"',coalesce(bc.name,''),'","percent":"',round(100*scc.sum_category/sum_table.total, 0),'"}')     
    from 
      stat_customer_category scc
      left join business_category bc on scc.category_id=bc.id
      inner join (
    	select 
    	  sum(T.sum_category) total 
    	from (
    	  select  
    	    scc.sum_category 
    	  from 
    	    stat_customer_category scc
    		left join business_category bc on scc.category_id=bc.id
    	  where 
    	    scc.customer_id=_customer_id and bc.`level`!=1 
    	    and bc.parent_id in (select category_id 
                               from stat_global_merchant_category_unrolled sgmcu2, business_category bc2  
                               where sgmcu2.global_merchant_id=GlobalMerchantIDSelect and sgmcu2.category_id=bc2.id and bc2.`level`=1)
    	  order by scc.sum_category desc
    	limit 4 ) T
      ) sum_table
    where 
      scc.customer_id=_customer_id and bc.`level`!=1 
      and bc.parent_id in (select category_id 
                           from stat_global_merchant_category_unrolled sgmcu2, business_category bc2  
	                        where sgmcu2.global_merchant_id=GlobalMerchantIDSelect and sgmcu2.category_id=bc2.id and bc2.`level`=1)
    order by scc.sum_category desc
    limit 4;	 
	 	
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET _done = TRUE;
    
   OPEN _cursor_selectcustomer;
      read_loop: LOOP
                  
    FETCH _cursor_selectcustomer INTO _customer_id, _name, _action_time, _action_type;
      IF _done THEN
        LEAVE read_loop;    
      END IF;
    
   if _addmaincomma then
      set _resultprocedure= CONCAT(_resultprocedure,',') ; 
    end if;    
      
      set _resultprocedure= CONCAT(_resultprocedure,'{"id":"',_customer_id,'","name":"',_name,'",');      
      set _resultprocedure= CONCAT(_resultprocedure,'"last_action_ts":"',_action_time,'",'); 
      set _resultprocedure= CONCAT(_resultprocedure,'"last_action_type":"',_action_type,'",'); 
      
      set _select_concat:='"profile_image_big":"","profile_image_small":"",';          
      select CONCAT('"profile_image_big":"', COALESCE(hsm.pic_big_url,'') ,'","profile_image_small":"', COALESCE(hsm.pic_url,''),'",') 
      into _select_concat
       from has_social_media as hsm 
       where hsm.media_id=1 and hsm.customer_id=_customer_id
		 limit 1 ;
      set _resultprocedure= CONCAT(_resultprocedure,_select_concat); 
          
      set _select_concat:='C';
       select case 
          when max(rank) <=10 && max(rank) >=8 then 'A+'
          when max(rank) <=7 && max(rank) >=6 then 'A'
          when max(rank) <=5 && max(rank) >=4 then 'B+'
          when max(rank) <=3 && max(rank) >=2 then 'B'
          when max(rank) <=1 && max(rank) >=0 then 'C'
         end 
         into _select_concat
       from rank_customer_media
        where customer_id= _customer_id; 
      set _resultprocedure= CONCAT(_resultprocedure,'"social_influence":"',_select_concat,'",'); 
                                         
      set _select_concat='"spending_power":"0%","spanding_power_level":"0","industry_grade":"C"';
      select  concat('"spending_power":"',COALESCE(max(rank)*10,0), '%","spanding_power_level":"',
        COALESCE(case
             when max(rank) <=10 and max(rank) >=8 then 4
             when max(rank) <=7 and max(rank) >=5 then 3
             when max(rank) <=4 and max(rank) >=3 then 2
             when max(rank) <=2 and max(rank) >=0 then 1
             end,1),'","industry_grade":"',         
        COALESCE(case 
                when max(rank) <=10 && max(rank) >=8 then 'A+'
                when max(rank) <=7 && max(rank) >=6 then 'A'
                when max(rank) <=5 && max(rank) >=4 then 'B+'
                when max(rank) <=3 && max(rank) >=2 then 'B'
                when max(rank) <=1 && max(rank) >=0 then 'C'
                end,'C'),'"')
        into _select_concat          
        from rank_customer_category_sum
        left join stat_global_merchant_category_unrolled on stat_global_merchant_category_unrolled.category_id=rank_customer_category_sum.category_id 
        where customer_id=_customer_id and stat_global_merchant_category_unrolled.global_merchant_id=GlobalMerchantIDSelect;             
      set _resultprocedure= CONCAT(_resultprocedure,_select_concat,',');     
      
       set _select_concat:='"loyalty_rank":"0","is_top_customer":""';      
       select CONCAT('"loyalty_rank":"',percentile - 1,'","is_top_customer":"',if(rank>5,concat(((10 - rank)*10+10),'%"'),'"'))
          into _select_concat 
          from rank_global_merchant_customer_sum 
        where customer_id= _customer_id and global_merchant_id=GlobalMerchantIDSelect;             
       set _resultprocedure= CONCAT(_resultprocedure,_select_concat,',');     
                 
       set _select_concat:='"like_status":"No"';      
       select concat('"like_status":"',if(count(*), 'Yes','No'),'"')
          into _select_concat  
        from customer_merchant_likes where customer_id=_customer_id and global_merchant_id=GlobalMerchantIDSelect;             
       set _resultprocedure= CONCAT(_resultprocedure,_select_concat,',');     
                          
       set _select_concat:='"average_check":"0","transactions_at_restaurant":"0",';
       select concat('"average_check":"$',COALESCE(round(avg_transaction,2),0),'","transactions_at_restaurant":"',COALESCE(number_of_transactions,0),'",')
        into _select_concat 
       from stat_customer_global_merchant 
        where customer_id=_customer_id and global_merchant_id =GlobalMerchantIDSelect;          
       set _resultprocedure= CONCAT(_resultprocedure,_select_concat); 
  
      -- > loop for intuit_customer_transaction
      set _addcomma=False; 
      set _select_concat_all_select='';
      set _select_concat=''; 
                  
       open _cursor_ict;
            LOOP_ict: loop
         fetch _cursor_ict into _select_concat;
          
           if _done then
              set _done := false;
               close _cursor_ict;
               leave LOOP_ict;
           end if;
           
           if _addcomma then
             set _select_concat_all_select= CONCAT(_select_concat_all_select,',') ; 
           end if;
           
        set _select_concat_all_select= CONCAT(_select_concat_all_select,_select_concat) ;
          set _addcomma=True; 
                   
       end loop LOOP_ict; 
       -- < loop for intuit_customer_transaction
      
       set _resultprocedure= CONCAT(_resultprocedure,'"transaction_details":[',_select_concat_all_select,'],'); 
       
       set _select_concat='0';
       select count(*)
        into _select_concat
          from customer_checkins 
        where customer_id=_customer_id and global_merchant_id=GlobalMerchantIDSelect;
        set _resultprocedure= CONCAT(_resultprocedure,'"checkins_at_restaurant":"',_select_concat,'",'); 

       -- > loop fro customer_checkins              
       set _addcomma=False;
       set _select_concat_all_select=''; 
        
        open _cursor_cc;
            LOOP_cc: loop
         fetch _cursor_cc into _select_concat;
           if _done then
              set _done := false;
               close _cursor_cc;
               leave LOOP_cc;
           end if;
           
         if _addcomma then
             set _select_concat_all_select= CONCAT(_select_concat_all_select,',') ; 
           end if;
           
        set _select_concat_all_select= CONCAT(_select_concat_all_select,_select_concat) ;
          set _addcomma=True;
          
       end loop LOOP_cc;
       
       set _resultprocedure= CONCAT(_resultprocedure,'"checkin_details":[',_select_concat_all_select,'],'); 
       -- < loop fro customer_checkins
       
       set _select_concat='0';
       select count(*)
        into _select_concat       
        from customer_review 
        where customer_id=_customer_id and global_merchant_id=GlobalMerchantIDSelect;
        set _resultprocedure= CONCAT(_resultprocedure,'"no_of_reviews":"',_select_concat,'",'); 

       -- > loop for customer_review
       set _addcomma=False;
       set _select_concat_all_select='';  
       
       open _cursor_cr;
            LOOP_cr: loop
         fetch _cursor_cr into _select_concat;
           if _done then
              set _done := false;
               close _cursor_cr;
               leave LOOP_cr;
           end if;
           
        if _addcomma then
             set _select_concat_all_select= CONCAT(_select_concat_all_select,',') ; 
           end if;
           
        set _select_concat_all_select= CONCAT(_select_concat_all_select,_select_concat) ;
          set _addcomma=True;        
 
       end loop LOOP_cr;
       
       set _resultprocedure= CONCAT(_resultprocedure,'"reviews":[',_select_concat_all_select,'],');        
       -- < loop for customer_review
       
       set _select_concat='0';
       select count(*)
        into _select_concat       
        from customer_qualified as cq 
        join merchant_deal as md on cq.campaign_id=md.merchant_campaign_id 
        where cq.customer_id=_customer_id and cq.global_merchant_id=GlobalMerchantIDSelect and cq.campaign_type_id!=3;
        set _resultprocedure= CONCAT(_resultprocedure,'"no_of_deals":"',_select_concat,'",'); 

       -- > loop for deals_eligible
       set _addcomma=False;
       set _select_concat_all_select=''; 
        
        open _cursor_deals_eligible;
            LOOP_de: loop
         fetch _cursor_deals_eligible into _select_concat;
           if _done then
              set _done := false;
               close _cursor_deals_eligible;
               leave LOOP_de;
           end if;
           
         if _addcomma then
             set _select_concat_all_select= CONCAT(_select_concat_all_select,',') ; 
           end if;
           
        set _select_concat_all_select= CONCAT(_select_concat_all_select,_select_concat) ;
          set _addcomma=True;
         
       end loop LOOP_de;
       
       set _resultprocedure= CONCAT(_resultprocedure,'"deals_eligible":[',_select_concat_all_select,'],'); 
       -- < loop for deals_eligible
       
       -- > loop for vip_privilieges
       set _addcomma=False;
       set _select_concat_all_select=''; 
        
       open _cursor_vp;
       LOOP_vp: loop
         fetch _cursor_vp into _select_concat;
         if _done then
           set _done := false;
           close _cursor_vp;
           leave LOOP_vp;
         end if;
         if _addcomma then
           set _select_concat_all_select = CONCAT(_select_concat_all_select, ','); 
         end if;
         set _select_concat_all_select = CONCAT(_select_concat_all_select, _select_concat);
         set _addcomma=True;
         
       end loop LOOP_vp;
     
       set _resultprocedure= CONCAT(_resultprocedure,'"vip_privileges":[',_select_concat_all_select,'],'); 
       -- < loop for vip_privilieges

       -- > loop for merchant_notes
       set _addcomma=False;
       set _select_concat_all_select=''; 
        
       open _cursor_merchant_notes;
       LOOP_mn: loop
         fetch _cursor_merchant_notes into _select_concat;
         if _done then
           set _done := false;
           close _cursor_merchant_notes;
           leave LOOP_mn;
         end if;
         if _addcomma then
           set _select_concat_all_select = CONCAT(_select_concat_all_select, ','); 
         end if;
         set _select_concat_all_select = CONCAT(_select_concat_all_select, _select_concat);
         set _addcomma=True;
         
       end loop LOOP_mn;
     
       set _resultprocedure= CONCAT(_resultprocedure,'"merchant_notes":[',_select_concat_all_select,'],'); 
       -- < loop for merchant_notes
	   
       -- > loop for favorite_locations
       set _addcomma=False;
       set _select_concat_all_select=''; 
        
       open _cursor_favourite_locations;
       LOOP_fl: loop
         fetch _cursor_favourite_locations into _select_concat;
         if _done then
           set _done := false;
           close _cursor_favourite_locations;
           leave LOOP_fl;
         end if;
         if _addcomma then
           set _select_concat_all_select = CONCAT(_select_concat_all_select, ','); 
         end if;
         set _select_concat_all_select = CONCAT(_select_concat_all_select, _select_concat);
         set _addcomma=True;
         
       end loop LOOP_fl;
     
       set _resultprocedure= CONCAT(_resultprocedure,'"favorite_locations":[',_select_concat_all_select,'],'); 
       -- < loop for favorite_locations
	   
       -- > loop for favourite_location_type
       set _addcomma=False;
       set _select_concat_all_select=''; 
        
       open _cursor_favourite_location_type;
       LOOP_flt: loop
         fetch _cursor_favourite_location_type into _select_concat;
         if _done then
           set _done := false;
           close _cursor_favourite_location_type;
           leave LOOP_flt;
         end if;
         if _addcomma then
           set _select_concat_all_select = CONCAT(_select_concat_all_select, ','); 
         end if;
         set _select_concat_all_select = CONCAT(_select_concat_all_select, _select_concat);
         set _addcomma=True;
         
       end loop LOOP_flt;
     
       set _resultprocedure= CONCAT(_resultprocedure,'"favourite_location_type":[',_select_concat_all_select,'],'); 
       -- < loop for favourite_location_type 
   
       set _select_concat='';
       select (exists(select CONCAT('"total_loyalty_points":"',total_cashback_earned*10,
                '","total_purchases":"$',total_purchases, 
                '","loyalty_points_redeemed":"',cashback_redeemed*10,
                '","balance_loyalty_points":"',cashback_balance*10,
                '","total_cashback_rewards":"$',total_cashback_earned,
                '","cashback_redeemed":"$',cashback_redeemed, 
                '","balance_cashback_rewards":"$',cashback_balance,'"')               
            from customer_cashback_active
            where customer_id=_customer_id and global_merchant_id=GlobalMerchantIDSelect)) into _flag;
       if not _flag
           then 
              set _select_concat='"total_loyalty_points":"0","total_purchases":"0","loyalty_points_redeemed":"0","balance_loyalty_points":"0","total_cashback_rewards":"0","cashback_redeemed":"0","balance_cashback_rewards":"0"';
       end if;
       if _flag 
          then 
             select CONCAT('"total_loyalty_points":"',total_cashback_earned*10,
               '","total_purchases":"$',total_purchases, 
               '","loyalty_points_redeemed":"',cashback_redeemed*10,
                '","balance_loyalty_points":"',cashback_balance*10,
                '","total_cashback_rewards":"$',total_cashback_earned,
                '","cashback_redeemed":"$',cashback_redeemed, 
                '","balance_cashback_rewards":"$',cashback_balance,'"')
            into _select_concat    
            from customer_cashback_active
            where customer_id=_customer_id and global_merchant_id=GlobalMerchantIDSelect;
        end if; 
		set _resultprocedure= CONCAT(_resultprocedure,coalesce(_select_concat, ''),'}');
                                   
       set _addmaincomma=true;
            
     END LOOP read_loop;
   CLOSE _cursor_selectcustomer; 
   
   set _resultprocedure= CONCAT('{"customers": [',_resultprocedure,']}');

   RETURN (_resultprocedure);
END