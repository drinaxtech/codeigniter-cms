-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 26, 2020 at 11:40 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`) VALUES
(1, 'technology', 'technology'),
(2, 'sports', 'sports'),
(3, 'gossip', 'gossip'),
(10, 'football', 'football'),
(11, 'tenis', 'tenis'),
(13, 'culture', 'culture'),
(50, 'dori', 'dori');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `body` varchar(1000) NOT NULL,
  `hide` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `body`, `hide`, `created_at`, `post_id`, `user_id`) VALUES
(206, 'Lampard yes', 0, '2020-07-24 21:47:17', 46, 10),
(207, 'Kloppi', 0, '2020-07-24 21:56:36', 46, 10),
(209, 'klopp', 0, '2020-07-24 22:07:21', 46, 10),
(212, 'assss', 0, '2020-07-24 22:08:56', 39, 10),
(214, 'asdee', 0, '2020-07-24 22:09:08', 39, 10),
(215, 'xdmdfmff', 0, '2020-07-24 22:09:15', 39, 10),
(216, 'aaaaaaa', 0, '2020-07-24 22:09:27', 39, 10),
(217, 'yes', 0, '2020-07-25 23:27:44', 46, 10),
(218, 'yes', 0, '2020-07-25 23:27:45', 46, 10);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone_number` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `text`, `address`, `phone_number`, `email`) VALUES
(1, 'about us', 'about-us', '<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>\n\n<p>&ldquo;Always use active voice over the passive one.&rdquo;</p>\n\n<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt quaerat voluptatem.</p>\n\n<ol>\n	<li><s><em><strong>Nemo enim ipsam voluptatem</strong></em></s></li>\n	<li><strong>Duis aute irure dolor</strong></li>\n	<li><strong>Ut enim ad minim veniam</strong></li>\n	<li><strong>Excepteur sint occaecat</strong></li>\n</ol>\n', NULL, NULL, NULL),
(2, 'contact us', 'contact-us', '', 'rr.kavajes; tirane; albania', '355 68 201 4322', 'contact@ci-blog.com');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `post_image` varchar(255) NOT NULL,
  `notification_view` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trash` int(11) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `body`, `post_image`, `notification_view`, `created_at`, `trash`, `views`, `category_id`, `user_id`) VALUES
(38, 'Tech Tent: Talking to Mr Raspberry Pi', 'Tech-Tent-Talking-to-Mr-Raspberry-Pi', '<p><em><strong>It was a scheme with limited ambitions - getting more young people with coding skills to apply for a university course.</strong></em></p>\r\n\r\n<p><em>But seven years after its launch, Raspberry Pi has become one of the most successful computers in history. On this week&#39;s Tech Tent, we talk to the project&#39;s founder about where it came from and what is next.</em></p>\r\n\r\n<h2><strong>Small start</strong></h2>\r\n\r\n<p>This week, Pi creator Eben Upton was honoured with the Lovie Award for lifetime achievement, recognition of the extraordinary impact that the Raspberry Pi has had.</p>\r\n\r\n<p>It was conceived as a charitable venture at a time when Eben Upton was interviewing applicants for the computer science course at Cambridge University and was disappointed at the number and calibre of the young people he was seeing.</p>\r\n\r\n<p>When I met him this week at Raspberry Pi&#39;s commercial headquarters in Cambridge - which is churning out substantial amounts of revenue for the charitable arm - he told me that as far as the original aim was concerned, it was job done.</p>\r\n\r\n<p>From a low of 200 applicants to study computing, they were now up to 1,100.</p>\r\n\r\n<p>&quot;We have twice as many people applying to study computer science at Cambridge as we had at the height of the dotcom boom. And I understand from people that are still involved in the admissions process, that when you ask them how did you get into computers, they do say &#39;Raspberry Pi.&#39;&quot;</p>\r\n\r\n<p>But what was unexpected - and drove the project off course for a while - was the huge enthusiasm not from children but from 40-something hobbyists who saw in the Raspberry Pi the rebirth of computers like the BBC Micro which they had cut their teeth on in the 1980s.</p>\r\n', '876424200.jpg', 1, '2019-11-16 12:04:27', 0, 3, 1, 2),
(39, 'Will fibre broadband be obsolete by 2030 - and what about 5G?', 'Will-fibre-broadband-be-obsolete-by-2030-and-what', '<p><strong>Labour has promised to give every home and business in the UK free full-fibre broadband by 2030 if it wins the general election.</strong></p>\r\n\r\n<p>The plan would see millions more properties given access to a full-fibre connection, though Prime Minister Boris Johnson said it was &quot;a crackpot scheme&quot;.</p>\r\n\r\n<p>If the plan went ahead and was completed on time, would it still be useful in 2030?</p>\r\n\r\n<h2>What is full-fibre broadband?</h2>\r\n\r\n<p>There are three main types of broadband connection that link the local telephone exchange to your home or office:</p>\r\n\r\n<ul>\r\n	<li>ADSL (asymmetric digital subscriber line) uses copper cables to a street-level cabinet or junction box and on to the house</li>\r\n	<li>FTTC (fibre to the cabinet) uses a faster fibre optic cable to the cabinet, but then copper cable from there to the house</li>\r\n	<li>FTTP (fibre to the premises) uses a fibre optic cable to connect to households without using any copper cable</li>\r\n</ul>\r\n\r\n<h2><strong>How fast is full-fibre?</strong></h2>\r\n\r\n<p>Currently, the UK government defines <strong>superfast</strong> broadband as having speeds greater than 30 megabits per second (Mbps). Megabits per second is the standard measurement of internet speed.</p>\r\n\r\n<p><strong>Ultrafast </strong>is defined as a speed greater than 100Mbps.</p>\r\n\r\n<p>&nbsp;</p>\r\n', '795343015.jpg', 1, '2019-11-16 12:13:45', 0, 5, 2, 2),
(40, 'Uber\'s paradox: Gig work app traps and frees its drivers', 'Ubers-paradox-Gig-work-app-traps-and-frees-its-drivers', '<p>On 24 November, after a nervous wait, Uber will learn whether its licence to operate in London is to be renewed.</p>\r\n\r\n<p>The impending decision has revived debate over whether the data-driven basis for its business model and the &quot;gig economy&quot; jobs it creates are fair.</p>\r\n\r\n<p>A wave of platforms has followed, offering new ways to buy and sell, to rent from and temporarily hire others.</p>\r\n\r\n<p>Rather than salaried employees, independent contractors are paid by consumers for a specific job - a &quot;gig&quot;.</p>\r\n\r\n<p>The platforms in the middle argue they do not employ staff but simply connect customers with people seeking to make money.</p>\r\n\r\n<p>Research by the Trades Union Congress (TUC) estimates that one in 10 workers in the UK now regularly does &quot;platform work&quot;.</p>\r\n\r\n<p>No company is more symbolic of this shift than Uber itself.</p>\r\n\r\n<p>As a consequence, it has become a lightning rod for arguments about what gig work really represents.</p>\r\n\r\n<p>Does it usher in new, flexible, liberating ways to work, or is it the means for a kind of arms-length control that undermines basic rights?</p>\r\n\r\n<p>Abdura Hadi, an Uber driver who has worked on the streets of London for five years, has noticed a change.</p>\r\n', '1140944663.jpg', 1, '2019-11-16 12:16:37', 0, 3, 2, 2),
(41, 'Amazon begins appeal over Pentagon cloud contract', 'Amazon-begins-appeal-over-Pentagon-cloud-contract', '<p><strong>Amazon has filed an intention to appeal the US Department of Defense&#39;s decision to give a major contract to Microsoft.</strong></p>\r\n\r\n<p>Amazon had been considered the favourite to win the deal, worth $10bn over the next 10 years.</p>\r\n\r\n<p>The company, which already provides cloud computing to the US Central Intelligence Agency, said the decision was made due to political pressure.</p>\r\n\r\n<p>In July, President Donald Trump threatened to intervene after what he described as &quot;tremendous complaints&quot;.</p>\r\n\r\n<p>Mr Trump had previously attacked Amazon chief executive Jeff Bezos, owner of the Washington Post, which has been critical of his presidency.</p>\r\n\r\n<p>The Pentagon subsequently delayed its decision to award the contract until 25 October, when it was announced the work would be given to Microsoft.</p>\r\n\r\n<ul>\r\n	<li><a href=\"https://www.bbc.com/news/technology-50191242\">Pentagon snubs Amazon for $10bn &#39;Jedi&#39; contract</a></li>\r\n</ul>\r\n\r\n<p>Defence Secretary Mark Esper said the competition was fair.</p>\r\n\r\n<p>&quot;I am confident it was conducted freely and fairly without any type of outside influence,&quot; he told reporters in the South Korean capital Seoul.</p>\r\n\r\n<p>The Joint Enterprise Defense Infrastructure project - known as JEDI - is designed to modernise the antiquated data and communication systems within the US military. The contract is considered to be particularly lucrative if other government departments follow the Defense Department&#39;s lead when upgrading their own systems.</p>\r\n\r\n<p>An Amazon spokesperson told the BBC: &quot;Amazon Web Services is uniquely experienced and qualified to provide the critical technology the US military needs, and remains committed to supporting the DoD&#39;s modernisation efforts.</p>\r\n\r\n<p>&quot;We also believe it&#39;s critical for our country that the government and its elected leaders administer procurements objectively and in a manner that is free from political influence.</p>\r\n\r\n<p>&quot;Numerous aspects of the JEDI evaluation process contained clear deficiencies, errors and unmistakable bias - and it&#39;s important that these matters be examined and rectified.&quot;</p>\r\n\r\n<p>The BBC understands Amazon submitted its intention to protest against the decision to the Court of Federal Claims last Friday. The formal appeal itself will be filed at a later stage.</p>\r\n\r\n<p>Microsoft did not respond to requests for comment.</p>\r\n\r\n<p>Four companies had initially been in the running for the deal when the process was launched two years ago. IBM was eliminated, as was Oracle - which lodged an unsuccessful legal challenge alleging conflict of interest stemming from Amazon&#39;s hiring of two former Defense Department employees. Both were said to have been involved in the JEDI selection process.</p>\r\n', '293123751.jpg', 1, '2019-11-16 12:20:13', 0, 4, 2, 2),
(46, '\'We are not arrogant\' - Klopp hits back at Lampard and says Chelsea manager \'has to learn\'', 'We-are-not-arrogant-Klopp-hits-back-at-Lampard', '<p>Asked if there had been a particular moment during his career where he had learned not to keep an argument with a fellow manager going after the final whistle, Klopp said:&nbsp;&nbsp;&ldquo;I don&#39;t remember but probably, yes!&nbsp;</p>\r\n\r\n<p>&ldquo;I really don&#39;t know. I respect all the other coaches. When you have a little look at yourself and know how outraged you can be in different situations - because we all have our own subjective view on a situation: foul, no foul, handball, and you feel that it&#39;s not fair and you feel you cannot wait until after the game. That happens.&nbsp;</p>\r\n\r\n<p>&ldquo;Probably I had it but I don&#39;t remember. During the game for sure, after the game I don&#39;t remember.&rdquo;</p>\r\n\r\n<p>Lampard, for his part, explained his side of the story in his own press conference ahead of Chelsea&rsquo;s game with Wolves.</p>\r\n\r\n<p>The Blues boss said: &ldquo;I think in terms of the language I used, I do regret that, because I think these things get replayed a lot on social media. I&#39;ve got two young daughters who are on social media, so I do regret that.</p>\r\n\r\n<p>&ldquo;In terms of regretting having passion to defend my team, no, I could have maybe handled it slightly differently, to keep that language in.</p>\r\n\r\n<p>&ldquo;But what I felt was, and I want to be clear about this actually, that some of the reports were that I was upset with the celebrating of the Liverpool team.</p>\r\n', '535447423.jpg', 1, '2020-07-24 21:10:16', 0, 4, 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'user'),
(2, 'creator'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `social_networks`
--

CREATE TABLE `social_networks` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `fa_icon` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `link` varchar(355) COLLATE utf8mb4_general_ci NOT NULL
) ;

--
-- Dumping data for table `social_networks`
--

INSERT INTO `social_networks` (`id`, `name`, `fa_icon`, `link`) VALUES
(1, 'facebook', 'fab fa-facebook-f', 'https://facebook.com'),
(2, 'twitter', 'fab fa-twitter', 'https://twitter.com/'),
(3, 'instagram', 'fab fa-instagram', 'https://instagram.com'),
(4, 'linkedin', 'fab fa-linkedin-in', 'https://linkedin.com'),
(5, 'dribbble', 'fab fa-dribbble', 'https://dribbble.com'),
(6, 'google plus', 'fab fa-google-plus-g', 'https://plus.google.com');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `unsubscribe` tinyint(4) NOT NULL DEFAULT '0'
) ;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `unsubscribe`) VALUES
(7, 'asdsdd@a.c', 1),
(8, 'aaassdsd@gmail.comoooooooo', 0),
(13, 'aaaa', 0),
(16, 'aaassd@gmail.com', 0),
(23, 'aaaaaa', 0),
(24, 'aaaa@cc.cc', 0),
(25, 'Dorian.rina@gmail.com', 0),
(26, 'Dorian.rina@gmail.co', 0),
(55, 'aaaa@cc.com', 0),
(56, 'aaaaaaaaaaaaaa@cc.c', 0),
(57, 'aaaaaaa@cc.co', 0),
(58, 'aaassd@gmail.al', 0),
(59, 'aaaaaaaaaaaaaa@cc.ccc', 0),
(60, 'dori.rina@dr.com', 0),
(64, 'dori@dr.com', 0),
(73, 'aaa@dor.co', 0),
(74, 'dori@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role_id` int(11) DEFAULT NULL,
  `special_permissions` tinyint(1) NOT NULL DEFAULT '0'
) ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `username`, `password`, `register_date`, `role_id`, `special_permissions`) VALUES
(1, 'dor', 'rina', 'admin@me.com', 'admin', '$2a$08$aO.agjqQ449q53hEUexG1O34/wSiKpXyBfssIOH2d83N9zOmzHEB.', '2019-10-24 12:53:41', 3, 1),
(2, 'dorian', 'rinaa', 'dorian@gmail.com', 'dori.rina', '$2a$08$o..BKPdH6pUGTaMsCXNK1.qFYuzcneUf1nExcbyUwTf.Y.LsdAh.S', '2019-10-20 15:14:23', 3, 0),
(5, 'dori', 'rina', 'dorian.rina@atis.al', 'doririna', '14c8490365fef265e25fc663e46cd4bf1fe39404', '2019-10-21 12:59:39', 1, 0),
(6, 'Blog', 'blog', 'jdq81968@idxue.com', 'blog', 'd5c2c73a2241d107f9b4597ec26ee1de058d11b9', '2019-10-21 13:01:28', 1, 0),
(7, 'dor', 'fffffff', 'cnbbbbbbbbbbbb@gdhhd.com', 'dejjjjjjjjjjj', '$2y$13$rmSSMI75TIcfeMDh6KawsOr4qoAg2py1Udro3nl7ZNt5PHGNloCL2', '2019-10-23 13:34:31', 1, 0),
(8, 'ffffffff', 'ssssssssssss', 'dddddddd@sjsj.com', 'dori5', '$2y$13$4aKOp5DGe2GQq0r/VY8YIeMBDYa7ypCJtCWU9yHoRyTRAEU24AlNC', '2019-10-23 13:38:28', 1, 0),
(9, 'dori', 'ria', 'dorooo@gmail.com', 'aserrrr', '$2a$08$kSPpH3fA5yj4Iebe7coMneDIDdn9vC0o9/Gi84KLJteLLJBcKbzu.', '2019-10-20 15:06:31', 3, 0),
(10, 'mssmmmmmmm', 'mmmmmmmmmmmm', 'mmmmmmmmmmmmmmmmmmmmm', 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmm', 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm', '2020-07-26 09:16:19', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_networks`
--
ALTER TABLE `social_networks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `social_networks`
--
ALTER TABLE `social_networks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
