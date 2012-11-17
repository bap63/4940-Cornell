import selenium
from selenium import webdriver
from selenium.webdriver.support.ui import WebDriverWait
import util
import time
import datetime
import csv

def fetchAll(all):
    dept = util.print_stale_dropdown(driver,"ctl00_ContentPlaceHolder1_deptListDropDownList")
    #dept.reverse()
    for d in dept:
        print "Starting dept: " + d
        driver.get(uriBook)
        time.sleep(1)
        dropID = "ctl00_ContentPlaceHolder1_deptListDropDownList"
        util.click_stale_dropdown(driver, dropID, d)
        time.sleep(1)
        util.print_table(driver,d)

        if all:
            try:
                cl = len(courseLinks)
                i = 0
                try:
                    while cl > i: 
                        for _ in xrange(10): 
                            try:
                                link = util.fetch_stale_table(driver)
                                cur = link[i]
                            except IndexError:
                                print "Regenerating book list..."
                                time.sleep(1)        
                        cur.click()
                        util.fetch_books(driver)
                        driver.get(uriBook)
                        util.click_stale_dropdown(driver, dropID, d)
                        i+=1
                except Exception as e:
                    error = e + " on " + d + "\n"
                    print error
                    log.write(error) 
            except:
                log.write("Could not find books for " + d + "\n")
    
def fetchSingle(depts):
    
    for d in depts:
        print "Starting dept: " + d
        driver.get(uriBook)
        driver.implicitly_wait(1)
        dropID = "ctl00_ContentPlaceHolder1_deptListDropDownList"
        util.click_stale_dropdown(driver, dropID, d)
        driver.implicitly_wait(1)
        courseLinks = util.fetch_stale_table(driver)
        try:
            cl = len(courseLinks)
            i = 0
            try:
                while cl > i: 
                    for _ in xrange(10): 
                        try:
                            link = util.fetch_stale_table(driver)
                            cur = link[i]
                        except IndexError:
                            print "Regenerating book list..."
                            time.sleep(1)       
                    cur.click()
                    util.fetch_books(driver)
                    driver.get(uriBook)
                    util.click_stale_dropdown(driver, dropID, d)
                    i+=1
            except Exception as e:
                error = e + " on " + d + "\n"
                print error
                log.write(error) 
        except:
            log.write("Could not find books for " + d + "\n")
    

now = datetime.datetime.now()	
fn = now.strftime("%Y-%m-%d_%H-%M") + ".txt"
log = open("Logs/"+fn, "w")
uriBook = 'http://textbooks.store.cornell.edu/courseVerifications.aspx'
driver = webdriver.Firefox()
driver.get(uriBook)
raw_input("Login with NETID. Then press enter to continue...")
driver.get(uriBook)


depts = ['ENGL - ENGLISH']
fetchSingle(depts)
#fetchAll(False)