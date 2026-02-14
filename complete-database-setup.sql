-- 1. Basic Details Table
CREATE TABLE IF NOT EXISTS basic_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    course VARCHAR(100) DEFAULT NULL,
    gender VARCHAR(20) DEFAULT NULL,
    birth_date DATE DEFAULT NULL,
    languages VARCHAR(255) DEFAULT NULL,
    profile_photo VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 2. Contact Information Table
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    phone VARCHAR(20) DEFAULT NULL,
    email VARCHAR(100) DEFAULT NULL,
    address TEXT DEFAULT NULL,
    social_links TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 3. About Section Table
CREATE TABLE IF NOT EXISTS about (
    id INT AUTO_INCREMENT PRIMARY KEY,
    about_text TEXT NOT NULL,
    cv_file VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 4. Education Table
CREATE TABLE IF NOT EXISTS education (
    id INT AUTO_INCREMENT PRIMARY KEY,
    degree VARCHAR(255) NOT NULL,
    stream VARCHAR(255),
    college VARCHAR(255),
    start_date DATE,
    end_date DATE,
    cgpa VARCHAR(10),
    graduation_type VARCHAR(50),
    description TEXT,
    marksheet VARCHAR(255),
    certificate VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 5. Experience Table (Professional & Internships)
CREATE TABLE IF NOT EXISTS experience (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type ENUM('professional', 'internship') NOT NULL,
    designation VARCHAR(255) NOT NULL,
    organization VARCHAR(255) NOT NULL,
    city VARCHAR(255),
    state VARCHAR(255),
    start_date DATE,
    end_date DATE,
    ctc VARCHAR(100),
    industry VARCHAR(255),
    skills TEXT,
    description TEXT,
    certificate VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 6. Projects Table
CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    description TEXT,
    skills TEXT,
    start_date DATE,
    end_date DATE,
    github_link VARCHAR(255),
    live_link VARCHAR(255),
    mentor VARCHAR(255),
    team_size INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 7. Certifications Table
CREATE TABLE IF NOT EXISTS certifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    provider VARCHAR(255),
    enrollment_no VARCHAR(100),
    marks VARCHAR(50),
    skills TEXT,
    certificate VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 8. Skills Table
CREATE TABLE IF NOT EXISTS skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL DEFAULT 'frontend',
    image VARCHAR(255) DEFAULT NULL,
    proficiency INT DEFAULT 80,
    description TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 9. Others Table
CREATE TABLE IF NOT EXISTS others (
    id INT AUTO_INCREMENT PRIMARY KEY,
    summary TEXT,
    key_expertise TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert Sample Data

-- Basic Details Sample
INSERT INTO
    basic_details (
        name,
        course,
        gender,
        birth_date,
        languages
    )
VALUES (
        'Your Name',
        'Computer Science',
        'Male',
        '1995-01-01',
        'English, Marathi, Hindi'
    )
ON DUPLICATE KEY UPDATE
    name = VALUES(name);

-- Contact Information Sample
INSERT INTO
    contacts (
        email,
        phone,
        address,
        social_links
    )
VALUES (
        'your.email@example.com',
        '+91 9876543210',
        'Your Address, City, State',
        'LinkedIn: yourprofile, GitHub: yourusername'
    )
ON DUPLICATE KEY UPDATE
    email = VALUES(email);

-- About Section Sample
INSERT INTO
    about (about_text)
VALUES (
        'Passionate developer with expertise in modern web technologies, dedicated to creating impactful and efficient solutions. I specialize in full-stack development with a focus on creating user-friendly applications that solve real-world problems.'
    )
ON DUPLICATE KEY UPDATE
    about_text = VALUES(about_text);

-- Education Sample
INSERT INTO
    education (
        degree,
        stream,
        college,
        start_date,
        end_date,
        cgpa,
        graduation_type
    )
VALUES (
        'Bachelor of Technology',
        'Computer Science',
        'Your College Name',
        '2020-07-01',
        '2024-06-30',
        '8.50',
        'Regular'
    )
ON DUPLICATE KEY UPDATE
    degree = VALUES(degree);

-- Skills Sample Data
INSERT INTO
    skills (
        name,
        category,
        image,
        proficiency,
        description
    )
VALUES (
        'HTML',
        'frontend',
        'assets/img/skills/HTML.png',
        95,
        'HyperText Markup Language'
    ),
    (
        'CSS',
        'frontend',
        'assets/img/skills/CSS.svg',
        90,
        'Cascading Style Sheets'
    ),
    (
        'JavaScript',
        'frontend',
        'assets/img/skills/js.webp',
        85,
        'JavaScript Programming Language'
    ),
    (
        'Bootstrap',
        'frontend',
        'assets/img/skills/bootstrap.png',
        80,
        'CSS Framework'
    ),
    (
        'React',
        'frontend',
        'assets/img/skills/react.png',
        75,
        'JavaScript Library'
    ),
    (
        'Node.js',
        'backend',
        'assets/img/skills/node.png',
        80,
        'JavaScript Runtime'
    ),
    (
        'PHP',
        'backend',
        'assets/img/skills/php.png',
        85,
        'Server-side Scripting Language'
    ),
    (
        'Python',
        'backend',
        'assets/img/skills/python.jpg',
        75,
        'Programming Language'
    ),
    (
        'MySQL',
        'databases',
        'assets/img/skills/sql.jpg',
        85,
        'Relational Database'
    ),
    (
        'MongoDB',
        'databases',
        'assets/img/skills/mongodb.webp',
        70,
        'NoSQL Database'
    ),
    (
        'Java',
        'languages',
        'assets/img/skills/java.jpeg',
        80,
        'Programming Language'
    ),
    (
        'C',
        'languages',
        'assets/img/skills/c.png',
        75,
        'Programming Language'
    ),
    (
        'Git',
        'tools',
        'assets/img/skills/git.png',
        85,
        'Version Control System'
    ),
    (
        'GitHub',
        'tools',
        'assets/img/skills/github.png',
        85,
        'Code Repository Platform'
    ),
    (
        'VS Code',
        'tools',
        'assets/img/skills/vscode.jpeg',
        90,
        'Code Editor'
    ),
    (
        'Eclipse',
        'tools',
        'assets/img/skills/eclipse.jpg',
        75,
        'Integrated Development Environment'
    )
ON DUPLICATE KEY UPDATE
    name = VALUES(name);

-- Projects Sample
INSERT INTO
    projects (
        name,
        description,
        skills,
        start_date,
        end_date,
        github_link,
        live_link,
        team_size
    )
VALUES (
        'Personal Portfolio Website',
        'A responsive personal portfolio website built with PHP, MySQL, and modern CSS. Features include dynamic content management, contact forms, and project showcases.',
        'HTML, CSS, JavaScript, PHP, MySQL, Bootstrap',
        '2024-01-01',
        '2024-02-15',
        'https://github.com/username/portfolio',
        'https://yourportfolio.com',
        1
    ),
    (
        'E-commerce Platform',
        'Full-stack e-commerce solution with user authentication, product catalog, shopping cart, and payment integration using Stripe API.',
        'React, Node.js, Express, MongoDB, Stripe API',
        '2024-02-01',
        '2024-04-30',
        'https://github.com/username/ecommerce',
        'https://yourecommerce.com',
        3
    )
ON DUPLICATE KEY UPDATE
    name = VALUES(name);

-- Certifications Sample
INSERT INTO
    certifications (
        name,
        provider,
        enrollment_no,
        marks,
        skills
    )
VALUES (
        'Web Development Certification',
        'Online Learning Platform',
        'WD2024001',
        '95%',
        'HTML, CSS, JavaScript, PHP'
    ),
    (
        'Full Stack Development',
        'Tech Institute',
        'FS2024002',
        '88%',
        'React, Node.js, MongoDB, Express'
    )
ON DUPLICATE KEY UPDATE
    name = VALUES(name);

-- Others Sample
INSERT INTO
    others (summary, key_expertise)
VALUES (
        'Passionate developer with expertise in modern web technologies, dedicated to creating impactful and efficient solutions.',
        'Web Development, Frontend Development, Backend Development, Database Design'
    )
ON DUPLICATE KEY UPDATE
    summary = VALUES(summary);