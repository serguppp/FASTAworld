# Fasta Sequence Analysis Application

This application allows users to upload, analyze, and visualize nucleotide sequences in FASTA format. Using this tool, users can perform various types of sequence analyses, including but not limited to calculating GC content, transcribing to RNA, translating to proteins, finding motifs, and more.

## Features

### 1. **Upload FASTA Files**
   - Users can upload their own FASTA files for analysis.
   - Users can either paste the sequences [in progress] and create a new file in database
   - The application supports `.fasta` file formats.
   - **File Type Selection**: It is important to select the correct sequence type (e.g., DNA, RNA) during the file upload process. Some analyses, such as transcription and translation, require the correct file type to produce accurate results.


### 2. **Sequence Analysis**
   Perform various analyses on the nucleotide sequences within the uploaded FASTA file:
   - **GC Content Calculation**: Determine the percentage of guanine (G) and cytosine (C) in the sequence.
   - **Nucleotide Count**: Count occurrences of each nucleotide (A, T, C, G).
   - **Transcription to RNA**: Convert the DNA sequence into RNA by replacing thymine (T) with uracil (U). - in progress
   - **Translation to Protein**: Translate the nucleotide sequence into a protein sequence based on the genetic code. - in progress
   - **Motif Search**: Search for specific motifs within the nucleotide sequence. - in progress
   - **Reverse Complement**: Generate the reverse complement of the sequence. - in progress
   - **Sequence Alignment**: Align two sequences to check for similarities or differences. - in progress
   - **Palindromic Sequences**: Find sequences that read the same backward as forward. - in progress

### 3. **File Management**
   - **View File Details**: Display information such as file name, sequence type, and sequence data.
   - **Edit Files**: Owners can edit names and types of files.
   - **Delete Files**: Delete uploaded files if no longer needed.

#### 4. **User Authentication**
   - The authentication system is based on **Blaze** from Laravel, providing secure login, registration, and password management functionalities.
   - Users can register, log in, and log out to manage their files and analyses.
   - **Profile Management**: Users can update their personal information, including:
     - **Change Name**: Update their display name.
     - **Change Email**: Modify their registered email address.
     - **Change Password**: Update their password for enhanced security.
   - **Account Deletion**: Users have the option to delete their account, which removes all associated data from the system.
   - Sessions are managed with Laravel's built-in features to ensure user-specific access to uploaded files and results.


## Installation

1. Clone this repository to your local machine:
   ```bash
   git clone https://github.com/serguppp/FASTAworld.git
2. Navigate to the project directory:
    ```bash
    cd ./FASTAworld/FASTAworld
3. Install the dependencies:
    ```bash
    composer install
    npm install
4. Allow to create SQLite database config
5. Generate the application key:
    ```bash
    php artisan key:generate
6. Run database migrations:
    ```bash 
    php artisan migrate
7. Serve the application:
    ```bash
    composer run dev

## Usage

### 1. Uploading Files
- Navigate to the "Upload" section in the application.
- Choose a .fasta file from your system.
- Select the sequence type (e.g., DNA, RNA, etc.).
- Click "Upload" to submit the file for analysis.

### 2. Viewing and Managing Files
- The files are available on the "Database" page, where you can view, edit, or delete them.
- After viewing a file, a page will be displayed with file details and a basic analysis (GC content, nucleotide count).
- Advanced analysis will be performed after clicking the corresponding button (transcription to RNA, translation, motif search, reverse complement etc.) [in progress].

###

## Project Structure

The application follows a standard Laravel project structure, with the following key directories and files:

- **app/**: Contains the core application logic, including models, controllers, and middleware.
  - **Http/Controllers/**: The controllers that handle user requests, file uploads, and sequence analyses.
  - **Models/**: Contains the file model (`FileUploadController.php`) for interacting with the database to manage uploaded files and their metadata.

- **database/**: Contains the migrations and seeders for setting up the database schema and seeding data.
  - **migrations/**: Database migrations for setting up tables.

- **resources/**: Contains the views and assets for the front-end of the application.
  - **views/**: Blade templates for rendering the user interface.
   
- **routes/**: Contains the `web.php` file that defines the application's routes for pages like uploading files, performing analyses, and managing user authentication.

- **public/**: The public-facing directory for the application. It contains the `index.php` file that serves as the entry point.

- **.env**: Configuration file for environment settings, including the database connection, application key, and other settings.

## Technologies Used

- **PHP**: Backend framework for handling server-side logic.
- **Laravel**: PHP framework used for routing, controllers, and database management.
- **Biopython**: A Python library used to handle biological data analysis (e.g., FASTA file parsing and analysis).
- **Blaze**: Authentication system for managing user registration, login, and sessions.
- **SQLite**: Relational database management system used to store and manage user data, uploaded files, and analysis results.
- **JavaScript**: For dynamic updates to the user interface.

## Contributing
Contributions are welcome! If you'd like to improve this project, please feel free to fork the repository, make your changes, and submit a pull request.

## License
This project is licensed under the MIT License – see the LICENSE file for details.
