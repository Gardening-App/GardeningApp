CREATE TABLE `profile` (
  `userID` int NOT NULL,
  `age` int DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `favoritePlant` varchar(45) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`userID`),
  CONSTRAINT `userID` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
