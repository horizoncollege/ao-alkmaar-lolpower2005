DROP DATABASE IF EXISTS `netland`;

CREATE DATABASE `netland`;

USE `netland`;

CREATE TABLE `media` (
	id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    rating DECIMAL(2,1) NULL,
    summary TEXT NOT NULL,
    has_won_awards INT NULL,
    seasons INT NULL,
    country VARCHAR(5) NOT NULL,
    spoken_in_language ENUM('NL', 'EN') NOT NULL,
    length_in_minutes INTEGER NULL,
    released_at DATE NULL,
    youtube_trailer_id VARCHAR(20) NULL,
    type_media ENUM('film', 'serie') NOT NULL
);
