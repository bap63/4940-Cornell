import csv
import re

#INSERT INTO book VALUES (null,'9780132302302','STRUCTURE OF AMERICAN INDUSTRY','Brock','PEARSON EDUCATION',148.75,'AMST4281-1','Fall-2012');
#INSERT INTO course VALUES (null,'name','term','instructor'); 
pattern = re.compile(r'[^\w ]', re.U)

def books():
    out = open("sql_out_books.sql", "w")
    file = csv.reader(open("all_books_refined.csv", "rb"))
    for f in file:
        title = re.sub(r'_', '', re.sub(pattern, '', f[4])).strip()
        publisher = re.sub(r'_', '', re.sub(pattern, '', f[5])).strip()
        author = re.sub(r'_', '', re.sub(pattern, '', f[3])).strip()
        courseName = f[0].strip().split('-')[0]
        term = f[1].strip()
        price = f[8].replace('$','')
        isbn = f[2]
    
        line = "INSERT INTO book VALUES (null,"
        line+= "'%s','%s','%s'," % (isbn,title,author)
        line+= "'%s',%s,'%s','%s'); " % (publisher,price,courseName,term)
        out.write(line + "\n");

def courses():
    out = open("sql_out_courses.sql", "w")
    file = csv.reader(open("all_courses.csv", "rb"))
    for f in file:
        dept = re.sub(r'_', '', re.sub(pattern, '', f[2])).strip()
        number =f[3].strip()
        term = re.sub(r'_', '', re.sub(pattern, '', f[1])).strip()
        term = term.replace(' ','-')
        name = dept+"-"+number
        instructor = re.sub(r'_', '', re.sub(pattern, '', f[5])).strip()
        line = "INSERT INTO course VALUES"
        line +=  "(null,'%s','%s','%s'); " % (name,term,instructor)
        out.write(line + "\n");
        
def missingCourse():
    out = open("sql_out_courses_missing.sql", "w")
    file = csv.reader(open("missing.csv", "rb"))
    for f in file:
        name =f[0].strip()
        term = f[1].strip()
        r = re.compile("([a-zA-Z]+)([0-9]+)")
        m = r.match(name)
        name = m.group(1) + "-" + m.group(2)
        line = "INSERT INTO course VALUES"
        line +=  "(null,'%s','%s','%s'); " % (name,term,'')
        out.write(line + "\n");
        
missingCourse()
#courses()
#books()