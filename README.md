# Web-Apps-TESI-Calendar
Web Apps project for BC TESI clubs

Authors: Robbie Li, Ayako Mikami, Jonathan Ho

Boston College Entrepreneurship Calendar Project Proposal

Summary

Our proposal is to develop a website that displays an interactive calendar that leaderships (who will be admin users) for all technology and entrepreneurship clubs in Boston College (Information Systems Academy, BCVC, Women in Computer Science, Computer Science Academy, Women Innovators Network, etc.) are able to post their dates for future events. This will allow the students and general members of the clubs to easily see all the tech and entrepreneurship events going on in campus. 

If a student visiting the website sees an event they want to attend, he or she can click on the event and fill out a form (Name, Eagle ID, bc email) and through javascript function determines whether the person is able to attend the event (e.g. has the event reached capacity limit?) and in that case they have the option to be added on the waitlist. On the backend there will be a sql table with the information and status column (going, waitlisted). Every time a member who has RSVP’d decides to cancel, the first person with the status of “waitlisted” will be updated to “going”, and will receive a notification email of their status change. This will be useful since BC’s event create/monitor system, OrgSync, does not have any way of automatically updating waitlisted members’ status once someone else who was supposed to attend the event cancels.

Features

Global calendar showing all entrepreneurship events on campus
Filter by club/organization
Add / Integrate calendar with personal calendar
Event RSVP
RSVP to event form
Waitlist functionality
Admin Database
Add new admin form
Email admin group form
*Listserv Subscription form*
Join general listserv


Technology Specs

HTML / CSS front end design
Javascript and PHP on backend: use to validate users, insert new users (Join Form like we did in HW12), php to allow admin users to send out emails to other people in the database 
SQL for database that stores all the admin users’ (leadership/faculty involved in tech & entrepreneurship) names and emails, and their club type 
Also holds password for club contacts to add events
Google Calendar API for calendar integration (Program in PHP, Java, Python, or Ruby)

