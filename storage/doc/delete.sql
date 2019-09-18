-- 多表删除，t1表为驱动表，如果t1表中没有想对应的task_id数据，其他表有也会删除失败
DELETE
    t1,
	t2,
	t3, 
	t4,
	t5 
FROM
	t1,
	t2,
	t3, 
	t4,
	t5 
WHERE
	t1.task_id = t2.task_id	
	AND t1.task_id = t3.task_id 
    AND t1.task_id = t4.task_id 
    AND t1.task_id = t5.task_id 
    AND t1.task_id = 13