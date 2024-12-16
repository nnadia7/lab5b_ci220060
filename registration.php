<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <style>
        /* Reset margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex; /* Flexbox for centering */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            min-height: 100vh; /* Ensure full viewport height */
        }

        .container {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            text-align: left;
            color: #555;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        button {
            width: 100%;
            background-color: #ff69b4; /* Pink button */
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #ff1493; /* Darker pink on hover */
        }

        .success {
            color: green;
            margin-bottom: 15px;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form method="POST" action="">
            <label for="matric">Matric:</label>
            <input type="text" name="matric" id="matric" required>

            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <label for="role">Role:</label>
            <select name="role" id="role" required>
                <option value="">Please select</option>
                <option value="Admin">Admin</option>
                <option value="Lecturer">Lecturer</option>
                <option value="Student">Student</option>
            </select>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
