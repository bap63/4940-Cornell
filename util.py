import time
import csv
import re
import selenium
from selenium import webdriver
from selenium.webdriver.support.ui import WebDriverWait

def click_stale_dropdown(self, elem_id, item_text): 
        for _ in xrange(10): 
            try: 
                elem = self.find_element_by_id(elem_id) 
                for option in elem.find_elements_by_tag_name('option'): 
                    if option.text == item_text: 
                        option.click()
                        print "Succesfully loaded course listing"
                        return ""  
            except Exception as e: 
                print e
                print "Retrying..."
                time.sleep(1)
                
def fetch_stale_table(self): 
        for _ in xrange(5): 
            try:
                links = []
                courseLinks = self.find_elements_by_tag_name("a")
                #print len(courseLinks)
                for c in courseLinks:
                    if c.get_attribute('class') == 'selectButton':
                        links.append(c)
                #print "Succesfully retrieved book table"
                return links
            except Exception as e: 
                #print e
                print "Retrying to print book table..."
                time.sleep(2)                
                
def print_table(self, dept): 
        for _ in xrange(10): 
                try:
                        out = csv.writer(open("Course Lists/"+dept+".csv", "wb"))
                        courseLinks = self.find_elements_by_tag_name("tr")
                        for tr in courseLinks:
                                row = []
                                for td in tr.find_elements_by_tag_name("td"):
                                        entry = td.text.strip()
                                        if not entry == "Select":
                                                row.append(entry)
                                if len(row) == 7:
                                        out.writerow(row)
                        print "Succesfully wrote file for " + dept
                        return "" 
                except Exception as e: 
                        #print e
                        print "Retrying to print course table..."
                        time.sleep(1)
                
def fetch_books(self):
        for _ in xrange(10): 
                try:
                        yearTag = self.find_element_by_id("ctl00_ContentPlaceHolder1_termSelectedLabel").text
                        yTag = re.sub(r'Displaying textbooks for:','',yearTag).strip()
                        yT = re.sub(r' ','-',yTag)
                        deptTag = self.find_element_by_id("ctl00_ContentPlaceHolder1_deptSelectedLabel").text
                        dTag = re.sub(r'Department:','',deptTag).strip()  
                        courseNumber = self.find_element_by_id("ctl00_ContentPlaceHolder1_courseSelectedLabel").text
                        cn = re.sub(r'Course:','',courseNumber).strip()
                        
                        fn = dTag+cn+"_"+yT+".csv"
                        out = csv.writer(open("Book Lists/"+fn, "wb"))
                        
                        table = self.find_element_by_id("ctl00_ContentPlaceHolder1_bookListDetailsGridView")
                        for tr in table.find_elements_by_tag_name("tr"):
                                row = []
                                for td in tr.find_elements_by_tag_name("td"):
                                        entry = td.text.strip()
                                        row.append(entry)
                                        #print entry
                                if len(row) == 7:
                                        out.writerow(row)
                        print "Wrote file " + fn
                        return ""
                except Exception as e: 
                        #print e
                        print "Retrying book fetch..."
                        time.sleep(1)
                        