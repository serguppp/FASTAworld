import sys
import json
from Bio import SeqIO
from collections import Counter

def analyze_fasta(file_path):
    try:
        result = []
        for record in SeqIO.parse(file_path,"fasta"):
            data = {
                "id": record.id,
                "description": record.description,
                "sequence": str(record.seq),
                "length": len(record.seq),
                "GC": (record.seq.count('G') + record.seq.count('C')) / len(record.seq) * 100
            }
            result.append(data)
        
        output_path = file_path + '.json'
        with open(output_path, 'w') as output_file:
            json.dump(result, output_file, indent=4)
            print(f"Success")
    except Exception as e:
        print(f"Error")

if __name__ == "__main__":
    file_path = sys.argv[1]
    analyze_fasta(file_path)
