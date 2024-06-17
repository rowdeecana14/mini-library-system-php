-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table mls.tbl_authors
CREATE TABLE IF NOT EXISTS `tbl_authors` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mls.tbl_authors: ~15 rows (approximately)
INSERT INTO `tbl_authors` (`author_id`, `author`) VALUES
	(53, 'Harper Lee'),
	(54, 'George Orwell'),
	(55, 'J.d. Salinger'),
	(56, 'Stephen Hawking'),
	(57, 'Richard Dawkins'),
	(58, 'James D. Watson'),
	(59, 'Yuval Noah Harari'),
	(60, 'Jared Diamond'),
	(61, 'Anne Frank'),
	(62, '381'),
	(63, 'Stephen R. Covey'),
	(64, 'Dale Carnegie'),
	(65, 'Robert T. Kiyosaki'),
	(66, 'Malcolm Gladwell'),
	(67, 'Steven D. Levitt And Stephen J. Dubner');

-- Dumping structure for table mls.tbl_books
CREATE TABLE IF NOT EXISTS `tbl_books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `pages` int(11) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `author_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  PRIMARY KEY (`book_id`),
  KEY `author_id` (`author_id`),
  KEY `genre_id` (`genre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mls.tbl_books: ~15 rows (approximately)
INSERT INTO `tbl_books` (`book_id`, `image`, `isbn`, `title`, `summary`, `pages`, `fee`, `status`, `created_at`, `updated_at`, `author_id`, `genre_id`) VALUES
	(42, 'To Kill a Mockingbird.png', '0001', 'To Kill A Mockingbird', 'A Novel Set In The Deep South, Focusing On The Moral Growth Of Scout Finch As Her Father, Lawyer Atticus Finch, Defends A Black Man Wrongly Accused Of Raping A White Woman. It Addresses Serious Issues Such As Racial Injustice And Moral Integrity.', 28, 500.00, 'Available', '2024-06-17 08:45:07', '0000-00-00 00:00:00', 53, 12),
	(43, '1984.png', '0002', '1984', 'A Dystopian Novel Set In A Totalitarian Society Under Constant Surveillance By Big Brother. The Protagonist, Winston Smith, Struggles With Oppression And Seeks Truth And Freedom In A World Dominated By Propaganda And Authoritarianism.', 328, 600.00, 'Available', '2024-06-17 08:49:27', '0000-00-00 00:00:00', 54, 12),
	(44, 'The Catcher in the Rye.png', '0003', 'The Catcher In The Rye', 'The Story Of Holden Caulfield, A Teenager Who Leaves His Prep School And Experiences The Complexities Of Adult Life In New York City. It Explores Themes Of Alienation, Identity, And The Loss Of Innocence.', 277, 400.00, 'Available', '2024-06-17 08:51:00', '2024-06-17 09:34:48', 55, 12),
	(45, 'A Brief History of Time.png', '0004', 'A Brief History Of Time', 'An Accessible Introduction To Cosmology, Discussing Concepts Such As Black Holes, The Big Bang, And The Nature Of Time, Written By The Renowned Physicist Stephen Hawking.', 256, 400.00, 'Available', '2024-06-17 09:32:55', '2024-06-17 09:38:20', 56, 13),
	(46, 'The Selfish Gene.png', '0005', 'The Selfish Gene', 'Introduces The Concept Of The Gene-centered View Of Evolution, Explaining How Genes Drive The Behaviors And Characteristics Of Organisms, And Introducing The Idea Of The "meme" As A Unit Of Cultural Evolution.', 384, 500.00, 'Available', '2024-06-17 09:38:02', '2024-06-17 09:39:08', 57, 13),
	(47, 'The Double Helix.png', '0006', 'The Double Helix', 'A Personal Account Of The Discovery Of The Structure Of Dna, Revealing The Excitement, Challenges, And Controversies Faced By The Scientists Involved In This Groundbreaking Work.', 256, 700.00, 'Available', '2024-06-17 09:41:29', '0000-00-00 00:00:00', 58, 13),
	(48, 'Sapiens A Brief History of Humankind.png', '0007', 'Sapiens: A Brief History Of Humankind', 'Traces The History Of Homo Sapiens From The Emergence Of The Species To The Present Day, Examining The Cognitive, Agricultural, And Scientific Revolutions That Shaped Human Societies.', 443, 600.00, 'Available', '2024-06-17 09:44:04', '0000-00-00 00:00:00', 59, 14),
	(49, 'Guns-Germs-and-Steel-The Fates of Human Societies.png', '0008', 'Guns, Germs, And Steel: The Fates Of Human Societies', 'Explores The Factors That Led To The Unequal Development Of Human Societies Across Different Continents, Focusing On The Roles Of Geography, Environment, And Technology.', 494, 500.00, 'Available', '2024-06-17 09:46:22', '0000-00-00 00:00:00', 60, 14),
	(50, 'The Diary of a Young Girl.png', '0009', 'The Diary Of A Young Girl', 'The Personal Diary Of Anne Frank, A Jewish Girl Hiding From The Nazis During World War Ii, Providing A Poignant And Insightful Look Into Her Life And Thoughts During A Time Of Great Peril.', 283, 400.00, 'Available', '2024-06-17 09:48:26', '0000-00-00 00:00:00', 61, 14),
	(51, 'The 7 Habits of Highly Effective People.png', '0010', 'The 7 Habits Of Highly Effective People', 'A Guide To Personal And Professional Effectiveness, Outlining Seven Habits That Can Help Individuals Achieve Success And Fulfillment Through Proactive Behavior, Goal Setting, And Continuous Improvement.', 381, 700.00, 'Available', '2024-06-17 09:51:07', '0000-00-00 00:00:00', 63, 15),
	(52, 'How to Win Friends and Influence People.png', '0011', 'How To Win Friends And Influence People', 'Offers Practical Advice On Improving Interpersonal Skills, Building Positive Relationships, And Influencing Others, Emphasizing The Importance Of Empathy, Listening, And Genuine Interest In Others.', 291, 500.00, 'Available', '2024-06-17 09:52:45', '2024-06-17 09:53:52', 64, 15),
	(53, 'Atomic Habits-An Easy & Proven Way to Build Good Habits & Break Bad Ones.png', '0012', 'Atomic Habits: An Easy & Proven Way To Build Good Habits & Break Bad Ones', 'Provides A Framework For Developing Good Habits And Breaking Bad Ones Through Small, Incremental Changes, Highlighting The Power Of Consistent, Positive Actions Over Time.', 320, 500.00, 'Available', '2024-06-17 09:55:10', '0000-00-00 00:00:00', 62, 15),
	(54, 'Rich Dad Poor Dad.png', '0013', 'Rich Dad Poor Dad', 'Shares Lessons On Financial Literacy, Emphasizing The Importance Of Investing, Entrepreneurship, And Financial Education, Based On The Authors Experiences With His Two Dads - His Biological Father And His Best Friends Father.', 336, 500.00, 'Available', '2024-06-17 09:59:46', '0000-00-00 00:00:00', 65, 16),
	(55, 'Outliers-The Story of Success.png', '0014', 'Outliers: The Story Of Success', 'Investigates The Factors That Contribute To High Levels Of Success, Arguing That Cultural Background, Timing, And Opportunities Play Crucial Roles In Shaping Extraordinary Achievements.', 336, 600.00, 'Available', '2024-06-17 10:01:21', '0000-00-00 00:00:00', 66, 16),
	(56, 'Freakonomics-A Rogue Economist Explores the Hidden Side of Everything.png', '0015', 'Freakonomics: A Rogue Economist Explores The Hidden Side Of Everything', 'Uses Economic Theory To Explore A Wide Range Of Real-world Phenomena, Revealing Surprising Insights Into Human Behavior And Challenging Conventional Wisdom.', 336, 1000.00, 'Available', '2024-06-17 10:04:24', '0000-00-00 00:00:00', 67, 16);

-- Dumping structure for table mls.tbl_genres
CREATE TABLE IF NOT EXISTS `tbl_genres` (
  `genre_id` int(11) NOT NULL AUTO_INCREMENT,
  `genre` varchar(255) NOT NULL,
  PRIMARY KEY (`genre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mls.tbl_genres: ~5 rows (approximately)
INSERT INTO `tbl_genres` (`genre_id`, `genre`) VALUES
	(12, 'Fiction And Literature'),
	(13, 'Science And Mathematics'),
	(14, 'History And Social Sciences'),
	(15, 'Self-improvement And Personal Development'),
	(16, 'Business And Economics');

-- Dumping structure for table mls.tbl_logs
CREATE TABLE IF NOT EXISTS `tbl_logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=352 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mls.tbl_logs: ~46 rows (approximately)
INSERT INTO `tbl_logs` (`log_id`, `description`, `action`, `date`, `user_id`) VALUES
	(306, 'Login successfully.', 'Login', '2024-06-17 07:03:53', 8),
	(307, 'Login successfully.', 'Login', '2024-06-17 07:03:56', 8),
	(308, 'Logout successfully.', 'Logout', '2024-06-17 07:04:07', 8),
	(309, 'Login successfully.', 'Login', '2024-06-17 07:04:10', 8),
	(310, 'Logout successfully.', 'Logout', '2024-06-17 07:10:04', 8),
	(311, 'Login successfully.', 'Login', '2024-06-17 07:10:07', 8),
	(312, 'Logout successfully.', 'Logout', '2024-06-17 07:10:26', 8),
	(313, 'Login successfully.', 'Login', '2024-06-17 07:20:09', 8),
	(314, 'Logout successfully.', 'Logout', '2024-06-17 08:16:31', 8),
	(315, 'Login successfully.', 'Login', '2024-06-17 08:21:39', 8),
	(316, 'Logout successfully.', 'Logout', '2024-06-17 08:29:07', 8),
	(317, 'Login successfully.', 'Login', '2024-06-17 08:29:13', 8),
	(318, 'Logout successfully.', 'Logout', '2024-06-17 08:46:42', 8),
	(319, 'Login successfully.', 'Login', '2024-06-17 08:47:10', 8),
	(320, 'Logout successfully.', 'Logout', '2024-06-17 08:49:30', 8),
	(321, 'Login successfully.', 'Login', '2024-06-17 08:50:14', 8),
	(322, 'Logout successfully.', 'Logout', '2024-06-17 08:51:37', 8),
	(323, 'Login successfully.', 'Login', '2024-06-17 09:30:46', 8),
	(324, 'Logout successfully.', 'Logout', '2024-06-17 09:31:19', 8),
	(325, 'Login successfully.', 'Login', '2024-06-17 09:31:35', 8),
	(326, 'Logout successfully.', 'Logout', '2024-06-17 10:09:44', 8),
	(327, 'Login successfully.', 'Login', '2024-06-17 10:10:15', 16),
	(328, 'Logout successfully.', 'Logout', '2024-06-17 10:18:45', 16),
	(329, 'Login successfully.', 'Login', '2024-06-17 10:19:05', 17),
	(330, 'Logout successfully.', 'Logout', '2024-06-17 10:19:52', 17),
	(331, 'Login successfully.', 'Login', '2024-06-17 10:19:56', 8),
	(332, 'Logout successfully.', 'Logout', '2024-06-17 10:20:06', 8),
	(333, 'Login successfully.', 'Login', '2024-06-17 10:20:08', 17),
	(334, 'Logout successfully.', 'Logout', '2024-06-17 10:20:38', 17),
	(335, 'Login successfully.', 'Login', '2024-06-17 10:20:40', 8),
	(336, 'Logout successfully.', 'Logout', '2024-06-17 10:22:09', 8),
	(337, 'Login successfully.', 'Login', '2024-06-17 10:22:11', 17),
	(338, 'Logout successfully.', 'Logout', '2024-06-17 10:22:34', 17),
	(339, 'Login successfully.', 'Login', '2024-06-17 10:22:36', 16),
	(340, 'Logout successfully.', 'Logout', '2024-06-17 10:22:45', 16),
	(341, 'Login successfully.', 'Login', '2024-06-17 10:22:49', 8),
	(342, 'Logout successfully.', 'Logout', '2024-06-17 10:23:58', 8),
	(343, 'Login successfully.', 'Login', '2024-06-17 10:24:02', 17),
	(344, 'Logout successfully.', 'Logout', '2024-06-17 10:24:23', 17),
	(345, 'Login successfully.', 'Login', '2024-06-17 10:24:26', 16),
	(346, 'Logout successfully.', 'Logout', '2024-06-17 10:24:58', 16),
	(347, 'Login successfully.', 'Login', '2024-06-17 10:25:27', 18),
	(348, 'Logout successfully.', 'Logout', '2024-06-17 10:26:26', 18),
	(349, 'Login successfully.', 'Login', '2024-06-17 10:30:57', 16),
	(350, 'Logout successfully.', 'Logout', '2024-06-17 10:32:31', 16),
	(351, 'Login successfully.', 'Login', '2024-06-17 10:32:35', 8);

-- Dumping structure for table mls.tbl_profiles
CREATE TABLE IF NOT EXISTS `tbl_profiles` (
  `profile_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mls.tbl_profiles: ~4 rows (approximately)
INSERT INTO `tbl_profiles` (`profile_id`, `image`, `first_name`, `last_name`, `gender`, `email`, `contact_no`, `address`) VALUES
	(8, 'unknown.png', 'Admin', 'Admin', 'Male', 'c.rowdee@yahoo.com', '0935678656', 'Escalante City'),
	(16, 'danica.jpg', 'Danica', 'Caña', 'Female', 'danicacana@gmail.com', '07', 'Dian ay'),
	(17, 'ace.png', 'Ace Jahrel', 'Caña', '', '', '', ''),
	(18, 'wp9034356.jpg', 'Rudy', 'Caña', '', '', '', '');

-- Dumping structure for table mls.tbl_rents
CREATE TABLE IF NOT EXISTS `tbl_rents` (
  `rented_id` int(11) NOT NULL AUTO_INCREMENT,
  `rent_no` varchar(200) NOT NULL,
  `rent_status` varchar(255) NOT NULL,
  `rent_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`rented_id`),
  KEY `user_id` (`user_id`),
  KEY `book_id` (`book_id`),
  KEY `book_id_2` (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mls.tbl_rents: ~20 rows (approximately)
INSERT INTO `tbl_rents` (`rented_id`, `rent_no`, `rent_status`, `rent_date`, `due_date`, `return_date`, `book_id`, `user_id`) VALUES
	(105, 'tmc-06172024-88109336', 'Returned', '2024-06-17', '2024-07-01', '0000-00-00', 55, 16),
	(106, 'tmc-06172024-88109336', 'Returned', '2024-06-17', '2024-07-01', '2024-06-17', 43, 16),
	(107, 'tmc-06172024-88109336', 'Returned', '2024-06-17', '2024-07-01', '0000-00-00', 42, 16),
	(108, 'tmc-06172024-88109336', 'Returned', '2024-06-17', '2024-07-01', '0000-00-00', 52, 16),
	(109, 'tmc-06172024-88109336', 'Returned', '2024-06-17', '2024-07-01', '0000-00-00', 50, 16),
	(110, 'tmc-06172024-88109336', 'Returned', '2024-06-17', '2024-07-01', '0000-00-00', 53, 16),
	(111, 'duf-06172024-63787883', 'Returned', '2024-06-03', '2024-07-01', '0000-00-00', 46, 17),
	(112, 'duf-06172024-63787883', 'Returned', '2024-06-03', '2024-07-01', '0000-00-00', 54, 17),
	(113, 'duf-06172024-63787883', 'Returned', '2024-06-03', '2024-07-01', '2024-06-17', 45, 17),
	(114, 'duf-06172024-63787883', 'Returned', '2024-06-03', '2024-07-01', '0000-00-00', 47, 17),
	(115, 'duf-06172024-63787883', 'Returned', '2024-06-03', '2024-07-01', '0000-00-00', 44, 17),
	(116, 'knq-06172024-38101481', 'Rented-process', '2024-06-17', '2024-07-01', '0000-00-00', 49, 17),
	(117, 'knq-06172024-38101481', 'Rented-process', '2024-06-17', '2024-07-01', '0000-00-00', 44, 17),
	(118, 'knq-06172024-38101481', 'Rented-process', '2024-06-17', '2024-07-01', '0000-00-00', 42, 17),
	(119, 'pde-06172024-80806054', 'Rented-process', '2024-06-24', '2024-07-01', '0000-00-00', 51, 16),
	(120, 'pde-06172024-80806054', 'Rented-process', '2024-06-24', '2024-07-01', '0000-00-00', 48, 16),
	(121, 'pde-06172024-80806054', 'Rented-process', '2024-06-24', '2024-07-01', '0000-00-00', 56, 16),
	(122, 'cwc-06172024-27139391', 'Rented-process', '2024-06-24', '2024-07-01', '0000-00-00', 54, 18),
	(123, 'cwc-06172024-27139391', 'Rented-process', '2024-06-24', '2024-07-01', '0000-00-00', 46, 18),
	(124, 'cwc-06172024-27139391', 'Rented-process', '2024-06-24', '2024-07-01', '0000-00-00', 43, 18);

-- Dumping structure for table mls.tbl_users
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mls.tbl_users: ~4 rows (approximately)
INSERT INTO `tbl_users` (`user_id`, `username`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
	(8, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'Active', '2020-01-03 10:33:14', '2024-06-17 10:20:58'),
	(16, 'danica', 'b63c10a6673b1c06b05bdce235ab85f5', 'Lessee', 'Active', '2024-06-17 10:10:02', '2024-06-17 10:13:58'),
	(17, 'ace', '360e2ece07507675dced80ba867d6dcd', 'Lessee', 'Active', '2024-06-17 10:18:57', '0000-00-00 00:00:00'),
	(18, 'rudy', 'cfce9735de7c3873a55331a4e74b70fc', 'Lessee', 'Active', '2024-06-17 10:25:10', '0000-00-00 00:00:00');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
