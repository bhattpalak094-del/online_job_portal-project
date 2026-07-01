-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2026 at 05:09 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `job`
--

-- --------------------------------------------------------

--
-- Table structure for table `applyers`
--

CREATE TABLE IF NOT EXISTS `applyers` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `j_title` varchar(100) NOT NULL,
  `cname` varchar(100) NOT NULL,
  `jname` varchar(100) NOT NULL,
  `status` enum('confirm','reject','shortlisted','pending') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`a_id`),
  KEY `job_id` (`job_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `applyers`
--

INSERT INTO `applyers` (`a_id`, `job_id`, `j_title`, `cname`, `jname`, `status`) VALUES
(1, 1, 'Web developer ', 'TCS', 'sakshi patel', 'confirm'),
(2, 1, 'Web developer ', 'TCS', 'Abhishek Patel', 'reject'),
(3, 2, 'Software Engineering', 'TCS', 'Abhishek Patel', 'confirm'),
(4, 2, 'Software Engineering', 'TCS', 'sakshi patel', 'reject'),
(5, 3, 'Data Analyst', 'TCS', 'sakshi patel', 'shortlisted'),
(6, 10, 'Data Scientist', 'Microsoft', 'Krina Patel', 'confirm'),
(7, 3, 'Data Analyst', 'TCS', 'Neha Shah', 'confirm'),
(8, 11, 'UI/UX Designer', 'Tech Mahindra', 'Maitri Joshi', 'pending'),
(9, 16, 'UI/UX Designer', 'Amazon', 'Maitri Joshi', 'confirm'),
(10, 7, 'Data Analyst', 'Accenture', 'Krina Patel', 'shortlisted'),
(11, 23, 'Full Stack Developer', 'Infosys', 'Diksha Singh', 'confirm'),
(12, 9, 'Programmer', 'Infosys', 'Abhishek Patel', 'confirm'),
(13, 17, 'Programmer', 'Wipro', 'Abhishek Patel', 'reject'),
(14, 19, 'Blockchain Developer', 'Cognizant', 'Neha Shah', 'reject'),
(15, 20, 'Web Developer', 'Cognizant', 'Diksha Singh', 'pending'),
(16, 5, 'Web developer ', 'HCL Technologies', 'Diksha Singh', 'shortlisted');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE IF NOT EXISTS `education` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
  `jname` varchar(100) NOT NULL,
  `s_school` varchar(100) NOT NULL,
  `s_year` int(11) NOT NULL,
  `s_percent` decimal(5,2) NOT NULL,
  `h_school` varchar(100) NOT NULL,
  `stream` varchar(100) NOT NULL,
  `h_year` int(11) NOT NULL,
  `h_percent` decimal(5,2) NOT NULL,
  `college` varchar(100) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `degree` varchar(100) NOT NULL,
  `c_year` int(11) NOT NULL,
  `cgpa` float NOT NULL,
  PRIMARY KEY (`e_id`),
  UNIQUE KEY `jname` (`jname`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`e_id`, `jname`, `s_school`, `s_year`, `s_percent`, `h_school`, `stream`, `h_year`, `h_percent`, `college`, `qualification`, `degree`, `c_year`, `cgpa`) VALUES
(1, 'sakshi patel', 'Narayan vidyalaya,bharuch', 2020, '70.00', 'Narayan vidyalaya,bharuch', 'commerce', 2022, '80.00', 'MKICS', 'graduation', 'bca', 2025, 9),
(2, 'Abhishek Patel', 'Amity', 2020, '70.00', 'Amity', 'science', 2022, '90.00', 'VNSGU', 'graduation', 'btech', 2025, 9),
(3, 'Krina Patel', 'Amity', 2020, '91.17', 'Narayan Vidyalaya', 'science', 2022, '95.00', 'L.D Engineering College', 'graduation', 'btech', 2025, 8.88),
(4, 'Neha Shah', 'Narayan Vidya Vihar', 2018, '86.00', 'Narayan Vidya Vihar', 'science', 2020, '76.80', 'L.J college of engineering', 'graduation', 'btech', 2025, 8),
(5, 'Maitri Joshi', 'Advait vidya niketan', 2020, '80.00', 'Advait vidya niketan', 'commerce', 2022, '70.00', 'VNSGU', 'graduation', 'bca', 2025, 7.77),
(6, 'Diksha Singh', 'GNFC ', 2020, '90.88', 'GNFC', 'science', 2022, '76.70', 'MKICS', 'graduation', 'bca', 2025, 8.8);

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE IF NOT EXISTS `employer` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(100) NOT NULL,
  `con_person` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobileno` varchar(10) NOT NULL,
  `status` enum('Approved','Rejected','Pending') NOT NULL DEFAULT 'Pending',
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `legal_doc` varchar(255) NOT NULL,
  `c_type` enum('National','International') NOT NULL,
  `logo` varchar(255) NOT NULL,
  PRIMARY KEY (`cname`),
  UNIQUE KEY `c_id` (`c_id`),
  UNIQUE KEY `username` (`username`),
  KEY `password` (`password`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`c_id`, `cname`, `con_person`, `address`, `city`, `email`, `mobileno`, `status`, `username`, `password`, `legal_doc`, `c_type`, `logo`) VALUES
(9, 'Accenture', 'Priya Desai', 'CDC5 Tower B, Divyasree Point, Sholinganallur, Chennai', 'Chennai', 'accenture.info@gmail.com', '8867543456', 'Approved', 'accenture', 'acc123', 'Legal_docs/Accenture.docx', 'International', 'Logo/accenture.png'),
(2, 'Amazon', 'Aditi Varma', 'Block-E, 14th Floor, International Trade Tower, Nehru Place, New Delhi ', 'Delhi', 'amazon.info@gmail.com', '9088764456', 'Approved', 'amazon', 'amazon22', 'Legal_docs/amazon.docx', 'International', 'Logo/amazon.png'),
(5, 'Cognizant', 'Jaimin Kohli', 'Cognizant Technology Solutions 18th to 21st floors, Pragya II, Block 15, GIFT SEZ, GIFT CITY, Gandhi', 'Ahmedabad', 'cognizant.info@gmail.com', '9967856785', 'Approved', 'cognizant', 'c12345', 'Legal_docs/cognizant.docx', 'International', 'Logo/cognizant.png'),
(6, 'HCL Technologies', 'Aalok Shah', ' 806, Siddharth, 96, Nehru Place, New Delhi', 'Delhi', 'hcl.techno@gmail.com', '9987554678', 'Approved', 'hcl', 'hcltech', 'Legal_docs/HCL.docx', 'National', 'Logo/hcl.png'),
(3, 'Infosys', 'Pransi Sharma', 'Plot No. 26A, Electronic City, Hosur Road, Bengaluru ', 'Bengaluru', 'infosys07@gmail.com', '9877656778', 'Approved', 'infosys', 'infosys3', 'Legal_docs/infosys.docx', 'National', 'Logo/infosys.png'),
(8, 'Microsoft', 'Abhishek Shukla', '807, New Delhi House, Barakhamba Road, New Delhi', 'Delhi', 'micro.soft@gmail.com', '9966547356', 'Approved', 'microsoft', 'micro11', 'Legal_docs/microsoft.docx', 'International', 'Logo/microsoft.png'),
(1, 'TCS', 'Pritesh Patel', 'TCS main building, ahmedabad', 'ahmedabad', 'tcs111@gmail.com', '9987765463', 'Approved', 'tcs', 'tcs111', 'Legal_docs/tcs.docx', 'National', 'Logo/tcs.png'),
(7, 'Tech Mahindra', 'Parth Patel', ' Sharda Centre, Off Karve Road, Erandwane, Pune', 'Mumbai', 'tech.mahindra@gmail.com', '9567894435', 'Rejected', 'tech', 'tech13', 'Legal_docs/tech_mahindra.docx', 'National', 'Logo/tech_mahindra.jpg'),
(4, 'Wipro', 'Saumil Mishra', 'Wipro Limited, Doddakannelli, Sarjapur Road, Bengaluru ', 'Bengaluru', 'wipro.limited@gmail.com', '9907786567', 'Approved', 'wipro', 'wipro44', 'Legal_docs/wipro.docx', 'National', 'Logo/wipro.png');

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE IF NOT EXISTS `experience` (
  `exp_id` int(11) NOT NULL AUTO_INCREMENT,
  `jname` varchar(100) NOT NULL,
  `e_type` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `tech` varchar(255) NOT NULL,
  `resume` varchar(200) NOT NULL,
  PRIMARY KEY (`exp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`exp_id`, `jname`, `e_type`, `company`, `position`, `duration`, `title`, `tech`, `resume`) VALUES
(1, 'sakshi patel', 'project', '', '', '', 'Online voting system', 'PHP', '../resumes/resume_1.docx'),
(2, 'Krina Patel', 'project', '', '', '', 'AI Resume Analyzer', 'PHP', '../resumes/resume_3.docx');

-- --------------------------------------------------------

--
-- Table structure for table `interview`
--

CREATE TABLE IF NOT EXISTS `interview` (
  `i_id` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(100) NOT NULL,
  `j_title` varchar(100) NOT NULL,
  `jname` varchar(100) NOT NULL,
  `i_date` date NOT NULL,
  `i_time` time NOT NULL,
  `i_mode` enum('Online','Offline') NOT NULL,
  PRIMARY KEY (`i_id`),
  KEY `cname` (`cname`,`j_title`,`jname`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `interview`
--

INSERT INTO `interview` (`i_id`, `cname`, `j_title`, `jname`, `i_date`, `i_time`, `i_mode`) VALUES
(1, 'TCS', 'Web developer ', 'sakshi patel', '2026-01-30', '09:00:00', 'Offline'),
(4, 'TCS', 'Software Engineering', 'Abhishek Patel', '2026-02-11', '07:00:00', 'Online'),
(6, 'TCS', 'Data Analyst', 'Neha Shah', '2026-04-20', '09:00:00', 'Online'),
(7, 'Amazon', 'UI/UX Designer', 'Maitri Joshi', '2026-04-27', '08:00:00', 'Offline'),
(8, 'Microsoft', 'Data Scientist', 'Krina Patel', '2026-05-01', '10:00:00', 'Online'),
(9, 'Infosys', 'Full Stack Developer', 'Diksha Singh', '2026-05-01', '09:00:00', 'Online'),
(10, 'Infosys', 'Programmer', 'Abhishek Patel', '2026-05-02', '08:00:00', 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `job_seeker`
--

CREATE TABLE IF NOT EXISTS `job_seeker` (
  `j_id` int(11) NOT NULL AUTO_INCREMENT,
  `jname` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobileno` varchar(10) NOT NULL,
  `type` enum('experience','fresher') NOT NULL,
  `status` enum('Approved','Rejected','Pending') NOT NULL DEFAULT 'Pending',
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`jname`),
  UNIQUE KEY `j_id` (`j_id`),
  KEY `username` (`username`),
  KEY `password` (`password`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `job_seeker`
--

INSERT INTO `job_seeker` (`j_id`, `jname`, `city`, `email`, `mobileno`, `type`, `status`, `username`, `password`) VALUES
(2, 'Abhishek Patel', 'Baroda', 'abhi13@gmail.com', '9987654678', 'experience', 'Approved', 'abhi', 'abhi13'),
(6, 'Diksha Singh', 'ankleshwar', 'dikshasingh33@gmail.com', '9844567834', 'experience', 'Approved', 'diksha', 'diksha03'),
(3, 'Krina Patel', 'Bharuch', 'krinapatel05@gmail.com', '9986758944', 'fresher', 'Approved', 'krina', 'krina05'),
(4, 'Maitri Joshi', 'Baroda', 'maitrijoshi19@gmail.com', '9975665469', 'experience', 'Approved', 'maitri', 'maitri01'),
(9, 'Misha Bhatt', 'Ahmedabad', 'mishu15@gmail.com', '9987665544', 'experience', 'Rejected', 'misha', 'misha5'),
(7, 'Neha Shah', 'Ahmedabad', 'neha.patel03@gmail.com', '7685647896', 'experience', 'Approved', 'neha', 'neha003'),
(8, 'Pranjal Jadav', 'Surat', 'pranjaljadav22@gmail.com', '8876556789', 'fresher', 'Pending', 'pranjal', 'pranju12'),
(5, 'Pravi Modi', 'surat', 'pravimodi22@gmail.com', '9066547835', 'fresher', 'Rejected', 'pravi', 'pravi02'),
(1, 'sakshi patel', 'bharuch', 'sip13@gmail.com', '9456774355', 'fresher', 'Approved', 'sakshi', 'sakshi1');

-- --------------------------------------------------------

--
-- Table structure for table `j_exp`
--

CREATE TABLE IF NOT EXISTS `j_exp` (
  `ex_id` int(11) NOT NULL AUTO_INCREMENT,
  `jname` varchar(100) NOT NULL,
  `com_name` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `ctc` float NOT NULL,
  `j_date` date NOT NULL,
  `l_date` date NOT NULL,
  `resume` varchar(100) NOT NULL,
  PRIMARY KEY (`ex_id`),
  KEY `jname` (`jname`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `j_exp`
--

INSERT INTO `j_exp` (`ex_id`, `jname`, `com_name`, `designation`, `ctc`, `j_date`, `l_date`, `resume`) VALUES
(1, 'Abhishek Patel', 'Technoviewer', 'Jr. web designer', 20000, '2025-05-01', '2026-01-31', '../resumes/resume_2.docx'),
(2, 'Neha Shah', 'GNFC', 'data analyst', 22000, '2026-01-01', '2026-03-31', '../resumes/resume_6.docx'),
(3, 'Maitri Joshi', 'GACL', 'Ui/Ux designer', 15000, '2025-09-01', '2026-02-28', '../resumes/resume_4.docx'),
(4, 'Diksha Singh', 'hcl tech', 'web developer', 25000, '2025-08-01', '2026-01-31', '../resumes/resume_6.docx');

-- --------------------------------------------------------

--
-- Table structure for table `manage_job`
--

CREATE TABLE IF NOT EXISTS `manage_job` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(100) NOT NULL,
  `j_title` varchar(100) NOT NULL,
  `total_vacancy` int(11) NOT NULL,
  `j_qualification` varchar(100) NOT NULL,
  `j_experience` varchar(100) NOT NULL,
  `j_type` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `time` timestamp NOT NULL,
  PRIMARY KEY (`job_id`),
  KEY `cname` (`cname`),
  KEY `j_title` (`j_title`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `manage_job`
--

INSERT INTO `manage_job` (`job_id`, `cname`, `j_title`, `total_vacancy`, `j_qualification`, `j_experience`, `j_type`, `location`, `time`) VALUES
(1, 'TCS', 'Web developer ', 1, 'BCA, MCA, BTECH', '1-3 Years', 'full-time', 'Ahmedabad', '2026-02-02 05:20:53'),
(2, 'TCS', 'Software Engineering', 1, 'BTECH, MTECH, BE, ME', '0-1 Years', 'part-time', 'pune', '2026-02-04 05:53:28'),
(3, 'TCS', 'Data Analyst', 1, 'BTECH, ME, MSC(IT)', 'Fresher', 'Internship', 'Delhi', '2026-02-21 08:17:19'),
(4, 'HCL Technologies', 'Software Engineering', 3, 'MCA, MTECH, ME', '1-3 Years', 'full-time', 'Chennai', '2026-03-28 00:48:03'),
(5, 'HCL Technologies', 'Web developer ', 2, 'BCA, BTECH', 'Fresher', 'Internship', 'pune', '2026-03-28 00:50:26'),
(6, 'Amazon', 'Full Stack Web Developer', 3, 'MCA, MTECH, ME', '1-3 Years', 'full-time', 'Hyderabad', '2026-03-28 02:17:01'),
(7, 'Accenture', 'Data Analyst', 2, 'BTECH', 'Fresher', 'Internship', 'Bangalore', '2026-03-28 02:19:19'),
(8, 'Cognizant', 'Project Manager', 3, 'ME, MSC(IT)', '3-5 Years', 'full-time', 'Pune', '2026-03-28 02:21:11'),
(9, 'Infosys', 'Programmer', 2, 'BTECH, BE', '1-3 Years', 'Work-from-home', 'Delhi', '2026-03-28 02:25:03'),
(10, 'Microsoft', 'Data Scientist', 2, 'BTECH, MTECH, ME', '3-5 Years', 'full-time', 'Banglore', '2026-03-28 02:27:39'),
(11, 'Tech Mahindra', 'UI/UX Designer', 2, 'BCA, BTECH, BE', 'Fresher', 'Internship', 'Chennai', '2026-03-28 02:32:55'),
(12, 'Wipro', 'Frontend Developer', 3, 'BTECH, MTECH', '0-1 Years', 'Work-from-home', 'Bangalore', '2026-03-28 02:35:37'),
(13, 'Microsoft', 'Backend Developer', 2, 'MCA, MSC(IT)', '0-1 Years', 'Work-from-home', 'Hyderabad', '2026-04-03 14:34:24'),
(14, 'Microsoft', 'Software Developer', 3, 'BCA', 'Fresher', 'Internship', 'pune', '2026-04-03 14:35:18'),
(15, 'Amazon', 'Project Manager', 2, 'BTECH, MTECH', '1-3 Years', 'part-time', 'Chennai', '2026-04-03 14:38:34'),
(16, 'Amazon', 'UI/UX Designer', 1, 'BCA, MCA, MSC(IT)', 'Fresher', 'Internship', 'pune', '2026-04-03 14:39:30'),
(17, 'Wipro', 'Programmer', 3, 'BCA, MCA, MSC(IT)', 'Fresher', 'Internship', 'Delhi', '2026-04-03 14:41:53'),
(18, 'Wipro', 'Software Developer', 2, 'BE, ME', '1-3 Years', 'full-time', 'Pune', '2026-04-03 14:46:10'),
(19, 'Cognizant', 'Blockchain Developer', 2, 'BTECH, MTECH', '1-3 Years', 'Work-from-home', 'Chennai', '2026-04-03 14:49:40'),
(20, 'Cognizant', 'Web Developer', 2, 'BCA, MCA', 'Fresher', 'Internship', 'Hyderabad', '2026-04-03 14:51:13'),
(22, 'Accenture', 'Frontend Developer', 2, 'MCA, MSC(IT)', '1-3 Years', 'full-time', 'Pune', '2026-04-03 14:55:42'),
(23, 'Infosys', 'Full Stack Developer', 1, 'BCA, MCA', 'Fresher', 'Internship', 'Hyderabad', '2026-04-03 14:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `n_id` int(11) NOT NULL AUTO_INCREMENT,
  `news` varchar(100) NOT NULL,
  `n_date` date NOT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`n_id`, `news`, `n_date`) VALUES
(2, 'Only One Vacancy left for Software Engineering ', '2026-02-13'),
(3, 'Many Latest Jobs are Posted...Now Apply', '2026-03-28');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('job_seeker','employer','admin') NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `password` (`password`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin11', 'admin'),
(2, 'sakshi', 'sakshi1', 'job_seeker'),
(3, 'tcs', 'tcs111', 'employer'),
(4, 'abhi', 'abhi13', 'job_seeker'),
(5, 'krina', 'krina05', 'job_seeker'),
(6, 'maitri', 'maitri01', 'job_seeker'),
(7, 'pravi', 'pravi02', 'job_seeker'),
(8, 'diksha', 'diksha03', 'job_seeker'),
(11, 'amazon', 'amazon22', 'employer'),
(12, 'infosys', 'infosys3', 'employer'),
(13, 'wipro', 'wipro44', 'employer'),
(14, 'cognizant', 'c12345', 'employer'),
(15, 'hcl', 'hcltech', 'employer'),
(16, 'tech', 'tech13', 'employer'),
(17, 'microsoft', 'micro11', 'employer'),
(18, 'accenture', 'acc123', 'employer'),
(19, 'neha', 'neha003', 'job_seeker'),
(20, 'pranjal', 'pranju12', 'job_seeker'),
(21, 'misha', 'misha5', 'job_seeker');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applyers`
--
ALTER TABLE `applyers`
  ADD CONSTRAINT `applyers_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `manage_job` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `education_ibfk_1` FOREIGN KEY (`jname`) REFERENCES `job_seeker` (`jname`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employer`
--
ALTER TABLE `employer`
  ADD CONSTRAINT `employer_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `employer_ibfk_2` FOREIGN KEY (`password`) REFERENCES `user` (`password`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_seeker`
--
ALTER TABLE `job_seeker`
  ADD CONSTRAINT `job_seeker_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `job_seeker_ibfk_2` FOREIGN KEY (`password`) REFERENCES `user` (`password`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `j_exp`
--
ALTER TABLE `j_exp`
  ADD CONSTRAINT `j_exp_ibfk_1` FOREIGN KEY (`jname`) REFERENCES `job_seeker` (`jname`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manage_job`
--
ALTER TABLE `manage_job`
  ADD CONSTRAINT `manage_job_ibfk_1` FOREIGN KEY (`cname`) REFERENCES `employer` (`cname`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
