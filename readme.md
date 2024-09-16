# Font Management System

## Overview
This project is a Font Management System that allows users to upload, manage, and organize fonts into groups. The system is built using PHP and JSON for data storage.

## Technologies Used
- **PHP**: The core programming language used for the backend logic.
- **Composer**: Dependency management for PHP.
- **JQuery**: For any client-side scripting (not shown in the provided code).
- **JSON**: Used for storing font group data.

## Project Structure
- `FontUploader.php`: Handles font uploads, deletions, and retrievals.
- `JsonHandler.php`: Manages font group data stored in a JSON file.
- `FontGroupManager.php`: (Content not provided, assumed to manage font groups).
- `assets/font_groups.json`: JSON file where font group data is stored.
- `fonts/`: Directory where uploaded fonts are stored.

## Prerequisites
- PHP 7.4 or higher
- Composer

## Installation
1. **Clone the repository**:
    ```sh
    git clone https://github.com/yourusername/font-management-system.git
    cd font-management-system
    ```

2. **Install dependencies**:
    ```sh
    composer install
    ```

3. **Set up the environment**:
   Ensure the `fonts/` directory is writable by the web server:
    ```sh
    chmod -R 775 fonts/
    ```

## Usage
1. **Upload a Font**:
    - Use the `upload` method in `FontUploader.php` to upload a TTF font file.

2. **Get Uploaded Fonts**:
    - Use the `getUploadedFonts` method in `FontUploader.php` to retrieve a list of uploaded fonts.

3. **Manage Font Groups**:
    - Use methods in `JsonHandler.php` to create, update, delete, and retrieve font groups.

