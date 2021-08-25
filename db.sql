DROP TABLE user;
DROP TABLE budget;
DROP TABLE budget_item;

CREATE TABLE user
(
   fname        VARCHAR2(15) NOT NULL,
   lname        VARCHAR2(15) NOT NULL,
   uid          INT(9)       PRIMARY KEY,
   password     VARCHAR2(20) NOT NULL

);

CREATE TABLE budget
(
   budget_id    INT(9)          PRIMARY KEY,
   user_id	INT(9)          NOT NULL REFERENCES user(uid)
   budget_type  VARCHAR2(15)
   income	INT(6)          NOT NULL,
   remaining    INT(6)
   
   
);

CREATE TABLE budget_item
(
   item_id	INT(9)          PRIMARY KEY,
   category     VARCHAR2(20)    
   amount	INT             NOT NULL           
   b_id         INT(9)          NOT NULL REFERENCES budget(budget_id)
);
