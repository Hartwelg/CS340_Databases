-- get all teams   
SELECT id, name FROM BasketBallTeams

-- get all players   
SELECT Id, JerseyNumber, Position FROM BasketballTeamPlayer 

-- get all winning scores  
SELECT id, GameId, FinalScoreOfWinningTeam FROM BasketballGame

-- get all losing scores  
SELECT id, GameId, FinalScoreOfLosingTeam FROM BasketballGame 

-- get all LeadingScore  
SELECT id, GameId, TotalPointsPerGame FROM LeadingScore 

-- Query for Add new team  
-- with colon : character being used to denote the variables that will have data from the backend programming language
INSERT INTO BasketballTeams 
            (id, 
             name, 
             mascot, 
             NumWins, 
             NumLosses, 
             BasketballTeamId) 
VALUES      (:id, 
             :name, 
             :mascot, 
             :NumWins, 
             :NumLosses, 
             :BasketballTeamId); 

-- Query for Add new player  
-- with colon : character being used to denote the variables that will have data from the backend programming 
INSERT INTO BasketballTeamPlayer 
            (Id, 
             BasketballTeamId, 
             FirstName, 
             LastName, 
             JerseyNumber, 
             Position) 
VALUES      (:Id, 
             :BasketballTeamId, 
             :FirstName, 
             :LastName, 
             :JerseyNumber, 
             :Position); 

-- Query for Add new BasketballGame  
-- with colon : character being used to denote the variables that will have data from the backend programming 
INSERT INTO BasketballGame 
            (id, 
             FinalScoreOfWinningTeam, 
             FinalScoreOfLosingTeam,
			 Location,
			 GameId,
			 Team1Id,
             Team2Id) 
VALUES      ( :id, 
             :FinalScoreOfWinningTeam, 
             :FinalScoreOfLosingTeam,
			 :Location,
			 :GameId,
			 :Team1Id,
             :Team2Id); 

-- Query for Add new LeadingScore  
-- with colon : character being used to denote the variables that will have data from the backend programming 
INSERT INTO LeadingScore 
            (id, 
             Position, 
             TeamId, 
             GameId,   
             TotalPointsPerGame) 
VALUES      (:id, 
             :Position, 
             :TeamId, 
             :GameId,  
             :TotalPointsPerGame); 

-- Query for deleting BasketballTeams
-- with colon : character being used to denote the variables that will have data from the backend programming 
DELETE FROM BasketballTeams 
WHERE  BasketballTeamId = :BasketballTeamId; 

-- Query for deleting player 
-- with colon : character being used to denote the variables that will have data from the backend programming 
DELETE FROM BasketballTeamPlayer 
WHERE  Id = :Id; 

-- Query for updating player 
-- with colon : character being used to denote the variables that will have data from the backend programming 
UPDATE BasketballTeamPlayer 
SET    Id = :Id, 
       BasketballTeamId = :BasketballTeamId,
	   FirstName = :FirstName, 
       LastName = :LastName, 
       JerseyNumber = :JerseyNumber, 
       Position = :Position  
WHERE  Id = :Id; 


    