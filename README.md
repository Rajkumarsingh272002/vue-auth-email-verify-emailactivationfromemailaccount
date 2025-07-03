✅ 1. 🔖 Project Name -> vue-auth-email-verify-emailactivationfromemailaccount

✅ 2. 📌 Project Title -> 🔐 Secure User Authentication with Email Verification using Vue.js + PHP
                           ✉️ Email-Based Account Activation System with Vue 3 & PHP API

🎯 Project Aim (प्रोजेक्ट का उद्देश्य)
The primary aim of this project is to implement a secure and user-friendly email-based account verification system that ensures only valid and verified users are allowed to log in to the platform.
It demonstrates how modern front-end frameworks like Vue.js 3 can be effectively combined with PHP APIs and MySQL to build a real-world authentication flow with the following core goals:

✅ Key Objectives (मुख्य उद्देश्य):
1-Secure User Registration:
Users can sign up with an email and password. Their account remains inactive (status = 0) until verified.

2-Email Verification Link with Token:
On signup, the system sends a unique token-based verification link to the user's email using a backend mail service (PHPMailer/Gmail SMTP).

3-Account Activation via Email:
When the user clicks the link, their status is updated from 0 to 1, allowing them to log in.

4-Protected Login Access:
Only users with status = 1 (verified accounts) are allowed to log in, ensuring unauthorized or unverified users are blocked.

5-Frontend-Backend Integration:
Vue 3 frontend with Pinia for state management and Axios for API interaction with PHP backend.

6-Reusable & Scalable Code Structure:
Clean separation of concerns with composables, Vue Router-based navigation, and secure API design — making it extensible for real-world projects.


📸 Screenshots (optional) ->




✅ 3. 💻 Tech Stack (Technologies Used)
                        Layer	Technologies
                        Frontend	HTML, CSS, JavaScript, Bootstrap, Vue.js 3, Pinia, Vue Router, Axios
                        Backend	PHP (API)
                        Database	MySQL
                        Hosting/Runtime	XAMPP (Local), InfinityFree (Deployment)       

✅ Features: ->
User Signup with email & password
Unique token generation for each user
Email sent with activation link
Status-based account activation (status = 0 ➝ 1)
Protected Login (only after activation)
Frontend in Vue 3 with Pinia state management
Backend APIs using PHP and MySQL



🧪 How to Run Locally
Clone the repo
make database(emailverify)
Import emailverify.sql into phpMyAdmin
Start XAMPP (Apache + MySQL) and paste this folder (phpAPI_verifyRegisteredEmailID) into htdocs . this folder(phpAPI_verifyRegisteredEmailID) found from you download all folder form github then you will found backend/htdocs/phpAPI_verifyRegisteredEmailID
Run npm install && npm run dev
Access the app at http://localhost:5173/
