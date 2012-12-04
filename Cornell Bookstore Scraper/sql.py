import csv
import re
out = open("sql_out.txt", "w")
file = csv.reader(open("all_books_refined.csv", "rb"))

#INSERT INTO book VALUES (null,'9780132302302','STRUCTURE OF AMERICAN INDUSTRY','Brock','PEARSON EDUCATION',148.75,'AMST4281-1','Fall-2012'); 
pattern = re.compile(r'[^\w ]', re.U)


for f in file:
    title = re.sub(r'_', '', re.sub(pattern, '', f[4]))
    publisher = re.sub(r'_', '', re.sub(pattern, '', f[5]))
    author = re.sub(r'_', '', re.sub(pattern, '', f[3]))
    line = "INSERT INTO book VALUES (null,"
    line+= "'%s','%s','%s'," % (f[2],title,author)
    line+= "'%s',%s,'%s','%s'); " % (publisher,f[8].replace('$',''),f[0],f[1])
    out.write(line + "\n");