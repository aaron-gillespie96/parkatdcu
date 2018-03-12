-- Q1: What is the best carpark for Helix?
SELECT c.name FROM facility as f JOIN carpark as c WHERE f.facilityname = 'helix' AND f.carpark_id = c.carparkid;
---A: Multistorey (CP1), Creche (CP2)

-- Q2: How many disabled carpark spaces are there on each campus?
SELECT cm.campusname, SUM(c.dspacesavailable) as 'disabled spaces' FROM campus as cm JOIN carpark as c WHERE c.campus_id = cm.campusid GROUP BY campus_id;
---A: Glasnevin 31, St.Pats 70, DCU Alpha 5

-- Q3: Historically, how occupied in St. Pats carpark on week10 at 3pm?
SELECT h.15 FROM carpark as cp JOIN historicaloccupancy as h WHERE cp.carparkid = h.carpark_id AND h.weekofyear = 10 AND cp.name = 'St Pats CP';
---A: 15, 0.3 (30%)

-- Q4: Where can a member of the general public park at 5:30pm on 26th of September 2016? Answer should provide a campus name.
SELECT c.name FROM carpark as c JOIN historicaloccupancy as o WHERE c.carparkid = o.carpark_id AND c.isforpublic = 1 AND o.17 < 100 AND o.17 != 'NULL' AND o.weekofyear = 39;
---A: Multistorey (CP1), Library (CP4), St.Pats (CP)

-- Q5: When is the best time to arrive at DCU Glasnevin to be able to park near the library? (example solution part)
SELECT weekofyear, @LeastVar:= LEAST(Min7, Min8, Min9) AS LeastVar,
  CASE @LeastVar WHEN `Min7` THEN '7'
                 WHEN `Min8` THEN '8'
                 WHEN `Min9` THEN '9' -- ...
  END AS LeastVarColumn
FROM (SELECT weekofyear, MIN(o.7) as Min7, MIN(o.8) as Min8, MIN(o.9) as Min9 FROM carpark as c JOIN historicaloccupancy as o, facility as f, campus as cm WHERE c.carparkid = f.carpark_id AND c.carparkid = o.carpark_id AND c.campus_id = cm.campusid AND f.facilityname = 'library' GROUP BY weekofyear) AS A;
