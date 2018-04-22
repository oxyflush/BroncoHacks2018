SQL> select * from people;

        ID NAME                        AGE JOB_INTEREST
---------- -------------------- ---------- --------------------
         1 Daniel Hoang                 23 iOS Developer
         2 Daniel Hoang                 23 iOS Developer
       102 NickCamp                      3 iOS Developer
         5 DanCamp2                      4 Healthcare2

SQL> select * from business;

        ID COMPANY_NAME         COMPANY_SIZE INDUSTRY
---------- -------------------- ------------ --------------------
         1 DanCamp                         2 Healthcare
         2 dan                            23 dan
         3 NickCamp                        3 iOS Developer
       103 NickCamp                        3 iOS Developer
       102 DanCamp2                        2 Healthcare2
        10 Salesforce                     32 wewe
         0 dhoang1                        23 Whyninjas1
       105 DogCamp                         5 Cats

SQL> select company_name, count(id)
  2  from business
  3  group by company_name;

COMPANY_NAME          COUNT(ID)
-------------------- ----------
DanCamp                       1
DogCamp                       1
dan                           1
dhoang1                       1
DanCamp2                      1
Salesforce                    1
NickCamp                      2

7 rows selected.

SQL> select distinct industry from business;

INDUSTRY
--------------------
iOS Developer
Healthcare2
                                                              46,1          50%
SQL> select name,industry from people,business where people.job_interest=business.industry;

NAME                 INDUSTRY
-------------------- --------------------
NickCamp             iOS Developer
Daniel Hoang         iOS Developer
Daniel Hoang         iOS Developer
NickCamp             iOS Developer
Daniel Hoang         iOS Developer
Daniel Hoang         iOS Developer
DanCamp2             Healthcare2

