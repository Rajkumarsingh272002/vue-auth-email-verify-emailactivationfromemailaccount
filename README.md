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

![Image](https://github.com/user-attachments/assets/1d4d8e9b-f1e9-4925-9ae7-5b4a809f10c2)
![Image](https://github.com/user-attachments/assets/e5463c2d-80de-4c65-b1a1-3bebaadac8ed)
![Image](https://github.com/user-attachments/assets/8c4507b4-5144-4ec2-adf2-b9924833f0b2)
![Image](https://github.com/user-attachments/assets/a6e65820-6a0b-4376-8a82-edb45388b40f)
![Image](https://github.com/user-attachments/assets/f68cc2d6-3493-489e-b38e-6492396d4715)
![Image](https://github.com/user-attachments/assets/c0ba3487-572b-4098-8258-d6ea99788341)
![Image](https://github.com/user-attachments/assets/57261b0a-9b41-4ce9-9207-9a68084aede7)
![Image](https://github.com/user-attachments/assets/d1698c6d-a6e3-4fc3-b13b-2f81612e39c8)
![Image](https://github.com/user-attachments/assets/62d6f369-e123-4c82-b455-76aec464b9bb)
![Image](https://github.com/user-attachments/assets/7d74e320-5cf1-4665-9597-baaab0f66305)
![Image](https://github.com/user-attachments/assets/f913c0b7-2104-4dc1-8913-6ae329a22f75)
![Image](https://github.com/user-attachments/assets/16bfb35f-3fe2-4253-8414-1292e21bf409)



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
