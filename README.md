# Fasta Sequence Analysis Application

This application allows users to upload, analyze, and visualize nucleotide sequences in FASTA format. Using this tool, users can perform various types of sequence analyses, including but not limited to calculating GC content, transcribing to RNA, translating to proteins, finding motifs, and more.

## Features

### 1. **Upload FASTA Files**
   - Users can upload their own FASTA files for analysis.
   - The application supports `.fasta` file formats.

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

## Technologies Used
- **PHP**: Backend framework for handling server-side logic.
- **Laravel**: PHP framework used for routing, controllers, and database management.
- **Biopython**: A Python library used to handle biological data analysis (e.g., FASTA file parsing and analysis).
- **JavaScript (optional)**: For dynamic updates to the user interface.

## Contributing
Contributions are welcome! If you'd like to improve this project, please feel free to fork the repository, make your changes, and submit a pull request.

## License
This project is licensed under the MIT License – see the LICENSE file for details.
