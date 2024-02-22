-- Drop the table if it exists
IF OBJECT_ID('dbo.user', 'U') IS NOT NULL
    DROP TABLE dbo.[user];

-- Create the table
CREATE TABLE dbo.[user] (
    id INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
    username VARCHAR(32) NULL,
    email VARCHAR(64) NULL,
    name VARCHAR(32) NOT NULL,
    password CHAR(40) NULL,
    salt CHAR(32) NULL,
    reset_token CHAR(96) NULL,
    role NVARCHAR(10) NOT NULL DEFAULT 'user', -- Adjust the length based on your needs
    rank TINYINT NOT NULL DEFAULT 0,
    task_color CHAR(6) NULL,
    theme VARCHAR(64) NULL,
    language VARCHAR(5) NULL,
    avatar_filename VARCHAR(64) NULL,
    options VARBINARY(MAX) NULL,
    api_key VARCHAR(40) NULL,
    api_visible TINYINT NOT NULL DEFAULT 1,
    created_date DATETIME NOT NULL,
    deleted_date DATETIME NULL
);

-- Add UNIQUE constraints
ALTER TABLE dbo.[user]
    ADD CONSTRAINT UQ_username UNIQUE (username);
ALTER TABLE dbo.[user]
    ADD CONSTRAINT UQ_email UNIQUE (email);

-- Drop the table if it exists
IF OBJECT_ID('dbo.user_group', 'U') IS NOT NULL
    DROP TABLE dbo.user_group;

