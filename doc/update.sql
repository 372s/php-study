-- 多表更新
UPDATE a, (SELECT id FROM a WHERE used = 1) b
SET used = 0 
WHERE a.id IN (b.id)