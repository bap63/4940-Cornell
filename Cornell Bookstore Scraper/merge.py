import os,csv

out = csv.writer(open("all_books.csv", "wb"))
base = os.path.dirname(__file__)
dir = os.listdir(os.path.join(base, 'Book Lists'))
for fname in dir:
    data = fname.strip(".csv").split("_")
    #print data[0]
    #print data[1]
    file = csv.reader(open(r'Book Lists/'+fname, "rb"))
    for line in file:
        out.writerow(data + line)

    
    