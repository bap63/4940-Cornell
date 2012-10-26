import selenium
from selenium import webdriver
from selenium.webdriver.support.ui import WebDriverWait
import util
import time
#driver.implicitly_wait(1)


uriBook = 'http://textbooks.store.cornell.edu/courseVerifications.aspx'
driver = webdriver.Firefox()
driver.get(uriBook)

raw_input("Login with NETID. Then press enter to continue...")

driver.get(uriBook)

dropID = "ctl00_ContentPlaceHolder1_deptListDropDownList"
util.click_stale_dropdown(driver, dropID, 'INFO - INFORMATION SCIENCE')
time.sleep(1)

#util.print_table(driver,'INFO - INFORMATION SCIENCE')

courseLinks = util.fetch_stale_table(driver)
cl = len(courseLinks)
i = 0
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
    util.click_stale_dropdown(driver, dropID, 'INFO - INFORMATION SCIENCE')
    i+=1