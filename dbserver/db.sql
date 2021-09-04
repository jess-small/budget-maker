
CREATE TABLE user
(
   username	VARCHAR(15) NOT NULL,
   uid          INT(9)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
   password     VARCHAR(255) NOT NULL

);

CREATE TABLE budget
(
   budget_id    INT(9)          NOT NULL PRIMARY KEY AUTO_INCREMENT,
   user_id	INT(9)		NOT NULL,
   budget_name  VARCHAR(30)	NOT NULL,
   budget_type  VARCHAR(15),
   starting_value INT(6)          NOT NULL,
   remaining    INT(6),
   constraint fk_budget_uid
   foreign key (user_id)
   	references user(uid)
   
   
);

CREATE TABLE expense
(
   expense_id	INT(9)          NOT NULL PRIMARY KEY AUTO_INCREMENT,
   expense_name VARCHAR(20)     NOT NULL,
   description  VARCHAR(20),   
   amount	INT             NOT NULL,           
   b_id         INT(9)          NOT NULL,
   
   constraint fk_expense_budget_id
   foreign key(b_id)
   	references budget(budget_id)
);



