<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>DeEnigma Registration Confirmation</title>
                <style>
                /* Reset styles */
                body, html {
                    margin: 0;
                    padding: 0;
                    font-family: Arial, sans-serif;
                }
            
                /* Container styles */
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #f9f9f9;
                }
            
                /* Logo styles */
                .logo {
                    text-align: center;
                    margin-bottom: 20px;
                }
            
                .logo img {
                    max-width: 200px;
                }
            
                /* Content styles */
                .content {
                    text-align: center;
                    margin-bottom: 20px;
                }
            
                .content h2 {
                    color: #333;
                }
            
                .content p {
                    color: #666;
                    margin-bottom: 10px;
                }
            
                .btn {
                    display: inline-block;
                    padding: 10px 20px;
                    background-color: #007bff;
                    color: #fff;
                    text-decoration: none;
                    border-radius: 5px;
                    transition: background-color 0.3s ease;
                }
            
                .btn:hover {
                    background-color: #0056b3;
                }
            
                /* Footer styles */
                .footer {
                    text-align: center;
                    color: #999;
                    font-size: 14px;
                }
            </style>
            </head>
            <body>
                <div class="container">
                    <div class="logo">
                        <img src="https://i.imgur.com/YDZCkjy.png" alt="DeEnigma">
                    </div>
                    <div class="content">
                    <p>We are pleased to inform you that a new user has successfully registered on our website. Below are the details of the new registrant:
                    </p>
                    <p>Name: {{$validated['full_name'];}} </p>
                    <p> Username: {{$validated['user_name'];}}</p>
                    <p>Email: {{$validated['email'];}}</p>

                    <p>
                    Please ensure their registration is reviewed and any necessary follow-up actions are taken promptly. <br />

                    If you need further information or encounter any issues, feel free to contact our support team. <br />

                    Thank you for your attention to this matter. <br />

                    Best regards,<br />
                    </p>
                    </div>
                    <div class="footer">
                        <p>This email was sent to you as part of your DeEnigma registration.</p>
                        <p>&copy; 2024 DeEnigma. All rights reserved.</p>
                    </div>
                </div>
            </body>
            </html>