-- Create the table
CREATE TABLE dbo.user_group (
    id INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
    user_id INT NOT NULL,
    group_id INT NOT NULL,
    manager TINYINT NOT NULL DEFAULT 0,
    CONSTRAINT FK_user_group_user_id FOREIGN KEY (user_id) REFERENCES [user] (id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT FK_user_group_group_id FOREIGN KEY (group_id) REFERENCES user_group (id) ON UPDATE NO ACTION ON DELETE NO ACTION
);
-- Add indexes
CREATE INDEX idx_group_id ON dbo.user_group (group_id);
CREATE INDEX idx_group_user_id ON dbo.user_group (user_id);

-----------------------------------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------------------------------
-- Drop the table if it exists
-- Drop the table if it exists
IF OBJECT_ID('dbo.issue', 'U') IS NOT NULL
    DROP TABLE dbo.issue;

-- Create the table
CREATE TABLE dbo.issue (
    id INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
    status INT NOT NULL DEFAULT 1,
    type_id INT NOT NULL DEFAULT 1,
    name NVARCHAR(255) NOT NULL,
    size_estimate NVARCHAR(20) NULL,
    description TEXT NOT NULL,
    parent_id INT NULL,
    author_id INT NOT NULL,
    owner_id INT NULL,
    priority INT NOT NULL DEFAULT 0,
    hours_total FLOAT NULL,
    hours_remaining FLOAT NULL,
    hours_spent FLOAT NULL,
    created_date DATETIME NOT NULL,
    closed_date DATETIME NULL,
    deleted_date DATETIME NULL,
    start_date DATE NULL,
    due_date DATE NULL,
    repeat_cycle VARCHAR(20) NULL,
    sprint_id INT NULL,
    due_date_sprint TINYINT NOT NULL DEFAULT 0,
    CONSTRAINT FK_issue_type_id FOREIGN KEY (type_id) REFERENCES issue_type (id) ON UPDATE CASCADE ON DELETE NO ACTION,
    CONSTRAINT FK_issue_author_id FOREIGN KEY (author_id) REFERENCES [user] (id) ON UPDATE CASCADE ON DELETE NO ACTION,
    CONSTRAINT FK_issue_owner_id FOREIGN KEY (owner_id) REFERENCES [user] (id) ON UPDATE NO ACTION ON DELETE NO ACTION,
    CONSTRAINT FK_issue_priority FOREIGN KEY (priority) REFERENCES issue_priority (value) ON UPDATE CASCADE ON DELETE NO ACTION,
    CONSTRAINT FK_issue_status FOREIGN KEY (status) REFERENCES issue_status (id) ON UPDATE CASCADE ON DELETE NO ACTION,
    CONSTRAINT FK_issue_parent_id FOREIGN KEY (parent_id) REFERENCES dbo.issue (id) ON UPDATE NO ACTION ON DELETE NO ACTION
);



-- Add indexes
CREATE INDEX idx_sprint_id ON dbo.issue (sprint_id);
CREATE INDEX idx_repeat_cycle ON dbo.issue (repeat_cycle);
CREATE INDEX idx_due_date ON dbo.issue (due_date);
CREATE INDEX idx_type_id ON dbo.issue (type_id);
CREATE INDEX idx_parent_id ON dbo.issue (parent_id);

-- Drop the table if it exists
IF OBJECT_ID('dbo.issue_backlog', 'U') IS NOT NULL
    DROP TABLE dbo.issue_backlog;

-- Create the table
CREATE TABLE dbo.issue_backlog (
    id INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
    sprint_id INT NULL,
    issues VARBINARY(MAX) NOT NULL,
    CONSTRAINT UK_issue_backlog_sprint_id UNIQUE (sprint_id),
    CONSTRAINT FK_issue_backlog_sprint_id FOREIGN KEY (sprint_id) REFERENCES sprint (id) ON DELETE CASCADE ON UPDATE CASCADE
);


-- Add index on sprint_id
CREATE INDEX idx_issue_backlog_sprint_id ON dbo.issue_backlog (sprint_id);

-- Drop the table if it exists
IF OBJECT_ID('dbo.issue_comment', 'U') IS NOT NULL
    DROP TABLE dbo.issue_comment;

-- Create the table
CREATE TABLE dbo.issue_comment (
    id INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
    issue_id INT NOT NULL,
    user_id INT NOT NULL,
    text NVARCHAR(MAX) NOT NULL,
    file_id INT NULL,
    created_date DATETIME NOT NULL,
    CONSTRAINT FK_comment_issue FOREIGN KEY (issue_id) REFERENCES dbo.issue (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FK_comment_user FOREIGN KEY (user_id) REFERENCES [user] (id) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- Add indexes
CREATE INDEX idx_comment_issue_id ON dbo.issue_comment (issue_id);
CREATE INDEX idx_comment_user_id ON dbo.issue_comment (user_id);

-- Drop the table if it exists
IF OBJECT_ID('dbo.issue_file', 'U') IS NOT NULL
    DROP TABLE dbo.issue_file;

-- Create the table
CREATE TABLE dbo.issue_file (
    id INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
    issue_id INT NOT NULL,
    filename NVARCHAR(255) NOT NULL DEFAULT '',
    disk_filename NVARCHAR(255) NOT NULL DEFAULT '',
    disk_directory NVARCHAR(255) NULL,
    filesize INT NOT NULL DEFAULT 0,
    content_type NVARCHAR(255) NULL,
    digest VARCHAR(40) NOT NULL,
    downloads INT NOT NULL DEFAULT 0,
    user_id INT NOT NULL DEFAULT 0,
    created_date DATETIME NOT NULL,
    deleted_date DATETIME NULL,
    CONSTRAINT FK_issue_file_issue_id FOREIGN KEY (issue_id) REFERENCES dbo.issue (id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Add indexes
CREATE INDEX idx_issue_file_issue_id ON dbo.issue_file (issue_id);
CREATE INDEX idx_issue_file_user_id ON dbo.issue_file (user_id);
CREATE INDEX idx_issue_file_created_date ON dbo.issue_file (created_date);

============================================================================================
-- Drop the table if it exists
IF OBJECT_ID('dbo.issue_priority', 'U') IS NOT NULL
    DROP TABLE dbo.issue_priority;

-- Create the table
CREATE TABLE dbo.issue_priority (
    id INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
    value INT NOT NULL,
    name NVARCHAR(64) NOT NULL,
    CONSTRAINT UQ_issue_priority_value UNIQUE (value)
);

-- Add indexes if needed
-- No separate index is needed for the primary key as it is automatically indexed

-- Insert data into the issue_priority table
INSERT INTO dbo.issue_priority (value, name)
VALUES
    (0, 'Normal'),
    (1, 'High'),
    (-1, 'Low');
******************************
-- Drop the table if it exists
IF OBJECT_ID('dbo.issue_status', 'U') IS NOT NULL
    DROP TABLE dbo.issue_status;

-- Create the table
CREATE TABLE dbo.issue_status (
    id INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
    name NVARCHAR(32) NOT NULL,
    closed BIT NOT NULL DEFAULT 0,
    taskboard BIT NOT NULL DEFAULT 1,
    taskboard_sort INT NULL
);

SET IDENTITY_INSERT dbo.issue_status ON;

-- Insert data into the issue_status table
INSERT INTO dbo.issue_status (id, name, closed, taskboard, taskboard_sort)
VALUES
    (1, 'New', 0, 2, 1),
    (2, 'Active', 0, 2, 2),
    (3, 'Completed', 1, 2, 3),
    (4, 'On Hold', 0, 1, 4);

	*****************************************************************
	-- Drop the table if it exists
IF OBJECT_ID('dbo.issue_type', 'U') IS NOT NULL
    DROP TABLE dbo.issue_type;

-- Create the table
CREATE TABLE dbo.issue_type (
    id INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
    name NVARCHAR(32) NOT NULL,
    role NVARCHAR(32) DEFAULT 'task' NOT NULL,
    default_description TEXT NULL,
    CONSTRAINT CK_issue_type_role CHECK (role IN ('task', 'project', 'bug'))
);

-- Disable identity insert for dbo.issue_status
SET IDENTITY_INSERT dbo.issue_status OFF;

-- Enable identity insert for dbo.issue_type
SET IDENTITY_INSERT dbo.issue_type ON;

-- Insert explicit values into dbo.issue_type
INSERT INTO dbo.issue_type (id, name, role) VALUES
    (1, 'Task', 'task'),
    (2, 'Project', 'project'),
    (3, 'Bug', 'bug');

-- Disable identity insert for dbo.issue_type
SET IDENTITY_INSERT dbo.issue_type OFF;


********************************************************
-- Drop the table if it exists
-- Drop the table if it exists
IF OBJECT_ID('dbo.issue_update', 'U') IS NOT NULL
    DROP TABLE dbo.issue_update;

-- Create the table
CREATE TABLE dbo.issue_update (
    id INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
    issue_id INT NOT NULL,
    user_id INT NOT NULL,
    created_date DATETIME NOT NULL,
    comment_id INT NULL,
    notify TINYINT NULL, -- Removed (1) from TINYINT
    CONSTRAINT FK_issue_update_issue FOREIGN KEY (issue_id) REFERENCES dbo.issue (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FK_issue_update_user FOREIGN KEY (user_id) REFERENCES dbo.[user] (id) ON DELETE NO ACTION ON UPDATE NO ACTION
);

*******************************************************
-- Drop the table if it exists
IF OBJECT_ID('dbo.issue_update_field', 'U') IS NOT NULL
    DROP TABLE dbo.issue_update_field;

-- Create the table
CREATE TABLE dbo.issue_update_field (
    id INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
    issue_update_id INT NOT NULL,
    field VARCHAR(64) NOT NULL,
    old_value TEXT NOT NULL,
    new_value TEXT NOT NULL,
    CONSTRAINT FK_issue_update_field_update FOREIGN KEY (issue_update_id) REFERENCES dbo.issue_update (id) ON DELETE CASCADE ON UPDATE CASCADE
);

********************************************
-- Drop the table if it exists
IF OBJECT_ID('dbo.issue_watcher', 'U') IS NOT NULL
    DROP TABLE dbo.issue_watcher;

-- Create the table
CREATE TABLE dbo.issue_watcher (
    id INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
    issue_id INT NOT NULL,
    user_id INT NOT NULL,
    CONSTRAINT unique_watch UNIQUE (issue_id, user_id),
    CONSTRAINT FK_issue_watcher_issue FOREIGN KEY (issue_id) REFERENCES dbo.issue(id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT FK_issue_watcher_user FOREIGN KEY (user_id) REFERENCES dbo.[user](id) ON UPDATE NO ACTION ON DELETE NO ACTION
);
**************************************************************
-- Drop the table if it exists
IF OBJECT_ID('dbo.issue_tag', 'U') IS NOT NULL
    DROP TABLE dbo.issue_tag;

-- Create the table
CREATE TABLE dbo.issue_tag (
    id INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
    tag VARCHAR(60) NOT NULL,
    issue_id INT NOT NULL,
    CONSTRAINT issue_tag_issue FOREIGN KEY (issue_id) REFERENCES dbo.issue(id) ON UPDATE CASCADE ON DELETE CASCADE
);
********************************************************
-- Drop the table if it exists
IF OBJECT_ID('dbo.issue_dependency', 'U') IS NOT NULL
    DROP TABLE dbo.issue_dependency;

-- Create the table
CREATE TABLE dbo.issue_dependency (
    id INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
    issue_id INT NOT NULL,
    dependency_id INT NOT NULL,
    dependency_type CHAR(2) NOT NULL,
    CONSTRAINT unique_dependency UNIQUE (issue_id, dependency_id),
    CONSTRAINT FK_issue_dependency_issue FOREIGN KEY (issue_id) REFERENCES dbo.issue(id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FK_issue_dependency_dependency FOREIGN KEY (dependency_id) REFERENCES dbo.issue(id) ON DELETE NO ACTION ON UPDATE NO ACTION
);


**********************************************************************
-- Drop the table if it exists
IF OBJECT_ID('dbo.sprint', 'U') IS NOT NULL
    DROP TABLE dbo.sprint;

-- Create the table
CREATE TABLE dbo.sprint (
    id INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
    name VARCHAR(60) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL
);


-- Drop the view if it exists
IF OBJECT_ID('dbo.user_group_user', 'V') IS NOT NULL
    DROP VIEW dbo.user_group_user;

-- Create the view
GO
CREATE VIEW dbo.user_group_user AS
SELECT
    g.id AS id,
    g.group_id AS group_id,
    g.user_id AS user_id,
    u.username AS user_username,
    u.email AS user_email,
    u.name AS user_name,
    u.role AS user_role,
    u.task_color AS user_task_color,
    u.deleted_date AS deleted_date,
    g.manager AS manager
FROM
    user_group g
    JOIN [user] u ON g.user_id = u.id;



-- Drop the view if it exists
IF OBJECT_ID('dbo.issue_comment_user', 'V') IS NOT NULL
    DROP VIEW dbo.issue_comment_user;

-- Create the view
CREATE VIEW dbo.issue_comment_user AS
SELECT
    c.id AS id,
    c.issue_id AS issue_id,
    c.user_id AS user_id,
    c.text AS text,
    c.file_id AS file_id,
    c.created_date AS created_date,
    u.username AS user_username,
    u.email AS user_email,
    u.name AS user_name,
    u.role AS user_role,
    u.task_color AS user_task_color
FROM
    issue_comment c
    JOIN [user] u ON c.user_id = u.id;



-- Drop the view if it exists
IF OBJECT_ID('dbo.issue_comment_detail', 'V') IS NOT NULL
    DROP VIEW dbo.issue_comment_detail;

-- Create the view
CREATE VIEW dbo.issue_comment_detail AS
SELECT
    c.id AS id,
    c.issue_id AS issue_id,
    c.user_id AS user_id,
    c.text AS text,
    c.file_id AS file_id,
    c.created_date AS created_date,
    u.username AS user_username,
    u.email AS user_email,
    u.name AS user_name,
    u.role AS user_role,
    u.task_color AS user_task_color,
    f.filename AS file_filename,
    f.filesize AS file_filesize,
    f.content_type AS file_content_type,
    f.downloads AS file_downloads,
    f.created_date AS file_created_date,
    f.deleted_date AS file_deleted_date,
    i.deleted_date AS issue_deleted_date
FROM
    issue_comment c
    JOIN [user] u ON c.user_id = u.id
    LEFT JOIN issue_file f ON c.file_id = f.id
    JOIN issue i ON i.id = c.issue_id;

-- Drop the view if it exists
IF OBJECT_ID('dbo.issue_detail', 'V') IS NOT NULL
    DROP VIEW dbo.issue_detail;

-- Create the view
CREATE VIEW dbo.issue_detail AS
SELECT
    issue.id AS id,
    issue.status AS status,
    issue.type_id AS type_id,
    issue.name AS name,
    issue.size_estimate AS size_estimate,
    issue.description AS description,
    issue.parent_id AS parent_id,
    issue.author_id AS author_id,
    issue.owner_id AS owner_id,
    issue.priority AS priority,
    issue.hours_total AS hours_total,
    issue.hours_remaining AS hours_remaining,
    issue.hours_spent AS hours_spent,
    issue.created_date AS created_date,
    issue.closed_date AS closed_date,
    issue.deleted_date AS deleted_date,
    issue.start_date AS start_date,
    issue.due_date AS due_date,
    CASE WHEN issue.due_date IS NOT NULL THEN 1 ELSE 0 END AS has_due_date,
    issue.repeat_cycle AS repeat_cycle,
    issue.sprint_id AS sprint_id,
    issue.due_date_sprint AS due_date_sprint,
    sprint.name AS sprint_name,
    sprint.start_date AS sprint_start_date,
    sprint.end_date AS sprint_end_date,
    type.name AS type_name,
    status.name AS status_name,
    status.closed AS status_closed,
    priority.id AS priority_id,
    priority.name AS priority_name,
    author.username AS author_username,
    author.name AS author_name,
    author.email AS author_email,
    author.task_color AS author_task_color,
    owner.username AS owner_username,
    owner.name AS owner_name,
    owner.email AS owner_email,
    owner.task_color AS owner_task_color,
    parent.name AS parent_name
FROM
    issue
    LEFT JOIN [user] author ON issue.author_id = author.id
    LEFT JOIN [user] owner ON issue.owner_id = owner.id
    LEFT JOIN issue_status status ON issue.status = status.id
    LEFT JOIN issue_priority priority ON issue.priority = priority.value
    LEFT JOIN issue_type type ON issue.type_id = type.id
    LEFT JOIN sprint ON issue.sprint_id = sprint.id
    LEFT JOIN issue parent ON issue.parent_id = parent.id;


-- Drop the view if it exists
IF OBJECT_ID('dbo.issue_file_detail', 'V') IS NOT NULL
    DROP VIEW dbo.issue_file_detail;

-- Create the issue_file_detail view
CREATE VIEW dbo.issue_file_detail AS
SELECT
    f.id AS id,
    f.issue_id AS issue_id,
    f.filename AS filename,
    f.disk_filename AS disk_filename,
    f.disk_directory AS disk_directory,
    f.filesize AS filesize,
    f.content_type AS content_type,
    f.digest AS digest,
    f.downloads AS downloads,
    f.user_id AS user_id,
    f.created_date AS created_date,
    f.deleted_date AS deleted_date,
    u.username AS user_username,
    u.email AS user_email,
    u.name AS user_name,
    u.task_color AS user_task_color
FROM
    issue_file f
    JOIN [user] u ON f.user_id = u.id;

-- Drop the view if it exists
IF OBJECT_ID('dbo.issue_update_detail', 'V') IS NOT NULL
    DROP VIEW dbo.issue_update_detail;

-- Create the issue_update_detail view
CREATE VIEW dbo.issue_update_detail AS
SELECT
    i.id AS id,
    i.issue_id AS issue_id,
    i.user_id AS user_id,
    i.created_date AS created_date,
    i.notify AS notify,
    u.username AS user_username,
    u.name AS user_name,
    u.email AS user_email,
    i.comment_id AS comment_id,
    c.text AS comment_text
FROM
    issue_update i
    JOIN [user] u ON i.user_id = u.id
    LEFT JOIN issue_comment c ON i.comment_id = c.id;

-- Drop the view if it exists
IF OBJECT_ID('dbo.issue_watcher_user', 'V') IS NOT NULL
    DROP VIEW dbo.issue_watcher_user;

-- Create the issue_watcher_user view
CREATE VIEW dbo.issue_watcher_user AS
SELECT
    w.id AS watcher_id,
    w.issue_id AS issue_id,
    u.id AS id,
    u.username AS username,
    u.email AS email,
    u.name AS name,
    u.password AS password,
    u.role AS role,
    u.task_color AS task_color,
    u.created_date AS created_date,
    u.deleted_date AS deleted_date
FROM
    issue_watcher w
    JOIN [user] u ON w.user_id = u.id;

-- Drop the table if it exists
IF OBJECT_ID('dbo.session', 'U') IS NOT NULL
    DROP TABLE dbo.session;

-- Create the session table
CREATE TABLE dbo.session (
    id INT IDENTITY(1,1) NOT NULL,
    token VARBINARY(64) NOT NULL,
    ip VARBINARY(39) NOT NULL,
    user_id INT NOT NULL,
    created DATETIME NOT NULL,
    PRIMARY KEY (id),
    UNIQUE (token, ip),
    FOREIGN KEY (user_id) REFERENCES [user](id) ON UPDATE CASCADE ON DELETE CASCADE
);
-- Drop the table if it exists
IF OBJECT_ID('dbo.config', 'U') IS NOT NULL
    DROP TABLE dbo.config;
-- Create the config table
CREATE TABLE dbo.config (
    id INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
    attribute VARCHAR(255) NULL,
    value VARCHAR(255) NULL,
    UNIQUE (attribute)
);

-- Insert data into the config table
INSERT INTO dbo.config (attribute, value) VALUES ('security.reset_ttl', '86400');
INSERT INTO dbo.config (attribute, value) VALUES ('security.file_blacklist', '/\.(ph(p([3457s]|\-s)?|t|tml)|aspx?|shtml|exe|dll)$/i');
INSERT INTO dbo.config (attribute, value) VALUES ('version', '21.03.18');


/*
-- Drop the views if they exist
IF OBJECT_ID('dbo.user_group_user', 'V') IS NOT NULL
    DROP VIEW dbo.user_group_user;
IF OBJECT_ID('dbo.issue_comment_user', 'V') IS NOT NULL
    DROP VIEW dbo.issue_comment_user;
IF OBJECT_ID('dbo.issue_comment_detail', 'V') IS NOT NULL
    DROP VIEW dbo.issue_comment_detail;
IF OBJECT_ID('dbo.issue_detail', 'V') IS NOT NULL
    DROP VIEW dbo.issue_detail;
IF OBJECT_ID('dbo.issue_file_detail', 'V') IS NOT NULL
    DROP VIEW dbo.issue_file_detail;
IF OBJECT_ID('dbo.issue_update_detail', 'V') IS NOT NULL
    DROP VIEW dbo.issue_update_detail;
IF OBJECT_ID('dbo.issue_watcher_user', 'V') IS NOT NULL
    DROP VIEW dbo.issue_watcher_user;

-- Drop the table if it exists
IF OBJECT_ID('dbo.[user]', 'U') IS NOT NULL
    DROP TABLE dbo.[user];

IF OBJECT_ID('dbo.user_group', 'U') IS NOT NULL
    DROP TABLE dbo.user_group;
IF OBJECT_ID('dbo.issue', 'U') IS NOT NULL
    DROP TABLE dbo.issue;
IF OBJECT_ID('dbo.issue_backlog', 'U') IS NOT NULL
    DROP TABLE dbo.issue_backlog;
IF OBJECT_ID('dbo.issue_comment', 'U') IS NOT NULL
    DROP TABLE dbo.issue_comment;
IF OBJECT_ID('dbo.issue_file', 'U') IS NOT NULL
    DROP TABLE dbo.issue_file;
IF OBJECT_ID('dbo.issue_priority', 'U') IS NOT NULL
    DROP TABLE dbo.issue_priority;
IF OBJECT_ID('dbo.issue_status', 'U') IS NOT NULL
    DROP TABLE dbo.issue_status;
IF OBJECT_ID('dbo.issue_type', 'U') IS NOT NULL
    DROP TABLE dbo.issue_type;
IF OBJECT_ID('dbo.issue_update', 'U') IS NOT NULL
    DROP TABLE dbo.issue_update;
IF OBJECT_ID('dbo.issue_update_field', 'U') IS NOT NULL
    DROP TABLE dbo.issue_update_field;
IF OBJECT_ID('dbo.issue_watcher', 'U') IS NOT NULL
    DROP TABLE dbo.issue_watcher;
IF OBJECT_ID('dbo.issue_tag', 'U') IS NOT NULL
    DROP TABLE dbo.issue_tag;
IF OBJECT_ID('dbo.issue_dependency', 'U') IS NOT NULL
    DROP TABLE dbo.issue_dependency;
IF OBJECT_ID('dbo.sprint', 'U') IS NOT NULL
    DROP TABLE dbo.sprint;
IF OBJECT_ID('dbo.session', 'U') IS NOT NULL
    DROP TABLE dbo.session;
IF OBJECT_ID('dbo.config', 'U') IS NOT NULL
    DROP TABLE dbo.config;
*/