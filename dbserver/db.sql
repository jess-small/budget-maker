CREATE TABLE administrator
(
   username	    VARCHAR(15)   NOT NULL,
   uid          INT(9)        NOT NULL PRIMARY KEY AUTO_INCREMENT,
   password     VARCHAR(255)  NOT NULL

);


CREATE TABLE user
(
   username	    VARCHAR(15)   NOT NULL,
   uid          INT(9)        NOT NULL PRIMARY KEY AUTO_INCREMENT,
   password     VARCHAR(255)  NOT NULL

);

CREATE TABLE budget
(
   budget_id   INT(9)          NOT NULL PRIMARY KEY AUTO_INCREMENT,
   user_id	   INT(9)		    NOT NULL,
   budget_name VARCHAR(30)	    NOT NULL,
   budget_type VARCHAR(15),
   starting_value INT(6)       NOT NULL

);

CREATE TABLE expense
(
   expense_id	 INT(9)          NOT NULL PRIMARY KEY AUTO_INCREMENT,
   expense_name VARCHAR(20)     NOT NULL,
   description  VARCHAR(20),   
   amount	    INT             NOT NULL,           
   b_id         INT(9)          NOT NULL

);



