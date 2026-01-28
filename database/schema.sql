CREATE DATABASE IF NOT EXISTS klinika_medina CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE klinika_medina;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_role (role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    subtitle VARCHAR(255),
    icon VARCHAR(50),
    description TEXT,
    duration VARCHAR(100),
    price VARCHAR(100),
    availability VARCHAR(255),
    image VARCHAR(255),
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image VARCHAR(255),
    pdf_document VARCHAR(255),
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS team (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    position VARCHAR(255),
    specialty VARCHAR(255),
    image VARCHAR(255),
    bio TEXT,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(255),
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_is_read (is_read),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS about_content (
    id INT AUTO_INCREMENT PRIMARY KEY,
    section VARCHAR(100) NOT NULL,
    title VARCHAR(255),
    content TEXT,
    image VARCHAR(255),
    display_order INT DEFAULT 0,
    created_by INT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_section (section)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users (name, email, password, role) VALUES 
('Administrator', 'admin@medina-ks.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

INSERT INTO about_content (section, title, content, image, display_order, created_by) VALUES
('home', 'Mirësevini në Klinikën Medina', 'Kujdesi mjekësor profesional për ju dhe familjen tuaj', NULL, 0, 1),
('home', 'Mjekë Profesionalë', 'Ekipi ynë i ekspertëve është këtu për t''ju ndihmuar', NULL, 1, 1),
('home', 'Termina Online', 'Rezervoni terminin tuaj lehtësisht dhe shpejt', NULL, 2, 1),
('home', 'Pse të Zgjidhni Klinikën Medina?', '', NULL, 10, 1),
('home', 'Teknologji Moderne', 'Pajisje mjekësore të fundit për diagnostikim dhe trajtim të saktë', '🏥', 11, 1),
('home', 'Mjekë Ekspertë', 'Ekipi ynë përbëhet nga specialistë me përvojë të gjatë', '👨‍⚕️', 12, 1),
('home', 'Orar Fleksibël', 'Jashtë orarit normal për nevojat tuaja urgjente', '⏰', 13, 1),
('home', 'Trajtim Personalizuar', 'Plane trajtimesh të personalizuara për çdo pacient', '💊', 14, 1),
('about', 'Rreth Nesh', 'Klinika Medina ofron kujdes mjekësor profesional për ju dhe familjen tuaj. Ekipi ynë përbëhet nga mjekë dhe infermierë me përvojë.', NULL, 0, 1),
('about', 'Misioni Jonë', 'Të ofrojmë shërbime mjekësore cilësore dhe të arritshme për të gjithë pacientët.', NULL, 1, 1),
('about', 'Vlerat Tona', 'Profesionalizëm, empati dhe përkushtim ndaj shëndetit të pacientëve.', NULL, 2, 1);

