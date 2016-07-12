SELECT REVERSE(MID(telephone, 2, CHAR_LENGTH(telephone))) AS 'enohpelet'
FROM distrib
WHERE telephone LIKE '05%';
