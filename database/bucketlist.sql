
-- ==========================================
-- BUCKETLIST DATABASE
-- ==========================================

CREATE DATABASE IF NOT EXISTS bucketlist
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE bucketlist;

-- ==========================================
-- BUCKET ITEMS TABLE
-- ==========================================

CREATE TABLE IF NOT EXISTS bucket_items (

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(100) NOT NULL,

    description TEXT NOT NULL,

    priority TINYINT UNSIGNED NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT chk_bucket_priority
        CHECK (priority BETWEEN 1 AND 5)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;

-- ==========================================
-- OPTIONAL TEST DATA
-- ==========================================

INSERT INTO bucket_items (name, description, priority)
VALUES
(
    'Visit Japan',
    'Experience Japanese culture, explore Tokyo and visit Kyoto.',
    1
),
(
    'See the Northern Lights',
    'Travel to northern Sweden and experience the northern lights.',
    2
),
(
    'Learn to surf',
    'Take surfing lessons and learn to ride the waves.',
    3
),
(
    'Travel to New York',
    'Explore Manhattan, visit Times Square and experience the city.',
    4
),
(
    'Go on a road trip',
    'Travel through Europe and discover new places and cultures.',
    5
);
