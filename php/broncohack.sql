create table business (
   ID  int,
  Company_Name char(20),
  Company_Size int,
  Industry char(20), PRIMARY KEY(ID)
   );

insert into business values(3,'NickCamp',3,'iOS Developer');

create table people(
   ID  int,
  Name char(20),
  Age int,
  Job_Interest char(20) , PRIMARY KEY(ID)
   );

insert into people values(2,'Daniel Hoang',23,'iOS Developer');

select Company_Name,Name from business,people where business.industry=people.job_interest;


