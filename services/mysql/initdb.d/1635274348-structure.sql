SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `finance` (
    `id` int(11) NOT NULL,
    `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `value` decimal(10,2) NOT NULL,
    `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `finance_categories` (
    `id` int(11) NOT NULL,
    `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `finance`
    ADD PRIMARY KEY (`id`),
    ADD KEY `finance_ibfk_1` (`category_id`);

ALTER TABLE `finance_categories`
    ADD PRIMARY KEY (`id`);


ALTER TABLE `finance`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `finance_categories`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `finance`
    ADD CONSTRAINT `finance_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `finance_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
