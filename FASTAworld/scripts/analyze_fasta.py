import sys
import json
from Bio import SeqIO

def analyze_fasta(file_path):
    nucleotide_counts = {"A": 0, "C": 0, "G": 0, "T": 0}
    total_bases = 0
    gc_count = 0

    for record in SeqIO.parse(file_path, "fasta"):
        seq = record.seq.upper()
        for base in nucleotide_counts:
            nucleotide_counts[base] += seq.count(base)
        total_bases += len(seq)
        gc_count += seq.count("G") + seq.count("C")

    gc_content = (gc_count / total_bases * 100) if total_bases > 0 else 0

    return {
        "gc_content": round(gc_content, 2),
        "nucleotide_counts": nucleotide_counts,
    }

if __name__ == "__main__":
    file_path = sys.argv[1]
    result = analyze_fasta(file_path)
    print(json.dumps(result))
