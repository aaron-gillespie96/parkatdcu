-- Q1: What is the best carpark for The Helix?
SELECT CarParkName , NearbyFacilities 
FROM CarParkData 
WHERE NearbyFacilities LIKE "%helix%"

-- Q2: How many disabled carpark spaces are there on each campus?
SELECT Campus AS "Campus" , SUM(NumberOfDisabledSpaces) AS "Total Number Of Disabled Spaces" 
FROM CarParkData 
GROUP BY Campus


-- Q3: Historically, how occupied is St. Pats carpark on week10 at 3pm?
SELECT CapacityAt15 
FROM CarparkHistoricalOccupancy 
WHERE Campus LIKE "St Pats" AND WeekOfYear LIKE "10"

-- Q4: Where can a member of the general public park at 5:30pm on 26th of September 2016? Answer should provide a campus name.
SELECT c.CarParkName , c.Campus , min(o.CapacityAt17) as "Occupancy at 5 oclock" 
FROM CarParkData c, CarparkHistoricalOccupancy o 
WHERE c.AvailableFor LIKE "%general%" AND o.WeekOfYear=10
-- Q5: When is the best time to arrive at DCU Glasnevin to be able to park near the library?
