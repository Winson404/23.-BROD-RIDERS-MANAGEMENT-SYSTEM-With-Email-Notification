DROP TABLE announcement;

CREATE TABLE `announcement` (
  `actId` int(11) NOT NULL AUTO_INCREMENT,
  `actName` text NOT NULL,
  `actDate` varchar(20) NOT NULL,
  `date_added` varchar(20) NOT NULL,
  PRIMARY KEY (`actId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO announcement VALUES("2","Activity 5","2022-12-23","");
INSERT INTO announcement VALUES("3","Activity 3","2022-12-10","2022-12-11");
INSERT INTO announcement VALUES("4","Activity 2","2022-12-11","2022-12-11");
INSERT INTO announcement VALUES("5","Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem, ipsum delectus voluptatum? Molestias aut inventore eaque, maxime numquam dignissimos asperiores, voluptatibus consectetur distinctio excepturi odit architecto, saepe enim sunt, molestiae.","2022-12-11","2022-12-11");
INSERT INTO announcement VALUES("6","sample","2022-12-27","2022-12-27");
INSERT INTO announcement VALUES("8","Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem, ipsum delectus voluptatum? Molestias aut inventore eaque, maxime numquam dignissimos asperiores, voluptatibus consectetur distinctio excepturi odit architecto, saepe enim sunt, molestiae.","2023-01-06","2022-12-27");
INSERT INTO announcement VALUES("9","Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem, ipsum delectus voluptatum? Molestias aut inventore eaque, maxime numquam dignissimos asperiores, voluptatibus consectetur distinctio excepturi odit architecto, saepe enim sunt, molestiae.","2022-12-30","2022-12-30");



DROP TABLE attendance;

CREATE TABLE `attendance` (
  `attendanceId` int(11) NOT NULL AUTO_INCREMENT,
  `user_Id` int(11) NOT NULL,
  `TimeIn` varchar(50) NOT NULL,
  `date_added` varchar(50) NOT NULL,
  PRIMARY KEY (`attendanceId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO attendance VALUES("1","75","20:04","2023-01-03");
INSERT INTO attendance VALUES("2","75","20:05","2023-01-03");
INSERT INTO attendance VALUES("3","76","20:06","2023-01-03");
INSERT INTO attendance VALUES("4","75","23:36","2023-01-13");



DROP TABLE club;

CREATE TABLE `club` (
  `clubId` int(11) NOT NULL AUTO_INCREMENT,
  `clubName` varchar(255) NOT NULL,
  `clubAddress` varchar(255) NOT NULL,
  `clubDescription` varchar(255) NOT NULL,
  PRIMARY KEY (`clubId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO club VALUES("1","Club 2");
INSERT INTO club VALUES("3","Club 1");
INSERT INTO club VALUES("4","Club 3");
INSERT INTO club VALUES("5","Club 4");
INSERT INTO club VALUES("6","Club 5");



DROP TABLE comment;

CREATE TABLE `comment` (
  `commentId` int(11) NOT NULL AUTO_INCREMENT,
  `announcementId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_added` varchar(20) NOT NULL,
  PRIMARY KEY (`commentId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO comment VALUES("1","8","66","Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem, ipsum delectus voluptatum? Molestias aut inventore eaque, maxime numquam dignissimos asperiores, voluptatibus consectetur distinctio excepturi odit architecto, saepe enim sunt, molestiae.","");
INSERT INTO comment VALUES("2","9","67","Lorem ipsum, dolor ","");
INSERT INTO comment VALUES("3","8","67","Test","2022-12-31");
INSERT INTO comment VALUES("4","8","67","HAHA","2022-12-31");
INSERT INTO comment VALUES("5","8","67","GEGE","2022-12-31");
INSERT INTO comment VALUES("6","8","67","gsgs","2022-12-31");
INSERT INTO comment VALUES("7","8","67","gfg","2022-12-31");
INSERT INTO comment VALUES("8","8","66","Test124","2023-01-01");
INSERT INTO comment VALUES("9","8","67","Test123","2023-01-01");
INSERT INTO comment VALUES("10","8","67","Test12345","2023-01-01");
INSERT INTO comment VALUES("11","8","80","GAGA","2023-01-02");
INSERT INTO comment VALUES("12","8","80","Testtest","2023-01-03");



DROP TABLE customization;

CREATE TABLE `customization` (
  `customID` int(11) NOT NULL AUTO_INCREMENT,
  `picture` varchar(255) NOT NULL,
  `status` varchar(150) NOT NULL DEFAULT 'Inactive',
  `date_added` varchar(100) NOT NULL,
  PRIMARY KEY (`customID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

INSERT INTO customization VALUES("10","wallpaperflare.com_wallpaper.jpg","Active","2022-11-27");
INSERT INTO customization VALUES("11","minimalism-1644666519306-6515.jpg","Inactive","2022-11-27");
INSERT INTO customization VALUES("18","logo.png","Inactive","2022-11-27");
INSERT INTO customization VALUES("19","2.jpg","Inactive","2022-12-27");



DROP TABLE incident;

CREATE TABLE `incident` (
  `incidentId` int(11) NOT NULL AUTO_INCREMENT,
  `reporterId` int(11) NOT NULL,
  `incidentLocation` text NOT NULL,
  `dateOccurence` varchar(100) NOT NULL,
  `timeOccurence` varchar(100) NOT NULL,
  `incidentDescription` text NOT NULL,
  `incidentinjuries` text NOT NULL,
  `incidentStatus` int(11) NOT NULL DEFAULT '0' COMMENT '0=Unverified, 1=Verified',
  `date_added` varchar(100) NOT NULL,
  PRIMARY KEY (`incidentId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO incident VALUES("2","72","fdsf","2022-12-16","19:15","fdg","gfdgfd","1","2022-12-30");
INSERT INTO incident VALUES("3","76","gfdgdf","2022-12-16","19:19","gfdgf","dgdfgdf","2","2022-12-30");
INSERT INTO incident VALUES("4","75","fdsfsfsd","2023-01-26","19:00","fsdfsf","sdfsdfs","1","2023-01-01");
INSERT INTO incident VALUES("5","77","fds","2023-01-02","17:43","fgfd","gfd","2","2023-01-03");
INSERT INTO incident VALUES("6","80","fsd","2023-01-13","17:59","fdsf","sfsd","0","2023-01-03");



DROP TABLE personinvolved;

CREATE TABLE `personinvolved` (
  `involvedId` int(11) NOT NULL AUTO_INCREMENT,
  `reporterId` int(11) NOT NULL,
  `personInvolved` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `date_added` varchar(255) NOT NULL,
  PRIMARY KEY (`involvedId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO personinvolved VALUES("1","67","fdsfsdfsf","fdsfsdfsdd","2023-01-01");
INSERT INTO personinvolved VALUES("2","67","fdsfsdfsfsffds","fsdfs","2023-01-01");
INSERT INTO personinvolved VALUES("3","80","fdsf","ds","2023-01-03");
INSERT INTO personinvolved VALUES("4","80","fdf","dsf","2023-01-03");



DROP TABLE requestletter;

CREATE TABLE `requestletter` (
  `requestId` int(11) NOT NULL AUTO_INCREMENT,
  `requestedby` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `fileType` varchar(255) NOT NULL,
  `fileSize` varchar(255) NOT NULL,
  `requestStatus` varchar(255) NOT NULL DEFAULT '0' COMMENT '0=Pending, 1=Approved, 2=Denied',
  `date_added` varchar(255) NOT NULL,
  `date_approved` varchar(50) NOT NULL,
  PRIMARY KEY (`requestId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO requestletter VALUES("1","76","brod-officer-scopes.docx","application/vnd.openxmlformats-officedocument.wordprocessingml.document","","2","2023-01-04","");
INSERT INTO requestletter VALUES("2","80","brod-officer-scopes.docx","application/vnd.openxmlformats-officedocument.wordprocessingml.document","","2","2023-01-04","");
INSERT INTO requestletter VALUES("3","80","18221-brod-officer-scopes.docx","application/vnd.openxmlformats-officedocument.wordprocessingml.document","","0","2023-01-04","");
INSERT INTO requestletter VALUES("4","80","26046-brgy-bugs.docx","application/vnd.openxmlformats-officedocument.wordprocessingml.document","","2","2023-01-04","2023-01-04");
INSERT INTO requestletter VALUES("5","80","67477-drivers-violation-additional-features.docx","application/vnd.openxmlformats-officedocument.wordprocessingml.document","","2","2023-01-04","");



DROP TABLE ride_direction;

CREATE TABLE `ride_direction` (
  `ride_id` int(11) NOT NULL AUTO_INCREMENT,
  `added_by` int(11) NOT NULL,
  `startingPoint` text NOT NULL,
  `firstStop` text NOT NULL,
  `secondStop` text NOT NULL,
  `thirdStop` text NOT NULL,
  `destination` text NOT NULL,
  `rideDate` varchar(50) NOT NULL,
  PRIMARY KEY (`ride_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO ride_direction VALUES("1","0","test1234","ww","ee","rr","test","2023-01-06");
INSERT INTO ride_direction VALUES("3","0","dfsfsd","11","22","33","gfdgfd","2023-01-11");
INSERT INTO ride_direction VALUES("4","0","fdsf","f","","fdsf","43","2023-01-11");
INSERT INTO ride_direction VALUES("5","0","fdsfs","","fdsf","sfsdfs","fds","2023-01-05");
INSERT INTO ride_direction VALUES("6","80","fdsf","sdfsf","dsfsdfds","","fsdfs","2023-01-14");
INSERT INTO ride_direction VALUES("7","66","fdsf","dsfs","fsf","sfsd","fds","2023-01-12");



DROP TABLE users;

CREATE TABLE `users` (
  `user_Id` int(11) NOT NULL AUTO_INCREMENT,
  `club` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `age` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `civilstatus` varchar(50) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `house_no` varchar(255) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `purok` varchar(255) NOT NULL,
  `zone` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'user.png',
  `password` varchar(100) NOT NULL,
  `user_type` varchar(50) NOT NULL DEFAULT 'Member',
  `account_status` varchar(20) NOT NULL DEFAULT '0' COMMENT '0=Pending, 1=Approved, 2=Denied',
  `verification_code` int(11) NOT NULL,
  `date_registered` date NOT NULL,
  PRIMARY KEY (`user_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4;

INSERT INTO users VALUES("66","0","Erwin","Cabag","Son","","1997-09-22","25 years old","admin@gmail.com","9359428963","Poblacion, Medellin, Cebu","Male","Married","Web developer","Bible Baptist Church","1234","Sitio Upper Landing","Purok San Isidro","Ambot","Daanlungsod","Medellin","","VII","13.jpg","0192023a7bbd73250516f069df18b500","BROD","1","374025","2022-11-25");
INSERT INTO users VALUES("67","3","Member","sAMPLE","d","","2016-03-09","6 years old","sonerwin12@gmail.com","9132456789","dsa","Male","Married","fdsf","Bible Baptist Church","fdsf","dsf","fdsf","fdsf","dsfsd","fdsf","GFD","fds","minimalism-1644666519306-6515.jpg","0192023a7bbd73250516f069df18b500","Member","1","336952","2022-11-25");
INSERT INTO users VALUES("72","1","Samplefhddds","gfdgfd","gdfgd","g","2022-12-21","5 days old","Norlyngelig16@gmail.com","9359428963","gfdgfdg","Male","Married","gfdgfdgd","Buddhist","gfdg","fdg","gdfgdg","gfdg","dfgd","fdgdg","fdg","dfg","21.jpg","66952c6203ae23242590c0061675234d","Member","1","0","2022-12-27");
INSERT INTO users VALUES("75","4","Norlyn","Son","Gelig","","2022-12-15","1 week old","Norlgelig16@gmail.com","9359428963","gfdgfd","Male","Separated","gfdgd","Evangelical Christianity","gfdg","dfgdg","df","gfdg","fdgd","gfdgdfg","Cebu","gfd","17.jpg","74129ee1fc4edfc41937efbbd6231c42","Member","1","0","2022-12-27");
INSERT INTO users VALUES("76","3","fsfdgd","gdfgdfg","dfgd","","2022-12-21","1 week old","sonerwin12@gmail.com","9132456789","gfdgdfgd","Female","Widow/ER","fdgdfg","United Church of Christ in the Philippines","fdsfsdf","sfsdfs","fdsfsdf","dsfsd","fsdfs","fdsfds","fdsfsdf","fdsfs","1.jpg","7488e331b8b64e5794da3fa4eb10ad5d","Member","1","0","2022-12-28");
INSERT INTO users VALUES("77","4","hgfhferwins","fhfh","hfghf","","2022-02-09","10 months old","adhgfhf342min@gmail.com","9132456789","hg","Male","Married","hgfh","Iglesia Ni Cristo","hgfh","fhfgh","fghfh","fghfgh","gfh","gfhfghfg","hfgh","fghfg","2.jpg","0192023a7bbd73250516f069df18b500","Member","0","0","2023-01-01");
INSERT INTO users VALUES("78","0","Erwin","Erwin","Erwin","","2023-01-01","1 day old","Erwin@gmail.com","9132456789","Erwin","Male","Married","Erwin","Methodist","Erwin","ErwinErwin","Erwin","Erwin","Erwin","Erwin","Erwin","Erwin","1.jpg","ee573038a64d9777ea8674688485c543","BROD","0","0","2023-01-02");
INSERT INTO users VALUES("79","0","CABAGCABAG","CABAG","CABAG","","2023-01-01","1 day old","CABAGCABAG@gmail.com","9132456789","CABAG","Male","Married","CABAG","Judaism","CABAG","CABAG","CABAG","CABAG","CABAG","CABAG","CABAG","CABAG","17.jpg","82c4ea19fddea3cf7b9ce84412fdf34d","BROD","1","0","2023-01-02");
INSERT INTO users VALUES("80","4","Alrights","Alrightf","Alrightg","","2023-01-01","1 day old","clubOfficer@gmail.com","9123456789","Alright","Male","Widow/ER","Alright","Evangelical Christianity","Alright","Alright","Alright","Alright","Alright","Alright","","Alright","academia.png","0192023a7bbd73250516f069df18b500","CLUB","1","0","2023-01-02");



DROP TABLE witness;

CREATE TABLE `witness` (
  `witnessId` int(11) NOT NULL AUTO_INCREMENT,
  `reporterId` int(11) NOT NULL,
  `witnessName` varchar(255) NOT NULL,
  `date_added` varchar(255) NOT NULL,
  PRIMARY KEY (`witnessId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO witness VALUES("1","67","fdsfsd","2023-01-01");
INSERT INTO witness VALUES("2","80","fds","2023-01-03");
INSERT INTO witness VALUES("3","80","fdsfsd","2023-01-03");



