import os,csv

def books():
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
            
def courses():
    out = csv.writer(open("all_courses.csv", "wb"))
    base = os.path.dirname(__file__)
    dir = os.listdir(os.path.join(base, 'Course Lists'))
    for fname in dir:
        data = fname.strip(".csv").split("_")
        file = csv.reader(open(r'Course Lists/'+fname, "rb"))
        for line in file:
            out.writerow(data + line)
            
courses()