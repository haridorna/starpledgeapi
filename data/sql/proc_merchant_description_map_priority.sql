drop procedure if exists `proc_merchant_description_map_priority`();
delimiter //
CREATE DEFINER=`privpass_admin`@`%` PROCEDURE `proc_merchant_description_map_priority`()
	LANGUAGE SQL
	NOT DETERMINISTIC
	CONTAINS SQL
	SQL SECURITY DEFINER
	COMMENT 'procedure for mapping descriptions in intuit_customer_transactions for priority merchants'
BEGIN
    DECLARE _id BIGINT(20) ;
	DECLARE _gm_id BIGINT(20) ;
	DECLARE _mapping_part1 VARCHAR(255)  DEFAULT NULL;
	DECLARE _mapping_part2 VARCHAR(255) DEFAULT NULL;
	DECLARE _mapping_part3 VARCHAR(255) DEFAULT NULL;
	DECLARE _display_flag TINYINT(4);
    DECLARE exit_loop INTEGER DEFAULT 0; 
    
    DECLARE desc_cursor CURSOR FOR     
        SELECT id,global_merchant_id,mapping_part1,mapping_part2,mapping_part3,display_flag 
        FROM merchant_description_map
		  WHERE global_merchant_id in (select global_merchant_id from merchant);
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET exit_loop = 1;
  
        OPEN desc_cursor; each_record_loop: LOOP
            FETCH desc_cursor INTO _id, _gm_id, _mapping_part1, _mapping_part2, _mapping_part3, _display_flag;
      
            IF exit_loop = 1 THEN 
    	       LEAVE each_record_loop;
            END IF;
    	  
            SET @sql = CONCAT("UPDATE intuit_customer_transaction SET globalMerchantId=", _gm_id, ", merchantDescriptionMapId=", _id, ", transactionDisplayFlag=", _display_flag, " WHERE globalMerchantId IS NULL");
    
            IF _mapping_part1 IS NOT NULL and _mapping_part1!="" THEN
                SET @sql = CONCAT(@sql, " AND LOWER(payeeName) LIKE ", "'%", LOWER(REPLACE(_mapping_part1, "'", "\\'")), "%'");
            END IF;
            IF _mapping_part2 IS NOT NULL and _mapping_part2!="" THEN
                SET @sql = CONCAT(@sql, " AND LOWER(payeeName) LIKE ", "'%", LOWER(REPLACE(_mapping_part2, "'", "\\'")), "%'");
            END IF;
            IF _mapping_part3 IS NOT NULL and _mapping_part3!="" THEN
                SET @sql = CONCAT(@sql, " AND LOWER(payeeName) LIKE ", "'%", LOWER(REPLACE(_mapping_part3, "'", "\\'")), "%'");
            END IF;
            
            -- INSERT INTO sql_log (log) VALUES(@sql);
            
            PREPARE stmt FROM @sql;
            EXECUTE stmt;
            DEALLOCATE PREPARE stmt;

        END LOOP each_record_loop;

    CLOSE desc_cursor;
   				
END //
delmiter ;