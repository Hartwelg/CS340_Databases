CREATE TABLE `BasketballTeams` ( 
	`id` int(11) NOT NULL AUTO_INCREMENT, 
	`name` varchar(30) NOT NULL, 
	`mascot` varchar(30) NOT NULL, 
	`NumWins` int(11) NOT NULL, 
	`NumLosses` int(11) NOT NULL, 
	`BasketballTeamId` int(30) NOT NULL,
	 PRIMARY KEY (`id`) 
)ENGINE=`innoDB` 

CREATE TABLE `BasketballTeamPlayer` ( 
	`Id` int(11) NOT NULL AUTO_INCREMENT, 
	`BasketballTeamId` int(11) NOT NULL, 
	`FirstName` varchar(60) NOT NULL, 
	`LastName` varchar(60) NOT NULL, 
	`JerseyNumber` int(60) NOT NULL, 
	`Position` varchar(60) NOT NULL, 
	PRIMARY KEY(`id`)
)ENGINE=`innoDB` 


    CREATE TABLE `BasketballGame` ( 
    `id` int(11) NOT NULL AUTO_INCREMENT, 
    `FinalScoreOfWinningTeam` int(60) NOT NULL DEFAULT 0,
     `FinalScoreOfLosingTeam` int(60) NOT NULL DEFAULT 0,
     `Location` varchar(60) NOT NULL, 
     `GameId` int(60) NOT NULL, 
     `Team1Id` int(11) NOT NULL, 
     `Team2Id` int(11) NOT NULL, 
     PRIMARY KEY (`id`)
     )ENGINE=`InnoDB` 

	ALTER TABLE `BasketballGame` ADD FOREIGN KEY (`Team1Id`) REFERENCES `BasketballTeams` (`id`)
	ALTER TABLE `BasketballGame` ADD FOREIGN KEY (`Team2Id`) REFERENCES `BasketballTeams` (`id`)

    CREATE TABLE `LeadingScore` ( 
    `id` int(11) NOT NULL, 
    `Position` varchar(60) NOT NULL, 
    `TeamId` int(11) NOT NULL, 
    `GameId` int(11) NOT NULL, 
    `TotalPointsPerGame` int(100) NOT NULL DEFAULT 0 
    )ENGINE=InnoDB

    ALTER TABLE `LeadingScore` ADD FOREIGN KEY (`id`) REFERENCES `BasketballTeamPlayer` (`id`)
	ALTER TABLE `LeadingScore` ADD FOREIGN KEY (`TeamId`) REFERENCES `BasketballTeams` (`id`) 
	ALTER TABLE `LeadingScore` ADD FOREIGN KEY (`GameId`) REFERENCES `BasketballGame` (`id`) 