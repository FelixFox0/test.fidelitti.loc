--
-- ADD SPECIAL ATTRIBUTE IMAGE
--

INSERT INTO PREFIX_special_attribute_group VALUES('2', 'Image', 'Product image');

--
-- CONVERT EXISTING SPECIAL ATTRIBUTE COLOR TO SPECIAL ATTRIBUTE IMAGE
--

UPDATE `PREFIX_special_attribute` 
SET `special_attribute_group_id` = 2, 
`special_attribute_name` = '', `special_attribute_value` = '' WHERE special_attribute_group_id = 1;

UPDATE `PREFIX_product_master` 
SET `special_attribute_group_id` = 2 WHERE `special_attribute_group_id` = 1;