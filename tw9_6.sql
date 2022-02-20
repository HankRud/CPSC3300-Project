#Nested Queries

#names of sailors who reserved at least
#two boats on the same day
select s.sname
from sailors s
where s.sid IN (select R.sid
				from reserves R, reserves R2
                where R.sid = R2.sid And R.bid <> R2.bid And R.day = R2.day);




