Model:	User:
			- add new user
			- get login, pass, mail
			- modify login, pass, mail
			- delete user
		Comment:
			- add new comment
			- add new like
			- delete comment
			- delete like
			- get comments from 1 image
			- get all comment from 1 user
			- get likes from 1 image
			- get all likes from 1 user
			- get like from 1 user in 1 image
			- ? get comments from 1 user in 1 image ?
		Photo:
			- get all photos
			- get all photos from 1 user
			- add new photo

Controller: Setup:
			- instanciate every objects and class from Model/control/view #bootstrapping
			User:
			- check if login/email exists and send creation routine -> send back to home UI with 'check email' notification
			- check if login/pass corresponds and set session_id -> send back to user View
			- unset session_id -> send back to home View
			- remove user -> send back to home View
			- check if pass/mail/login corresponds to login and modify -> send back to parameters View
			
			Comment/likes:
			- check for like and add if not exist -> send back to user View
			- add comment -> send back to user View
			- check for like and delete if exist -> send back to user View
			- delete comment -> send back to user View 
			
			Photos:
			- get all photos -> send back to home View
			- get all photos from 1 user -> send back to personnal user view
			- parse photo and send into db -> send back to webcam view

View: if session id on
		- Personnal account view > 1. like and comments, 2. personnal photos
		- GLobal view
		- Parameters view
	  if session id off
		- Global view
		- create account view
		- login view

Bonus > adding friends and create Private content option
		Adding ajax in view to handle controller requests
		Connect to an api (fb, google...)
		Adding description to image
		adding hashtags to description and comments and link everything
