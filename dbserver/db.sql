
CREATE TABLE user
(
   fname        VARCHAR(15) NOT NULL,
   lname        VARCHAR(15) NOT NULL,
   uid          INT(9)       PRIMARY KEY,
   password     VARCHAR(20) NOT NULL

);

CREATE TABLE budget
(
   budget_id    INT(9)          PRIMARY KEY,
   user_id	INT(9)          NOT NULL,
   budget_type  VARCHAR(15),
   income	INT(6)          NOT NULL,
   remaining    INT(6),
   constraint fk_budget_uid
   foreign key (user_id)
   	references user(uid)
   
   
);

CREATE TABLE budget_item
(
   item_id	INT(9)          PRIMARY KEY,
   category     VARCHAR(20),    
   amount	INT             NOT NULL,           
   b_id         INT(9)          NOT NULL,
   constraint fk_budget_item_budget_id
   foreign key(b_id)
   	references budget(budget_id)
);
