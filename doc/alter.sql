--  添加外键，添加task_type表外键，task表主键task_id
alter table task_type add foreign key(task_id) references task(task_id);