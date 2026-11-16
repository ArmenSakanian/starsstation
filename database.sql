-- Stars Station Studio database schema
-- Create an empty database named `starsstation`, select it, then run this script.

SET NAMES utf8mb4;
SET time_zone = '+00:00';

CREATE TABLE IF NOT EXISTS contact_submissions (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(120) NOT NULL,
    last_name VARCHAR(120) NULL,
    phone_number VARCHAR(40) NULL,
    email VARCHAR(190) NOT NULL,
    message TEXT NOT NULL,
    language CHAR(2) NOT NULL DEFAULT 'fr',
    subscribed TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_contact_email (email),
    KEY idx_contact_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS contact_submission_files (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    submission_id BIGINT UNSIGNED NOT NULL,
    original_name VARCHAR(255) NOT NULL,
    stored_name VARCHAR(255) NOT NULL,
    mime_type VARCHAR(190) NOT NULL,
    file_size BIGINT UNSIGNED NOT NULL,
    public_path VARCHAR(500) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_stored_name (stored_name),
    KEY idx_submission_id (submission_id),
    CONSTRAINT fk_submission_files_submission
        FOREIGN KEY (submission_id) REFERENCES contact_submissions(id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS newsletter_subscribers (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    email VARCHAR(190) NOT NULL,
    language CHAR(2) NOT NULL DEFAULT 'fr',
    source VARCHAR(30) NOT NULL DEFAULT 'footer',
    status ENUM('active', 'unsubscribed') NOT NULL DEFAULT 'active',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_newsletter_email (email),
    KEY idx_newsletter_status (status),
    KEY idx_newsletter_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
