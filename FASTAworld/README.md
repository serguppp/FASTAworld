# Fasta Sequence Analysis Application

This application allows users to upload, analyze, and visualize nucleotide sequences in FASTA format. Using this tool, users can perform various types of sequence analyses, including but not limited to calculating GC content, transcribing to RNA, translating to proteins, finding motifs, and more.

## Features

### 1. **Upload FASTA Files**
   - Users can upload their own FASTA files for analysis.
   - The application supports `.fasta` file formats.
   - **File Type Selection**: It is important to select the correct sequence type (e.g., DNA, RNA) during the file upload process. Some analyses, such as transcription and translation, require the correct file type to produce accurate results.


### 2. **Sequence Analysis**
   Perform various analyses on the nucleotide sequences within the uploaded FASTA file:
   - **GC Content Calculation**: Determine the percentage of guanine (G) and cytosine (C) in the sequence.
   - **Nucleotide Count**: Count occurrences of each nucleotide (A, T, C, G).
   - **Transcription to RNA**: Convert the DNA sequence into RNA by replacing thymine (T) with uracil (U).
   - **Translation to Protein**: Translate the nucleotide sequence into a protein sequence based on the genetic code.
   - **Motif Search**: Search for specific motifs within the nucleotide sequence.
   - **Reverse Complement**: Generate the reverse complement of the sequence.
   - **Sequence Alignment**: Align two sequences to check for similarities or differences.
   - **Palindromic Sequences**: Find sequences that read the same backward as forward.

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
   git clone https://github.com/yourusername/fasta-sequence-analysis.git
2. Navigate to the project directory:
    ```bash
    cd fasta-sequence-analysis
3. Install the dependencies:
    ```bash
    composer Install
4. Set up your .env file for database configuration:
    ```bash
    cp .env.example .env
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

### 2. Performing Analyses
- After uploading a file, you will be redirected to the analysis page where you can:
  - Choose which analyses to perform (e.g., GC Content, Transcription, Translation).
  - The results will be displayed on the same page once the analysis is complete.

### 3. Visualizing Results
- GC content and nucleotide counts will be shown as numerical values.
- Transcription and translation results will display the RNA and protein sequences.
- Sequence alignments and motifs will be visualized with clear annotations.

### 4. File Management
- View details of uploaded files including their name and analysis results.
- Delete files you no longer need.

## Project Structure  

The application follows a standard Laravel project structure, with the following key directories and files:  

- **app/**: Contains the core application logic, including models, controllers, and middleware.  
  - **Http/Controllers/**: Houses the controllers that handle user requests, file uploads, and sequence analyses.  
    - The **auth/** and **requests/** directories, along with `ProfileController`, contain Laravel Breeze's default authentication controllers, which have been customized for this project.  
    - `FileController` is responsible for managing files within the project.  
  - **Models/**: Contains the `File` and `User` models, which interact with the database to manage uploaded files and their metadata.  

- **Providers/**: Contains `AppServiceProvider`, which adds MIME rules for FASTA files.  

- **database/**: Includes migrations and seeders for setting up the database schema and populating data.  
  - **migrations/**: Contains database migrations for setting up tables, including default Laravel Breeze migrations for authentication, system management, and file storage.  

- **resources/**: Holds the views and assets for the front-end of the application.  
  - **views/**: Blade templates for rendering the user interface.  
    - `welcome.blade.php`: The default homepage.  
    - `upload.blade.php`: The default page after logging in.  
    - **auth/**: Contains Laravel Breeze's default authentication views, which are not currently used but may be in the future.  
    - **components/**: Contains reusable view components.  
    - **files/**: Contains views for managing and displaying files.  
    - **profile/**: Contains views for Laravel Breeze's default user profile management.  
  - **css/** and **js/**: Stores the application's CSS and JavaScript files.  

- **routes/**: Defines the application's routes.  
  - `web.php`: Contains routes for file uploads, sequence analyses, and user authentication.  
  - `auth.php`: Defines Laravel Breeze's authentication routes. Currently, only the registration and login routes are used.  

- **public/**: The public-facing directory of the application.  
  - `index.php`: The main entry point for the application.  
  - **storage/uploads/**: Stores all user-uploaded files and analysis results.  
- **scripts/**: Contains Python scripts for analyzing FASTA files.  

- **tests/**: Contains Laravel Breeze's default authentication tests, as well as custom tests for file management in the **File** directory.  

- **.env**: Configuration file for environment settings, including database connection details, application keys, and other essential settings.  


## Technologies Used

- **PHP**: Backend framework for handling server-side logic.
- **Laravel**: PHP framework used for routing, controllers, and database management.
- **Biopython**: A Python library used to handle biological data analysis (e.g., FASTA file parsing and analysis).
- **Blaze**: Authentication system for managing user registration, login, and sessions.
- **MySQL**: Relational database management system used to store and manage user data, uploaded files, and analysis results.
- **JavaScript**: For dynamic updates to the user interface.

## Contributing
Contributions are welcome! If you'd like to improve this project, please feel free to fork the repository, make your changes, and submit a pull request.

## License
This project is licensed under the MIT License – see the LICENSE file for details.
